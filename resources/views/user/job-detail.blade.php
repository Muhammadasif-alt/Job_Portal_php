@extends('user.layouts.master')
@section('title', $job->position . ' at ' . ($job->advertiser->name ?? 'Top Employer') . ' — ' . ($job->location->name ?? 'USA') . ' | Jobs in USA')
@section('meta_description', 'Apply for ' . $job->position . ' at ' . ($job->advertiser->name ?? 'top employer') . ' in ' . ($job->location->name ?? 'USA') . '. ' . \Illuminate\Support\Str::limit(strip_tags($job->description ?? ''), 130))
@section('og_title', $job->position . ' at ' . ($job->advertiser->name ?? 'Top Employer'))
@section('og_description', \Illuminate\Support\Str::limit(strip_tags($job->description ?? 'Apply now on Jobs in USA.'), 160))
@section('canonical', route('jobs.show', \Illuminate\Support\Str::slug($job->position . '-' . ($job->location->name ?? ''))))

@section('content')

@php
    $applyUrl = $job->application_url ?: '#';
    $hasApply = !empty($job->application_url);
    $jobTypeLabel = $job->employment_type ? ucfirst(str_replace('_',' ',$job->employment_type)) : ($job->job_type ? ucfirst(str_replace('_',' ',$job->job_type)) : 'Open');
    $salaryRange = null;
    if (($job->salary_minimum ?? 0) > 0 || ($job->salary_maximum ?? 0) > 0) {
        $cur = $job->salary_currency ?? 'USD';
        $salaryRange = $cur . ' ' . number_format($job->salary_minimum ?? 0) . ' – ' . number_format($job->salary_maximum ?? 0);
        if ($job->salary_period) { $salaryRange .= ' / ' . ucfirst($job->salary_period); }
    }
@endphp

<style>
    /* === Hero — light gradient + dark text (matches home theme) === */
    .jd-hero {
        position: relative;
        padding: 50px 0 60px;
        background: linear-gradient(180deg, #f8faff 0%, #ffffff 50%, #f5f5f7 100%);
        overflow: hidden;
        color: #0a0a0a;
        border-bottom: 1px solid #f0f0f3;
    }
    .jd-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 12% 20%, rgba(10,10,10,.04) 0, transparent 40%),
                    radial-gradient(circle at 88% 80%, rgba(10,10,10,.03) 0, transparent 45%);
    }
    .jd-hero-inner { position: relative; z-index: 2; }
    .jd-hero-bc {
        display: inline-flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 8px;
        background: #fff;
        border: 1px solid #e5e5e7;
        padding: 8px 16px;
        border-radius: 999px;
        font-size: 12.5px;
        margin-bottom: 22px;
        list-style: none;
        box-shadow: 0 1px 2px rgba(15,23,42,.04);
    }
    .jd-hero-bc li { display: inline-flex; align-items: center; gap: 8px; }
    .jd-hero-bc li + li::before { content: '›'; color: #c7c7cc; }
    .jd-hero-bc a { color: #555; text-decoration: none; font-weight: 600; transition: color .15s ease; }
    .jd-hero-bc a:hover { color: #0a0a0a; }
    .jd-hero-bc li:last-child { color: #0a0a0a; font-weight: 700; }

    .jd-hero-row {
        display: grid;
        grid-template-columns: 100px 1fr;
        gap: 28px;
        align-items: center;
    }
    @media (max-width: 768px) {
        .jd-hero-row { grid-template-columns: 1fr; gap: 18px; text-align: center; justify-items: center; }
    }
    .jd-hero-logo {
        width: 100px; height: 100px;
        border-radius: 16px;
        background: #fff;
        border: 1px solid #ececec;
        display: flex; align-items: center; justify-content: center;
        overflow: hidden;
        box-shadow: 0 14px 32px rgba(15,23,42,.08);
    }
    .jd-hero-logo img { max-width: 75%; max-height: 75%; object-fit: contain; }
    .jd-hero-text h1 {
        font-size: clamp(24px, 3vw, 36px);
        font-weight: 800;
        line-height: 1.15;
        color: #0a0a0a;
        margin: 0 0 14px;
        letter-spacing: -.7px;
    }
    .jd-hero-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 14px 22px;
        font-size: 14.5px;
        color: #555;
        align-items: center;
    }
    .jd-hero-meta span { display: inline-flex; align-items: center; gap: 7px; }
    .jd-hero-meta i { color: #0a0a0a; font-size: 16px; }
    .jd-hero-meta span.badge-pill {
        background: #0a0a0a;
        border: 1px solid #0a0a0a;
        color: #fff;
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
    .jd-hero-cta {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #0a0a0a;
        color: #fff !important;
        padding: 14px 28px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        border: 1.5px solid #0a0a0a;
        transition: all .15s ease;
    }
    .jd-hero-cta:hover {
        background: #1a1a1a;
        border-color: #1a1a1a;
        transform: translateY(-1px);
        box-shadow: 0 8px 20px rgba(0,0,0,.18);
    }
    .jd-hero-cta.disabled {
        background: #e5e5e7;
        color: #999 !important;
        border-color: #e5e5e7;
        cursor: not-allowed;
        box-shadow: none;
    }

    /* Layout */
    .jd-section { padding: 50px 0 70px; background: #fafafa; }
    .jd-row {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 28px;
        align-items: start;
    }
    @media (max-width: 991px) { .jd-row { grid-template-columns: 1fr; } }

    .jd-card {
        background: #fff;
        border: 1px solid #ececec;
        border-radius: 16px;
        padding: 32px 30px;
        margin-bottom: 24px;
    }
    .jd-card h2 {
        font-size: 19px;
        font-weight: 800;
        color: #0a0a0a;
        margin: 0 0 18px;
        padding-bottom: 14px;
        border-bottom: 2px solid #0a0a0a;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        letter-spacing: -.2px;
    }
    .jd-card h2 i { color: #0a0a0a; }

    .jd-description {
        font-size: 15.5px;
        line-height: 1.85;
        color: #2a2a2a;
    }
    .jd-description p { margin-bottom: 16px; }
    .jd-description strong { color: #0a0a0a; font-weight: 700; }
    .jd-description h2, .jd-description h3, .jd-description h4 {
        color: #0a0a0a;
        font-weight: 800;
        margin: 24px 0 12px;
    }
    .jd-description h2 { font-size: 22px; }
    .jd-description h3 { font-size: 18px; }
    .jd-description h4 { font-size: 16px; }
    .jd-description ul, .jd-description ol { margin: 14px 0 14px 24px; }
    .jd-description ul li, .jd-description ol li { margin-bottom: 6px; line-height: 1.7; }
    .jd-description br { line-height: 2.4; }
    .jd-description a {
        color: #0a0a0a;
        font-weight: 600;
        border-bottom: 1.5px solid #0a0a0a;
        text-decoration: none;
        transition: opacity .15s ease;
    }
    .jd-description a:hover { opacity: .65; }

    /* Sidebar */
    .jd-aside { position: sticky; top: 90px; }

    /* Apply card — dark with brand-color glow (matches modern CTA) */
    .jd-aside-apply {
        background: #0a0a0a;
        color: #fff;
        text-align: center;
        padding: 30px 26px;
        border-radius: 16px;
        margin-bottom: 22px;
        position: relative;
        overflow: hidden;
    }
    .jd-aside-apply::before, .jd-aside-apply::after {
        content: ""; position: absolute;
        border-radius: 50%;
        filter: blur(50px);
        opacity: .3;
        pointer-events: none;
    }
    .jd-aside-apply::before { width: 200px; height: 200px; background: #ff5722; top: -60px; right: -50px; }
    .jd-aside-apply::after { width: 160px; height: 160px; background: #5e2bff; bottom: -50px; left: -40px; }
    .jd-aside-apply > * { position: relative; z-index: 2; }
    .jd-aside-apply .eyebrow {
        display: inline-block;
        background: rgba(255,255,255,.10);
        border: 1px solid rgba(255,255,255,.20);
        color: rgba(255,255,255,.85);
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 1.4px;
        text-transform: uppercase;
        padding: 5px 12px;
        border-radius: 999px;
        margin-bottom: 12px;
    }
    .jd-aside-apply h4 { color: #fff; font-size: 18px; font-weight: 800; margin: 0 0 8px; line-height: 1.3; }
    .jd-aside-apply p { color: rgba(255,255,255,0.78); font-size: 13.5px; margin: 0 0 18px; line-height: 1.55; }
    .jd-aside-apply a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        background: #fff;
        color: #0a0a0a;
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 14px;
        text-decoration: none;
        transition: all .15s ease;
    }
    .jd-aside-apply a:hover { transform: translateY(-1px); box-shadow: 0 8px 18px rgba(0,0,0,.25); }
    .jd-aside-apply a.disabled { opacity: 0.5; cursor: not-allowed; }

    .jd-aside-card {
        background: #fff;
        border: 1px solid #ececec;
        border-radius: 16px;
        padding: 28px 26px;
        margin-bottom: 22px;
    }
    .jd-aside-card h3 {
        font-size: 14px;
        font-weight: 800;
        color: #0a0a0a;
        margin: 0 0 18px;
        padding-bottom: 12px;
        border-bottom: 2px solid #0a0a0a;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 1.2px;
    }
    .jd-overview-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .jd-overview-list li {
        display: flex;
        gap: 12px;
        align-items: flex-start;
    }
    .jd-overview-list .ico {
        width: 38px; height: 38px;
        border-radius: 10px;
        background: #0a0a0a;
        color: #fff;
        display: flex; align-items: center; justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }
    .jd-overview-list .label { font-size: 11px; color: #888; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 3px; }
    .jd-overview-list .value { font-size: 14px; color: #0a0a0a; font-weight: 700; line-height: 1.3; }

    /* Apply CTA banner — dark theme */
    .jd-apply-banner {
        background: #0a0a0a;
        color: #fff;
        text-align: center;
        padding: 40px 30px;
        border-radius: 16px;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }
    .jd-apply-banner::before, .jd-apply-banner::after {
        content: ""; position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        opacity: .25;
        pointer-events: none;
    }
    .jd-apply-banner::before { width: 280px; height: 280px; background: #ff5722; top: -80px; right: -60px; }
    .jd-apply-banner::after { width: 220px; height: 220px; background: #5e2bff; bottom: -60px; left: -50px; }
    .jd-apply-banner > * { position: relative; z-index: 2; }
    .jd-apply-banner h3 { color: #fff; font-size: 24px; font-weight: 800; margin: 0 0 10px; letter-spacing: -.4px; }
    .jd-apply-banner p { color: rgba(255,255,255,0.78); font-size: 14.5px; margin: 0 0 22px; line-height: 1.6; }
    .jd-apply-banner a {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #fff;
        color: #0a0a0a;
        padding: 14px 32px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 14.5px;
        text-decoration: none;
        transition: all .15s ease;
    }
    .jd-apply-banner a:hover { transform: translateY(-1px); box-shadow: 0 12px 28px rgba(0,0,0,.25); }
    .jd-apply-banner a.disabled { opacity: 0.5; cursor: not-allowed; }

    /* Explore links */
    .jd-explore-links {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .jd-explore-links a {
        background: #fafafa;
        border: 1px solid #ececec;
        color: #1a1a1a;
        padding: 9px 16px;
        border-radius: 999px;
        font-size: 13px;
        text-decoration: none;
        font-weight: 500;
        transition: all .15s ease;
    }
    .jd-explore-links a:hover {
        background: #0a0a0a;
        color: #fff;
        border-color: #0a0a0a;
        transform: translateY(-1px);
    }

    /* Related jobs */
    .jd-related {
        padding: 70px 0;
        background: #fff;
        border-top: 1px solid #ececec;
    }
    .jd-related-head { text-align: center; margin-bottom: 40px; }
    .jd-related-head h2 {
        font-size: clamp(24px, 2.8vw, 32px);
        font-weight: 800;
        color: #0a0a0a;
        margin: 0 0 8px;
        letter-spacing: -.4px;
    }
    .jd-related-head p { color: #555; font-size: 15px; margin: 0; }
    .jd-related-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
    }
    @media (max-width: 991px) { .jd-related-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 575px) { .jd-related-grid { grid-template-columns: 1fr; } }
    .jd-related-card {
        background: #fff;
        border: 1px solid #ececec;
        border-radius: 14px;
        padding: 22px 20px;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        transition: all .25s ease;
    }
    .jd-related-card:hover {
        border-color: #0a0a0a;
        transform: translateY(-3px);
        box-shadow: 0 14px 32px rgba(15,23,42,.10);
        color: inherit;
    }
    .jd-related-top { display: flex; gap: 12px; align-items: center; margin-bottom: 12px; }
    .jd-related-logo {
        width: 44px; height: 44px;
        border-radius: 12px;
        background: #f5f5f7;
        display: flex; align-items: center; justify-content: center;
        overflow: hidden;
        flex-shrink: 0;
    }
    .jd-related-logo img { max-width: 80%; max-height: 80%; object-fit: contain; }
    .jd-related-card h3 { font-size: 15px; font-weight: 700; color: #0a0a0a; margin: 0 0 4px; line-height: 1.3; }
    .jd-related-card .company { font-size: 12px; color: #777; }
    .jd-related-card .meta { font-size: 12.5px; color: #555; display: flex; gap: 14px; flex-wrap: wrap; margin-top: 12px; }
    .jd-related-card .meta i { color: #0a0a0a; margin-right: 4px; }

    @media (max-width: 768px) {
        .jd-hero { padding: 40px 0 50px; }
        .jd-card { padding: 22px 20px; }
    }
</style>

{{-- Hero --}}
<section class="jd-hero">
    <div class="container">
        <div class="jd-hero-inner">
            <ul class="jd-hero-bc">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('jobs.index') }}">Jobs</a></li>
                @if($job->location)
                    <li><a href="{{ route('jobs.location', $job->location->id) }}">{{ $job->location->name }}</a></li>
                @endif
                <li>{{ \Illuminate\Support\Str::limit($job->position, 40) }}</li>
            </ul>
            <div class="jd-hero-row">
                <div class="jd-hero-logo">
                    @if($job->advertiser && $job->advertiser->logo)
                        <img src="{{ asset('public/storage/' . $job->advertiser->logo) }}" alt="{{ $job->advertiser->name ?? 'Company' }}">
                    @else
                        <img src="{{ asset('public/user/images/jobimages.png') }}" alt="Company">
                    @endif
                </div>
                <div class="jd-hero-text">
                    <h1>{{ $job->position }}</h1>
                    <div class="jd-hero-meta">
                        @if($job->advertiser)
                            <span><i class="icon-material-outline-business-center"></i>{{ $job->advertiser->name }}</span>
                        @endif
                        @if($job->location)
                            <span><i class="icon-material-outline-location-on"></i>{{ $job->location->name }}@if($job->location->area), {{ $job->location->area }}@endif</span>
                        @endif
                        <span class="badge-pill">{{ $jobTypeLabel }}</span>
                        @if($salaryRange)
                            <span><i class="icon-material-outline-account-balance-wallet"></i>{{ $salaryRange }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Body --}}
<section class="jd-section">
    <div class="container">
        <div class="jd-row">
            <div>
                <div class="jd-card">
                    <h2><i class="icon-feather-info"></i> Job Description</h2>
                    <div class="jd-description">
                        {!! $job->description ?? '<p>No job description available.</p>' !!}
                    </div>
                </div>

                @if($job->requirements)
                    <div class="jd-card">
                        <h2><i class="icon-feather-check-square"></i> Requirements</h2>
                        <div class="jd-description">
                            {!! $job->requirements !!}
                        </div>
                    </div>
                @endif

                @if($job->benefits)
                    <div class="jd-card">
                        <h2><i class="icon-feather-award"></i> Benefits</h2>
                        <div class="jd-description">
                            {!! $job->benefits !!}
                        </div>
                    </div>
                @endif

                {{-- Apply Banner --}}
                <div class="jd-apply-banner">
                    <h3>Ready to apply for this {{ $job->position }} role?</h3>
                    <p>Take the next step in your career — submit your application directly with the employer.</p>
                    <a href="{{ $applyUrl }}"
                       class="{{ !$hasApply ? 'disabled' : '' }}"
                       @if($hasApply) target="_blank" rel="noopener" @endif>
                        <i class="icon-line-awesome-briefcase"></i>
                        {{ $hasApply ? 'Apply For This Position' : 'Application Not Available' }}
                    </a>
                </div>

                {{-- Internal links --}}
                <div class="jd-card">
                    <h2><i class="icon-feather-compass"></i> Explore More</h2>
                    <div class="jd-explore-links">
                        @if($job->location)
                            <a href="{{ url('/jobs?location=' . urlencode($job->location->name)) }}">More jobs in {{ $job->location->name }}</a>
                        @endif
                        @if($job->category && $job->category->slug)
                            <a href="{{ route('jobs.category', $job->category->slug) }}">More {{ $job->category->name }} jobs</a>
                        @endif
                        <a href="{{ url('/jobs?position=' . urlencode($job->position)) }}">Similar {{ $job->position }} jobs</a>
                        <a href="{{ route('jobs.index') }}">Browse all jobs</a>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <aside>
                <div class="jd-aside">
                    <div class="jd-aside-apply">
                        <span class="eyebrow">Interested?</span>
                        <h4>Apply for this role today</h4>
                        <p>Apply directly with {{ $job->advertiser->name ?? 'the employer' }} — it only takes a minute and is 100% free.</p>
                        <a href="{{ $applyUrl }}"
                           class="{{ !$hasApply ? 'disabled' : '' }}"
                           @if($hasApply) target="_blank" rel="noopener" @endif>
                            {{ $hasApply ? 'Apply Now' : 'Not Available' }}
                            @if($hasApply)<i class="icon-feather-arrow-right"></i>@endif
                        </a>
                    </div>

                    <div class="jd-aside-card">
                        <h3>Job Overview</h3>
                        <ul class="jd-overview-list">
                            <li>
                                <div class="ico"><i class="icon-material-outline-business-center"></i></div>
                                <div>
                                    <div class="label">Job Type</div>
                                    <div class="value">{{ $jobTypeLabel }}</div>
                                </div>
                            </li>
                            @if($job->category)
                                <li>
                                    <div class="ico"><i class="icon-line-awesome-suitcase"></i></div>
                                    <div>
                                        <div class="label">Category</div>
                                        <div class="value">{{ $job->category->name }}</div>
                                    </div>
                                </li>
                            @endif
                            @if($salaryRange)
                                <li>
                                    <div class="ico"><i class="icon-line-awesome-money"></i></div>
                                    <div>
                                        <div class="label">Salary Range</div>
                                        <div class="value">{{ $salaryRange }}</div>
                                    </div>
                                </li>
                            @endif
                            @if($job->advertiser)
                                <li>
                                    <div class="ico"><i class="icon-line-awesome-building"></i></div>
                                    <div>
                                        <div class="label">Company</div>
                                        <div class="value">{{ $job->advertiser->name }}</div>
                                    </div>
                                </li>
                            @endif
                            @if($job->location)
                                <li>
                                    <div class="ico"><i class="icon-material-outline-location-on"></i></div>
                                    <div>
                                        <div class="label">Location</div>
                                        <div class="value">{{ $job->location->name }}@if($job->location->area), {{ $job->location->area }}@endif</div>
                                    </div>
                                </li>
                            @endif
                            <li>
                                <div class="ico"><i class="icon-line-awesome-calendar"></i></div>
                                <div>
                                    <div class="label">Date Posted</div>
                                    <div class="value">{{ $job->created_at?->format('M d, Y') ?? date('M d, Y') }}</div>
                                </div>
                            </li>
                            @if($job->work_hours)
                                <li>
                                    <div class="ico"><i class="icon-line-awesome-clock-o"></i></div>
                                    <div>
                                        <div class="label">Work Hours</div>
                                        <div class="value">{{ $job->work_hours }}</div>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

{{-- Related Jobs --}}
@if(!empty($relatedJobs) && $relatedJobs->count())
    <section class="jd-related">
        <div class="container">
            <div class="jd-related-head">
                <h2>Similar Jobs You Might Like</h2>
                <p>Other roles matching your interests in {{ $job->category->name ?? 'this category' }} or {{ $job->location->name ?? 'your area' }}.</p>
            </div>
            <div class="jd-related-grid">
                @foreach($relatedJobs as $rel)
                    <a href="{{ route('jobs.show', \Illuminate\Support\Str::slug($rel->position . '-' . ($rel->location->name ?? ''))) }}" class="jd-related-card">
                        <div class="jd-related-top">
                            <div class="jd-related-logo">
                                <img src="{{ $rel->advertiser && $rel->advertiser->logo ? asset('public/storage/' . $rel->advertiser->logo) : asset('public/user/images/jobimages.png') }}" alt="{{ $rel->advertiser->name ?? 'Company' }}">
                            </div>
                            <div>
                                <h3>{{ \Illuminate\Support\Str::limit($rel->position, 50) }}</h3>
                                <span class="company">{{ $rel->advertiser->name ?? 'Company' }}</span>
                            </div>
                        </div>
                        <div class="meta">
                            @if($rel->location)
                                <span><i class="icon-material-outline-location-on"></i>{{ $rel->location->name }}</span>
                            @endif
                            <span><i class="icon-material-outline-business-center"></i>{{ ucfirst(str_replace('_',' ',$rel->employment_type ?? $rel->job_type ?? 'Open')) }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif

{{-- JSON-LD JobPosting (Google Jobs eligible — all required + recommended fields) --}}
@php
    // Build the description as full HTML for Google (allows formatted job description)
    $jobDescriptionHtml = $job->description ?? '';
    if ($job->requirements) { $jobDescriptionHtml .= '<h3>Requirements</h3>' . $job->requirements; }
    if ($job->benefits)     { $jobDescriptionHtml .= '<h3>Benefits</h3>'     . $job->benefits; }
    $validThrough = $job->expires_at ?? $job->valid_through ?? $job->created_at?->copy()->addDays(60);
    $isRemote = stripos($job->position . ' ' . ($job->location->name ?? ''), 'remote') !== false;
@endphp
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "JobPosting",
    "title": {!! json_encode($job->position) !!},
    "description": {!! json_encode($jobDescriptionHtml) !!},
    "identifier": {
        "@@type": "PropertyValue",
        "name": {!! json_encode($job->advertiser->name ?? 'Jobs in USA') !!},
        "value": {!! json_encode((string) $job->id) !!}
    },
    "datePosted": {!! json_encode($job->created_at?->toIso8601String() ?? now()->toIso8601String()) !!},
    "validThrough": {!! json_encode($validThrough?->toIso8601String() ?? now()->addDays(60)->toIso8601String()) !!},
    "employmentType": {!! json_encode(strtoupper(str_replace([' ', '-'], '_', $job->employment_type ?? 'FULL_TIME'))) !!},
    "directApply": true,
    "hiringOrganization": {
        "@@type": "Organization",
        "name": {!! json_encode($job->advertiser->name ?? '') !!},
        "sameAs": {!! json_encode(url('/companies/' . ($job->advertiser->id ?? ''))) !!}@if($job->advertiser && $job->advertiser->logo),
        "logo": {!! json_encode(asset('public/storage/' . $job->advertiser->logo)) !!}@endif
    },
    "jobLocation": {
        "@@type": "Place",
        "address": {
            "@@type": "PostalAddress",
            "addressLocality": {!! json_encode($job->location->name ?? '') !!},
            "addressRegion": {!! json_encode($job->location->area ?? $job->location->name ?? '') !!},
            "addressCountry": "US"
        }
    }@if($isRemote)
    ,
    "jobLocationType": "TELECOMMUTE",
    "applicantLocationRequirements": {
        "@@type": "Country",
        "name": "USA"
    }
    @endif
    @if($job->salary_minimum || $job->salary_maximum)
    ,
    "baseSalary": {
        "@@type": "MonetaryAmount",
        "currency": {!! json_encode($job->salary_currency ?? 'USD') !!},
        "value": {
            "@@type": "QuantitativeValue",
            "minValue": {!! json_encode((float)($job->salary_minimum ?? 0)) !!},
            "maxValue": {!! json_encode((float)($job->salary_maximum ?? 0)) !!},
            "unitText": "YEAR"
        }
    }
    @endif
    @if($job->requirements)
    ,
    "qualifications": {!! json_encode(strip_tags($job->requirements)) !!}
    @endif
    @if($job->category)
    ,
    "industry": {!! json_encode($job->category->name) !!},
    "occupationalCategory": {!! json_encode($job->category->name) !!}
    @endif
}
</script>

{{-- BreadcrumbList schema --}}
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "BreadcrumbList",
    "itemListElement": [
        { "@@type": "ListItem", "position": 1, "name": "Home", "item": {!! json_encode(url('/')) !!} },
        { "@@type": "ListItem", "position": 2, "name": "Jobs", "item": {!! json_encode(route('jobs.index')) !!} }@if($job->location),
        { "@@type": "ListItem", "position": 3, "name": {!! json_encode($job->location->name) !!}, "item": {!! json_encode(route('jobs.location', $job->location->id)) !!} },
        { "@@type": "ListItem", "position": 4, "name": {!! json_encode($job->position) !!}, "item": {!! json_encode(url()->current()) !!} }
        @else,
        { "@@type": "ListItem", "position": 3, "name": {!! json_encode($job->position) !!}, "item": {!! json_encode(url()->current()) !!} }
        @endif
    ]
}
</script>

@endsection