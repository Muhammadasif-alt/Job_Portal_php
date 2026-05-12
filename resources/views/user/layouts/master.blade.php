<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from jobword.utouchdesign.com/jobword_ltr/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Apr 2025 10:25:57 GMT -->

<!-- Mirrored from www.jobword.flarza.com/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Oct 2025 12:15:52 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Jobs in USA">
    <meta name="theme-color" content="#ff8a00">
    @php
        $metaDescription =
            trim($__env->yieldContent('meta_description')) ?:
            'Find thousands of job opportunities across the USA. Search for jobs by location, category, and experience level on Jobs in USA - your premier job search platform.';
        $metaKeywords =
            trim($__env->yieldContent('meta_keywords')) ?:
            'jobs, USA jobs, job search, employment, careers, job listings, work opportunities, hiring, job board';
    @endphp

    <meta name="description" content="@yield('meta_description', 'Find latest jobs')">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="@yield('meta_keywords', $metaKeywords)">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    @stack('meta')
    <meta property="og:title" content="@yield('og_title', 'Jobs in USA - Find Your Dream Job Today')">
    <meta property="og:description" content="@yield('og_description', $metaDescription)">
    <meta property="og:image" content="@yield('og_image', asset('public/user/images/job-portal-og-image.jpg'))">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jobs Portal')</title>


    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('public/user/images/favicon.png') }}">

    <!-- DNS prefetch + preconnect for faster third-party loads -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="dns-prefetch" href="//www.googletagmanager.com">

    <!-- Google Fonts (single request, swap so text shows immediately) -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('public/user/css/bootstrap-grid.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/style.css') }}">
    <style>
        @media (min-width: 1200px) {
            .container { max-width: 1440px !important; }
        }
        /* Prevent horizontal scroll on mobile */
        html, body { overflow-x: hidden; max-width: 100%; }

        /* === Unified hero background image across ALL pages === */
        body .intro-banner.intro-hero-v2,
        body .about-hero,
        body .contact-hero,
        body .jobs-hero,
        body .cat-hero,
        body .loc-hero,
        body .companies-hero,
        body .blog-hero,
        body .js-hero,
        body .seeker-hero,
        body .utf-page-heading-area {
            background-image: url('{{ asset('public/user/images/hero-diverse-professionals.jpg') }}') !important;
            background-color: transparent !important;
            background-size: cover !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            position: relative !important;
            isolation: isolate;
        }
        body .intro-banner.intro-hero-v2::before,
        body .about-hero::before,
        body .contact-hero::before,
        body .jobs-hero::before,
        body .cat-hero::before,
        body .loc-hero::before,
        body .companies-hero::before,
        body .blog-hero::before,
        body .js-hero::before,
        body .seeker-hero::before,
        body .utf-page-heading-area::before {
            content: "" !important;
            position: absolute !important;
            inset: 0 !important;
            top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important;
            width: auto !important; height: auto !important;
            background-image: linear-gradient(135deg,
                rgba(247,244,239,0.90) 0%,
                rgba(247,244,239,0.82) 40%,
                rgba(255,255,255,0.95) 100%) !important;
            background-color: transparent !important;
            z-index: 1 !important;
            pointer-events: none !important;
            opacity: 1 !important;
            display: block !important;
        }
        body .intro-banner.intro-hero-v2 > *,
        body .about-hero > *,
        body .contact-hero > *,
        body .jobs-hero > *,
        body .cat-hero > *,
        body .loc-hero > *,
        body .companies-hero > *,
        body .blog-hero > *,
        body .utf-page-heading-area > * {
            position: relative;
            z-index: 2;
        }

        /* === Global 2-color H1 accent (orange gradient) across ALL hero variations === */
        body .intro-banner.intro-hero-v2 h1 .accent,
        body .about-hero h1 .accent,
        body .about-hero h1 > span,
        body .contact-hero h1 .accent,
        body .jobs-hero h1 .accent,
        body .cat-hero h1 .accent,
        body .cat-hero h1 span,
        body .loc-hero h1 .accent,
        body .companies-hero h1 .accent,
        body .blog-hero h1 .accent,
        body .js-hero h1 .accent,
        body .seeker-hero h1 .accent,
        body .utf-page-heading-area h1 .accent {
            background: linear-gradient(90deg, #ff5722, #ff8a00 60%, #ffab40) !important;
            -webkit-background-clip: text !important;
            background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            color: transparent !important;
            font-style: inherit;
            font-weight: inherit;
        }

        /* Hide decorative orange/purple blobs on job-seekers heroes (had ::after blobs) */
        body .js-hero::after,
        body .seeker-hero::after { display: none !important; }
        body .js-hero > *,
        body .seeker-hero > * { position: relative; z-index: 2; }

        /* Override white text → dark text on job-seekers heroes (now use light overlay) */
        body .js-hero,
        body .seeker-hero { color: #0a0a0a !important; }
        body .js-hero h1,
        body .seeker-hero h1 { color: #0a0a0a !important; }
        body .js-hero p,
        body .seeker-hero p { color: #555 !important; }
        body .js-hero .eyebrow,
        body .seeker-hero .eyebrow {
            background: #fff !important;
            border: 1px solid #e5e5e7 !important;
            color: #555 !important;
            backdrop-filter: none !important;
        }
        body .js-hero-stats { border-top-color: rgba(10,10,10,.10) !important; }
        body .js-hero-stats .stat strong { color: #0a0a0a !important; }
        body .js-hero-stats .stat span { color: #555 !important; }
        /* Accent gradient text — re-tune to brand orange (against light bg) */
        body .js-hero h1 .accent,
        body .seeker-hero h1 .accent {
            background: linear-gradient(90deg, #ff5722, #ff8a00 60%, #ffab40) !important;
            -webkit-background-clip: text !important;
            background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            color: transparent !important;
        }
        /* Global brand override — back-to-top, pagination active, default theme orange */
        #backtotop a {
            background-color: #0a0a0a !important;
            color: #fff !important;
            border-color: #0a0a0a !important;
        }
        #backtotop a:hover { background-color: #1a1a1a !important; }
        .pagination ul li a.current-page {
            background-color: #0a0a0a !important;
            color: #fff !important;
            border-color: #0a0a0a !important;
        }
        /* Hide preloader fast — fallback if JS hides it later */
        .preloader { transition: opacity .25s ease; }
    </style>

    <!-- Select2 CSS — non-blocking; only the jobs filter / a few selects use it -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
          media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"></noscript>

    <!-- Google Tag Manager (deferred — does not block first paint) -->
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      window.addEventListener('load', function () {
        // gtag.js
        var s1 = document.createElement('script');
        s1.async = true;
        s1.src = 'https://www.googletagmanager.com/gtag/js?id=G-2NKX5SJMB7';
        document.head.appendChild(s1);
        gtag('js', new Date());
        gtag('config', 'G-2NKX5SJMB7');

        // GTM
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-WTHF244L');
      });
    </script>

    {{-- AOS (Animate On Scroll) — lightweight animation library --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
    <style>
        /* Reduce motion preference — accessibility */
        @media (prefers-reduced-motion: reduce) {
            [data-aos] { transition-duration: 0.01ms !important; transform: none !important; opacity: 1 !important; }
        }
        /* Subtle custom AOS variants */
        [data-aos="fade-up-soft"] { opacity: 0; transform: translateY(20px); transition: opacity 0.7s ease, transform 0.7s ease; }
        [data-aos="fade-up-soft"].aos-animate { opacity: 1; transform: translateY(0); }
    </style>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WTHF244L"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Preloader Start -->
    <div class="preloader">
        <div class="utf-preloader">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- Preloader End -->

    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Header Container -->
        <header id="utf-header-container-block">
            <div id="header">
                <div class="container">
                    <div class="utf-left-side">
                        <div id="logo"> <a href="/"><img src="{{ asset('public/user/images/jobs-in-usa.png') }}"
                                    alt="Jobs in USA" loading="lazy"></a> </div>
                        <nav id="navigation">
                            <ul id="responsive">

                                <li>
                                    <a href="{{ route('about.us') }}"
                                        class="{{ request()->routeIs('about.us') ? 'current' : '' }}">
                                        About Us
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('jobs.companies') }}"
                                        class="{{ request()->routeIs('jobs.companies', 'companies.show') ? 'current' : '' }}">
                                        Employers
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('job-seekers.index') }}"
                                        class="{{ request()->routeIs('job-seekers.*') ? 'current' : '' }}">
                                        Job Seekers
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('jobs.index') }}"
                                        class="{{ request()->routeIs('jobs.index', 'jobs.show', 'jobs.search', 'jobs.location', 'jobs.locations', 'jobs.categories', 'jobs.category') ? 'current' : '' }}">
                                        Jobs
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('blog.index') }}"
                                        class="{{ request()->routeIs('blog.*') ? 'current' : '' }}">
                                        Blogs
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('contact.us') }}"
                                        class="{{ request()->routeIs('contact.us') ? 'current' : '' }}">
                                        Contact
                                    </a>
                                </li>

                                @guest
                                    <li class="mobile-only-auth">
                                        <a href="{{ route('login') }}">Sign In</a>
                                    </li>
                                    <li class="mobile-only-auth">
                                        <a href="{{ route('register') }}">Sign Up</a>
                                    </li>
                                @endguest

                            </ul>
                        </nav>

                        <div class="clearfix"></div>
                    </div>

                    <div class="utf-right-side">
                        @auth
                            @php
                                $authUser = auth()->user();
                                $roleLabel = match ($authUser->role) {
                                    'admin'      => 'Administrator',
                                    'company'    => 'Company',
                                    'job_seeker' => 'Job Seeker',
                                    default      => 'Member',
                                };
                                $dashUrl = match ($authUser->role) {
                                    'admin'      => route('admin.dashboard'),
                                    'company'    => route('company.dashboard'),
                                    'job_seeker' => route('seeker.dashboard'),
                                    default      => url('/'),
                                };
                            @endphp
                            <div class="utf-header-widget-item">
                                <a href="{{ $dashUrl }}" class="utf-button-header-bg" title="Go to your dashboard">
                                    <i class="icon-feather-grid"></i> <span>Dashboard</span>
                                </a>
                            </div>
                            <div class="utf-header-widget-item">
                                <form method="POST" action="{{ route('logout') }}" class="utf-user-logout-form">
                                    @csrf
                                    <button type="submit" class="log-in-button" title="Sign out">
                                        <i class="icon-feather-log-out"></i> <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="utf-header-widget-item">
                                <a href="{{ route('login') }}" class="log-in-button">
                                    <i class="icon-feather-log-in"></i> <span>Sign In</span>
                                </a>
                            </div>
                            <div class="utf-header-widget-item">
                                <a href="{{ route('register') }}" class="utf-button-header-bg">
                                    <i class="icon-feather-user-plus"></i> <span>Sign Up</span>
                                </a>
                            </div>
                        @endauth
                        <span class="mmenu-trigger">
                            <button class="hamburger utf-hamburger-collapse-item" type="button">
                                <span class="utf-hamburger-box-item">
                                    <span class="utf-hamburger-inner-item"></span>
                                </span>
                            </button>
                        </span>
                    </div>
                    <style>
                        /* === User dropdown chip (logged-in navbar) === */
                        .utf-user-dropdown { position: relative; }
                        .utf-user-chip {
                            display: inline-flex; align-items: center; gap: 10px;
                            background: #0a0a0a; color: #fff;
                            border: 1px solid #0a0a0a; border-radius: 999px;
                            padding: 5px 14px 5px 5px; height: 46px;
                            font: 600 14px/1 'Nunito', system-ui, sans-serif;
                            cursor: pointer;
                            transition: background .15s ease, box-shadow .15s ease;
                        }
                        .utf-user-chip:hover { background: #1a1a1a; box-shadow: 0 6px 14px rgba(10,10,10,.20); }
                        .utf-user-chip .user-avatar {
                            width: 36px; height: 36px; border-radius: 50%;
                            overflow: hidden; flex-shrink: 0; padding: 0; margin: 0;
                            border: 2px solid rgba(255,255,255,.18);
                        }
                        .utf-user-chip .user-avatar img { width: 100%; height: 100%; object-fit: cover; }
                        .utf-user-chip .user-name { color: #fff; white-space: nowrap; }
                        .utf-user-chip .chev { font-size: 14px; opacity: .8; transition: transform .2s ease; }
                        .utf-user-dropdown.open .utf-user-chip .chev { transform: rotate(180deg); }

                        .utf-user-menu {
                            position: absolute; top: calc(100% + 10px); right: 0;
                            min-width: 250px;
                            background: #fff;
                            border: 1px solid #ececec;
                            border-radius: 14px;
                            box-shadow: 0 24px 48px rgba(15,23,42,.12);
                            padding: 8px;
                            z-index: 1000;
                            opacity: 0; pointer-events: none;
                            transform: translateY(-6px);
                            transition: opacity .15s ease, transform .15s ease;
                        }
                        .utf-user-dropdown.open .utf-user-menu {
                            opacity: 1; pointer-events: auto; transform: translateY(0);
                        }
                        .utf-user-menu-head {
                            padding: 12px 14px 14px;
                            border-bottom: 1px solid #f3f4f6;
                            margin-bottom: 6px;
                        }
                        .utf-user-menu-head .nm { font-weight: 700; color: #0a0a0a; font-size: 14.5px; line-height: 1.3; }
                        .utf-user-menu-head .rl {
                            display: inline-block; margin-top: 4px;
                            font-size: 11px; font-weight: 700; color: #5e2bff;
                            background: #f3efff; padding: 3px 10px; border-radius: 999px;
                            letter-spacing: 1px; text-transform: uppercase;
                        }
                        .utf-user-menu-item {
                            display: flex; align-items: center; gap: 12px;
                            width: 100%;
                            padding: 10px 14px;
                            border-radius: 8px;
                            font: 600 14px/1.3 'Nunito', system-ui, sans-serif;
                            color: #374151 !important;
                            text-decoration: none !important;
                            background: transparent;
                            border: none; text-align: left;
                            cursor: pointer;
                            transition: background .12s ease, color .12s ease;
                        }
                        .utf-user-menu-item:hover { background: #f3f4f6; color: #0a0a0a !important; }
                        .utf-user-menu-item i {
                            width: 32px; height: 32px; border-radius: 8px;
                            background: #f3f4f6; color: #0a0a0a;
                            display: inline-flex; align-items: center; justify-content: center;
                            font-size: 15px; flex-shrink: 0;
                        }
                        .utf-user-menu-item:hover i { background: #0a0a0a; color: #fff; }
                        .utf-user-menu-item.logout { color: #b91c1c !important; }
                        .utf-user-menu-item.logout i { color: #b91c1c; }
                        .utf-user-menu-item.logout:hover { background: #fef2f2; color: #b91c1c !important; }
                        .utf-user-menu-item.logout:hover i { background: #b91c1c; color: #fff; }
                        .utf-user-menu-sep { height: 1px; background: #f3f4f6; margin: 6px 4px; }
                        .utf-user-logout-form { margin: 0; padding: 0; }

                        @media (max-width: 575px) {
                            .utf-user-chip .user-name { display: none; }
                            .utf-user-menu { right: -10px; min-width: 230px; }
                        }

                        /* === ManageWP-inspired clean navbar === */
                        #utf-header-container-block { background: #fff !important; }
                        #header {
                            background: #fff !important;
                            border-bottom: 1px solid #f0f0f3;
                            box-shadow: 0 1px 2px rgba(15,23,42,.02);
                        }
                        #header .container {
                            display: flex !important;
                            align-items: center;
                            justify-content: space-between;
                            gap: 24px;
                            height: 76px;
                        }
                        #header .utf-left-side {
                            display: flex !important;
                            align-items: center;
                            gap: 50px;
                            flex: 1 1 auto !important;
                            width: auto !important;
                            float: none !important;
                            position: relative !important;
                            justify-content: flex-start;
                        }
                        #header .utf-right-side {
                            display: flex !important;
                            align-items: center !important;
                            gap: 12px;
                            flex-shrink: 0;
                            flex-wrap: nowrap !important;
                            position: relative !important;
                            right: auto !important;
                            float: none !important;
                            background: transparent !important;
                            width: auto !important;
                            height: 76px !important;
                        }

                        /* Logo */
                        #header #logo { flex-shrink: 0; }
                        #header #logo img { max-height: 38px; width: auto; }

                        /* Nav menu */
                        #header #navigation {
                            flex: 1;
                            display: flex;
                            justify-content: center;
                        }
                        #header #navigation > ul {
                            display: flex;
                            align-items: center;
                            gap: 4px;
                            list-style: none;
                            margin: 0;
                            padding: 0;
                        }
                        #header #navigation > ul > li > a {
                            display: inline-flex;
                            align-items: center;
                            color: #1a1a1a !important;
                            font-size: 15px !important;
                            font-weight: 500 !important;
                            text-decoration: none;
                            padding: 10px 16px !important;
                            border-radius: 8px;
                            background: transparent !important;
                            border: none !important;
                            line-height: 1 !important;
                            height: auto !important;
                            transition: background .15s ease, color .15s ease;
                            text-transform: none !important;
                            letter-spacing: 0 !important;
                            white-space: nowrap !important;
                        }
                        #header #navigation > ul > li > a:hover {
                            background: #f5f5f7 !important;
                            color: #000 !important;
                        }
                        #header #navigation > ul > li > a.current {
                            color: #000 !important;
                            font-weight: 600 !important;
                            background: #f5f5f7 !important;
                        }
                        #header #navigation > ul > li > a::after,
                        #header #navigation > ul > li > a::before { display: none !important; }

                        /* Right-side widget container — every direct wrapper aligned identically */
                        #header .utf-right-side .utf-header-widget-item {
                            display: inline-flex !important;
                            align-items: center !important;
                            justify-content: center !important;
                            align-self: center !important;
                            height: 46px !important;
                            margin: 0 !important;
                            padding: 0 !important;
                            float: none !important;
                            border: none !important;
                            background: transparent !important;
                            line-height: 1 !important;
                            vertical-align: middle !important;
                            top: auto !important;
                            right: auto !important;
                            bottom: auto !important;
                            left: auto !important;
                            transform: none !important;
                            inset: auto !important;
                            position: relative !important;
                        }

                        /* === Authenticated user chip — kill ALL inherited positioning from template === */
                        #header .utf-right-side .utf-header-notifications,
                        #header .utf-right-side .user-menu,
                        #header .utf-right-side .utf-header-notifications-trigger,
                        #header .utf-right-side .user-profile-title {
                            position: static !important;
                            top: auto !important;
                            right: auto !important;
                            bottom: auto !important;
                            left: auto !important;
                            transform: none !important;
                            float: none !important;
                            display: inline-flex !important;
                            align-items: center !important;
                            justify-content: center !important;
                            margin: 0 !important;
                            padding: 0 !important;
                            border: none !important;
                            background: transparent !important;
                            box-shadow: none !important;
                            height: 46px !important;
                            line-height: 1 !important;
                            vertical-align: middle !important;
                            width: auto !important;
                            min-width: 0 !important;
                            max-width: none !important;
                            inset: auto !important;
                        }
                        #header .utf-right-side .utf-header-notifications::before,
                        #header .utf-right-side .utf-header-notifications::after,
                        #header .utf-right-side .user-menu::before,
                        #header .utf-right-side .user-menu::after,
                        #header .utf-right-side .utf-header-notifications-trigger::before,
                        #header .utf-right-side .utf-header-notifications-trigger::after,
                        #header .utf-right-side .user-profile-title::before,
                        #header .utf-right-side .user-profile-title::after {
                            display: none !important;
                            content: none !important;
                        }
                        #header .utf-right-side .user-profile-title > a {
                            position: static !important;
                            top: auto !important;
                            right: auto !important;
                            bottom: auto !important;
                            left: auto !important;
                            transform: none !important;
                            float: none !important;
                            display: inline-flex !important;
                            align-items: center !important;
                            justify-content: center;
                            gap: 10px;
                            padding: 6px 18px 6px 6px !important;
                            background: #fff !important;
                            border: 1.5px solid #1a1a1a !important;
                            border-radius: 8px !important;
                            color: #1a1a1a !important;
                            text-decoration: none !important;
                            font-weight: 600 !important;
                            font-size: 14.5px !important;
                            line-height: 1.4 !important;
                            min-width: 200px !important;
                            height: 46px !important;
                            box-sizing: border-box;
                            margin: 0 !important;
                            inset: auto !important;
                            vertical-align: middle !important;
                            transition: background .15s ease, color .15s ease;
                        }
                        #header .utf-right-side .user-profile-title > a:hover {
                            background: #1a1a1a !important;
                            color: #fff !important;
                        }
                        #header .utf-right-side .user-profile-title > a:hover .user-name { color: #fff !important; }
                        #header .utf-right-side .user-profile-title .user-avatar {
                            width: 32px !important;
                            height: 32px !important;
                            min-width: 32px;
                            border-radius: 50% !important;
                            overflow: hidden;
                            border: none !important;
                            background: #0a0a0a;
                            margin: 0 !important;
                            padding: 0 !important;
                            position: static !important;
                            display: inline-flex !important;
                            align-items: center;
                            justify-content: center;
                            top: auto !important;
                            float: none !important;
                            flex-shrink: 0;
                        }
                        #header .utf-right-side .user-profile-title .user-avatar img {
                            width: 100% !important;
                            height: 100% !important;
                            object-fit: cover;
                            border-radius: 50% !important;
                            display: block !important;
                            border: none !important;
                            margin: 0 !important;
                            padding: 0 !important;
                        }
                        #header .utf-right-side .user-profile-title .user-avatar::after,
                        #header .utf-right-side .user-profile-title .user-avatar.status-online::after {
                            display: none !important;
                        }
                        #header .utf-right-side .user-profile-title .user-name {
                            color: #1a1a1a !important;
                            font-size: 14.5px !important;
                            font-weight: 600 !important;
                            line-height: 1 !important;
                            margin: 0 !important;
                            padding: 0 !important;
                            white-space: nowrap !important;
                            transition: color .15s ease;
                        }
                        #header .utf-right-side .user-profile-title .user-name::after { display: none !important; }

                        /* Login / Logout button — outlined dark, fixed 46px height to match user chip */
                        #header .utf-right-side .log-in-button {
                            display: inline-flex !important;
                            align-items: center;
                            justify-content: center;
                            gap: 8px;
                            color: #1a1a1a !important;
                            background: #fff !important;
                            border: 1.5px solid #1a1a1a !important;
                            font-size: 14.5px !important;
                            font-weight: 600 !important;
                            text-decoration: none;
                            padding: 0 28px !important;
                            border-radius: 8px !important;
                            min-width: 120px !important;
                            height: 46px !important;
                            box-sizing: border-box;
                            line-height: 1 !important;
                            margin: 0 !important;
                            top: auto !important;
                            transform: none !important;
                            white-space: nowrap !important;
                            transition: all .15s ease;
                        }
                        #header .utf-right-side .log-in-button span,
                        #header .utf-right-side .utf-button-header-bg span {
                            white-space: nowrap !important;
                        }
                        #header .utf-right-side .log-in-button i {
                            color: #1a1a1a !important;
                            background: transparent !important;
                            font-size: 15px !important;
                            margin: 0 !important;
                            top: 0 !important;
                            line-height: 1 !important;
                        }
                        #header .utf-right-side .log-in-button:hover {
                            background: #1a1a1a !important;
                            color: #fff !important;
                            border-color: #1a1a1a !important;
                        }
                        #header .utf-right-side .log-in-button:hover i { color: #fff !important; }

                        /* Logout form — make it inline & remove default button chrome */
                        #header .utf-right-side .logout-form {
                            display: inline-flex !important;
                            align-items: center !important;
                            justify-content: center !important;
                            margin: 0 !important;
                            padding: 0 !important;
                            border: none !important;
                            background: transparent !important;
                            height: 46px !important;
                            line-height: 1 !important;
                            vertical-align: middle !important;
                        }
                        #header .utf-right-side button.log-in-button {
                            cursor: pointer;
                            font-family: inherit !important;
                            vertical-align: middle !important;
                        }

                        /* Sign Up button — filled black, same 46px height */
                        #header .utf-right-side .utf-button-header-bg {
                            display: inline-flex !important;
                            align-items: center;
                            justify-content: center;
                            gap: 8px;
                            background: #1a1a1a !important;
                            color: #fff !important;
                            font-size: 14.5px !important;
                            font-weight: 600 !important;
                            text-decoration: none;
                            padding: 0 28px !important;
                            border-radius: 8px !important;
                            border: 1.5px solid #1a1a1a !important;
                            min-width: 120px !important;
                            height: 46px !important;
                            box-sizing: border-box;
                            line-height: 1 !important;
                            margin: 0 !important;
                            white-space: nowrap !important;
                            transition: all .15s ease;
                        }
                        #header .utf-right-side .utf-button-header-bg i {
                            color: #fff !important;
                            font-size: 15px !important;
                            margin: 0 !important;
                            line-height: 1 !important;
                        }
                        #header .utf-right-side .utf-button-header-bg:hover {
                            background: #000 !important;
                            border-color: #000 !important;
                            color: #fff !important;
                            transform: translateY(-1px);
                            box-shadow: 0 4px 10px rgba(0,0,0,.18);
                        }

                        /* Mobile toggle */
                        #header .mmenu-trigger .hamburger { padding: 8px; }
                        #header .mmenu-trigger .utf-hamburger-inner-item,
                        #header .mmenu-trigger .utf-hamburger-inner-item::before,
                        #header .mmenu-trigger .utf-hamburger-inner-item::after {
                            background: #1a1a1a !important;
                        }
                        @media (min-width: 1100px) {
                            #header .mmenu-trigger { display: none !important; }
                        }

                        /* Hide mobile-only auth links on desktop */
                        @media (min-width: 1100px) {
                            #header #navigation .mobile-only-auth { display: none !important; }
                        }

                        /* Mobile/tablet — only Logo + Hamburger in header; Sign In/Up moved into menu */
                        @media (max-width: 1099px) {
                            #header .container { gap: 8px !important; padding: 0 14px !important; }
                            #header .utf-right-side { gap: 8px !important; }
                            #header .utf-right-side .log-in-button,
                            #header .utf-right-side .utf-button-header-bg {
                                display: none !important;
                            }
                            #header .mmenu-trigger {
                                display: inline-flex !important;
                                align-items: center;
                                justify-content: center;
                                width: 44px !important;
                                height: 44px !important;
                                background: #1a1a1a !important;
                                border-radius: 8px !important;
                                margin: 0 !important;
                                top: auto !important;
                                float: none !important;
                                position: relative !important;
                            }
                            #header .mmenu-trigger .hamburger {
                                padding: 0 !important;
                                top: auto !important;
                                left: auto !important;
                                height: 22px !important;
                                width: 26px !important;
                                transform: none !important;
                                -moz-transform: none !important;
                                position: relative !important;
                                display: inline-flex !important;
                                align-items: center;
                                justify-content: center;
                            }
                            #header .mmenu-trigger .utf-hamburger-box-item {
                                position: relative !important;
                                width: 22px !important;
                                height: 18px !important;
                                display: inline-block !important;
                            }
                            #header .mmenu-trigger .utf-hamburger-inner-item,
                            #header .mmenu-trigger .utf-hamburger-inner-item::before,
                            #header .mmenu-trigger .utf-hamburger-inner-item::after {
                                background-color: #fff !important;
                                background: #fff !important;
                                width: 22px !important;
                                height: 2.5px !important;
                                border-radius: 2px !important;
                                left: 0 !important;
                                position: absolute !important;
                            }
                            #header .mmenu-trigger .utf-hamburger-inner-item { top: 50% !important; margin-top: -1.25px !important; }
                            #header .mmenu-trigger .utf-hamburger-inner-item::before { top: -8px !important; content: "" !important; display: block !important; }
                            #header .mmenu-trigger .utf-hamburger-inner-item::after { bottom: -8px !important; top: auto !important; content: "" !important; display: block !important; }
                            #header #logo img { max-height: 32px !important; }
                        }

                        /* === Mobile menu (mmenu) — visual feedback on items === */
                        .mm-menu { --mm-color-background: #1a1a1a; }
                        .mm-menu .mm-navbar { color: #fff !important; font-weight: 700; }
                        .mm-menu .mm-listitem { position: relative; }
                        .mm-menu .mm-listitem:after {
                            border-color: rgba(255,255,255,.08) !important;
                            left: 20px !important;
                        }
                        .mm-menu .mm-listitem__text,
                        .mm-menu .mm-listitem > a {
                            color: #fff !important;
                            padding: 18px 44px 18px 22px !important;
                            font-size: 15px !important;
                            font-weight: 500 !important;
                            transition: background .15s ease, color .15s ease;
                            display: block;
                            position: relative;
                        }
                        /* Chevron arrow on the right */
                        .mm-menu .mm-listitem > a::after,
                        .mm-menu .mm-listitem__text::after {
                            content: "";
                            position: absolute;
                            right: 22px;
                            top: 50%;
                            width: 8px;
                            height: 8px;
                            border-right: 2px solid rgba(255,255,255,.5);
                            border-top: 2px solid rgba(255,255,255,.5);
                            transform: translateY(-50%) rotate(45deg);
                            transition: border-color .15s ease, right .15s ease;
                            pointer-events: none;
                        }
                        /* Tap/active feedback */
                        .mm-menu .mm-listitem > a:hover,
                        .mm-menu .mm-listitem > a:focus,
                        .mm-menu .mm-listitem > a:active,
                        .mm-menu .mm-listitem__text:hover,
                        .mm-menu .mm-listitem__text:active {
                            background: rgba(255,255,255,.06) !important;
                            color: #ff8a00 !important;
                        }
                        .mm-menu .mm-listitem > a:hover::after,
                        .mm-menu .mm-listitem > a:active::after,
                        .mm-menu .mm-listitem__text:hover::after,
                        .mm-menu .mm-listitem__text:active::after {
                            border-color: #ff8a00;
                            right: 18px;
                        }
                        /* Sign Up — accent pill style to stand out */
                        .mm-menu .mm-listitem.mobile-only-auth:last-child > a,
                        .mm-menu .mm-listitem.mobile-only-auth:last-child .mm-listitem__text {
                            background: #ff8a00 !important;
                            color: #fff !important;
                            margin: 14px 18px 0 !important;
                            padding: 14px 22px !important;
                            border-radius: 10px !important;
                            text-align: center !important;
                            font-weight: 700 !important;
                        }
                        .mm-menu .mm-listitem.mobile-only-auth:last-child:after { display: none !important; }
                        .mm-menu .mm-listitem.mobile-only-auth:last-child > a::after,
                        .mm-menu .mm-listitem.mobile-only-auth:last-child .mm-listitem__text::after { display: none !important; }
                        /* Sign In — outlined style above Sign Up */
                        .mm-menu .mm-listitem.mobile-only-auth:nth-last-child(2) > a,
                        .mm-menu .mm-listitem.mobile-only-auth:nth-last-child(2) .mm-listitem__text {
                            border: 1.5px solid rgba(255,255,255,.25) !important;
                            margin: 18px 18px 0 !important;
                            padding: 14px 22px !important;
                            border-radius: 10px !important;
                            text-align: center !important;
                            font-weight: 600 !important;
                        }
                        .mm-menu .mm-listitem.mobile-only-auth:nth-last-child(2):after { display: none !important; }
                        .mm-menu .mm-listitem.mobile-only-auth:nth-last-child(2) > a::after,
                        .mm-menu .mm-listitem.mobile-only-auth:nth-last-child(2) .mm-listitem__text::after { display: none !important; }

                        /* Auth user state */
                        #header .utf-right-side .utf-header-notifications,
                        #header .utf-right-side .utf-header-notifications-trigger,
                        #header .utf-right-side .utf-header-notifications-trigger.user-profile-title {
                            display: inline-flex !important;
                            align-items: center !important;
                            margin: 0 !important;
                            padding: 0 !important;
                            background: transparent !important;
                            box-shadow: none !important;
                            border: none !important;
                            float: none !important;
                            position: relative !important;
                            top: auto !important;
                            transform: none !important;
                            height: auto !important;
                            width: auto !important;
                        }
                        #header .utf-right-side .utf-header-notifications-trigger a {
                            display: inline-flex !important;
                            align-items: center !important;
                            gap: 10px;
                            color: #1a1a1a !important;
                            text-decoration: none;
                            background: #f5f5f7;
                            padding: 6px 14px 6px 6px;
                            border-radius: 999px;
                            transition: background .15s ease;
                            line-height: 1 !important;
                        }
                        #header .utf-right-side .utf-header-notifications-trigger a:hover { background: #ebebef; }
                        #header .utf-right-side .user-avatar {
                            width: 32px !important; height: 32px !important;
                            border-radius: 50% !important;
                            overflow: hidden;
                            display: inline-flex !important;
                            align-items: center; justify-content: center;
                            margin: 0 !important; padding: 0 !important;
                            position: relative;
                            background: linear-gradient(135deg, #1a1a1a, #404040);
                            flex-shrink: 0;
                        }
                        #header .utf-right-side .user-avatar img {
                            width: 100% !important; height: 100% !important;
                            object-fit: cover; display: block;
                            border-radius: 50%;
                        }
                        #header .utf-right-side .user-avatar.status-online::after {
                            display: none;
                        }
                        #header .utf-right-side .user-name {
                            font-weight: 600 !important;
                            font-size: 13.5px !important;
                            color: #1a1a1a !important;
                            white-space: nowrap;
                            line-height: 1 !important;
                            margin: 0 !important;
                        }

                        @media (max-width: 991px) {
                            #header .container { height: 64px; }
                            #header #navigation { display: none; }
                        }
                    </style>
                </div>
            </div>
        </header>
        <div class="clearfix"></div>
        <!-- Header Container / End -->


        @yield('content')

        <!-- CTA Block — Modern, oversized, no privacy button -->
        <style>
            .modern-cta-section {
                padding: 90px 0;
                background: #f5f5f7;
            }
            .modern-cta-card {
                position: relative;
                background: #0a0a0a;
                color: #fff;
                border-radius: 24px;
                padding: 70px 60px;
                overflow: hidden;
                text-align: center;
            }
            .modern-cta-card::before, .modern-cta-card::after {
                content: "";
                position: absolute;
                border-radius: 50%;
                filter: blur(80px);
                opacity: .35;
                pointer-events: none;
            }
            .modern-cta-card::before {
                width: 360px; height: 360px;
                background: #ff5722;
                top: -120px; right: -100px;
            }
            .modern-cta-card::after {
                width: 320px; height: 320px;
                background: #5e2bff;
                bottom: -120px; left: -100px;
            }
            .modern-cta-card .cta-inner { position: relative; z-index: 2; max-width: 760px; margin: 0 auto; }
            .modern-cta-card .eyebrow {
                display: inline-block;
                font-size: 12px;
                font-weight: 700;
                letter-spacing: 1.4px;
                text-transform: uppercase;
                color: rgba(255,255,255,.85);
                background: rgba(255,255,255,.10);
                border: 1px solid rgba(255,255,255,.20);
                padding: 7px 16px;
                border-radius: 999px;
                margin-bottom: 22px;
                backdrop-filter: blur(8px);
            }
            .modern-cta-card h2 {
                font-size: clamp(32px, 4vw, 52px);
                font-weight: 800;
                line-height: 1.1;
                letter-spacing: -.8px;
                color: #fff !important;
                margin: 0 0 18px;
            }
            .modern-cta-card h2 .accent {
                background: linear-gradient(90deg, #ffd54f, #ff7043);
                -webkit-background-clip: text;
                background-clip: text;
                -webkit-text-fill-color: transparent;
                color: transparent;
            }
            .modern-cta-card p {
                color: rgba(255,255,255,.85);
                font-size: 17px;
                line-height: 1.65;
                max-width: 580px;
                margin: 0 auto 32px;
            }
            .modern-cta-card .cta-actions {
                display: inline-flex;
                gap: 12px;
                flex-wrap: wrap;
                justify-content: center;
            }
            .modern-cta-card .btn-cta-primary {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                background: #fff;
                color: #0a0a0a !important;
                font-size: 16px;
                font-weight: 700;
                padding: 16px 32px;
                border-radius: 12px;
                text-decoration: none;
                transition: all .15s ease;
            }
            .modern-cta-card .btn-cta-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 14px 32px rgba(0,0,0,.25);
            }
            .modern-cta-card .btn-cta-secondary {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                background: transparent;
                color: #fff !important;
                font-size: 16px;
                font-weight: 600;
                padding: 16px 30px;
                border-radius: 12px;
                border: 1.5px solid rgba(255,255,255,.30);
                text-decoration: none;
                transition: all .15s ease;
            }
            .modern-cta-card .btn-cta-secondary:hover {
                background: rgba(255,255,255,.10);
                border-color: rgba(255,255,255,.50);
            }
            .modern-cta-card .cta-stats {
                display: flex;
                justify-content: center;
                gap: 40px;
                margin-top: 40px;
                padding-top: 30px;
                border-top: 1px solid rgba(255,255,255,.15);
                flex-wrap: wrap;
            }
            .modern-cta-card .cta-stats .stat strong {
                display: block;
                font-size: 22px;
                font-weight: 800;
                color: #fff;
                line-height: 1.1;
            }
            .modern-cta-card .cta-stats .stat span {
                font-size: 12px;
                color: rgba(255,255,255,.65);
                text-transform: uppercase;
                letter-spacing: 1.2px;
            }
            @media (max-width: 768px) {
                .modern-cta-section { padding: 56px 0; }
                .modern-cta-card { padding: 50px 26px; border-radius: 18px; }
                .modern-cta-card .cta-stats { gap: 24px; }
            }
        </style>
        <section class="modern-cta-section">
            <div class="container">
                <div class="modern-cta-card">
                    <div class="cta-inner">
                        <span class="eyebrow">Get started today</span>
                        <h2>Your next great job is <span class="accent">one click away</span></h2>
                        <p>Join thousands of professionals finding verified U.S. jobs every day. Sign up free, set your preferences, and let opportunities come to you.</p>
                        <div class="cta-actions">
                            <a href="{{ route('register') }}" class="btn-cta-primary">
                                Create Your Free Account
                                <i class="icon-feather-arrow-right"></i>
                            </a>
                            <a href="{{ route('jobs.index') }}" class="btn-cta-secondary">
                                Browse All Jobs
                            </a>
                        </div>
                        <div class="cta-stats">
                            <div class="stat"><strong>230K+</strong><span>Open Jobs</span></div>
                            <div class="stat"><strong>10K+</strong><span>Employers</span></div>
                            <div class="stat"><strong>50</strong><span>U.S. States</span></div>
                            <div class="stat"><strong>100%</strong><span>Free</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- CTA Block End -->

        <!-- Footer — ManageWP-inspired dark navy with blue glow -->
        <style>
            /* === Footer: dark navy gradient with subtle blue radial glow === */
            #footer {
                background: linear-gradient(135deg, #0a1828 0%, #061224 55%, #050b18 100%) !important;
                color: #b0c0d0 !important;
                padding: 0 !important;
                margin: 0 !important;
                position: relative !important;
                overflow: hidden;
            }
            #footer::before {
                content: "";
                position: absolute;
                top: -100px; left: -100px;
                width: 720px; height: 480px;
                background: radial-gradient(ellipse at top left, rgba(64,145,255,.22) 0%, rgba(64,145,255,.08) 30%, transparent 65%);
                pointer-events: none;
                z-index: 0;
            }
            #footer::after { display: none !important; }
            #footer > * { position: relative; z-index: 1; }
            #footer .utf-footer-section-item-block {
                background: transparent !important;
                padding: 90px 0 0 !important;
                border: none !important;
            }
            #footer .utf-footer-section-item-block::before,
            #footer .utf-footer-section-item-block::after { display: none !important; }
            #footer .container-fluid { padding-left: 60px !important; padding-right: 60px !important; }

            /* Brand column */
            #footer .footer-logo {
                max-width: 170px;
                height: auto;
                margin-bottom: 22px;
                filter: brightness(0) invert(1);
                opacity: .95;
            }
            #footer .utf-footer-item-links p {
                color: #8a9bb0 !important;
                font-size: 14.5px !important;
                line-height: 1.75 !important;
                margin: 0 0 18px !important;
                max-width: 400px;
            }
            #footer .utf-footer-item-links p a {
                color: #c8d6e8 !important;
                text-decoration: none;
                transition: color .15s ease;
            }
            #footer .utf-footer-item-links p a:hover { color: #4d9eff !important; }

            /* Section headings — bright blue ManageWP style */
            #footer .utf-footer-item-links h3 {
                color: #4d9eff !important;
                font-size: 14px !important;
                font-weight: 700 !important;
                text-transform: uppercase !important;
                letter-spacing: 1.6px !important;
                margin: 0 0 24px !important;
                padding: 0 !important;
                border: none !important;
                background: none !important;
            }
            #footer .utf-footer-item-links h3::before,
            #footer .utf-footer-item-links h3::after { display: none !important; }

            /* Link lists */
            #footer .utf-footer-item-links ul {
                list-style: none !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            #footer .utf-footer-item-links ul li {
                margin: 0 !important;
                padding: 0 !important;
                background: none !important;
            }
            #footer .utf-footer-item-links ul li a {
                color: #c8d6e8 !important;
                font-size: 14.5px !important;
                font-weight: 400 !important;
                line-height: 1 !important;
                padding: 8px 0 !important;
                display: inline-flex !important;
                align-items: center;
                text-decoration: none !important;
                transition: color .15s ease, transform .15s ease;
            }
            #footer .utf-footer-item-links ul li a i { display: none !important; }
            #footer .utf-footer-item-links ul li a span {
                color: inherit !important;
                font: inherit !important;
                background: none !important;
            }
            #footer .utf-footer-item-links ul li a:hover {
                color: #4d9eff !important;
                transform: translateX(2px);
            }
            #footer .utf-footer-item-links ul li::before { display: none !important; }

            /* Hub link — promotes the "All Categories" / "All Locations" landing pages */
            #footer .utf-footer-item-links ul li a.footer-hub-link {
                color: #fff !important;
                background: rgba(77,158,255,.12) !important;
                border: 1px solid rgba(77,158,255,.30) !important;
                border-radius: 8px;
                padding: 9px 12px !important;
                margin-bottom: 10px;
                font-weight: 600 !important;
                gap: 6px;
                transition: background .15s ease, border-color .15s ease, transform .15s ease;
            }
            #footer .utf-footer-item-links ul li a.footer-hub-link i {
                display: inline-block !important;
                font-size: 14px !important;
                color: #4d9eff !important;
                margin-right: 4px;
            }
            #footer .utf-footer-item-links ul li a.footer-hub-link span strong { color: #fff !important; font-weight: 600 !important; }
            #footer .utf-footer-item-links ul li a.footer-hub-link:hover {
                background: rgba(77,158,255,.22) !important;
                border-color: rgba(77,158,255,.55) !important;
                transform: translateX(2px);
                color: #fff !important;
            }
            #footer .utf-footer-item-links ul li a.footer-hub-link:hover i { color: #fff !important; }

            /* Copyright bar */
            #footer .utf-footer-copyright-item {
                background: transparent !important;
                border-top: 1px solid rgba(64,145,255,.12) !important;
                margin-top: 70px !important;
                padding: 26px 0 !important;
                color: #6b7d92 !important;
                font-size: 13.5px !important;
                text-align: center;
            }
            #footer .utf-footer-copyright-item .container-fluid { padding: 0 60px !important; }
            #footer .utf-footer-copyright-item .row,
            #footer .utf-footer-copyright-item .col-xl-12 {
                color: #6b7d92 !important;
                text-align: center !important;
            }

            @media (max-width: 991px) {
                #footer .container-fluid { padding-left: 24px !important; padding-right: 24px !important; }
                #footer .utf-footer-section-item-block { padding-top: 60px !important; }
                #footer::before { width: 100%; height: 320px; }
            }
        </style>

        <!-- Footer -->
        <div id="footer">
            <div class="utf-footer-section-item-block">
                <div class="container-fluid px-5">
                    <div class="row">
                        <div class="col-xl-4 col-md-12">
                            <div class="utf-footer-item-links">
                                <a href="/"><img class="footer-logo"
                                        src="{{ asset('public/user/images/jobs-in-usa.png') }}" alt=""></a>
                                <p>Jobs in USA is your premier destination for finding job opportunities across the
                                    United States. We connect job seekers with employers in various industries,
                                    locations, and experience levels. Discover your next career opportunity with our
                                    comprehensive job search platform.</p>
                                <p>
                                    <a href="{{ url('/privacy-policy') }}">Privacy Policy</a> &nbsp;·&nbsp;
                                    <a href="{{ url('/terms-of-service') }}">Terms of Service</a> &nbsp;·&nbsp;
                                    <a href="{{ url('/about-us') }}">About Us</a> &nbsp;·&nbsp;
                                    <a href="{{ url('/contact') }}">Contact</a>
                                </p>
                            </div>
                        </div>

                        <div class="col-xl-2 col-md-3 col-sm-6">
                            <div class="utf-footer-item-links">
                                <h3>Job Categories</h3>
                                <ul>
                                    <li><a href="{{ route('jobs.categories') }}" class="footer-hub-link"><i
                                                class="icon-feather-grid"></i> <span><strong>Browse All Categories</strong></span></a>
                                    </li>
                                    <li><a href="{{ route('pages.warehouse-jobs') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Warehouse Jobs</span></a>
                                    </li>
                                    <li><a href="{{ route('pages.healthcare-jobs') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Healthcare
                                                Jobs</span></a></li>
                                    <li><a href="{{ route('pages.truck-driver-jobs') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Truck Driver
                                                Jobs</span></a></li>
                                    <li><a href="{{ route('pages.construction-jobs') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Construction
                                                Jobs</span></a></li>
                                    <li><a href="{{ route('pages.it-jobs') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>IT Jobs</span></a></li>
                                    <li><a href="{{ route('pages.software-developer-jobs') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Software Developer
                                                Jobs</span></a></li>
                                    <li><a href="{{ route('pages.data-entry-jobs') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Data Entry
                                                Jobs</span></a></li>
                                    <li><a href="{{ route('pages.customer-service-jobs') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Customer Service
                                                Jobs</span></a></li>
                                    <li><a href="{{ route('pages.marketing-jobs') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Marketing Jobs</span></a>
                                    </li>
                                    <li><a href="{{ route('pages.accounting-jobs') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Accounting
                                                Jobs</span></a></li>
                                    <li><a href="{{ route('pages.retail-jobs') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Retail Jobs</span></a>
                                    </li>
                                    <li><a href="{{ route('pages.security-guard-jobs') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Security Guard
                                                Jobs</span></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-2 col-md-3 col-sm-6">
                            <div class="utf-footer-item-links">
                                <h3>States</h3>
                                <ul>
                                    <li><a href="{{ route('jobs.locations') }}" class="footer-hub-link"><i
                                                class="icon-feather-map-pin"></i> <span><strong>Browse All Locations</strong></span></a>
                                    </li>
                                    <li><a href="{{ route('pages.jobs-in-texas') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Jobs in Texas</span></a>
                                    </li>
                                    <li><a href="{{ route('pages.jobs-in-california') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Jobs in
                                                California</span></a></li>
                                    <li><a href="{{ route('pages.jobs-in-new-york') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Jobs in New
                                                York</span></a></li>
                                    <li><a href="{{ route('pages.jobs-in-florida') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Jobs in
                                                Florida</span></a></li>
                                    <li><a href="{{ route('pages.jobs-in-illinois') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Jobs in
                                                Illinois</span></a></li>
                                    <li><a href="{{ route('pages.jobs-in-pennsylvania') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Jobs in
                                                Pennsylvania</span></a></li>
                                    <li><a href="{{ route('pages.jobs-in-ohio') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Jobs in Ohio</span></a>
                                    </li>
                                    <li><a href="{{ route('pages.jobs-in-georgia') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Jobs in
                                                Georgia</span></a></li>
                                    <li><a href="{{ route('pages.jobs-in-north-carolina') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Jobs in North
                                                Carolina</span></a></li>
                                    <li><a href="{{ route('pages.jobs-in-michigan') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Jobs in
                                                Michigan</span></a></li>
                                    <li><a href="{{ route('pages.jobs-in-new-jersey') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Jobs in New
                                                Jersey</span></a></li>
                                    <li><a href="{{ route('pages.jobs-in-virginia') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Jobs in
                                                Virginia</span></a></li>
                                    <li><a href="{{ route('pages.jobs-in-washington') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Jobs in
                                                Washington</span></a></li>
                                    <li><a href="{{ route('pages.jobs-in-arizona') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Jobs in
                                                Arizona</span></a></li>
                                    <li><a href="{{ route('pages.jobs-in-massachusetts') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Jobs in
                                                Massachusetts</span></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-2 col-md-3 col-sm-6">
                            <div class="utf-footer-item-links">
                                <h3>Remote & Work Styles</h3>
                                <ul>
                                    <li><a href="{{ route('pages.remote-jobs-usa') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Remote Jobs
                                                USA</span></a></li>
                                    <li><a href="{{ route('pages.work-from-home-jobs') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Work From Home
                                                Jobs</span></a></li>
                                    <li><a href="{{ route('pages.online-jobs-usa') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Online Jobs
                                                USA</span></a></li>
                                    <li><a href="{{ route('pages.part-time-remote-jobs') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Part-Time Remote
                                                Jobs</span></a></li>
                                    <li><a href="{{ route('pages.entry-level-remote-jobs') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Entry Level Remote
                                                Jobs</span></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-2 col-md-3 col-sm-6">
                            <div class="utf-footer-item-links">
                                <h3>Experience Levels</h3>
                                <ul>
                                    <li><a href="{{ route('pages.entry-level-jobs') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Entry Level
                                                Jobs</span></a></li>
                                    <li><a href="{{ route('pages.no-experience-jobs') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>No Experience
                                                Jobs</span></a></li>
                                    <li><a href="{{ route('pages.graduate-jobs') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Graduate Jobs</span></a>
                                    </li>
                                    <li><a href="{{ route('pages.internship-jobs') }}"><i
                                                class="icon-feather-chevron-right"></i> <span>Internship
                                                Jobs</span></a></li>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>

                <!-- Footer Copyrights -->
                <div class="utf-footer-copyright-item">
                    <div class="container-fluid px-5">
                        <div class="row">
                            <div class="col-xl-12">Copyright &copy; 2026 Jobs in USA. All Rights Reserved.</div>
                        </div>
                    </div>
                </div>
                <!-- Footer Copyrights / End -->
            </div>
            <!-- Footer / End -->
        </div>
        <!-- Wrapper / End -->

        <!-- Scripts -->
        <script src="{{ asset('public/user/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('public/user/js/jquery-migrate-3.0.0.min.js') }}" defer></script>
        <script src="{{ asset('public/user/js/mmenu.min.js') }}" defer></script>
        <script src="{{ asset('public/user/js/tippy.all.min.js') }}" defer></script>
        <script src="{{ asset('public/user/js/simplebar.min.js') }}" defer></script>
        <script src="{{ asset('public/user/js/bootstrap-slider.min.js') }}" defer></script>
        <script src="{{ asset('public/user/js/bootstrap-select.min.js') }}" defer></script>
        <script src="{{ asset('public/user/js/snackbar.js') }}" defer></script>
        <script src="{{ asset('public/user/js/clipboard.min.js') }}" defer></script>
        <script src="{{ asset('public/user/js/counterup.min.js') }}" defer></script>
        <script src="{{ asset('public/user/js/magnific-popup.min.js') }}" defer></script>
        <script src="{{ asset('public/user/js/slick.min.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
        <script src="{{ asset('public/user/js/custom_jquery.js') }}" defer></script>

        <script>
            window.addEventListener('load', function () {
                // Hide preloader as soon as everything is ready
                var pre = document.querySelector('.preloader');
                if (pre) { pre.style.opacity = '0'; setTimeout(function () { pre.style.display = 'none'; }, 250); }
                // Move any Google Places autocomplete container into the search field block
                if (window.jQuery && jQuery('.utf-intro-banner-search-form-block')[0]) {
                    jQuery(".pac-container").prependTo(".utf-intro-search-field-item.with-autocomplete");
                }
            });

            // === User dropdown chip toggle ===
            (function () {
                var btn = document.getElementById('utfUserChipBtn');
                if (!btn) return;
                var dd = btn.closest('.utf-user-dropdown');
                btn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    var open = dd.classList.toggle('open');
                    btn.setAttribute('aria-expanded', open ? 'true' : 'false');
                });
                document.addEventListener('click', function (e) {
                    if (!dd.contains(e.target)) {
                        dd.classList.remove('open');
                        btn.setAttribute('aria-expanded', 'false');
                    }
                });
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') {
                        dd.classList.remove('open');
                        btn.setAttribute('aria-expanded', 'false');
                    }
                });
            })();
        </script>

        {{-- AOS init — scroll animations --}}
        <script src="https://unpkg.com/aos@2.3.4/dist/aos.js" defer></script>
        <script>
            window.addEventListener('load', function () {
                if (typeof AOS !== 'undefined') {
                    AOS.init({
                        duration: 700,
                        easing: 'ease-out-cubic',
                        once: true,
                        offset: 80,
                        delay: 0,
                        disable: function() { return window.innerWidth < 480; }
                    });
                }
            });
        </script>

</body>

<!-- Mirrored from jobword.utouchdesign.com/jobword_ltr/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Apr 2025 10:26:10 GMT -->

<!-- Mirrored from www.jobword.flarza.com/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Oct 2025 12:16:19 GMT -->

</html>
