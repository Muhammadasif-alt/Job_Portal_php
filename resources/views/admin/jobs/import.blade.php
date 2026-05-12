@extends('admin.layouts.app')

@section('content')
<style>
    .form-wrap { padding: 24px; max-width: 900px; }
    .form-head { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 22px; }
    .form-head h1 {
        font-size: 26px; font-weight: 800; margin: 0; letter-spacing: -.4px;
        background: linear-gradient(90deg, #0a0a0a, #404040);
        -webkit-background-clip: text; background-clip: text;
        -webkit-text-fill-color: transparent; color: transparent;
    }
    .form-head .breadcrumbs { font-size: 14px; color: #6b7280; margin-top: 4px; }
    .form-head .breadcrumbs a { color: #0a0a0a; text-decoration: none; font-weight: 600; }
    .form-head .breadcrumbs a:hover { text-decoration: underline; }

    .panel {
        background: #fff;
        border: 1px solid #eef0f4;
        border-radius: 16px;
        margin-bottom: 22px;
        overflow: hidden;
    }
    .panel-head {
        padding: 18px 22px;
        border-bottom: 1px solid #eef0f4;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    .panel-head h3 {
        font-size: 16.5px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .panel-head h3 i { color: #0a0a0a; font-size: 18px; }
    .panel-body { padding: 24px; }

    .field { margin-bottom: 20px; }
    .field:last-child { margin-bottom: 0; }
    .field label {
        display: block;
        font-size: 13.5px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 7px;
    }
    .field .help-text { font-size: 12.5px; color: #6b7280; margin-top: 6px; }

    /* Drag & drop file zone */
    .dropzone {
        border: 2px dashed #d1d5db;
        border-radius: 14px;
        padding: 42px 22px;
        text-align: center;
        cursor: pointer;
        background: #fafbff;
        transition: border-color .15s ease, background .15s ease;
        display: block;
    }
    .dropzone:hover, .dropzone.dragover {
        border-color: #0a0a0a;
        background: #f3f4f6;
    }
    .dropzone i { font-size: 44px; color: #0a0a0a; margin-bottom: 10px; display: inline-block; }
    .dropzone .dz-text { font-weight: 600; color: #0f172a; font-size: 15px; }
    .dropzone .dz-sub  { font-size: 13px; color: #6b7280; margin-top: 5px; }
    .dropzone input[type="file"] { display: none; }
    .dropzone.has-file { background: #f3f4f6; border-color: #0a0a0a; }
    .dropzone.has-file i { color: #0a0a0a; }
    .dropzone .file-name { color: #0a0a0a; font-weight: 600; font-size: 14px; margin-top: 8px; word-break: break-all; }
    .dropzone .file-meta { font-size: 12px; color: #6b7280; margin-top: 2px; }

    /* Custom checkbox row */
    .check-row {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 14px 16px;
        border: 1px solid #eef0f4;
        border-radius: 12px;
        background: #fafbff;
        cursor: pointer;
        transition: border-color .15s ease, background .15s ease;
    }
    .check-row:hover { border-color: #0a0a0a; background: #f3f4f6; }
    .check-row input { accent-color: #0a0a0a; margin-top: 3px; width: 18px; height: 18px; }
    .check-row .label { font-weight: 600; color: #0f172a; font-size: 14px; }
    .check-row .desc  { font-size: 12.5px; color: #6b7280; margin-top: 2px; line-height: 1.5; }

    /* Info card */
    .info-card {
        padding: 16px 18px;
        background: #f8faff;
        border-left: 3px solid #0a0a0a;
        border-radius: 10px;
        font-size: 13.5px;
        color: #4b5563;
        line-height: 1.6;
    }
    .info-card strong { color: #0f172a; }
    .info-card code { background: rgba(10,10,10,.08); color: #0a0a0a; padding: 1px 6px; border-radius: 4px; font-size: 12.5px; }

    .form-foot {
        padding: 16px 22px;
        background: #fafbff;
        border-top: 1px solid #eef0f4;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }
    .alert-box { padding: 14px 18px; border-radius: 12px; margin-bottom: 18px; font-size: 13.5px; display: flex; justify-content: space-between; gap: 10px; }
    .alert-box.success { background: #f3f4f6; color: #0a0a0a; border: 1px solid #e5e7eb; }
    .alert-box.warn    { background: #fffbeb; color: #92400e; border: 1px solid #fde68a; }
    .alert-box.danger  { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }
    .alert-box ul { margin: 6px 0 0 18px; }
    .alert-box .close-x { background: transparent; border: none; color: inherit; opacity: .6; cursor: pointer; }
    .alert-box .close-x:hover { opacity: 1; }
</style>

<div class="form-wrap">
    <div class="form-head">
        <div>
            <h1>Import Jobs</h1>
            <div class="breadcrumbs">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span class="mx-1">/</span>
                <a href="{{ route('admin.jobs.index') }}">Jobs</a>
                <span class="mx-1">/</span>
                <span>Import</span>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert-box success">
            <span><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}</span>
            <button type="button" class="close-x" onclick="this.parentElement.remove()"><i class="bi bi-x-lg"></i></button>
        </div>
    @endif

    @if (session('import_errors') && is_array(session('import_errors')))
        <div class="alert-box warn">
            <div>
                <strong>Some rows had issues:</strong>
                <ul>
                    @foreach (session('import_errors') as $err)<li>{{ $err }}</li>@endforeach
                </ul>
            </div>
            <button type="button" class="close-x" onclick="this.parentElement.remove()"><i class="bi bi-x-lg"></i></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert-box danger">
            <div>
                <strong>Please fix the following:</strong>
                <ul>
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
            <button type="button" class="close-x" onclick="this.parentElement.remove()"><i class="bi bi-x-lg"></i></button>
        </div>
    @endif

    <div class="panel">
        <div class="panel-head">
            <h3><i class="bi bi-cloud-upload"></i> Upload Excel or CSV</h3>
            <a href="{{ route('admin.jobs.index') }}" class="btn-soft">
                <i class="bi bi-arrow-left"></i> Back to Jobs
            </a>
        </div>

        <form action="{{ route('admin.jobs.import') }}" method="POST" enctype="multipart/form-data" id="import-form">
            @csrf
            <div class="panel-body">
                <div class="field">
                    <label>Choose file <span style="color:#9ca3af;font-weight:500;">(.xlsx, .xls, .csv)</span></label>
                    <label class="dropzone" for="file" id="dropzone">
                        <i class="bi bi-file-earmark-arrow-up"></i>
                        <div class="dz-text" id="dz-text">Click to select or drag &amp; drop your file here</div>
                        <div class="dz-sub" id="dz-sub">Max 200 MB • First row must contain column headings</div>
                        <div class="file-name" id="dz-filename" style="display:none;"></div>
                        <div class="file-meta" id="dz-meta" style="display:none;"></div>
                        <input type="file" name="file" id="file" accept=".xlsx,.xls,.csv" required>
                    </label>
                    @error('file')
                        <div style="color:#dc2626; font-size:13px; margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label>Options</label>
                    <label class="check-row" for="skip_existing">
                        <input type="checkbox" name="skip_existing" id="skip_existing" value="1" {{ old('skip_existing') ? 'checked' : '' }}>
                        <div>
                            <div class="label">Skip rows with existing references</div>
                            <div class="desc">If a job with the same sender / display reference already exists, that row will be ignored.</div>
                        </div>
                    </label>
                </div>

                <div class="info-card">
                    <i class="bi bi-info-circle me-1"></i>
                    <strong>Auto-deduplication is on.</strong> Jobs with the same <code>position + employer + location</code>
                    will be skipped automatically. After import you'll see a summary like
                    <em>"245 imported, 89 duplicates skipped."</em>
                </div>
            </div>

            <div class="form-foot">
                <a href="{{ route('admin.jobs.index') }}" class="btn-soft">Cancel</a>
                <button type="submit" class="btn-soft primary" id="submit-btn">
                    <i class="bi bi-upload"></i> Start Import
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
(function () {
    const dz       = document.getElementById('dropzone');
    const input    = document.getElementById('file');
    const dzText   = document.getElementById('dz-text');
    const dzSub    = document.getElementById('dz-sub');
    const dzName   = document.getElementById('dz-filename');
    const dzMeta   = document.getElementById('dz-meta');

    function bytes(n) {
        if (n < 1024) return n + ' B';
        if (n < 1024*1024) return (n/1024).toFixed(1) + ' KB';
        return (n/1024/1024).toFixed(2) + ' MB';
    }

    function showFile(file) {
        dz.classList.add('has-file');
        dzText.style.display = 'none';
        dzSub.style.display  = 'none';
        dzName.textContent = file.name;
        dzMeta.textContent = bytes(file.size) + ' · ' + (file.type || file.name.split('.').pop().toUpperCase());
        dzName.style.display = 'block';
        dzMeta.style.display = 'block';
    }

    input.addEventListener('change', () => {
        if (input.files[0]) showFile(input.files[0]);
    });

    // Drag & drop
    ['dragenter','dragover'].forEach(e => dz.addEventListener(e, ev => {
        ev.preventDefault(); dz.classList.add('dragover');
    }));
    ['dragleave','drop'].forEach(e => dz.addEventListener(e, ev => {
        ev.preventDefault(); dz.classList.remove('dragover');
    }));
    dz.addEventListener('drop', ev => {
        const file = ev.dataTransfer.files[0];
        if (!file) return;
        const dt = new DataTransfer();
        dt.items.add(file);
        input.files = dt.files;
        showFile(file);
    });

    // Submit button loading state
    document.getElementById('import-form').addEventListener('submit', () => {
        const btn = document.getElementById('submit-btn');
        btn.disabled = true;
        btn.innerHTML = '<i class="bi bi-arrow-clockwise"></i> Importing… please wait';
    });
})();
</script>
@endpush
@endsection
