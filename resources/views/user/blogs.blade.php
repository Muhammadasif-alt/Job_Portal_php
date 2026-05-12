@extends('user.layouts.master')
@section('title', 'Career Blog — Job Search Tips, Resume Advice & Industry Insights | Jobs in USA')
@section('meta_description', 'Read the latest career advice, resume writing tips, salary guides, remote work insights and U.S. industry trends. Expert articles to help you land your next job faster.')
@section('meta_keywords', 'career blog, job search tips, resume writing tips, interview tips, salary guide usa, remote work tips, industry insights, career advice america')
@section('og_title', 'Career Blog — Expert Job Search Advice | Jobs in USA')
@section('og_description', 'Career advice, resume tips, interview playbooks and salary guides — everything you need to advance your career in the United States.')
@section('og_image', asset('public/user/images/blog-compact-post-01.jpg'))
@section('canonical', route('blog.index'))
@section('content')

@php
    // Helper closure: resolve correct image path whether stored as
    //   "public/user/images/..." (seeder) or "blogs/abc.jpg" (admin upload)
    $blogImg = function ($path) {
        if (!$path) return asset('public/user/images/blog-compact-post-01.jpg');
        if (str_starts_with($path, 'public/') || str_starts_with($path, 'http')) {
            return asset($path);
        }
        return asset('public/storage/' . $path);
    };
@endphp

<style>
    /* === Blog Hero (matches home/jobs/companies/categories/locations/about) === */
    .blog-hero {
        position: relative;
        background: linear-gradient(180deg, #f8faff 0%, #ffffff 50%, #f5f5f7 100%);
        padding: 70px 0 60px;
        overflow: hidden;
        border-bottom: 1px solid #f0f0f3;
    }
    .blog-hero::before {
        content: "";
        position: absolute; inset: 0;
        background-image: radial-gradient(circle at 12% 20%, rgba(10,10,10,.04) 0, transparent 40%),
                          radial-gradient(circle at 88% 80%, rgba(10,10,10,.03) 0, transparent 45%);
        pointer-events: none;
    }
    .blog-hero .container { position: relative; z-index: 2; text-align: center; }
    .blog-hero .breadcrumbs-mini { color: #777; font-size: 13px; margin-bottom: 14px; }
    .blog-hero .breadcrumbs-mini a { color: #0a0a0a; text-decoration: none; font-weight: 600; }
    .blog-hero .breadcrumbs-mini a:hover { text-decoration: underline; }
    .blog-hero .eyebrow {
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
    .blog-hero h1 {
        color: #0a0a0a;
        font-size: clamp(30px, 4.4vw, 52px);
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -1.2px;
        margin: 0 0 18px;
        max-width: 920px;
        margin-left: auto; margin-right: auto;
    }
    .blog-hero h1 .accent {
        background: linear-gradient(90deg, #0a0a0a, #404040);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
    }
    .blog-hero p.lead {
        color: #555;
        font-size: clamp(15px, 1.5vw, 17px);
        line-height: 1.65;
        max-width: 720px;
        margin: 0 auto 0;
    }

    /* === Blog body section === */
    .blog-body { padding: 60px 0; }

    /* 3-col grid */
    .blog-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 22px;
        margin-bottom: 30px;
    }
    @media (max-width: 991px) { .blog-grid { grid-template-columns: 1fr; } }

    .blog-card {
        display: flex;
        flex-direction: column;
        background: #fff;
        border: 1px solid #ececec;
        border-radius: 16px;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        transition: all .25s ease;
    }
    .blog-card:hover {
        border-color: #0a0a0a;
        transform: translateY(-4px);
        box-shadow: 0 18px 36px rgba(15,23,42,.10);
    }
    .blog-card-thumb {
        width: 100%;
        height: 200px;
        overflow: hidden;
        background: #f5f5f7;
        position: relative;
    }
    .blog-card-thumb img {
        width: 100%; height: 100%;
        object-fit: cover;
        display: block;
        transition: transform .5s ease;
    }
    .blog-card:hover .blog-card-thumb img { transform: scale(1.05); }
    .blog-card-thumb .cat-pill {
        position: absolute;
        top: 14px; left: 14px;
        background: #0a0a0a;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 999px;
        text-transform: uppercase;
        letter-spacing: .8px;
    }
    .blog-card-body {
        padding: 20px 22px 22px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .blog-card-meta {
        display: flex;
        gap: 14px;
        font-size: 12px;
        color: #777;
        margin-bottom: 10px;
        flex-wrap: wrap;
    }
    .blog-card-meta span { display: inline-flex; align-items: center; gap: 5px; }
    .blog-card-meta i { color: #0a0a0a; font-size: 13px; }
    .blog-card h3 {
        font-size: 18px;
        font-weight: 700;
        line-height: 1.35;
        margin-bottom: 10px;
        color: #0a0a0a;
        letter-spacing: -.2px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .blog-card p {
        font-size: 14px;
        line-height: 1.65;
        color: #555;
        margin-bottom: 14px;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .blog-card-readmore {
        color: #0a0a0a;
        font-weight: 700;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-transform: uppercase;
        letter-spacing: .5px;
        border-bottom: 1.5px solid #0a0a0a;
        padding-bottom: 2px;
        align-self: flex-start;
        transition: gap .15s ease;
    }
    .blog-card:hover .blog-card-readmore { gap: 10px; }

    /* === Sidebar === */
    .blog-sidebar { display: flex; flex-direction: column; gap: 20px; position: sticky; top: 90px; }
    .blog-sidebar-card {
        background: #fff;
        border: 1px solid #ececec;
        border-radius: 16px;
        padding: 24px;
    }

    /* Sidebar promo (replaces orange resume card) */
    .promo-card {
        background: #0a0a0a;
        border-radius: 16px;
        padding: 30px 26px;
        color: #fff;
        position: relative;
        overflow: hidden;
    }
    .promo-card::before, .promo-card::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        filter: blur(50px);
        opacity: .3;
        pointer-events: none;
    }
    .promo-card::before {
        width: 200px; height: 200px;
        background: #ff5722;
        top: -60px; right: -50px;
    }
    .promo-card::after {
        width: 160px; height: 160px;
        background: #5e2bff;
        bottom: -50px; left: -40px;
    }
    .promo-card-inner { position: relative; z-index: 2; }
    .promo-card .eyebrow {
        display: inline-block;
        background: rgba(255,255,255,.10);
        border: 1px solid rgba(255,255,255,.20);
        color: rgba(255,255,255,.85);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.4px;
        text-transform: uppercase;
        padding: 5px 12px;
        border-radius: 999px;
        margin-bottom: 14px;
    }
    .promo-card h4 {
        color: #fff;
        font-size: 18px;
        font-weight: 800;
        line-height: 1.25;
        margin: 0 0 8px;
    }
    .promo-card p {
        color: rgba(255,255,255,.78);
        font-size: 13.5px;
        line-height: 1.55;
        margin: 0 0 18px;
    }
    .promo-card .promo-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #fff;
        color: #0a0a0a !important;
        font-size: 13.5px;
        font-weight: 700;
        padding: 11px 20px;
        border-radius: 8px;
        text-decoration: none;
        transition: all .15s ease;
    }
    .promo-card .promo-btn:hover { transform: translateY(-1px); box-shadow: 0 8px 18px rgba(0,0,0,.25); }

    /* Sidebar latest posts */
    .blog-sidebar-card h3 {
        font-size: 15px;
        font-weight: 800;
        color: #0a0a0a;
        margin: 0 0 18px;
        padding: 0 0 14px;
        border-bottom: 2px solid #0a0a0a;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        display: inline-block;
    }
    .latest-list {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }
    .latest-list li { display: flex; gap: 12px; align-items: flex-start; }
    .latest-list .thumb {
        width: 64px; height: 64px;
        border-radius: 10px;
        overflow: hidden;
        flex-shrink: 0;
        background: #f5f5f7;
    }
    .latest-list .thumb img { width: 100%; height: 100%; object-fit: cover; }
    .latest-list .info h4 {
        font-size: 13.5px;
        line-height: 1.4;
        margin: 0 0 4px;
        font-weight: 600;
    }
    .latest-list .info h4 a { color: #0a0a0a; text-decoration: none; }
    .latest-list .info h4 a:hover { color: #404040; }
    .latest-list .info .date {
        font-size: 11.5px;
        color: #777;
        text-transform: uppercase;
        letter-spacing: .8px;
    }

    /* === Pagination — dark === */
    .blog-pagination {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }
    .blog-pagination ul {
        list-style: none; margin: 0; padding: 0;
        display: inline-flex;
        gap: 6px;
        flex-wrap: wrap;
    }
    .blog-pagination li a, .blog-pagination li span {
        min-width: 40px; height: 40px;
        padding: 0 12px;
        background: #fff;
        border: 1px solid #ececec;
        border-radius: 8px;
        color: #0a0a0a;
        font-size: 14px;
        font-weight: 600;
        display: inline-flex;
        align-items: center; justify-content: center;
        text-decoration: none;
        transition: all .15s ease;
    }
    .blog-pagination li a:hover { background: #f5f5f7; border-color: #0a0a0a; }
    .blog-pagination li a.active,
    .blog-pagination li.active a,
    .blog-pagination li span.current-page {
        background: #0a0a0a; color: #fff; border-color: #0a0a0a;
    }
    .blog-pagination .utf-pagination-container-aera ul {
        display: inline-flex !important;
    }

    /* Override theme pagination internal styles */
    .blog-pagination .utf-pagination-container-aera ul li a,
    .blog-pagination .utf-pagination-container-aera ul li span {
        min-width: 40px !important;
        height: 40px !important;
        padding: 0 12px !important;
        background: #fff !important;
        border: 1px solid #ececec !important;
        border-radius: 8px !important;
        color: #0a0a0a !important;
        font-weight: 600 !important;
    }
    .blog-pagination .utf-pagination-container-aera ul li a.current-page,
    .blog-pagination .utf-pagination-container-aera ul li.active a,
    .blog-pagination .utf-pagination-container-aera ul li.active span {
        background: #0a0a0a !important;
        color: #fff !important;
        border-color: #0a0a0a !important;
    }

    /* === FAQ === */
    .blog-faq-section {
        background: #fafafa;
        padding: 70px 0;
        border-top: 1px solid #ececec;
    }
    .blog-faq-head { text-align: center; max-width: 760px; margin: 0 auto 40px; }
    .blog-faq-head .eyebrow {
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
        margin-bottom: 14px;
    }
    .blog-faq-head h2 {
        font-size: clamp(26px, 3vw, 36px);
        font-weight: 800;
        color: #0a0a0a;
        line-height: 1.2;
        letter-spacing: -.5px;
        margin: 0 0 12px;
    }
    .blog-faq-head p { color: #555; font-size: 15.5px; line-height: 1.65; margin: 0; }

    .blog-faq-list { max-width: 880px; margin: 0 auto; }
    .blog-faq-item {
        background: #fff;
        border: 1px solid #ececec;
        border-radius: 12px;
        margin-bottom: 12px;
        overflow: hidden;
        transition: all .2s ease;
    }
    .blog-faq-item[open] {
        border-color: #0a0a0a;
        box-shadow: 0 4px 16px rgba(0,0,0,.06);
    }
    .blog-faq-item summary {
        padding: 20px 24px;
        font-weight: 600;
        font-size: 15.5px;
        color: #0a0a0a;
        cursor: pointer;
        list-style: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
    }
    .blog-faq-item summary::-webkit-details-marker { display: none; }
    .blog-faq-item summary::after {
        content: '+';
        font-size: 24px;
        color: #0a0a0a;
        font-weight: 300;
    }
    .blog-faq-item[open] summary::after { content: '−'; }
    .blog-faq-item .faq-answer {
        padding: 0 24px 22px;
        color: #555;
        font-size: 14.5px;
        line-height: 1.75;
    }
    .blog-faq-item .faq-answer a {
        color: #0a0a0a;
        font-weight: 600;
        border-bottom: 1.5px solid #0a0a0a;
        text-decoration: none;
    }

    @media (max-width: 991px) {
        .blog-sidebar { position: static; margin-top: 30px; }
    }
</style>

{{-- JSON-LD: Blog schema --}}
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Blog",
    "name": "Jobs in USA Career Blog",
    "url": "{{ route('blog.index') }}",
    "description": "Career advice, job search tips, resume writing guides, and U.S. industry insights from Jobs in USA.",
    "publisher": {
        "@@type": "Organization",
        "name": "Jobs in USA",
        "logo": { "@@type": "ImageObject", "url": "{{ asset('public/user/images/Jobs in USA.png') }}" }
    }
}
</script>

<!-- Hero -->
<section class="blog-hero">
    <div class="container">
        <div class="breadcrumbs-mini">
            <a href="{{ url('/') }}">Home</a> &nbsp;&rsaquo;&nbsp; Career Blog
        </div>
        <span class="eyebrow" data-aos="fade-down" data-aos-duration="600">Career Insights</span>
        <h1 data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">Expert Career Advice for <span class="accent">Job Seekers</span> in the USA</h1>
        <p class="lead" data-aos="fade-up" data-aos-duration="700" data-aos-delay="250">Resume writing tips, interview playbooks, salary negotiation guides, remote work insights and U.S. industry trends — everything you need to advance your career, written by hiring experts.</p>
    </div>
</section>

<!-- Blog Body -->
<section class="blog-body">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="blog-grid">
                    @forelse($blogs as $post)
                        <a href="{{ route('blog.show', $post->slug) }}" class="blog-card">
                            <div class="blog-card-thumb">
                                <img src="{{ $blogImg($post->featured_image) }}" alt="{{ $post->title }}" loading="lazy">
                                @if($post->category?->name)
                                    <span class="cat-pill">{{ $post->category->name }}</span>
                                @endif
                            </div>
                            <div class="blog-card-body">
                                <div class="blog-card-meta">
                                    <span><i class="icon-feather-user"></i>{{ $post->author_name ?? $post->author?->name ?? 'Jobs in USA Editorial' }}</span>
                                    <span><i class="icon-feather-calendar"></i>{{ optional($post->published_at)->format('M d, Y') }}</span>
                                    @if($post->reading_time)
                                        <span><i class="icon-feather-clock"></i>{{ $post->reading_time }} min</span>
                                    @endif
                                </div>
                                <h3>{{ $post->title }}</h3>
                                <p>{{ $post->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}</p>
                                <span class="blog-card-readmore">Read More <i class="icon-feather-arrow-right"></i></span>
                            </div>
                        </a>
                    @empty
                        <div class="text-center text-muted p-5" style="grid-column: 1 / -1;">
                            <p>No blog posts found.</p>
                        </div>
                    @endforelse
                </div>

                @if($blogs->hasPages())
                    <div class="blog-pagination">
                        <div class="utf-pagination-container-aera">
                            {{ $blogs->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-xl-4 col-lg-4">
                <div class="blog-sidebar">
                    <!-- Promo card (replaces orange resume widget) -->
                    <div class="promo-card">
                        <div class="promo-card-inner">
                            <span class="eyebrow">Stand Out</span>
                            <h4>Make Your Resume Work Harder for You</h4>
                            <p>Sign up free, build your profile, and let verified U.S. employers find you — your next role is one click away.</p>
                            <a href="{{ route('register') }}" class="promo-btn">
                                Create Free Account <i class="icon-feather-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Latest blog posts -->
                    <div class="blog-sidebar-card">
                        <h3>Latest Posts</h3>
                        <ul class="latest-list">
                            @forelse($latestBlogs as $latest)
                                <li>
                                    <div class="thumb">
                                        <img src="{{ $blogImg($latest->featured_image) }}" alt="{{ $latest->title }}" loading="lazy">
                                    </div>
                                    <div class="info">
                                        <h4><a href="{{ route('blog.show', $latest->slug) }}">{{ $latest->title }}</a></h4>
                                        <span class="date">{{ optional($latest->published_at)->format('M d, Y') }}</span>
                                    </div>
                                </li>
                            @empty
                                <li class="text-muted">No posts yet</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="blog-faq-section" aria-labelledby="blog-faq-heading">
    <div class="container">
        <header class="blog-faq-head">
            <span class="eyebrow">Common Questions</span>
            <h2 id="blog-faq-heading">Frequently Asked Career &amp; Job Search Questions</h2>
            <p>Get clear answers about applying for jobs, building a strong profile, employer verification, and how to make the most of Jobs in USA.</p>
        </header>

        <div class="blog-faq-list">
            <details class="blog-faq-item" open>
                <summary>Is Jobs in USA free for job seekers?</summary>
                <div class="faq-answer">Yes — 100% free. Creating an account, browsing jobs, and applying for positions is completely free for job seekers. <a href="{{ route('register') }}">Create your free account</a> to get started.</div>
            </details>
            <details class="blog-faq-item">
                <summary>How do I apply for a job on Jobs in USA?</summary>
                <div class="faq-answer">Browse our <a href="{{ route('jobs.index') }}">verified job listings</a> or use search filters to find roles that match your skills. Click any job to view full details, then hit "Apply." You'll need to be signed in with your resume ready.</div>
            </details>
            <details class="blog-faq-item">
                <summary>How can I make my profile stand out to employers?</summary>
                <div class="faq-answer">Add a complete resume, list your skills clearly, upload a professional photo, and keep your profile updated. Complete profiles are up to 3× more likely to attract employer attention. Read our <a href="{{ route('blog.index') }}">resume writing guides</a> for more tips.</div>
            </details>
            <details class="blog-faq-item">
                <summary>How do I post a job as an employer?</summary>
                <div class="faq-answer">Register an employer account, choose a posting plan that fits your hiring needs, and submit your listing through the dashboard. Once verified, your job goes live and reaches qualified candidates across all 50 U.S. states.</div>
            </details>
            <details class="blog-faq-item">
                <summary>Can I save jobs to apply later?</summary>
                <div class="faq-answer">Absolutely. Click the bookmark icon on any job listing to save it to your account. Review and apply to your saved jobs anytime from your dashboard.</div>
            </details>
            <details class="blog-faq-item">
                <summary>How often is the blog updated with new content?</summary>
                <div class="faq-answer">We publish fresh career articles, salary guides, interview tips, and industry insights every week. Subscribe to job alerts to also get notified when matching positions go live.</div>
            </details>
            <details class="blog-faq-item">
                <summary>How are job listings verified on Jobs in USA?</summary>
                <div class="faq-answer">Every employer profile is reviewed by our trust and safety team before going live. We verify business legitimacy and remove fraudulent or outdated listings — keeping the platform safe for all job seekers.</div>
            </details>
            <details class="blog-faq-item">
                <summary>What industries does Jobs in USA cover?</summary>
                <div class="faq-answer">We feature verified jobs across every major U.S. industry — healthcare, IT, software, construction, warehouse, transportation, retail, customer service, marketing, accounting, hospitality, education, finance, and more. Browse all <a href="{{ route('jobs.categories') }}">categories</a>.</div>
            </details>
        </div>
    </div>
</section>

{{-- FAQ JSON-LD for SEO --}}
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
        {"@@type":"Question","name":"Is Jobs in USA free for job seekers?","acceptedAnswer":{"@@type":"Answer","text":"Yes — 100% free. Creating an account, browsing jobs, and applying for positions is completely free for job seekers."}},
        {"@@type":"Question","name":"How do I apply for a job on Jobs in USA?","acceptedAnswer":{"@@type":"Answer","text":"Browse our verified job listings or use search filters to find roles that match your skills. Click any job to view details, then hit Apply."}},
        {"@@type":"Question","name":"How can I make my profile stand out to employers?","acceptedAnswer":{"@@type":"Answer","text":"Add a complete resume, list your skills clearly, upload a professional photo, and keep your profile updated. Complete profiles are up to 3× more likely to attract employer attention."}},
        {"@@type":"Question","name":"How do I post a job as an employer?","acceptedAnswer":{"@@type":"Answer","text":"Register an employer account, choose a posting plan, and submit your listing through the dashboard. Once verified, your job goes live across all 50 U.S. states."}},
        {"@@type":"Question","name":"How are job listings verified on Jobs in USA?","acceptedAnswer":{"@@type":"Answer","text":"Every employer profile is reviewed by our trust and safety team before going live. We verify business legitimacy and remove fraudulent listings."}}
    ]
}
</script>

@endsection
