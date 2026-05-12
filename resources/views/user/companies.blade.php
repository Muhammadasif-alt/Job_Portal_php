@extends('user.layouts.master')
@section('title', 'Browse Companies')
@section('content')

<style>
/* === Companies page — matches home/jobs hero (light bg, dark text) === */
.companies-hero {
    position: relative;
    background: linear-gradient(180deg, #f8faff 0%, #ffffff 50%, #f5f5f7 100%);
    padding: 70px 0 60px;
    overflow: hidden;
    border-bottom: 1px solid #f0f0f3;
}
.companies-hero::before {
    content: "";
    position: absolute; inset: 0;
    background-image: radial-gradient(circle at 12% 20%, rgba(10,10,10,.04) 0, transparent 40%),
                      radial-gradient(circle at 88% 80%, rgba(10,10,10,.03) 0, transparent 45%);
    pointer-events: none;
}
.companies-hero .container { position: relative; z-index: 2; text-align: center; }
.companies-hero h1 {
    color: #0a0a0a;
    font-size: clamp(30px, 4.4vw, 52px);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -1.2px;
    margin: 0 0 18px;
    max-width: 920px;
    margin-left: auto;
    margin-right: auto;
}
.companies-hero h1 .accent {
    background: linear-gradient(90deg, #0a0a0a, #404040);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    color: transparent;
}
.companies-hero p.lead {
    color: #555;
    font-size: clamp(15px, 1.5vw, 17px);
    line-height: 1.65;
    max-width: 720px;
    margin: 0 auto 28px;
}
.companies-hero .eyebrow {
    display: inline-block;
    background: #fff;
    border: 1px solid #e5e5e7;
    color: #555;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1.6px;
    text-transform: uppercase;
    padding: 6px 14px;
    border-radius: 999px;
    margin-bottom: 18px;
    box-shadow: 0 1px 2px rgba(15,23,42,.04);
}
.companies-hero .breadcrumbs-mini { color: #777; font-size: 13px; margin-bottom: 14px; }
.companies-hero .breadcrumbs-mini a { color: #0a0a0a; text-decoration: none; font-weight: 600; }
.companies-hero .breadcrumbs-mini a:hover { text-decoration: underline; }

/* Search bar */
.companies-search {
    background: #fff;
    border: 1px solid #e5e5e7;
    border-radius: 14px;
    padding: 8px;
    box-shadow: 0 8px 24px rgba(15,23,42,.06);
    display: flex;
    gap: 6px;
    max-width: 720px;
    margin: 0 auto 28px;
}
.companies-search input[type="text"] {
    flex: 1;
    border: none !important;
    background: transparent;
    padding: 0 16px;
    font-size: 15px;
    height: 52px;
    color: #1a1a1a;
    box-shadow: none !important;
    outline: none !important;
}
.companies-search select {
    border: none !important;
    background: #f5f5f7;
    border-radius: 10px;
    padding: 0 14px;
    height: 52px;
    font-size: 14px;
    color: #1a1a1a;
    box-shadow: none !important;
    outline: none !important;
    min-width: 140px;
    border-left: 1px solid #ececec !important;
}
.companies-search button {
    background: #0a0a0a;
    border: 1.5px solid #0a0a0a;
    color: #fff;
    border-radius: 10px;
    padding: 0 28px;
    height: 52px;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    transition: all .15s ease;
}
.companies-search button:hover {
    background: #1a1a1a;
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(0,0,0,.18);
}

/* Stats strip — clean white cards (matches home) */
.companies-stats {
    display: inline-flex;
    gap: 32px;
    padding: 20px 36px;
    background: #fff;
    border: 1px solid #ececec;
    border-radius: 14px;
    box-shadow: 0 6px 18px rgba(15,23,42,.05);
    flex-wrap: wrap;
    justify-content: center;
}
.companies-stats .stat {
    text-align: center;
    min-width: 120px;
}
.companies-stats .stat strong {
    display: block;
    font-size: 24px;
    font-weight: 800;
    color: #0a0a0a;
    line-height: 1.1;
    letter-spacing: -.5px;
}
.companies-stats .stat span {
    font-size: 11.5px;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    color: #777;
    font-weight: 600;
}

/* Toolbar */
.companies-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    margin: 36px 0 22px;
}
.companies-toolbar .results-info {
    color: #555;
    font-size: 14.5px;
}
.companies-toolbar .results-info strong { color: #0a0a0a; }
.companies-toolbar .quick-filters { display: flex; gap: 8px; flex-wrap: wrap; }
.companies-toolbar .quick-filters a {
    padding: 9px 16px;
    border-radius: 999px;
    background: #fff;
    border: 1px solid #ececec;
    color: #1a1a1a;
    font-size: 13.5px;
    font-weight: 500;
    text-decoration: none;
    transition: all .15s ease;
}
.companies-toolbar .quick-filters a:hover {
    background: #f5f5f7;
    border-color: #d5d5d7;
}
.companies-toolbar .quick-filters a.active {
    background: #0a0a0a;
    border-color: #0a0a0a;
    color: #fff;
    font-weight: 600;
}

/* Card column wrapper — guarantees horizontal + vertical gaps */
.company-card-col {
    padding: 0 12px 24px;
    display: flex;
}
.utf-companies-grid {
    margin: 0 -12px;
}

/* Company card */
.company-card {
    background: #fff;
    border: 1px solid #eef0f4;
    border-radius: 16px;
    padding: 24px;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    gap: 14px;
    transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    text-decoration: none !important;
    color: inherit;
    position: relative;
    overflow: hidden;
}
.company-card::after {
    content: "";
    position: absolute;
    inset: -2px -2px auto auto;
    width: 90px; height: 90px;
    background: linear-gradient(135deg, var(--accent-1, #2a41e8), var(--accent-2, #5e2bff));
    opacity: .07;
    border-radius: 50%;
    transform: translate(35%, -35%);
    transition: transform .35s ease, opacity .25s ease;
}
.company-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 18px 40px rgba(15, 23, 42, .10);
    border-color: transparent;
}
.company-card:hover::after { transform: translate(20%, -20%) scale(1.15); opacity: .12; }

.company-card-head {
    display: flex;
    align-items: center;
    gap: 14px;
}
.company-avatar {
    width: 60px;
    height: 60px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: 700;
    font-size: 24px;
    letter-spacing: .5px;
    flex-shrink: 0;
    background: linear-gradient(135deg, var(--accent-1, #2a41e8), var(--accent-2, #5e2bff));
    box-shadow: 0 8px 18px rgba(42, 65, 232, .22);
}
.company-card h3 {
    font-size: 17px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 4px;
    line-height: 1.25;
    /* clamp to 2 lines */
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.company-card .verified {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #16a34a;
    font-weight: 600;
}
.company-card .verified i { font-size: 14px; }

.company-card-body { color: #6b7280; font-size: 13px; }
.company-card-body .meta { display: flex; align-items: center; gap: 8px; margin-bottom: 6px; }
.company-card-body .meta i { color: #9ca3af; font-size: 14px; }

.company-card-footer {
    margin-top: auto;
    padding-top: 14px;
    border-top: 1px dashed #eef0f4;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.positions-badge {
    background: linear-gradient(135deg, #ecfdf5, #d1fae5);
    color: #065f46;
    font-weight: 700;
    font-size: 13px;
    padding: 6px 12px;
    border-radius: 999px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.positions-badge.empty {
    background: #f3f4f6;
    color: #6b7280;
}
.positions-badge .dot {
    width: 7px; height: 7px;
    background: #10b981;
    border-radius: 50%;
    animation: pulse 1.6s infinite;
}
.positions-badge.empty .dot { background: #9ca3af; animation: none; }
@keyframes pulse {
    0%, 100% { box-shadow: 0 0 0 0 rgba(16,185,129,.55); }
    50% { box-shadow: 0 0 0 6px rgba(16,185,129,0); }
}
.view-jobs-link {
    font-size: 13px;
    font-weight: 700;
    color: #0a0a0a;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: gap .15s ease;
}
.company-card:hover .view-jobs-link { gap: 8px; }

/* Empty state */
.empty-state {
    text-align: center;
    padding: 70px 20px;
    background: #fff;
    border-radius: 16px;
    border: 1px dashed #e5e7eb;
}
.empty-state i { font-size: 56px; color: #9ca3af; margin-bottom: 14px; }
.empty-state h4 { color: #0a0a0a; margin: 0 0 6px; font-weight: 700; }
.empty-state p { color: #6b7280; margin: 0; }

/* Pagination — dark (overrides theme orange) */
.utf-pagination-container-aera { margin-top: 32px; display: flex; justify-content: center; }
.utf-pagination-container-aera .pagination ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: inline-flex;
    gap: 6px;
    flex-wrap: wrap;
}
.utf-pagination-container-aera .pagination li a,
.utf-pagination-container-aera .pagination li span {
    min-width: 40px;
    height: 40px;
    padding: 0 12px;
    background: #fff;
    border: 1px solid #ececec;
    border-radius: 8px;
    color: #0a0a0a;
    font-size: 14px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all .15s ease;
}
.utf-pagination-container-aera .pagination li a:hover {
    background: #f5f5f7;
    border-color: #0a0a0a;
}
.utf-pagination-container-aera .pagination li a.current-page,
.utf-pagination-container-aera .pagination li.active a {
    background: #0a0a0a !important;
    color: #fff !important;
    border-color: #0a0a0a !important;
}
.utf-pagination-container-aera .pagination li a.disabled {
    opacity: .35;
    cursor: not-allowed;
    pointer-events: none;
}

/* Responsive */
@media (max-width: 768px) {
    .companies-hero { padding: 50px 0 50px; }
    .companies-search { flex-direction: column; padding: 12px; }
    .companies-search select, .companies-search button { width: 100%; }
    .companies-search select { border-left: none !important; }
    .companies-stats { gap: 18px; padding: 14px 22px; }
    .companies-stats .stat strong { font-size: 20px; }
}
</style>

@php
    // Deterministic gradient palette per company name
    $palettes = [
        ['#2a41e8', '#5e2bff'],
        ['#f97316', '#ef4444'],
        ['#10b981', '#0ea5e9'],
        ['#ec4899', '#8b5cf6'],
        ['#f59e0b', '#ef4444'],
        ['#06b6d4', '#3b82f6'],
        ['#14b8a6', '#0ea5e9'],
        ['#a855f7', '#ec4899'],
        ['#0ea5e9', '#6366f1'],
        ['#84cc16', '#10b981'],
    ];
@endphp

<!-- Hero -->
<div class="companies-hero">
    <div class="container">
        <div class="breadcrumbs-mini">
            <a href="{{ url('/') }}">Home</a> &nbsp;&rsaquo;&nbsp; Browse Employers
        </div>
        <span class="eyebrow">Top Employers</span>
        <h1>Discover Top <span class="accent">Companies Hiring</span> in the USA</h1>
        <p class="lead">Explore {{ number_format($stats['total_companies']) }}+ trusted U.S. employers across every industry. Connect directly with verified hiring companies and find your next career move with confidence.</p>

        <form method="GET" action="{{ route('jobs.companies') }}" class="companies-search">
            <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Search by company name…" autocomplete="off">
            <select name="sort">
                <option value="name"   {{ ($sort ?? '') === 'name'   ? 'selected' : '' }}>A&ndash;Z</option>
                <option value="jobs"   {{ ($sort ?? '') === 'jobs'   ? 'selected' : '' }}>Most Jobs</option>
                <option value="newest" {{ ($sort ?? '') === 'newest' ? 'selected' : '' }}>Newest</option>
            </select>
            <button type="submit"><i class="icon-line-awesome-search"></i> &nbsp;Search</button>
        </form>

        <div class="companies-stats">
            <div class="stat">
                <strong>{{ number_format($stats['total_companies']) }}+</strong>
                <span>Employers</span>
            </div>
            <div class="stat">
                <strong>{{ number_format($stats['total_jobs']) }}+</strong>
                <span>Open Jobs</span>
            </div>
            <div class="stat">
                <strong>{{ number_format($stats['hiring_now']) }}+</strong>
                <span>Hiring Now</span>
            </div>
            <div class="stat">
                <strong>24/7</strong>
                <span>Updated Daily</span>
            </div>
        </div>
    </div>
</div>

<!-- Page Content -->
<div class="container">
    <div class="companies-toolbar">
        <div class="results-info">
            @if(!empty($search))
                Results for <strong>“{{ $search }}”</strong> &mdash;
            @endif
            Showing <strong>{{ $companies->firstItem() ?? 0 }}–{{ $companies->lastItem() ?? 0 }}</strong>
            of <strong>{{ number_format($companies->total()) }}</strong> companies
        </div>
        <div class="quick-filters">
            <a href="{{ route('jobs.companies', ['sort' => 'name']) }}"   class="{{ ($sort ?? '') === 'name'   ? 'active' : '' }}">All</a>
            <a href="{{ route('jobs.companies', ['sort' => 'jobs']) }}"   class="{{ ($sort ?? '') === 'jobs'   ? 'active' : '' }}">Most Jobs</a>
            <a href="{{ route('jobs.companies', ['sort' => 'newest']) }}" class="{{ ($sort ?? '') === 'newest' ? 'active' : '' }}">Newest</a>
        </div>
    </div>

    <div class="row utf-companies-grid">
        @forelse($companies as $company)
            @php
                $jobsCount = $company->jobs_count ?? 0;
                $initials  = collect(preg_split('/\s+/', trim($company->name)))
                                ->filter()
                                ->take(2)
                                ->map(fn($w) => mb_strtoupper(mb_substr($w, 0, 1)))
                                ->implode('');
                if ($initials === '') { $initials = '?'; }
                $palette  = $palettes[crc32($company->name) % count($palettes)];
            @endphp
            <div class="col-xl-4 col-md-6 col-sm-12 company-card-col">
                <a href="{{ route('companies.show', $company->id) }}" class="company-card"
                   style="--accent-1: {{ $palette[0] }}; --accent-2: {{ $palette[1] }};">
                    <div class="company-card-head">
                        <div class="company-avatar">{{ $initials }}</div>
                        <div style="min-width:0;">
                            <h3>{{ $company->name }}</h3>
                            <div class="verified"><i class="icon-material-outline-check-circle"></i> Verified Employer</div>
                        </div>
                    </div>

                    <div class="company-card-body">
                        <div class="meta"><i class="icon-feather-briefcase"></i>
                            {{ $jobsCount > 0 ? 'Actively hiring across multiple roles' : 'No active openings right now' }}
                        </div>
                        <div class="meta"><i class="icon-material-outline-business"></i>
                            {{ $company->type ? ucfirst($company->type) : 'Trusted employer on JobsInUSA' }}
                        </div>
                    </div>

                    <div class="company-card-footer">
                        <span class="positions-badge {{ $jobsCount > 0 ? '' : 'empty' }}">
                            <span class="dot"></span>
                            {{ $jobsCount }} {{ $jobsCount === 1 ? 'Open Position' : 'Open Positions' }}
                        </span>
                        <span class="view-jobs-link">
                            View Jobs <i class="icon-material-outline-arrow-right-alt"></i>
                        </span>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="icon-material-outline-business"></i>
                    <h4>No companies found</h4>
                    <p>
                        @if(!empty($search))
                            We couldn't find any companies matching “{{ $search }}”. Try a different search.
                        @else
                            Check back soon — new employers join every day.
                        @endif
                    </p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    {{ $companies->onEachSide(2)->links() }}
</div>

@endsection
