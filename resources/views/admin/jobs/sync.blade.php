@extends('admin.layouts.app')

@section('content')
<style>
    .sync-wrap { padding: 24px; max-width: 1100px; }
    .sync-head { display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:14px; margin-bottom: 22px; }
    .sync-head h1 {
        font-size: 26px; font-weight: 800; margin: 0; letter-spacing: -.4px;
        background: linear-gradient(90deg, #0a0a0a, #404040);
        -webkit-background-clip: text; background-clip: text;
        -webkit-text-fill-color: transparent; color: transparent;
    }
    .sync-head .breadcrumbs { font-size: 14px; color: #6b7280; margin-top: 4px; }
    .sync-head .breadcrumbs a { color: #0a0a0a; text-decoration: none; font-weight: 600; }

    /* Status hero */
    .status-hero {
        position: relative; background: #0a0a0a; color: #fff;
        border-radius: 22px; padding: 30px 32px; overflow: hidden;
        margin-bottom: 24px;
    }
    .status-hero::before, .status-hero::after {
        content:""; position:absolute; border-radius:50%; filter:blur(80px); opacity:.35; pointer-events:none;
    }
    .status-hero::before { width:240px; height:240px; background:#ff8a00; top:-90px; right:-50px; }
    .status-hero::after  { width:280px; height:280px; background:#5e2bff; bottom:-110px; left:-90px; }
    .status-hero .row-flex {
        display: flex; justify-content: space-between; align-items: center;
        flex-wrap: wrap; gap: 18px; position: relative; z-index: 2;
    }
    .status-hero h2 { font-size: 24px; font-weight: 800; margin: 0 0 4px; letter-spacing: -.3px; }
    .status-hero p  { margin: 0; color: rgba(255,255,255,.7); font-size: 14px; }

    .status-pill {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 6px 14px; border-radius: 999px;
        font-size: 12.5px; font-weight: 700; letter-spacing: .3px;
        text-transform: uppercase;
    }
    .status-pill.success { background: rgba(16,185,129,.18); color: #6ee7b7; }
    .status-pill.failed  { background: rgba(239,68,68,.18);  color: #fca5a5; }
    .status-pill.running { background: rgba(96,165,250,.18); color: #93c5fd; }
    .status-pill.none    { background: rgba(255,255,255,.12); color: #fff; }

    .stat-row {
        display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px;
        margin-top: 24px; position: relative; z-index: 2;
    }
    @media (max-width: 720px) { .stat-row { grid-template-columns: repeat(2, 1fr); } }
    .stat-card {
        background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.08);
        border-radius: 14px; padding: 16px 18px;
    }
    .stat-card .lbl { font-size: 11px; font-weight: 700; letter-spacing: .8px; color: rgba(255,255,255,.55); text-transform: uppercase; }
    .stat-card .val { font-size: 22px; font-weight: 800; margin-top: 4px; }

    .sync-btn {
        display: inline-flex; align-items: center; gap: 8px;
        background: #fff; color: #0a0a0a;
        padding: 12px 20px; border-radius: 10px;
        font-size: 14px; font-weight: 700; border: none; cursor: pointer;
        text-decoration: none;
        transition: transform .15s ease, box-shadow .15s ease;
    }
    .sync-btn:hover { transform: translateY(-1px); box-shadow: 0 10px 22px rgba(0,0,0,.18); color:#0a0a0a; }
    .sync-btn[disabled] { opacity: .7; cursor: wait; }
    .sync-btn i.spin { animation: sync-spin 1s linear infinite; transform-origin:center; display:inline-block; }
    @keyframes sync-spin { to { transform: rotate(360deg); } }

    /* History table */
    .history-card {
        background: #fff; border: 1px solid #eef0f4; border-radius: 16px; overflow: hidden;
    }
    .history-head { padding: 18px 22px; border-bottom: 1px solid #eef0f4; }
    .history-head h3 { margin:0; font-size: 16.5px; font-weight: 700; color: #0a0a0a; display:inline-flex; align-items:center; gap:8px; }
    .history-table { width: 100%; border-collapse: collapse; }
    .history-table th, .history-table td { padding: 12px 22px; text-align: left; font-size: 13.5px; }
    .history-table th { background: #fafbff; font-weight: 700; color: #374151; font-size: 12px; text-transform: uppercase; letter-spacing: .5px; border-bottom: 1px solid #eef0f4; }
    .history-table tr + tr td { border-top: 1px solid #f3f4f6; }
    .history-table .pill {
        display: inline-flex; align-items:center; gap:5px;
        padding: 3px 10px; border-radius: 999px;
        font-size: 11.5px; font-weight: 700; text-transform: uppercase;
    }
    .history-table .pill.success { background: #ecfdf5; color: #047857; }
    .history-table .pill.failed  { background: #fef2f2; color: #b91c1c; }
    .history-table .pill.running { background: #eff6ff; color: #1d4ed8; }
    .history-table .when { color: #6b7280; font-size: 12.5px; }

    .empty {
        padding: 50px 30px; text-align: center; color: #6b7280; font-size: 14px;
    }
    .empty i { font-size: 36px; color: #c7c7cc; margin-bottom: 10px; display:inline-block; }

    .alert-flash {
        padding: 12px 18px; border-radius: 12px; margin-bottom: 18px;
        font-size: 13.5px; display: flex; justify-content: space-between; align-items: center; gap: 10px;
    }
    .alert-flash.success { background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; }
    .alert-flash.danger  { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }
</style>

<div class="sync-wrap">
    <div class="sync-head">
        <div>
            <h1>Jobg8 Auto-Sync</h1>
            <div class="breadcrumbs">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span class="mx-1">/</span>
                <a href="{{ route('admin.jobs.index') }}">Jobs</a>
                <span class="mx-1">/</span>
                <span>Auto-Sync</span>
            </div>
        </div>
        <a href="{{ route('admin.jobs.index') }}" class="btn btn-light">
            <i class="bi bi-arrow-left"></i> Back to Jobs
        </a>
    </div>

    @if (session('success'))
        <div class="alert-flash success">
            <span><i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" style="background:none;border:none;color:inherit;opacity:.6;cursor:pointer;"><i class="bi bi-x-lg"></i></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert-flash danger">
            <span><i class="bi bi-exclamation-triangle-fill me-1"></i> {{ session('error') }}</span>
            <button onclick="this.parentElement.remove()" style="background:none;border:none;color:inherit;opacity:.6;cursor:pointer;"><i class="bi bi-x-lg"></i></button>
        </div>
    @endif

    {{-- ========== Status hero ========== --}}
    <div class="status-hero">
        <div class="row-flex">
            <div>
                <h2>Hourly job feed sync</h2>
                <p>Downloads Jobs.zip from Jobg8 every hour, extracts the spreadsheet, and imports new rows (duplicates auto-skipped).</p>
            </div>

            <form method="POST" action="{{ route('admin.jobs.sync.trigger') }}" id="syncForm">
                @csrf
                <button type="submit" class="sync-btn" id="syncBtn">
                    <i class="bi bi-arrow-clockwise"></i>
                    Sync Now
                </button>
            </form>
        </div>

        <div class="stat-row">
            <div class="stat-card">
                <div class="lbl">Last status</div>
                <div class="val">
                    @if($latest)
                        @php $cls = $latest->status === 'success' ? 'success' : ($latest->status === 'failed' ? 'failed' : 'running'); @endphp
                        <span class="status-pill {{ $cls }}">
                            <i class="bi bi-{{ $latest->status === 'success' ? 'check-circle-fill' : ($latest->status === 'failed' ? 'exclamation-triangle-fill' : 'arrow-clockwise') }}"></i>
                            {{ $latest->status }}
                        </span>
                    @else
                        <span class="status-pill none"><i class="bi bi-dash-circle"></i> Never run</span>
                    @endif
                </div>
            </div>
            <div class="stat-card">
                <div class="lbl">Last run</div>
                <div class="val">{{ $latest ? $latest->started_at->diffForHumans() : '—' }}</div>
            </div>
            <div class="stat-card">
                <div class="lbl">Last imported</div>
                <div class="val">{{ $latest ? number_format($latest->imported) : '—' }}</div>
            </div>
            <div class="stat-card">
                <div class="lbl">Last skipped</div>
                <div class="val">{{ $latest ? number_format($latest->skipped) : '—' }}</div>
            </div>
        </div>
    </div>

    {{-- ========== Sync history ========== --}}
    <div class="history-card">
        <div class="history-head">
            <h3><i class="bi bi-clock-history"></i> Sync History <span style="font-size:12px;color:#9ca3af;font-weight:500;margin-left:6px;">(last 20 runs)</span></h3>
        </div>
        @if($history->isEmpty())
            <div class="empty">
                <i class="bi bi-inboxes"></i>
                <div>No syncs yet. Click <strong>Sync Now</strong> to run the first one, or wait for the hourly schedule.</div>
            </div>
        @else
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Started</th>
                        <th>Imported</th>
                        <th>Skipped</th>
                        <th>Size</th>
                        <th>Duration</th>
                        <th>Trigger</th>
                        <th>Error</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($history as $row)
                        <tr>
                            <td><span class="pill {{ $row->status }}"><i class="bi bi-{{ $row->status === 'success' ? 'check' : ($row->status === 'failed' ? 'x' : 'arrow-clockwise') }}"></i> {{ $row->status }}</span></td>
                            <td>
                                <div>{{ $row->started_at->format('M d, Y H:i') }}</div>
                                <div class="when">{{ $row->started_at->diffForHumans() }}</div>
                            </td>
                            <td>{{ number_format($row->imported) }}</td>
                            <td>{{ number_format($row->skipped) }}</td>
                            <td>{{ $row->file_size_human }}</td>
                            <td>{{ $row->duration_human }}</td>
                            <td><code style="font-size:11.5px;background:#f3f4f6;padding:2px 6px;border-radius:4px;">{{ $row->triggered_by }}</code></td>
                            <td style="max-width:260px;">
                                @if($row->error_message)
                                    <span style="color:#b91c1c;font-size:12px;" title="{{ $row->error_message }}">
                                        {{ \Illuminate\Support\Str::limit($row->error_message, 60) }}
                                    </span>
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

<script>
    document.getElementById('syncForm')?.addEventListener('submit', function () {
        const btn = document.getElementById('syncBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="bi bi-arrow-clockwise spin"></i> Syncing… (this can take a few minutes)';
    });
</script>
@endsection
