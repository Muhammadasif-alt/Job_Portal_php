@extends('user.layouts.master')
@section('title', $company->name . ' - Jobs')

@section('content')
<style>
    /* === Page-level brand overrides (light hero + dark accents) === */
    .utf-page-heading-area {
        background: linear-gradient(180deg, #f8faff 0%, #ffffff 50%, #f5f5f7 100%) !important;
        padding: 70px 0 60px !important;
        border-bottom: 1px solid #ececec !important;
        position: relative;
        overflow: hidden;
    }
    .utf-page-heading-area::before {
        content: '';
        position: absolute;
        right: -120px; top: -120px;
        width: 360px; height: 360px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(94,43,255,.08), transparent 70%);
        pointer-events: none;
    }
    .utf-page-heading-area::after {
        content: '';
        position: absolute;
        left: -100px; bottom: -120px;
        width: 320px; height: 320px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255,87,34,.07), transparent 70%);
        pointer-events: none;
    }
    .utf-page-heading-area h1 {
        font-size: clamp(28px, 3.4vw, 44px) !important;
        font-weight: 800 !important;
        letter-spacing: -.5px;
        color: #0a0a0a !important;
        margin-bottom: 14px !important;
        position: relative; z-index: 2;
    }
    .utf-page-heading-area #breadcrumbs ul { background: transparent !important; padding: 0 !important; }
    .utf-page-heading-area #breadcrumbs ul li,
    .utf-page-heading-area #breadcrumbs ul li a { color: #555 !important; font-weight: 600; font-size: 13px; }
    .utf-page-heading-area #breadcrumbs ul li a:hover { color: #0a0a0a !important; }
    .utf-page-heading-area #breadcrumbs ul li:last-child { color: #0a0a0a !important; }

    /* Company overview card */
    .utf-company-overview .company-desc h3 { color: #0a0a0a !important; font-weight: 700; }
    .utf-company-overview .company-desc i { color: #0a0a0a !important; }
    .utf-company-overview .company-desc a { color: #0a0a0a !important; font-weight: 600; }

    /* Sidebar widgets */
    .utf-sidebar-widget-item h3 {
        color: #0a0a0a !important;
        font-weight: 700 !important;
        border-bottom: 2px solid #0a0a0a !important;
        display: inline-block;
        padding-bottom: 8px;
    }
    .utf-sidebar-widget-item input[type="checkbox"] { accent-color: #0a0a0a !important; }

    /* Job listing cards */
    .utf-job-listing-item:hover { border-color: #0a0a0a !important; box-shadow: 0 16px 32px rgba(15,23,42,.08) !important; }
    .utf-job-listing-item h3, .utf-job-listing-item h3 a { color: #0a0a0a !important; }
    .utf-job-listing-item .utf-job-listing-footer ul li i { color: #0a0a0a !important; }
    .utf-job-listing-item h3 a:hover { color: #0a0a0a !important; text-decoration: underline; }

    /* Buttons */
    .button, .button.ripple-effect, .utf-listing-container-area .button {
        background: #0a0a0a !important;
        border: 1px solid #0a0a0a !important;
        color: #fff !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
    }
    .button:hover { background: #1a1a1a !important; color: #fff !important; }
</style>

<!-- Page Title -->
<div class="utf-page-heading-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 data-aos="fade-up" data-aos-duration="700">Jobs at <span class="accent">{{ $company->name }}</span></h1>
                <nav id="breadcrumbs" data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('jobs.companies') }}">Companies</a></li>
                        <li>{{ $company->name }}</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Company Jobs Section -->
<div class="utf-listing-container-area padding-bottom-70">
    <div class="container">
        <div class="row">
            <!-- Search Sidebar -->
            <div class="col-lg-4 col-md-12">
                <div class="utf-sidebar-container-aera">
                    <!-- Company Info -->
                    <div class="utf-sidebar-widget-item">
                        <div class="utf-company-overview margin-bottom-30">
                            <div class="company-logo-img">
                                <img src="{{ $company->logo ? asset('public/storage/' . $company->logo) : asset('public/user/images/companies.png') }}"
                                     alt="{{ $company->name }}" class="img-fluid">
                            </div>
                            <div class="company-desc">
                                <h3>{{ $company->name }}</h3>
                                @if($company->website)
                                <p><i class="icon-feather-globe"></i>
                                    <a href="{{ $company->website }}" target="_blank" rel="nofollow">
                                        {{ parse_url($company->website, PHP_URL_HOST) }}
                                    </a>
                                </p>
                                @endif
                                @if($company->location)
                                <p><i class="icon-material-outline-location-on"></i>
                                    {{ $company->location->name }}
                                    @if($company->location->area)
                                        , {{ $company->location->area }}
                                    @endif
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Location Filter -->
                    <div class="utf-sidebar-widget-item">
                        <h3>Filter by Location</h3>
                        <select class="selectpicker" data-live-search="true" title="All Locations">
                            @foreach($locations as $location)
                                <option>{{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Categories -->
                    <div class="utf-sidebar-widget-item">
                        <h3>Job Categories</h3>
                        <ul class="utf-job-listing">
                            @foreach($categories as $category)
                            <li>
                                <a href="{{ route('jobs.category', $category->slug) }}">
                                    {{ $category->name }}
                                    <span class="counter">{{ $category->jobs_count }} </span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Job Listings -->
            <div class="col-lg-8 col-md-12">
                <style>
                    /* Match /jobs listing card pattern */
                    .jobs-grid {
                        display: grid;
                        grid-template-columns: repeat(3, 1fr);
                        gap: 20px;
                        margin-top: 20px;
                    }
                    @media (max-width: 991px) { .jobs-grid { grid-template-columns: repeat(2, 1fr); } }
                    @media (max-width: 575px) { .jobs-grid { grid-template-columns: 1fr; } }

                    .job-card {
                        display: flex; flex-direction: column;
                        background: #fff; border: 1px solid #ececec;
                        border-radius: 14px; padding: 22px 20px;
                        text-decoration: none; color: inherit; height: 100%;
                        transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
                    }
                    .job-card:hover {
                        border-color: #0a0a0a;
                        box-shadow: 0 14px 32px rgba(15,23,42,.08);
                        transform: translateY(-3px);
                    }
                    .job-card-top {
                        display: flex; justify-content: space-between; align-items: flex-start;
                        margin-bottom: 14px;
                    }
                    .job-card-logo {
                        width: 56px; height: 56px; border-radius: 12px;
                        background: #f5f5f7;
                        display: flex; align-items: center; justify-content: center;
                        overflow: hidden; flex-shrink: 0;
                    }
                    .job-card-logo img { max-width: 80%; max-height: 80%; object-fit: contain; }
                    .job-card-badge {
                        font-size: 11px; font-weight: 700;
                        padding: 5px 11px; border-radius: 6px;
                        color: #fff;
                        display: inline-flex; align-items: center; gap: 4px;
                        white-space: nowrap; text-transform: uppercase; letter-spacing: .5px;
                    }
                    .job-card-badge.green  { background: #047857; }
                    .job-card-badge.yellow { background: #b45309; }
                    .job-card-title {
                        font-size: 16.5px; font-weight: 700; color: #0a0a0a;
                        margin: 0 0 12px; line-height: 1.35;
                        display: -webkit-box; -webkit-line-clamp: 2;
                        -webkit-box-orient: vertical; overflow: hidden; min-height: 46px;
                    }
                    .job-card-meta { list-style: none; padding: 0; margin: 0 0 18px; flex-grow: 1; }
                    .job-card-meta li {
                        font-size: 13px; color: #555; margin-bottom: 6px;
                        display: flex; align-items: center; gap: 8px;
                    }
                    .job-card-meta li i { color: #0a0a0a; font-size: 14px; }
                    .job-card-button {
                        display: inline-flex; align-items: center; justify-content: center; gap: 6px;
                        background: #0a0a0a; color: #fff !important;
                        padding: 11px 14px; border-radius: 10px;
                        font-size: 13.5px; font-weight: 600;
                        margin-top: auto;
                        transition: background .2s ease;
                        border: 1.5px solid #0a0a0a;
                    }
                    .job-card:hover .job-card-button { background: #1a1a1a; border-color: #1a1a1a; }

                    .no-jobs {
                        grid-column: 1 / -1; text-align: center;
                        padding: 60px 20px; background: #fafafa;
                        border: 1px dashed #ddd; border-radius: 14px;
                    }
                    .no-jobs i { font-size: 50px; color: #c7c7cc; }
                    .no-jobs h4 { font-size: 18px; color: #0a0a0a; margin: 14px 0 6px; font-weight: 700; }
                    .no-jobs p { color: #777; margin: 0; }
                </style>

                <div class="jobs-grid">
                    @forelse($jobs as $job)
                        <a href="{{ route('jobs.show', \Illuminate\Support\Str::slug($job->position . '-' . ($job->location->name ?? '')) ) }}" class="job-card">
                            <div class="job-card-top">
                                <div class="job-card-logo">
                                    <img src="{{ $company->logo ? asset('public/storage/' . $company->logo) : asset('public/user/images/jobimages.png') }}"
                                         alt="{{ $company->name }}" loading="lazy">
                                </div>
                                <span class="job-card-badge {{ ($job->employment_type ?? '') == 'Part Time' ? 'yellow' : 'green' }}">
                                    <i class="icon-material-outline-business-center"></i>
                                    {{ $job->employment_type ?? 'Full Time' }}
                                </span>
                            </div>

                            <h3 class="job-card-title">{{ $job->position }}</h3>

                            <ul class="job-card-meta">
                                @if($job->category)
                                    <li><i class="icon-feather-briefcase"></i> {{ $job->category->name }}</li>
                                @endif
                                @if($job->location)
                                    <li><i class="icon-material-outline-location-on"></i>
                                        {{ $job->location->name }}{{ $job->location->area ? ', ' . $job->location->area : '' }}
                                    </li>
                                @endif
                                <li><i class="icon-material-outline-access-time"></i>
                                    {{ $job->created_at->diffForHumans() }}
                                </li>
                            </ul>

                            <span class="job-card-button">Browse Job <i class="icon-feather-arrow-right"></i></span>
                        </a>
                    @empty
                        <div class="no-jobs">
                            <i class="icon-feather-search"></i>
                            <h4>No open jobs right now</h4>
                            <p>{{ $company->name }} doesn't have any active openings at the moment. Check back soon.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                {{ $jobs->onEachSide(2)->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Initialize Select Picker -->
<script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
    });
</script>
@endpush
