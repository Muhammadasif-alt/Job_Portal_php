<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobSyncLog;
use Illuminate\Support\Facades\Artisan;

/**
 * Admin dashboard for the Jobg8 hourly job-import sync. Shows last run
 * summary + history table, and exposes a "Sync Now" button.
 */
class JobSyncController extends Controller
{
    public function index()
    {
        $latest = JobSyncLog::where('source', 'jobg8')->latest('started_at')->first();
        $history = JobSyncLog::where('source', 'jobg8')
            ->latest('started_at')
            ->limit(20)
            ->get();

        return view('admin.jobs.sync', compact('latest', 'history'));
    }

    public function trigger()
    {
        // Run synchronously so the admin sees the result immediately. The
        // command itself extends time-limit / handles long-running imports.
        try {
            Artisan::call('jobs:sync-jobg8', ['--triggered-by' => 'admin']);

            return back()->with('success', 'Sync started. Check the table below for the result.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Could not start sync: '.$e->getMessage());
        }
    }
}
