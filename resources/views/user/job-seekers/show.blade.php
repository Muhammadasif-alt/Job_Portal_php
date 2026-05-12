@extends('user.layouts.master')

@section('title', $seeker->name.' — Job Seeker Profile | Jobs in USA')
@section('meta_description', $seeker->name.' is actively looking for opportunities in '.$profile['city'].'. View skills, experience and contact details on Jobs in USA.')

@section('content')

@php
    use App\Http\Controllers\Public\JobSeekerPublicController;

    $initials = collect(preg_split('/\s+/', trim($seeker->name)))
        ->filter()->take(2)
        ->map(fn($w) => mb_strtoupper(mb_substr($w, 0, 1)))
        ->implode('');
@endphp

<style>
    .seeker-page { background: #f5f5f7; padding: 40px 0 70px; }

    .seeker-breadcrumb { font-size: 13.5px; color: #6b7280; margin-bottom: 20px; }
    .seeker-breadcrumb a { color: #0a0a0a; font-weight: 600; text-decoration: none; }
    .seeker-breadcrumb a:hover { text-decoration: underline; }
    .seeker-breadcrumb .sep { margin: 0 8px; color: #cbd5e1; }

    /* === Profile header === */
    .seeker-hero {
        position: relative;
        background: #0a0a0a; color: #fff;
        border-radius: 22px; padding: 40px 40px 36px;
        overflow: hidden;
        margin-bottom: 28px;
    }
    .seeker-hero::before, .seeker-hero::after {
        content: ""; position: absolute;
        border-radius: 50%; filter: blur(80px); opacity: .35;
        pointer-events: none;
    }
    .seeker-hero::before { width: 360px; height: 360px; background: #ff5722; top: -120px; right: -100px; }
    .seeker-hero::after  { width: 320px; height: 320px; background: #5e2bff; bottom: -120px; left: -100px; }
    .seeker-hero > * { position: relative; z-index: 2; }

    .seeker-hero-row {
        display: flex; gap: 24px; align-items: flex-start; flex-wrap: wrap;
    }
    .seeker-avatar-lg {
        width: 96px; height: 96px; border-radius: 22px;
        background: rgba(255,255,255,.10);
        border: 1px solid rgba(255,255,255,.18);
        color: #fff; display: inline-flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: 36px; letter-spacing: -1px;
        flex-shrink: 0;
    }
    .seeker-meta { flex: 1; min-width: 0; }
    .seeker-status {
        display: inline-flex; align-items: center; gap: 7px;
        background: rgba(52,211,153,.16); border: 1px solid rgba(52,211,153,.30);
        color: #34d399; font-size: 11.5px; font-weight: 700;
        padding: 5px 12px; border-radius: 999px;
        letter-spacing: 1px; text-transform: uppercase;
        margin-bottom: 10px;
    }
    .seeker-status .dot {
        width: 7px; height: 7px; background: #34d399;
        border-radius: 50%; animation: dotPulse 1.6s infinite;
    }
    @keyframes dotPulse {
        0%, 100% { box-shadow: 0 0 0 0 rgba(52,211,153,.7); }
        70%      { box-shadow: 0 0 0 8px rgba(52,211,153,0); }
    }
    .seeker-name {
        font-size: clamp(26px, 3vw, 36px);
        font-weight: 800; letter-spacing: -.6px;
        margin: 0 0 6px;
    }
    .seeker-headline {
        font-size: 16px; color: rgba(255,255,255,.85);
        line-height: 1.5; margin: 0 0 16px;
    }
    .seeker-quick-meta { display: flex; gap: 22px; flex-wrap: wrap; font-size: 14px; color: rgba(255,255,255,.78); }
    .seeker-quick-meta span { display: inline-flex; align-items: center; gap: 6px; }
    .seeker-quick-meta i { color: #ffd54f; font-size: 16px; }

    .seeker-cta-col { display: flex; flex-direction: column; gap: 10px; flex-shrink: 0; }
    .seeker-cta-col .btn-light, .seeker-cta-col .btn-ghost {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        padding: 12px 22px; border-radius: 12px;
        font-weight: 700; font-size: 14.5px;
        text-decoration: none !important; white-space: nowrap;
        transition: transform .15s ease;
    }
    .seeker-cta-col .btn-light { background: #fff; color: #0a0a0a !important; }
    .seeker-cta-col .btn-light:hover { transform: translateY(-2px); }
    .seeker-cta-col .btn-ghost { background: transparent; color: #fff !important; border: 1.5px solid rgba(255,255,255,.30); }
    .seeker-cta-col .btn-ghost:hover { background: rgba(255,255,255,.10); }

    /* === Two-column body === */
    .seeker-body {
        display: grid; grid-template-columns: minmax(0, 2.2fr) minmax(0, 1fr);
        gap: 24px; align-items: start;
    }
    @media (max-width: 991px) { .seeker-body { grid-template-columns: 1fr; } }

    .panel {
        background: #fff; border: 1px solid #ececec;
        border-radius: 16px; padding: 26px 28px;
        margin-bottom: 22px;
    }
    .panel h3 {
        font-size: 17px; font-weight: 700; color: #0a0a0a;
        margin: 0 0 16px; display: flex; align-items: center; gap: 10px;
    }
    .panel h3 i { color: #5e2bff; }
    .panel p { font-size: 14.5px; line-height: 1.75; color: #555; margin: 0; }
    .panel p + p { margin-top: 10px; }

    .skill-grid { display: flex; flex-wrap: wrap; gap: 8px; }
    .skill-grid .skill {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 14px; border-radius: 999px;
        background: #fafbff; border: 1px solid #e5e7eb;
        font-size: 13.5px; font-weight: 600; color: #0a0a0a;
    }
    .skill-grid .skill i { color: #ff5722; font-size: 12px; }

    /* Info table */
    .info-table { display: grid; grid-template-columns: max-content 1fr; gap: 12px 24px; }
    .info-table dt { font-size: 12.5px; color: #6b7280; font-weight: 600; text-transform: uppercase; letter-spacing: .8px; padding-top: 2px; }
    .info-table dd { margin: 0; font-size: 14.5px; color: #0a0a0a; font-weight: 600; }
    .info-table dd a { color: #0a0a0a; text-decoration: none; border-bottom: 1px solid #cbd5e1; }
    .info-table dd a:hover { border-color: #0a0a0a; }

    /* === Sidebar === */
    .seeker-side .panel-dark {
        background: #0a0a0a; color: #fff;
        border-radius: 16px; padding: 26px 24px;
        position: relative; overflow: hidden; margin-bottom: 22px;
    }
    .seeker-side .panel-dark::before {
        content: ""; position: absolute; right: -60px; top: -60px;
        width: 220px; height: 220px; border-radius: 50%;
        background: radial-gradient(circle, rgba(94,43,255,.32), transparent 70%);
        pointer-events: none;
    }
    .seeker-side .panel-dark > * { position: relative; z-index: 1; }
    .seeker-side .panel-dark .eyebrow {
        display: inline-block; background: rgba(255,255,255,.10);
        border: 1px solid rgba(255,255,255,.18);
        font-size: 11px; font-weight: 700; text-transform: uppercase;
        letter-spacing: 1.4px; padding: 5px 12px; border-radius: 999px;
        margin-bottom: 14px;
    }
    .seeker-side .panel-dark h4 { font-size: 17px; font-weight: 700; margin: 0 0 8px; line-height: 1.35; }
    .seeker-side .panel-dark p { font-size: 13.5px; color: rgba(255,255,255,.82); margin: 0 0 14px; line-height: 1.65; }
    .seeker-side .panel-dark a.btn-light {
        display: inline-flex; align-items: center; gap: 8px;
        background: #fff; color: #0a0a0a !important; font-weight: 700; font-size: 13.5px;
        padding: 11px 18px; border-radius: 10px; text-decoration: none;
    }
    .seeker-side .panel-dark a.btn-light:hover { transform: translateY(-1px); }

    /* Related seekers in sidebar */
    .related-list { display: flex; flex-direction: column; gap: 10px; }
    .related-card {
        display: flex; align-items: center; gap: 12px;
        padding: 12px; border-radius: 12px;
        text-decoration: none !important; color: inherit !important;
        transition: background .15s ease;
    }
    .related-card:hover { background: #fafbff; }
    .related-card .av {
        width: 44px; height: 44px; border-radius: 11px;
        background: #0a0a0a; color: #fff;
        display: inline-flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: 14px; flex-shrink: 0;
    }
    .related-card .info { flex: 1; min-width: 0; }
    .related-card .nm { font-weight: 700; font-size: 14px; color: #0a0a0a; line-height: 1.3; }
    .related-card .ct { font-size: 12px; color: #6b7280; margin-top: 2px; }

    /* Big back-button to listing */
    .back-row { margin-top: 12px; }
    .back-row a {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 14px; font-weight: 600; color: #0a0a0a;
        text-decoration: none;
    }
    .back-row a:hover { gap: 12px; transition: gap .15s ease; }
</style>

<div class="seeker-page">
    <div class="container">
        <div class="seeker-breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            <span class="sep">/</span>
            <a href="{{ route('job-seekers.index') }}">Job Seekers</a>
            <span class="sep">/</span>
            <span>{{ $seeker->name }}</span>
        </div>

        {{-- ============ HERO ============ --}}
        <section class="seeker-hero">
            <div class="seeker-hero-row">
                <div class="seeker-avatar-lg">{{ $initials ?: 'U' }}</div>
                <div class="seeker-meta">
                    <span class="seeker-status"><span class="dot"></span> Actively looking</span>
                    <h1 class="seeker-name">{{ $seeker->name }}</h1>
                    <p class="seeker-headline">{{ $profile['headline'] }}</p>
                    <div class="seeker-quick-meta">
                        <span><i class="icon-feather-map-pin"></i> {{ $profile['city'] }}</span>
                        <span><i class="icon-feather-briefcase"></i> {{ $profile['experience_years'] }} yrs experience</span>
                        <span><i class="icon-feather-clock"></i> Open to {{ $profile['open_to'] }}</span>
                    </div>
                </div>
                <div class="seeker-cta-col">
                    <a href="{{ route('register') }}" class="btn-light"><i class="icon-feather-send"></i> Send a Job Offer</a>
                    <a href="{{ route('jobs.index') }}" class="btn-ghost"><i class="icon-feather-bookmark"></i> Save Profile</a>
                </div>
            </div>
        </section>

        {{-- ============ BODY ============ --}}
        <div class="seeker-body">
            <div class="seeker-main">
                <div class="panel">
                    <h3><i class="icon-feather-user"></i> About</h3>
                    <p>{{ $seeker->name }} is a {{ $profile['experience_years'] }}-year veteran based in {{ $profile['city'] }}, currently exploring {{ $profile['open_to'] }} opportunities across the United States.</p>
                    <p>{{ $profile['headline'] }} — comfortable working in fast-paced environments, with a strong track record of meeting deadlines and collaborating across teams. Available to start immediately for the right role.</p>
                </div>

                <div class="panel">
                    <h3><i class="icon-feather-zap"></i> Top Skills</h3>
                    <div class="skill-grid">
                        @foreach($profile['skills'] as $skill)
                            <span class="skill"><i class="icon-feather-check"></i> {{ $skill }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="panel">
                    <h3><i class="icon-feather-target"></i> Job Preferences</h3>
                    <dl class="info-table">
                        <dt>Preferred Location</dt>
                        <dd>{{ $profile['city'] }}</dd>

                        <dt>Open To</dt>
                        <dd>{{ $profile['open_to'] }} positions, on-site or remote</dd>

                        <dt>Experience</dt>
                        <dd>{{ $profile['experience_years'] }} years in the industry</dd>

                        <dt>Available From</dt>
                        <dd>Immediately</dd>

                        <dt>Username</dt>
                        <dd>&#64;{{ $seeker->username }}</dd>

                        <dt>Joined</dt>
                        <dd>{{ optional($seeker->created_at)->format('M Y') }}</dd>
                    </dl>
                </div>

                <div class="back-row">
                    <a href="{{ route('job-seekers.index') }}"><i class="icon-feather-arrow-left"></i> Back to all job seekers</a>
                </div>
            </div>

            <aside class="seeker-side">
                <div class="panel-dark">
                    <span class="eyebrow"><i class="icon-feather-briefcase"></i> For Employers</span>
                    <h4>Hire {{ explode(' ', $seeker->name)[0] }} for your team</h4>
                    <p>Post a matching job in seconds and reach this candidate plus 100,000+ other active U.S. seekers. Free for your first listing.</p>
                    <a href="{{ route('register') }}" class="btn-light"><i class="icon-feather-plus"></i> Post a Job</a>
                </div>

                @if($relatedSeekers->count())
                    <div class="panel" style="padding: 20px 22px;">
                        <h3 style="font-size: 15px; margin-bottom: 12px;"><i class="icon-feather-users"></i> Similar Talent</h3>
                        <div class="related-list">
                            @foreach($relatedSeekers as $rs)
                                @php
                                    $rsProfile  = JobSeekerPublicController::profileFor($rs);
                                    $rsInitials = collect(preg_split('/\s+/', trim($rs->name)))
                                        ->filter()->take(2)
                                        ->map(fn($w) => mb_strtoupper(mb_substr($w, 0, 1)))
                                        ->implode('');
                                @endphp
                                <a href="{{ route('job-seekers.show', $rs->username) }}" class="related-card">
                                    <div class="av">{{ $rsInitials ?: 'U' }}</div>
                                    <div class="info">
                                        <div class="nm">{{ $rs->name }}</div>
                                        <div class="ct">{{ $rsProfile['city'] }} · {{ $rsProfile['experience_years'] }} yrs</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </aside>
        </div>
    </div>
</div>

@endsection
