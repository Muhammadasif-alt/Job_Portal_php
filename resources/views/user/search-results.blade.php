@extends('user.layouts.master')
@section('title', 'Search Results')

@section('content')
<!-- Page Content -->
<div class="full-page-container">
    <div class="full-page-content-container" data-simplebar>
        <div class="full-page-content-inner">
            <!-- Search and Filters Section -->
            <div class="utf-inner-search-section-title">
                <h4>
                    Search Results for "{{ $keywords ?? 'All Jobs' }}"
                    @if($selectedLocation)
                        @if(is_numeric($selectedLocation))
                            {{ ' in ' . optional(\App\Models\Location::find($selectedLocation))->name }}
                        @else
                            {{ ' in ' . $selectedLocation }}
                        @endif
                    @endif
                </h4>

                <!-- Search Form -->
                <form method="GET" action="{{ route('jobs.search') }}" class="utf-search-filters">
                    <div class="row">
                        <!-- Keywords Search -->
                        <div class="col-md-4">
                            <div class="utf-input-with-icon">
                                <input type="text" name="keywords" placeholder="Job Title, Company, or Keywords" value="{{ $keywords ?? '' }}" class="form-control">
                                <i class="icon-material-outline-search"></i>
                            </div>
                        </div>

                        <!-- Location Dropdown -->
                        <div class="col-md-4">
                            <div class="utf-input-with-icon">
                                <select class="form-control select2" name="location" data-placeholder="All Locations">
                                    <option value="">All Locations</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->name }}" {{ $selectedLocation == $location->name ? 'selected' : '' }}>
                                            {{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <i class="icon-material-outline-location-on"></i>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="button full-width">Search</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Results Count & Sort -->
            <div class="utf-notify-box-aera margin-top-15">
                <div class="utf-switch-container-item">
                    @if($jobs->total() > 0)
                        <span>Found {{ $jobs->total() }} {{ Str::plural('job', $jobs->total()) }}</span>
                    @else
                        <span>No jobs found matching your search criteria</span>
                    @endif
                </div>
                <div class="sort-by">
                    <span>Sort By:</span>
                    <select class="selectpicker hide-tick" id="sortSelect">
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>Newest</option>
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'position_asc']) }}" {{ request('sort') == 'position_asc' ? 'selected' : '' }}>Position (A-Z)</option>
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'position_desc']) }}" {{ request('sort') == 'position_desc' ? 'selected' : '' }}>Position (Z-A)</option>
                    </select>
                </div>
            </div>

            <!-- Job Listings -->
                    <div class="utf-listings-container-part compact-list-layout margin-top-20 margin-bottom-25">
                @forelse($jobs as $job)
                    <a href="{{ route('jobs.show', \Illuminate\Support\Str::slug($job->position . '-' . ($job->location->name ?? '')) ) }}" class="utf-job-listing utf-apply-button-item">
                        <div class="utf-job-listing-details">
                            <div class="utf-job-listing-company-logo">
                                <img src="{{ $job->advertiser && $job->advertiser->logo ? asset('public/storage/' . $job->advertiser->logo) : asset('public/user/images/jobimages.png') }}" alt="{{ $job->advertiser->name ?? 'Company' }}" loading="lazy">
                            </div>

                            <div class="utf-job-listing-description">
                                <span class="dashboard-status-button utf-job-status-item {{ ($job->employment_type ?? '') == 'Full Time' ? 'green' : (($job->employment_type ?? '') == 'Part Time' ? 'yellow' : 'green') }}">
                                    <i class="icon-material-outline-business-center"></i> {{ $job->employment_type ?? 'Full Time' }}
                                </span>

                                <h3 class="utf-job-listing-title">{{ $job->position }}</h3>

                                <div class="utf-job-listing-footer">
                                    <ul>
                                        <li><i class="icon-feather-briefcase"></i> {{ $job->category?->name ?? ($job->advertiser->name ?? 'N/A') }}</li>
                                        @if($job->location)
                                            <li><i class="icon-material-outline-location-on"></i>
                                                {{ $job->location->name }}{{ $job->location->area ? ', ' . $job->location->area : '' }}{{ $job->location->postal_code ? ' (' . $job->location->postal_code . ')' : '' }}
                                            </li>
                                        @endif
                                        <li><i class="icon-material-outline-access-time"></i> {{ $job->created_at->diffForHumans() }}</li>
                                    </ul>
                                </div>
                            </div>
                            <span class="list-apply-button ripple-effect">View Job <i class="icon-line-awesome-bullhorn"></i></span>
                        </div>
                    </a>
                @empty
                    <div class="notification warning closeable">
                        <p>No jobs found matching your search criteria. Try adjusting your search or filters.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($jobs->hasPages())
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="utf-pagination-container-aera margin-top-20 margin-bottom-20">
                            @push('meta')
                                @if($jobs->onFirstPage() === false)
                                    <link rel="prev" href="{{ $jobs->previousPageUrl() }}">
                                @endif
                                @if($jobs->hasMorePages())
                                    <link rel="next" href="{{ $jobs->nextPageUrl() }}">
                                @endif
                            @endpush
                            {{ $jobs->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize select2
        $('.select2').select2({
            width: '100%',
            placeholder: $(this).data('placeholder')
        });

        // Handle sort selection
        $('#sortSelect').on('change', function() {
            window.location.href = $(this).val();
        });
    });
</script>
@endpush
