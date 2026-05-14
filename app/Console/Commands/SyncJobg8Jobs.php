<?php

namespace App\Console\Commands;

use App\Imports\JobsImport;
use App\Models\JobSyncLog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;
use XMLReader;
use ZipArchive;

/**
 * Hourly sync that pulls the Jobg8 jobs ZIP, unpacks it, and imports new jobs.
 *
 * Jobg8 ships a Jobs.xml inside the ZIP (not Excel). The command supports
 * both formats:
 *   - .xml         → streamed XMLReader, rows piped through JobsImport::model()
 *   - .xlsx/.xls/.csv → existing JobsImport via Maatwebsite Excel
 *
 * Triggered by: schedule (hourly) OR the admin "Sync Now" button.
 */
class SyncJobg8Jobs extends Command
{
    protected $signature = 'jobs:sync-jobg8
                            {--triggered-by=schedule : Who started this run (schedule|admin)}';

    protected $description = 'Download the Jobg8 jobs ZIP, extract Jobs.xml (or Excel), and import new jobs.';

    public function handle(): int
    {
        @set_time_limit(1800);

        $username = config('services.jobg8.username');
        $password = config('services.jobg8.password');
        $accountNumber = config('services.jobg8.account_number');
        $filename = config('services.jobg8.filename', 'Jobs.zip');
        $endpoint = config('services.jobg8.endpoint', 'https://www.jobg8.com/fileserver/jobs.aspx');

        if (! $username || ! $password || ! $accountNumber) {
            $this->error('Jobg8 credentials are missing. Set JOBG8_USERNAME / JOBG8_PASSWORD / JOBG8_ACCOUNT_NUMBER in .env.');

            return self::FAILURE;
        }

        $log = JobSyncLog::create([
            'source' => 'jobg8',
            'status' => JobSyncLog::STATUS_RUNNING,
            'triggered_by' => $this->option('triggered-by') ?: 'schedule',
            'started_at' => now(),
        ]);

        $start = microtime(true);
        $tmpZip = storage_path('app/jobg8/'.now()->format('Ymd_His').'_'.$filename);
        $extract = storage_path('app/jobg8/extract_'.$log->id);

        try {
            @mkdir(dirname($tmpZip), 0775, true);
            @mkdir($extract, 0775, true);

            // 1) Download ZIP
            $this->info('Downloading from Jobg8...');
            $response = Http::timeout(300)
                ->withOptions(['sink' => $tmpZip])
                ->get($endpoint, [
                    'username' => $username,
                    'password' => $password,
                    'accountnumber' => $accountNumber,
                    'filename' => $filename,
                ]);

            if (! $response->successful()) {
                throw new \RuntimeException('Jobg8 download failed: HTTP '.$response->status());
            }

            $fileSize = filesize($tmpZip) ?: 0;
            if ($fileSize < 1024) {
                $body = trim((string) file_get_contents($tmpZip));
                throw new \RuntimeException('Jobg8 returned a short response ('.$fileSize.' bytes): "'.\Illuminate\Support\Str::limit($body, 200).'". Likely rate-limit ("Download Recently Performed") — try again in a few minutes.');
            }
            $log->update(['file_size_bytes' => $fileSize]);

            // 2) Extract — stream files out one-by-one. extractTo() silently fails
            // on Windows for very large extracted payloads (Jobg8's Jobs.xml is ~340 MB).
            $this->info('Extracting ZIP ('.number_format($fileSize / 1024 / 1024, 2).' MB)...');
            $zip = new ZipArchive;
            if ($zip->open($tmpZip) !== true) {
                throw new \RuntimeException('Could not open the downloaded ZIP file.');
            }
            $extractedFiles = [];
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $name = $zip->getNameIndex($i);
                if (! $name || str_ends_with($name, '/')) {
                    continue;
                }

                $dest = $extract.DIRECTORY_SEPARATOR.basename($name);
                $src = $zip->getStream($name);
                if (! $src) {
                    continue;
                }
                $dst = fopen($dest, 'wb');
                if (! $dst) {
                    fclose($src);

                    continue;
                }
                while (! feof($src)) {
                    $chunk = fread($src, 1024 * 1024); // 1 MB at a time
                    if ($chunk === false) {
                        break;
                    }
                    fwrite($dst, $chunk);
                }
                fclose($src);
                fclose($dst);
                $extractedFiles[] = $dest;
                $this->info('  Extracted: '.basename($name).' ('.number_format(filesize($dest) / 1024 / 1024, 1).' MB)');
            }
            $zip->close();

            if (empty($extractedFiles)) {
                throw new \RuntimeException('ZIP extracted no files — archive may be empty or corrupted.');
            }

            // 3) Pick the data file from the extracted list directly (avoids race
            // conditions with the filesystem iterator on very large files).
            // Prefer XML (Jobg8 default), then spreadsheet.
            $dataFile = null;
            $kind = null;
            foreach (['xml', 'xlsx', 'xls', 'csv'] as $preferExt) {
                foreach ($extractedFiles as $path) {
                    if (strtolower(pathinfo($path, PATHINFO_EXTENSION)) === $preferExt) {
                        $dataFile = $path;
                        $kind = $preferExt;
                        break 2;
                    }
                }
            }
            if (! $dataFile) {
                $names = array_map('basename', $extractedFiles);
                throw new \RuntimeException('No xml/xlsx/xls/csv found in ZIP. Files present: '.implode(', ', $names));
            }
            $this->info('Found '.$kind.' file: '.basename($dataFile).' ('.number_format(filesize($dataFile) / 1024 / 1024, 1).' MB)');

            // 4) Run the importer
            $importer = new JobsImport;

            if ($kind === 'xml') {
                $this->importXml($dataFile, $importer);
            } else {
                Excel::import($importer, $dataFile);
            }

            $duration = (int) round(microtime(true) - $start);
            $log->update([
                'status' => JobSyncLog::STATUS_SUCCESS,
                'imported' => $importer->imported,
                'skipped' => $importer->skipped,
                'duration_seconds' => $duration,
                'finished_at' => now(),
            ]);

            $this->info("Done — imported {$importer->imported}, skipped {$importer->skipped} (took {$duration}s).");

            return self::SUCCESS;
        } catch (Throwable $e) {
            $log->update([
                'status' => JobSyncLog::STATUS_FAILED,
                'duration_seconds' => (int) round(microtime(true) - $start),
                'error_message' => $e->getMessage(),
                'finished_at' => now(),
            ]);
            $this->error('Jobg8 sync failed: '.$e->getMessage());

            return self::FAILURE;
        } finally {
            $this->cleanup($tmpZip, $extract);
        }
    }

    /**
     * Stream the Jobs.xml using XMLReader (memory-efficient even at 100K+ jobs).
     * Each <Job> child element becomes an associative array fed to JobsImport::model().
     * Returns the importer's $imported/$skipped counters via reference.
     */
    private function importXml(string $xmlPath, JobsImport $importer): void
    {
        $reader = new XMLReader;
        if (! $reader->open($xmlPath, null, LIBXML_NOERROR | LIBXML_NOWARNING)) {
            throw new \RuntimeException('Could not open Jobs.xml for streaming.');
        }

        $rows = 0;
        DB::beginTransaction();
        try {
            while ($reader->read()) {
                // Find <Job> elements — case-insensitive match
                if ($reader->nodeType !== XMLReader::ELEMENT) {
                    continue;
                }
                if (strcasecmp($reader->name, 'Job') !== 0) {
                    continue;
                }

                $jobXml = $reader->readOuterXml();
                if (! $jobXml) {
                    continue;
                }

                $row = $this->jobXmlToRow($jobXml);
                if (! $row) {
                    continue;
                }

                $model = $importer->model($row);
                if ($model) {
                    $model->save();
                }

                $rows++;
                // Commit in chunks so a crash doesn't waste minutes of progress
                if ($rows % 500 === 0) {
                    DB::commit();
                    DB::beginTransaction();
                    $this->info("  ...processed {$rows} so far (imported={$importer->imported}, skipped={$importer->skipped})");
                }
            }
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        } finally {
            $reader->close();
        }
    }

    /**
     * Convert one <Job>...</Job> XML chunk into the LOWERCASE-keyed associative
     * array that JobsImport::model() expects.
     */
    private function jobXmlToRow(string $jobXml): ?array
    {
        $simple = @simplexml_load_string($jobXml);
        if (! $simple) {
            return null;
        }

        $row = [];
        foreach ($simple->children() as $child) {
            $key = strtolower(preg_replace('/[^a-z0-9]/i', '', (string) $child->getName()));
            $row[$key] = trim((string) $child);
        }
        if (empty($row)) {
            return null;
        }

        // Map Jobg8 XML field names → JobsImport's expected keys.
        // JobsImport already supports several aliases; we just add the canonical Jobg8 ones.
        $aliases = [
            'title' => 'position', // Jobg8 uses <Title>; importer reads $row['position']
        ];
        foreach ($aliases as $from => $to) {
            if (isset($row[$from]) && ! isset($row[$to])) {
                $row[$to] = $row[$from];
            }
        }

        return $row;
    }

    /** Returns [path, kind] where kind is 'xml'|'xlsx'|'xls'|'csv', or [null, null]. */
    private function findDataFile(string $dir): array
    {
        // Two-pass: prefer xml first, then spreadsheet
        $found = ['xml' => null, 'xlsx' => null, 'xls' => null, 'csv' => null];
        $rii = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS));
        foreach ($rii as $file) {
            if (! $file->isFile()) {
                continue;
            }
            $ext = strtolower($file->getExtension());
            if (isset($found[$ext]) && ! $found[$ext]) {
                $found[$ext] = $file->getPathname();
            }
        }
        foreach (['xml', 'xlsx', 'xls', 'csv'] as $ext) {
            if ($found[$ext]) {
                return [$found[$ext], $ext];
            }
        }

        return [null, null];
    }

    /** Best-effort temp cleanup. Failures are non-fatal. */
    private function cleanup(string $zipPath, string $extractDir): void
    {
        try {
            @unlink($zipPath);
        } catch (Throwable) {
        }
        try {
            if (is_dir($extractDir)) {
                $rii = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($extractDir, \FilesystemIterator::SKIP_DOTS),
                    \RecursiveIteratorIterator::CHILD_FIRST
                );
                foreach ($rii as $file) {
                    $file->isDir() ? @rmdir($file->getPathname()) : @unlink($file->getPathname());
                }
                @rmdir($extractDir);
            }
        } catch (Throwable) {
        }
    }
}
