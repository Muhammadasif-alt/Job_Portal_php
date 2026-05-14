<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSyncLog extends Model
{
    public const STATUS_RUNNING = 'running';

    public const STATUS_SUCCESS = 'success';

    public const STATUS_FAILED = 'failed';

    protected $fillable = [
        'source',
        'status',
        'imported',
        'skipped',
        'file_size_bytes',
        'duration_seconds',
        'triggered_by',
        'error_message',
        'started_at',
        'finished_at',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'finished_at' => 'datetime',
        ];
    }

    public function getFileSizeHumanAttribute(): string
    {
        $bytes = (int) $this->file_size_bytes;
        if ($bytes <= 0) {
            return '—';
        }
        if ($bytes < 1024) {
            return $bytes.' B';
        }
        if ($bytes < 1024 * 1024) {
            return number_format($bytes / 1024, 1).' KB';
        }

        return number_format($bytes / 1024 / 1024, 2).' MB';
    }

    public function getDurationHumanAttribute(): string
    {
        $sec = (int) $this->duration_seconds;
        if ($sec <= 0) {
            return '—';
        }
        if ($sec < 60) {
            return $sec.'s';
        }
        $m = intdiv($sec, 60);
        $s = $sec % 60;

        return $m.'m '.($s ? $s.'s' : '');
    }
}
