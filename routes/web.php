<?php

use App\Http\Controllers\AdvertiserController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobImportExportController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Public\ApplicationController;
use App\Http\Controllers\Public\JobSeekerPublicController;
use App\Http\Controllers\Public\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserJobController;
use App\Http\Controllers\BlogCatgoriesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactMessageController;
use Illuminate\Support\Facades\Route;

// ============================================
// PUBLIC ROUTES (No Auth Required)
// ============================================

// Homepage - Featured jobs, categories, locations
// In routes/web.php
Route::get('/', [UserJobController::class, 'index'])->name('home');
Route::get('/jobs', [UserJobController::class, 'showAllJobs'])->name('jobs.index');
// Redirect legacy id-prefixed job URLs (/jobs/12345-some-title) to slug-only canonical URL (301)
Route::get('/jobs/{id}-{any}', function ($id, $any) {
    $job = \App\Models\Job::with('location')->find($id);
    if (! $job) {
        abort(404);
    }
    $slug = \Illuminate\Support\Str::slug($job->position . '-' . ($job->location->name ?? ''));
    return redirect()->route('jobs.show', $slug, 301);
})->where('id', '[0-9]+')->where('any', '.*');
Route::get('/categories/{category:slug}', [UserJobController::class, 'showCategory'])->name('jobs.category');
Route::get('/search', [UserJobController::class, 'search'])->name('jobs.search');
Route::get('/locations', [UserJobController::class, 'locations'])->name('jobs.locations');
Route::get('/location/{location}', [UserJobController::class, 'showByLocation'])->name('jobs.location');
Route::get('/categories', [UserJobController::class, 'categories'])->name('jobs.categories');
Route::get('/companies', [UserJobController::class, 'companies'])->name('jobs.companies');
Route::get('/companies/{advertiser}', [UserJobController::class, 'showCompany'])->name('companies.show');

// Public job seekers directory
Route::get('/job-seekers', [JobSeekerPublicController::class, 'index'])->name('job-seekers.index');
Route::get('/job-seekers/{username}', [JobSeekerPublicController::class, 'show'])
    ->where('username', '[A-Za-z0-9_.]+')
    ->name('job-seekers.show');
Route::get('/about-us', [UserJobController::class, 'about_us'])->name('about.us');
Route::get('/contact-us', [UserJobController::class, 'contact_us'])->name('contact.us');
Route::post('/contact-us', [\App\Http\Controllers\ContactMessageController::class, 'store'])->name('contact.store');
// /jobs/search → redirect to canonical /search (the named jobs.search route declared earlier)
Route::get('/jobs/search', fn () => redirect()->route('jobs.search', request()->query(), 301));

// Job detail by SEO slug (no ID in URL). Placed after specific /jobs routes to avoid capturing reserved paths.
Route::get('/jobs/{slug}', [UserJobController::class, 'showJobBySlug'])->name('jobs.show')->where('slug', '(?!search$)[A-Za-z0-9\-]+');

// Blog routes (public)
Route::get('/blog', [\App\Http\Controllers\Public\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blog:slug}', [\App\Http\Controllers\Public\BlogController::class, 'show'])->name('blog.show');

// SEO Landing Pages
Route::view('/jobs-in-texas', 'pages.jobs-in-texas')->name('pages.jobs-in-texas');
Route::view('/jobs-in-california', 'pages.jobs-in-california')->name('pages.jobs-in-california');
Route::view('/jobs-in-new-york', 'pages.jobs-in-new-york')->name('pages.jobs-in-new-york');
Route::view('/jobs-in-florida', 'pages.jobs-in-florida')->name('pages.jobs-in-florida');
Route::view('/jobs-in-illinois', 'pages.jobs-in-illinois')->name('pages.jobs-in-illinois');
Route::view('/jobs-in-pennsylvania', 'pages.jobs-in-pennsylvania')->name('pages.jobs-in-pennsylvania');
Route::view('/jobs-in-ohio', 'pages.jobs-in-ohio')->name('pages.jobs-in-ohio');
Route::view('/jobs-in-georgia', 'pages.jobs-in-georgia')->name('pages.jobs-in-georgia');
Route::view('/jobs-in-north-carolina', 'pages.jobs-in-north-carolina')->name('pages.jobs-in-north-carolina');
Route::view('/jobs-in-michigan', 'pages.jobs-in-michigan')->name('pages.jobs-in-michigan');
Route::view('/jobs-in-new-jersey', 'pages.jobs-in-new-jersey')->name('pages.jobs-in-new-jersey');
Route::view('/jobs-in-virginia', 'pages.jobs-in-virginia')->name('pages.jobs-in-virginia');
Route::view('/jobs-in-washington', 'pages.jobs-in-washington')->name('pages.jobs-in-washington');
Route::view('/jobs-in-arizona', 'pages.jobs-in-arizona')->name('pages.jobs-in-arizona');
Route::view('/jobs-in-massachusetts', 'pages.jobs-in-massachusetts')->name('pages.jobs-in-massachusetts');

Route::view('/warehouse-jobs', 'pages.warehouse-jobs')->name('pages.warehouse-jobs');
Route::view('/healthcare-jobs', 'pages.healthcare-jobs')->name('pages.healthcare-jobs');
Route::view('/truck-driver-jobs', 'pages.truck-driver-jobs')->name('pages.truck-driver-jobs');
Route::view('/construction-jobs', 'pages.construction-jobs')->name('pages.construction-jobs');
Route::view('/it-jobs', 'pages.it-jobs')->name('pages.it-jobs');
Route::view('/software-developer-jobs', 'pages.software-developer-jobs')->name('pages.software-developer-jobs');
Route::view('/data-entry-jobs', 'pages.data-entry-jobs')->name('pages.data-entry-jobs');
Route::view('/customer-service-jobs', 'pages.customer-service-jobs')->name('pages.customer-service-jobs');
Route::view('/marketing-jobs', 'pages.marketing-jobs')->name('pages.marketing-jobs');
Route::view('/accounting-jobs', 'pages.accounting-jobs')->name('pages.accounting-jobs');
Route::view('/retail-jobs', 'pages.retail-jobs')->name('pages.retail-jobs');
Route::view('/security-guard-jobs', 'pages.security-guard-jobs')->name('pages.security-guard-jobs');

Route::view('/remote-jobs-usa', 'pages.remote-jobs-usa')->name('pages.remote-jobs-usa');
Route::view('/work-from-home-jobs', 'pages.work-from-home-jobs')->name('pages.work-from-home-jobs');
Route::view('/online-jobs-usa', 'pages.online-jobs-usa')->name('pages.online-jobs-usa');
Route::view('/part-time-remote-jobs', 'pages.part-time-remote-jobs')->name('pages.part-time-remote-jobs');
Route::view('/entry-level-remote-jobs', 'pages.entry-level-remote-jobs')->name('pages.entry-level-remote-jobs');

Route::view('/entry-level-jobs', 'pages.entry-level-jobs')->name('pages.entry-level-jobs');
Route::view('/no-experience-jobs', 'pages.no-experience-jobs')->name('pages.no-experience-jobs');
Route::view('/graduate-jobs', 'pages.graduate-jobs')->name('pages.graduate-jobs');
Route::view('/internship-jobs', 'pages.internship-jobs')->name('pages.internship-jobs');

// Static informational pages
Route::view('/privacy-policy', 'pages.privacy')->name('pages.privacy');
Route::view('/terms-of-service', 'pages.terms')->name('pages.terms');
Route::view('/contact', 'pages.contact')->name('pages.contact');
Route::view('/disclaimer', 'pages.disclaimer')->name('pages.disclaimer');

// Simple sitemap (XML) including homepage, static pages and recent job slugs
Route::get('/sitemap.xml', function () {
    $jobs = \App\Models\Job::orderBy('updated_at', 'desc')->take(1000)->get();

    $urls = [];
    $urls[] = url('/');
    $urls[] = url('/jobs');
    $urls[] = url('/about-us');
    $urls[] = url('/contact-us');
    $urls[] = url('/privacy-policy');
    $urls[] = url('/terms-of-service');
    $urls[] = url('/disclaimer');

    foreach ($jobs as $job) {
        if (! empty($job->slug)) {
            $urls[] = url('/jobs/' . $job->slug);
        }
    }

    $xml = '<?xml version="1.0" encoding="UTF-8"?>\n';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">\n';
    foreach ($urls as $u) {
        $xml .= "  <url>\n";
        $xml .= "    <loc>{$u}</loc>\n";
        $xml .= "  </url>\n";
    }
    $xml .= '</urlset>';

    return response($xml, 200)
        ->header('Content-Type', 'application/xml')
        ->header('X-Content-Type-Options', 'nosniff');
});

// ============================================
// AUTHENTICATED USER ROUTES
// ============================================

// Job Applications
Route::get('/jobs/{job}/apply', [ApplicationController::class, 'create'])->name('jobs.apply.form');
Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('jobs.apply');
Route::get('/my-applications', [ApplicationController::class, 'myApplications'])->name('applications.my');

// User Profile
Route::get('/profile', [ProfileController::class, 'show'])->name('public.profile');
Route::put('/profile', [ProfileController::class, 'update'])->name('public.profile.update');

// Save Jobs (Future feature)
Route::post('/jobs/{job}/save', [ProfileController::class, 'saveJob'])->name('jobs.save');

// ============================================
// ADMIN DASHBOARD & RESOURCES
// ============================================
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Admin Dashboard — admins ONLY
    Route::get('/administration', [JobController::class, 'dashboard'])
        ->middleware(\App\Http\Middleware\EnsureRole::class.':admin')
        ->name('admin.dashboard');

    // Admin Resource Routes — admins ONLY
    Route::prefix('admin')->name('admin.')->middleware(\App\Http\Middleware\EnsureRole::class.':admin')->group(function () {
        // Shortcut: redirect /admin to the admin dashboard
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });

        // Jobs Management
        Route::resource('jobs', JobController::class);
        Route::get('/jobs/import/form', [JobImportExportController::class, 'showImportForm'])
             ->name('jobs.import.form');
        Route::post('/jobs/import', [JobImportExportController::class, 'import'])
             ->name('jobs.import');
        Route::get('/jobs/export', [JobImportExportController::class, 'export'])
             ->name('jobs.export');
        // Advertisers Management
        Route::resource('advertisers', AdvertiserController::class);
        // Categories Management
        Route::resource('categories', CategoriesController::class);
        // Locations Management
        Route::resource('locations', LocationController::class);
        // Users Management
        Route::delete('users/{user}/photo', [UserController::class, 'removePhoto'])->name('users.photo.remove');
        Route::resource('users', UserController::class);

        // Blog categories and posts
        Route::resource('blogcategories', BlogCatgoriesController::class);
        Route::resource('blogs', BlogController::class);

    // Contact Messages
    Route::post('contact-messages/bulk-destroy', [ContactMessageController::class, 'bulkDestroy'])->name('contact-messages.bulk-destroy');
    Route::post('contact-messages/scan-spam',    [ContactMessageController::class, 'scanSpam'])->name('contact-messages.scan-spam');
    Route::resource('contact-messages', ContactMessageController::class)->except('create', 'edit');

        // Dangerous: delete all data (jobs, categories, advertisers, locations)
        Route::post('/cleanup', [JobController::class, 'destroyAll'])->name('cleanup');
    });
    // Generic /dashboard — dispatch based on the user's role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if (! $user) return redirect()->route('login');
        return redirect()->route($user->dashboardRouteName());
    })->name('dashboard');

    // Company dashboard (employers posting jobs)
    Route::prefix('company')->name('company.')->middleware(\App\Http\Middleware\EnsureRole::class.':company')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\CompanyDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile',   [\App\Http\Controllers\CompanyJobController::class, 'profile'])->name('profile');

        // Settings (brand-styled, replaces /user/profile for company)
        Route::get   ('/settings',                  [\App\Http\Controllers\SettingsController::class, 'company'])->name('settings');
        Route::put   ('/settings/account',          [\App\Http\Controllers\SettingsController::class, 'updateAccount'])->name('settings.account');
        Route::put   ('/settings/company-details',  [\App\Http\Controllers\SettingsController::class, 'updateCompanyDetails'])->name('settings.details');
        Route::put   ('/settings/password',         [\App\Http\Controllers\SettingsController::class, 'updatePassword'])->name('settings.password');
        Route::delete('/settings/photo',            [\App\Http\Controllers\SettingsController::class, 'removePhoto'])->name('settings.photo.remove');

        // Job CRUD scoped to the current company
        Route::get   ('/jobs',                [\App\Http\Controllers\CompanyJobController::class, 'index'])->name('jobs.index');
        Route::get   ('/jobs/create',         [\App\Http\Controllers\CompanyJobController::class, 'create'])->name('jobs.create');
        Route::post  ('/jobs',                [\App\Http\Controllers\CompanyJobController::class, 'store'])->name('jobs.store');
        Route::get   ('/jobs/{job}/edit',     [\App\Http\Controllers\CompanyJobController::class, 'edit'])->name('jobs.edit');
        Route::put   ('/jobs/{job}',          [\App\Http\Controllers\CompanyJobController::class, 'update'])->name('jobs.update');
        Route::delete('/jobs/{job}',          [\App\Http\Controllers\CompanyJobController::class, 'destroy'])->name('jobs.destroy');
    });

    // Job seeker dashboard (candidates browsing/applying)
    Route::prefix('seeker')->name('seeker.')->middleware(\App\Http\Middleware\EnsureRole::class.':job_seeker')->group(function () {
        Route::get('/dashboard',              [\App\Http\Controllers\JobSeekerDashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/ai-matches',   [\App\Http\Controllers\JobSeekerDashboardController::class, 'aiMatches'])->name('dashboard.ai-matches');

        // Profile
        Route::get   ('/profile',     [\App\Http\Controllers\SeekerProfileController::class, 'show'])->name('profile');
        Route::put   ('/profile',     [\App\Http\Controllers\SeekerProfileController::class, 'update'])->name('profile.update');

        // Resume / CV
        Route::get   ('/resume',      [\App\Http\Controllers\SeekerProfileController::class, 'resume'])->name('resume');
        Route::post  ('/resume',      [\App\Http\Controllers\SeekerProfileController::class, 'uploadResume'])->name('resume.upload');
        Route::delete('/resume',      [\App\Http\Controllers\SeekerProfileController::class, 'deleteResume'])->name('resume.delete');

        // My Applications
        Route::get   ('/applications', [\App\Http\Controllers\SeekerProfileController::class, 'applications'])->name('applications');

        // Settings (brand-styled, replaces /user/profile for seeker)
        Route::get   ('/settings',          [\App\Http\Controllers\SettingsController::class, 'seeker'])->name('settings');
        Route::put   ('/settings/account',  [\App\Http\Controllers\SettingsController::class, 'updateAccount'])->name('settings.account');
        Route::put   ('/settings/password', [\App\Http\Controllers\SettingsController::class, 'updatePassword'])->name('settings.password');
        Route::delete('/settings/photo',    [\App\Http\Controllers\SettingsController::class, 'removePhoto'])->name('settings.photo.remove');
    });

    // AI Assistant — shared across admin / company / seeker panels
    Route::prefix('ai')->name('ai.')->group(function () {
        Route::post('/job-description',     [\App\Http\Controllers\AiAssistantController::class, 'jobDescription'])->name('job-description');
        Route::post('/polish-bio',          [\App\Http\Controllers\AiAssistantController::class, 'polishBio'])->name('polish-bio');
        Route::post('/polish-headline',     [\App\Http\Controllers\AiAssistantController::class, 'polishHeadline'])->name('polish-headline');
        Route::post('/extract-skills',      [\App\Http\Controllers\AiAssistantController::class, 'extractSkills'])->name('extract-skills');
        Route::post('/category-description',[\App\Http\Controllers\AiAssistantController::class, 'categoryDescription'])->name('category-description');
        Route::post('/blog-content',        [\App\Http\Controllers\AiAssistantController::class, 'blogContent'])->name('blog-content');
        Route::post('/blog-excerpt',        [\App\Http\Controllers\AiAssistantController::class, 'blogExcerpt'])->name('blog-excerpt');
        Route::post('/blog-meta',           [\App\Http\Controllers\AiAssistantController::class, 'blogMeta'])->name('blog-meta');
        Route::post('/generic',             [\App\Http\Controllers\AiAssistantController::class, 'generic'])->name('generic');
    });
});
// /register is handled by Fortify (resources/views/auth/register.blade.php).
// Fortify already redirects authenticated users via the RedirectIfAuthenticated middleware,
// so no manual override is needed here.
