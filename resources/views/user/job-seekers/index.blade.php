@extends('user.layouts.master')

@section('title', 'Browse Job Seekers — Hire Verified Talent | Jobs in USA')
@section('meta_description', 'Browse thousands of active U.S. job seekers actively looking for work. Filter by skill, location and experience to find your next great hire on Jobs in USA.')

@section('content')

@php
    use App\Http\Controllers\Public\JobSeekerPublicController;
@endphp

<style>
    .js-page { background: #f5f5f7; padding: 0 0 80px; }

    /* === Hero === */
    .js-hero {
        position: relative;
        background: #0a0a0a;
        color: #fff;
        padding: 80px 0 90px;
        overflow: hidden;
        text-align: center;
    }
    .js-hero::before, .js-hero::after {
        content: ""; position: absolute;
        border-radius: 50%; filter: blur(80px);
        opacity: .35; pointer-events: none;
    }
    .js-hero::before { width: 380px; height: 380px; background: #ff5722; top: -120px; right: -100px; }
    .js-hero::after  { width: 340px; height: 340px; background: #5e2bff; bottom: -120px; left: -100px; }
    .js-hero .container { position: relative; z-index: 2; }
    .js-hero .eyebrow {
        display: inline-block;
        background: rgba(255,255,255,.10);
        border: 1px solid rgba(255,255,255,.20);
        font-size: 12px; font-weight: 700;
        letter-spacing: 1.4px; text-transform: uppercase;
        padding: 7px 16px; border-radius: 999px;
        margin-bottom: 22px; backdrop-filter: blur(8px);
    }
    .js-hero h1 {
        font-size: clamp(32px, 4vw, 52px);
        font-weight: 800; line-height: 1.1; letter-spacing: -.8px;
        margin: 0 0 16px;
    }
    .js-hero h1 .accent {
        background: linear-gradient(90deg, #ffd54f, #ff7043);
        -webkit-background-clip: text; background-clip: text;
        -webkit-text-fill-color: transparent; color: transparent;
    }
    .js-hero p { font-size: 17px; color: rgba(255,255,255,.85); line-height: 1.65; max-width: 660px; margin: 0 auto 30px; }

    .js-search-box {
        max-width: 560px; margin: 0 auto;
        background: #fff; border-radius: 14px;
        display: flex; gap: 8px;
        padding: 8px;
        box-shadow: 0 24px 48px rgba(0,0,0,.30);
    }
    .js-search-box input {
        flex: 1; height: 50px; border: none; outline: none;
        padding: 0 16px; font-size: 15px; color: #0f172a;
        font-family: inherit; background: transparent;
    }
    .js-search-box button {
        height: 50px; padding: 0 26px;
        background: #0a0a0a; color: #fff; border: none;
        border-radius: 10px; font-weight: 700; font-size: 14.5px;
        cursor: pointer; display: inline-flex; align-items: center; gap: 8px;
        transition: background .15s ease;
    }
    .js-search-box button:hover { background: #1a1a1a; }

    .js-hero-stats {
        display: flex; justify-content: center; gap: 40px;
        margin-top: 30px; padding-top: 24px;
        border-top: 1px solid rgba(255,255,255,.15);
        flex-wrap: wrap;
    }
    .js-hero-stats .stat strong { display: block; font-size: 22px; font-weight: 800; color: #fff; line-height: 1.1; }
    .js-hero-stats .stat span { font-size: 12px; color: rgba(255,255,255,.65); text-transform: uppercase; letter-spacing: 1.2px; }

    /* === Cards section === */
    .js-section { padding: 70px 0 30px; }
    .js-section-head { display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 28px; }
    .js-section-head h2 { font-size: clamp(22px, 2.5vw, 30px); font-weight: 800; color: #0a0a0a; letter-spacing: -.5px; margin: 0; }
    .js-section-head p  { color: #555; font-size: 15px; margin: 6px 0 0; }
    .js-section-head .count-pill {
        display: inline-flex; align-items: center; gap: 6px;
        background: #fff; border: 1px solid #e5e5e7;
        padding: 6px 14px; border-radius: 999px;
        font-size: 13px; font-weight: 600; color: #0a0a0a;
    }

    .js-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
    @media (max-width: 991px) { .js-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 575px) { .js-grid { grid-template-columns: 1fr; } }

    .js-card {
        background: #fff;
        border: 1px solid #ececec;
        border-radius: 16px;
        padding: 22px 22px 18px;
        position: relative;
        transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        text-decoration: none !important;
        color: inherit !important;
        display: flex; flex-direction: column;
    }
    .js-card:hover { transform: translateY(-3px); box-shadow: 0 20px 40px rgba(15,23,42,.08); border-color: #0a0a0a; }
    .js-card-head { display: flex; align-items: center; gap: 14px; margin-bottom: 14px; }
    .js-avatar {
        width: 54px; height: 54px; border-radius: 14px;
        background: #0a0a0a; color: #fff;
        display: inline-flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: 18px; letter-spacing: -.5px;
        flex-shrink: 0; box-shadow: 0 6px 14px rgba(10,10,10,.20);
    }
    .js-card-name { font-weight: 700; font-size: 16px; color: #0a0a0a; line-height: 1.2; margin: 0 0 3px; }
    .js-card-loc { font-size: 12.5px; color: #6b7280; display: inline-flex; align-items: center; gap: 5px; }
    .js-card-loc i { font-size: 13px; color: #ff5722; }

    .js-card-headline {
        font-size: 14px; color: #374151; line-height: 1.55;
        margin: 0 0 14px;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        min-height: 44px;
    }
    .js-skills { display: flex; flex-wrap: wrap; gap: 6px; margin: 0 0 16px; }
    .js-skill {
        font-size: 11.5px; font-weight: 600; color: #0a0a0a;
        background: #f3f4f6; border: 1px solid #e5e7eb;
        padding: 4px 10px; border-radius: 999px;
    }

    .js-card-meta {
        display: flex; justify-content: space-between; align-items: center;
        padding-top: 14px; border-top: 1px solid #f3f4f6;
        margin-top: auto;
    }
    .js-card-exp { font-size: 12px; color: #6b7280; display: inline-flex; align-items: center; gap: 5px; }
    .js-card-exp i { color: #5e2bff; font-size: 13px; }
    .js-view-link {
        font-size: 13px; font-weight: 700; color: #0a0a0a;
        display: inline-flex; align-items: center; gap: 4px;
        transition: gap .15s ease;
    }
    .js-card:hover .js-view-link { gap: 8px; }

    /* Empty state */
    .js-empty { text-align: center; padding: 80px 20px; background: #fff; border-radius: 16px; border: 1px solid #ececec; }
    .js-empty i { font-size: 56px; color: #d1d5db; }
    .js-empty h4 { color: #0a0a0a; font-weight: 700; margin: 14px 0 6px; font-size: 19px; }
    .js-empty p { color: #6b7280; margin: 0; font-size: 14.5px; }

    /* Pagination */
    .js-pagination { margin-top: 36px; }

    /* === FAQs === */
    .js-faq-section { background: #fff; padding: 70px 0; border-top: 1px solid #ececec; border-bottom: 1px solid #ececec; }
    .js-faq-head { text-align: center; margin-bottom: 40px; }
    .js-faq-head .eyebrow {
        display: inline-block; background: #fff; border: 1px solid #e5e5e7;
        color: #555; font-weight: 700; font-size: 12px;
        padding: 6px 14px; border-radius: 999px;
        letter-spacing: 1.4px; text-transform: uppercase; margin-bottom: 14px;
    }
    .js-faq-head h2 {
        font-size: clamp(26px, 3vw, 38px); font-weight: 800;
        color: #0a0a0a; line-height: 1.2; letter-spacing: -.5px;
        margin: 0 0 12px;
    }
    .js-faq-head p { color: #555; font-size: 16px; margin: 0; }
    .js-faqs { max-width: 820px; margin: 0 auto; }
    .js-faq {
        background: #fff; border: 1px solid #ececec;
        border-radius: 14px; padding: 0;
        margin-bottom: 12px;
        overflow: hidden;
        transition: border-color .15s ease;
    }
    .js-faq[open] { border-color: #0a0a0a; box-shadow: 0 8px 18px rgba(10,10,10,.06); }
    .js-faq summary {
        list-style: none; cursor: pointer;
        padding: 18px 22px;
        font-weight: 700; font-size: 15.5px; color: #0a0a0a;
        display: flex; justify-content: space-between; align-items: center;
        gap: 12px;
    }
    .js-faq summary::-webkit-details-marker { display: none; }
    .js-faq summary::after {
        content: "+"; font-size: 22px; font-weight: 400; color: #0a0a0a;
        transition: transform .2s ease;
    }
    .js-faq[open] summary::after { content: "×"; transform: rotate(0deg); }
    .js-faq-body { padding: 0 22px 18px; color: #555; font-size: 14.5px; line-height: 1.7; }

    /* === CTA === */
    .js-cta-section { padding: 70px 0; background: #f5f5f7; }
    .js-cta-card {
        position: relative;
        background: #0a0a0a; color: #fff;
        border-radius: 24px; padding: 60px 40px;
        overflow: hidden; text-align: center;
    }
    .js-cta-card::before, .js-cta-card::after {
        content: ""; position: absolute;
        border-radius: 50%; filter: blur(80px); opacity: .35;
        pointer-events: none;
    }
    .js-cta-card::before { width: 360px; height: 360px; background: #ff5722; top: -120px; right: -100px; }
    .js-cta-card::after  { width: 320px; height: 320px; background: #5e2bff; bottom: -120px; left: -100px; }
    .js-cta-card > * { position: relative; z-index: 2; }
    .js-cta-card h2 {
        font-size: clamp(26px, 3.4vw, 40px);
        font-weight: 800; letter-spacing: -.6px; margin: 0 0 14px;
    }
    .js-cta-card h2 .accent {
        background: linear-gradient(90deg, #ffd54f, #ff7043);
        -webkit-background-clip: text; background-clip: text;
        -webkit-text-fill-color: transparent; color: transparent;
    }
    .js-cta-card p { font-size: 16px; color: rgba(255,255,255,.85); max-width: 580px; margin: 0 auto 26px; line-height: 1.65; }
    .js-cta-actions { display: inline-flex; gap: 12px; flex-wrap: wrap; justify-content: center; }
    .js-cta-btn-primary, .js-cta-btn-outline {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 14px 28px; border-radius: 12px;
        font-weight: 700; font-size: 15px;
        text-decoration: none !important;
        transition: transform .15s ease;
    }
    .js-cta-btn-primary { background: #fff; color: #0a0a0a !important; }
    .js-cta-btn-primary:hover { transform: translateY(-2px); }
    .js-cta-btn-outline { background: transparent; color: #fff !important; border: 1.5px solid rgba(255,255,255,.30); }
    .js-cta-btn-outline:hover { background: rgba(255,255,255,.10); border-color: rgba(255,255,255,.50); }
</style>

<div class="js-page">
    {{-- ============ HERO ============ --}}
    <section class="js-hero">
        <div class="container">
            <span class="eyebrow"><i class="icon-feather-users"></i> Active U.S. Talent Pool</span>
            <h1>Meet professionals <span class="accent">ready to work</span></h1>
            <p>Browse thousands of verified job seekers across all 50 states. Filter by skill, location, and experience — and connect with your next great hire today.</p>

            <form action="{{ route('job-seekers.index') }}" method="GET" class="js-search-box">
                <input type="text" name="q" value="{{ $search }}"
                       placeholder="Search by name, username, or skill…"
                       autocomplete="off">
                <button type="submit"><i class="icon-feather-search"></i> Search</button>
            </form>

            <div class="js-hero-stats">
                <div class="stat"><strong>{{ number_format($stats['total_seekers'] ?? 0) }}+</strong><span>Active Job Seekers</span></div>
                <div class="stat"><strong>{{ number_format($stats['open_jobs'] ?? 0) }}+</strong><span>Open Jobs</span></div>
                <div class="stat"><strong>{{ number_format($stats['companies'] ?? 0) }}+</strong><span>Hiring Companies</span></div>
            </div>
        </div>
    </section>

    {{-- ============ CARDS GRID ============ --}}
    <section class="js-section">
        <div class="container">
            <div class="js-section-head">
                <div>
                    <h2>{{ $search ? 'Results for "'.$search.'"' : 'Featured Job Seekers' }}</h2>
                    <p>Real candidates actively looking for opportunities right now.</p>
                </div>
                <span class="count-pill"><i class="icon-feather-user-check"></i> {{ number_format($seekers->total()) }} talent profiles</span>
            </div>

            @if($seekers->count())
                <div class="js-grid">
                    @foreach($seekers as $seeker)
                        @php
                            $profile = JobSeekerPublicController::profileFor($seeker);
                            $initials = collect(preg_split('/\s+/', trim($seeker->name)))
                                ->filter()->take(2)
                                ->map(fn($w) => mb_strtoupper(mb_substr($w, 0, 1)))
                                ->implode('');
                        @endphp
                        <a href="{{ route('job-seekers.show', $seeker->username) }}" class="js-card">
                            <div class="js-card-head">
                                <div class="js-avatar">{{ $initials ?: 'U' }}</div>
                                <div>
                                    <h3 class="js-card-name">{{ $seeker->name }}</h3>
                                    <span class="js-card-loc"><i class="icon-feather-map-pin"></i> {{ $profile['city'] }}</span>
                                </div>
                            </div>
                            <p class="js-card-headline">{{ $profile['headline'] }}</p>
                            <div class="js-skills">
                                @foreach(array_slice($profile['skills'], 0, 4) as $skill)
                                    <span class="js-skill">{{ $skill }}</span>
                                @endforeach
                            </div>
                            <div class="js-card-meta">
                                <span class="js-card-exp"><i class="icon-feather-briefcase"></i> {{ $profile['experience_years'] }} yr exp · {{ $profile['open_to'] }}</span>
                                <span class="js-view-link">View Profile <i class="icon-feather-arrow-right"></i></span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="js-pagination">
                    {{ $seekers->onEachSide(1)->links() }}
                </div>
            @else
                <div class="js-empty">
                    <i class="icon-feather-users"></i>
                    <h4>No job seekers match your search</h4>
                    <p>Try a different keyword, or <a href="{{ route('job-seekers.index') }}" style="color:#0a0a0a;font-weight:600;">browse all profiles</a>.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- ============ FAQs ============ --}}
    <section class="js-faq-section">
        <div class="container">
            <div class="js-faq-head">
                <span class="eyebrow">FAQ</span>
                <h2>Common questions from employers</h2>
                <p>Everything you need to know about hiring through Jobs in USA.</p>
            </div>

            <div class="js-faqs">
                <details class="js-faq">
                    <summary>How do I contact a job seeker?</summary>
                    <div class="js-faq-body">Click any profile card to open the full profile page. From there, you can review their skills and preferences, then either post a matching job or contact them directly through your company dashboard.</div>
                </details>
                <details class="js-faq">
                    <summary>Are these candidates verified?</summary>
                    <div class="js-faq-body">Every account on Jobs in USA goes through email verification before profiles are listed publicly. Our team also flags suspicious accounts to keep the talent pool clean and trustworthy.</div>
                </details>
                <details class="js-faq">
                    <summary>Is there a cost to browse job seekers?</summary>
                    <div class="js-faq-body">Browsing the talent directory is completely free. To unlock direct messaging, post unlimited jobs, and access advanced filters, you can upgrade your company account at any time.</div>
                </details>
                <details class="js-faq">
                    <summary>Can I filter candidates by skill or location?</summary>
                    <div class="js-faq-body">Yes — use the search bar at the top to find candidates by name, username, or specific skills. Each card also shows the candidate's preferred U.S. city so you can spot regional matches at a glance.</div>
                </details>
                <details class="js-faq">
                    <summary>How fresh are these profiles?</summary>
                    <div class="js-faq-body">Profiles are sorted by most recently active. New candidates join the platform every day, and inactive profiles are filtered out automatically so you only see talent that's currently available.</div>
                </details>
                <details class="js-faq">
                    <summary>Can job seekers reach out to me first?</summary>
                    <div class="js-faq-body">Absolutely. When you post a job, candidates can apply directly through the listing — those applications appear in your company dashboard alongside the candidate's profile and contact info.</div>
                </details>
            </div>
        </div>
    </section>

    {{-- ============ CTA ============ --}}
    <section class="js-cta-section">
        <div class="container">
            <div class="js-cta-card">
                <h2>Ready to find your <span class="accent">next great hire?</span></h2>
                <p>Post a job, get discovered by qualified U.S. talent, and start building your team today. Join thousands of companies already hiring on Jobs in USA.</p>
                <div class="js-cta-actions">
                    <a href="{{ route('register') }}" class="js-cta-btn-primary">
                        Post a Job — Free <i class="icon-feather-arrow-right"></i>
                    </a>
                    <a href="{{ route('jobs.companies') }}" class="js-cta-btn-outline">
                        Browse Top Employers
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
