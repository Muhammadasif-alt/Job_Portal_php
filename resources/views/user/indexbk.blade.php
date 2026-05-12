@extends('user.layouts.master')

@section('content')

  <!-- Intro Banner  -->
  <div class="intro-banner" data-background-image="user/images/home-background-03.jpg">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="utf-banner-headline-text-part">
            <h3>Change Your Career Starts Now!</h3>
            <span>Find Jobs, Employment & Career Making Over 100,000 Applications Every Day.</span>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="utf-intro-banner-search-form-block margin-top-40">
            <div class="utf-intro-search-field-item">
              <input id="intro-keywords" type="text" placeholder="Search Jobs Keywords...">
			  <i class="icon-feather-search"></i>
            </div>
			<div class="utf-intro-search-field-item">
              <select class="selectpicker default" data-live-search="true" data-selected-text-format="count" data-size="5" title="Select Location">
                <option>Afghanistan</option>
                <option>Albania</option>
                <option>Algeria</option>
                <option>Brazil</option>
                <option>Burundi</option>
                <option>Bulgaria</option>
                <option>Germany</option>
                <option>Grenada</option>
                <option>Guatemala</option>
                <option>Iceland</option>
              </select>
            </div>
			<div class="utf-intro-search-button">
              <button class="button ripple-effect" onclick="window.location.href='jobs-list-layout-leftside.html'"><i class="icon-material-outline-search"></i> Search Jobs</button>
            </div>
          </div>
		  <p class="utf-trending-silver-item"><span class="utf-trending-black-item">Trending Jobs Keywords:</span> <a href="#">Web Designer</a>  <a href="#">Web Developer</a>  <a href="#">Graphic Designer</a>  <a href="#">PHP Developer</a>  <a href="#">IOS Developer</a>  <a href="#">Android Developer</a></p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="main_popular_categories">
              <ul class="main_popular_categories_list">
                <li> <a href="listings_grid_with_sidebar.html">
                  <div class="utf_box"> <i class="icon-line-awesome-laptop"></i>
                    <p>IT Engineer</p>
                  </div>
                  </a>
				</li>
                <li> <a href="listings_grid_with_sidebar.html">
                  <div class="utf_box"> <i class="icon-feather-pie-chart"></i>
                    <p>Marketing</p>
                  </div>
                  </a>
				</li>
                <li> <a href="listings_grid_with_sidebar.html">
                  <div class="utf_box"> <i class="icon-line-awesome-bank"></i>
                    <p>Banking</p>
                  </div>
                  </a>
				</li>
                <li> <a href="listings_grid_with_sidebar.html">
                  <div class="utf_box"> <i class="icon-line-awesome-medkit"></i>
                    <p>Health Care</p>
                  </div>
                  </a>
				</li>
                <li> <a href="listings_grid_with_sidebar.html">
                  <div class="utf_box"> <i class="icon-line-awesome-cubes"></i>
                    <p>Design & Art</p>
                  </div>
                  </a>
				</li>
              </ul>
            </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Jobs Category Boxes -->
  <div class="section margin-top-60 margin-bottom-70">
    <div class="container">
      <div class="row">
        <div class="col-xl-12">
          <div class="utf-section-headline-item centered margin-top-0 margin-bottom-40">
            <span>Jobs Categories</span>
			<h3>Choose Your Sector</h3>
			<div class="utf-headline-display-inner-item">Jobs Categories</div>
			<p class="utf-slogan-text">Lorem Ipsum is simply dummy text printing and type setting industry Lorem Ipsum been industry standard dummy text ever since when unknown printer took a galley.</p>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 col-lg-4">
			<a href="jobs-list-layout-leftside.html" class="photo-box photo-category-box small" data-background-image="user/images/job-category-01.jpg">
			  <div class="utf-opening-position-counter-item">10 Openings</div>
			  <div class="utf-opening-box-content-part">
				<div class="utf-category-box-icon-item"> <i class="icon-line-awesome-bullhorn"></i> </div>
				<h3>Design, Art & Multimedia</h3>
				<span>2,612 Jobs</span>
			  </div>
			</a>
		</div>
        <div class="col-xl-3 col-md-6 col-lg-4">
			<a href="jobs-list-layout-leftside.html" class="photo-box photo-category-box small" data-background-image="user/images/job-category-02.jpg">
			  <div class="utf-opening-position-counter-item">18 Openings</div>
			  <div class="utf-opening-box-content-part">
				<div class="utf-category-box-icon-item"> <i class="icon-line-awesome-graduation-cap"></i> </div>
				<h3>Education & Training</h3>
				<span>4,218 Jobs</span>
			  </div>
			</a>
		</div>
        <div class="col-xl-3 col-md-6 col-lg-4">
			<a href="jobs-list-layout-leftside.html" class="photo-box photo-category-box small" data-background-image="user/images/job-category-03.jpg">
			  <div class="utf-opening-position-counter-item">25 Openings</div>
			  <div class="utf-opening-box-content-part">
				<div class="utf-category-box-icon-item"> <i class="icon-line-awesome-line-chart"></i> </div>
				<h3>Accounting / Finance</h3>
				<span>2,186 Jobs</span>
			  </div>
			</a>
		</div>
        <div class="col-xl-3 col-md-6 col-lg-4">
			<a href="jobs-list-layout-leftside.html" class="photo-box photo-category-box small" data-background-image="user/images/job-category-04.jpg">
			  <div class="utf-opening-position-counter-item">23 Openings</div>
			  <div class="utf-opening-box-content-part">
				<div class="utf-category-box-icon-item"> <i class="icon-line-awesome-users"></i> </div>
				<h3>Human Resource</h3>
				<span>5,298 Jobs</span>
			  </div>
			</a>
		</div>
        <div class="col-xl-3 col-md-6 col-lg-4">
			<a href="jobs-list-layout-leftside.html" class="photo-box photo-category-box small" data-background-image="user/images/job-category-05.jpg">
			  <div class="utf-opening-position-counter-item">29 Openings</div>
			  <div class="utf-opening-box-content-part">
				<div class="utf-category-box-icon-item"> <i class="icon-feather-phone-call"></i> </div>
				<h3>Telecommunications</h3>
				<span>7,549 Jobs</span>
			  </div>
			</a>
		</div>
        <div class="col-xl-3 col-md-6 col-lg-4">
			<a href="jobs-list-layout-leftside.html" class="photo-box photo-category-box small" data-background-image="user/images/job-category-06.html">
			  <div class="utf-opening-position-counter-item">36 Openings</div>
			  <div class="utf-opening-box-content-part">
				<div class="utf-category-box-icon-item"> <i class="icon-line-awesome-cutlery"></i> </div>
				<h3>Restaurant / Food Service</h3>
				<span>2,873 Jobs</span>
			  </div>
			</a>
		</div>
        <div class="col-xl-3 col-md-6 col-lg-4">
			<a href="jobs-list-layout-leftside.html" class="photo-box photo-category-box small" data-background-image="user/images/job-category-07.jpg">
			  <div class="utf-opening-position-counter-item">44 Openings</div>
			  <div class="utf-opening-box-content-part">
				<div class="utf-category-box-icon-item"> <i class="icon-line-awesome-building"></i> </div>
				<h3>Construction / Facilities</h3>
				<span>3,125 Jobs</span>
			  </div>
			</a>
		</div>
        <div class="col-xl-3 col-md-6 col-lg-4">
			<a href="jobs-list-layout-leftside.html" class="photo-box photo-category-box small" data-background-image="user/images/job-category-08.jpg">
			  <div class="utf-opening-position-counter-item">22 Openings</div>
			  <div class="utf-opening-box-content-part">
				<div class="utf-category-box-icon-item"> <i class="icon-line-awesome-user-md"></i> </div>
				<h3>Health</h3>
				<span>2,445 Jobs</span>
			  </div>
			</a>
		</div>
		<div class="col-xl-12 utf-centered-button margin-top-10">
			<a href="jobs-categorie-two.html" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-0">View All Categories <i class="icon-feather-chevron-right"></i></a>
		</div>
      </div>
    </div>
  </div>
  <!-- Jobs Category Boxes / End -->

  <!-- Features Jobs -->
  <div class="section gray padding-top-60 padding-bottom-60">
    <div class="container">
      <div class="row">
        <div class="col-xl-12">
          <div class="utf-section-headline-item centered margin-top-0 margin-bottom-40">
            <span>Jobs Listing</span>
			<h3>Features Jobs Post</h3>
			<div class="utf-headline-display-inner-item">Jobs Listing</div>
			<p class="utf-slogan-text">Lorem Ipsum is simply dummy text printing and type setting industry Lorem Ipsum been industry standard dummy text ever since when unknown printer took a galley.</p>
          </div>
          <div class="utf-listings-container-part compact-list-layout margin-top-35">
            <a href="single-job-page.html" class="utf-job-listing utf-apply-button-item">
				<div class="utf-job-listing-details">
				  <div class="utf-job-listing-company-logo"> <img src="user/images/company_logo_1.png" alt=""> </div>
				  <div class="utf-job-listing-description">
				    <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i> Full Time</span>
					<h3 class="utf-job-listing-title">Web Designer, Graphic Designer, UI/UX Designer & Art</h3>
					<div class="utf-job-listing-footer">
					  <ul>
						<li><i class="icon-feather-briefcase"></i> Graphic Designer</li>
						<li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
						<li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
						<li><i class="icon-material-outline-access-time"></i> 15 Minute Ago</li>
					  </ul>
					</div>
				  </div>
				  <span class="list-apply-button ripple-effect">Browse Job <i class="icon-line-awesome-bullhorn"></i></span>
				</div>
            </a>
            <a href="single-job-page.html" class="utf-job-listing utf-apply-button-item">
				<div class="utf-job-listing-details">
				  <div class="utf-job-listing-company-logo"> <img src="user/images/company_logo_2.png" alt=""> </div>
				  <div class="utf-job-listing-description">
				    <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i> Full Time</span>
					<h3 class="utf-job-listing-title">PHP Developer, Team of PHP & IT Co <span class="utf-verified-badge" title="Verified" data-tippy-placement="top"></span></h3>
					<div class="utf-job-listing-footer">
					  <ul>
						<li><i class="icon-feather-briefcase"></i> UI/UX Designer</li>
						<li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
						<li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
						<li><i class="icon-material-outline-access-time"></i> 25 Minute Ago</li>
					  </ul>
					</div>
				  </div>
				  <span class="list-apply-button ripple-effect">Browse Job <i class="icon-line-awesome-bullhorn"></i></span>
				</div>
            </a>
            <a href="single-job-page.html" class="utf-job-listing utf-apply-button-item">
				<div class="utf-job-listing-details">
				  <div class="utf-job-listing-company-logo"> <img src="user/images/company_logo_3.png" alt=""> </div>
				  <div class="utf-job-listing-description">
				    <span class="dashboard-status-button utf-job-status-item yellow"><i class="icon-material-outline-business-center"></i> Part Time</span>
					<h3 class="utf-job-listing-title">Website Developer & Software Developer</h3>
					<div class="utf-job-listing-footer">
					  <ul>
						<li><i class="icon-feather-briefcase"></i> Software Developer</li>
						<li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
						<li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
						<li><i class="icon-material-outline-access-time"></i> 38 Minute Ago</li>
					  </ul>
					</div>
				  </div>
				  <span class="list-apply-button ripple-effect">Browse Job <i class="icon-line-awesome-bullhorn"></i></span>
				</div>
            </a>
            <a href="single-job-page.html" class="utf-job-listing utf-apply-button-item">
				<div class="utf-job-listing-details">
				  <div class="utf-job-listing-company-logo"> <img src="user/images/company_logo_4.png" alt=""> </div>
				  <div class="utf-job-listing-description">
				    <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i> Full Time</span>
					<h3 class="utf-job-listing-title">Application Developer & Web Designer <span class="utf-verified-badge" title="Verified" data-tippy-placement="top"></span></h3>
					<div class="utf-job-listing-footer">
					  <ul>
						<li><i class="icon-feather-briefcase"></i> Web Developer</li>
						<li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
						<li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
						<li><i class="icon-material-outline-access-time"></i> 55 Minute Ago</li>
					  </ul>
					</div>
				  </div>
				  <span class="list-apply-button ripple-effect">Browse Job <i class="icon-line-awesome-bullhorn"></i></span>
				</div>
            </a>
            <a href="single-job-page.html" class="utf-job-listing utf-apply-button-item">
				<div class="utf-job-listing-details">
				  <div class="utf-job-listing-company-logo"> <img src="user/images/company_logo_5.png" alt=""> </div>
				  <div class="utf-job-listing-description">
				    <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i> Full Time</span>
					<h3 class="utf-job-listing-title">IT Department Manager & Blogger-Entrepenour</h3>
					<div class="utf-job-listing-footer">
					  <ul>
						<li><i class="icon-feather-briefcase"></i> Android Developer</li>
						<li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
						<li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
						<li><i class="icon-material-outline-access-time"></i> 1 Days Ago</li>
					  </ul>
					</div>
				  </div>
				  <span class="list-apply-button ripple-effect">Browse Job <i class="icon-line-awesome-bullhorn"></i></span>
				</div>
            </a>
			<a href="single-job-page.html" class="utf-job-listing utf-apply-button-item">
				<div class="utf-job-listing-details">
				  <div class="utf-job-listing-company-logo"> <img src="user/images/company_logo_6.png" alt=""> </div>
				  <div class="utf-job-listing-description">
				    <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i> Full Time</span>
					<h3 class="utf-job-listing-title">Frontend/Backendd Developer</h3>
					<div class="utf-job-listing-footer">
					  <ul>
						<li><i class="icon-feather-briefcase"></i> IOS Developer</li>
						<li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
						<li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
						<li><i class="icon-material-outline-access-time"></i> 1 Days Ago</li>
					  </ul>
					</div>
				  </div>
				  <span class="list-apply-button ripple-effect">Browse Job <i class="icon-line-awesome-bullhorn"></i></span>
				</div>
            </a>
		  </div>
		  <div class="utf-centered-button margin-top-10">
			<a href="jobs-list-layout-leftside.html" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-20">Browse All Jobs <i class="icon-feather-chevron-right"></i></a>
		  </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Features Jobs / End -->

  <!-- Features Cities -->
  <div class="section margin-top-65 margin-bottom-60">
    <div class="container">
      <div class="row">
        <div class="col-xl-12">
          <div class="utf-section-headline-item centered margin-top-0 margin-bottom-40">
            <span>Jobs Location</span>
			<h3>Companies By Location</h3>
			<div class="utf-headline-display-inner-item">Jobs Location</div>
			<p class="utf-slogan-text">Lorem Ipsum is simply dummy text printing and type setting industry Lorem Ipsum been industry standard dummy text ever since when unknown printer took a galley.</p>
          </div>
        </div>
        <div class="col-xl-4 col-md-6">
			<a href="jobs-list-layout-leftside.html" class="photo-box" data-background-image="user/images/popular-location-01.jpg">
			  <div class="utf-opening-box-content-part">
				<h3>Afghanistan</h3>
				<span>376 Jobs</span>
			  </div>
			</a>
		</div>
        <div class="col-xl-3 col-md-6">
			<a href="jobs-list-layout-leftside.html" class="photo-box" data-background-image="user/images/popular-location-02.jpg">
			  <div class="utf-opening-box-content-part">
				<h3>Australia</h3>
				<span>645 Jobs</span>
			  </div>
			</a>
		</div>
        <div class="col-xl-5 col-md-6">
			<a href="jobs-list-layout-leftside.html" class="photo-box" data-background-image="user/images/popular-location-03.jpg">
			  <div class="utf-opening-box-content-part">
				<h3>Bangladesh</h3>
				<span>832 Jobs</span>
			  </div>
			</a>
		</div>
        <div class="col-xl-5 col-md-6">
			<a href="jobs-list-layout-leftside.html" class="photo-box" data-background-image="user/images/popular-location-04.jpg">
			  <div class="utf-opening-box-content-part">
				<h3>Belize</h3>
				<span>513 Jobs</span>
			  </div>
			</a>
		</div>
		<div class="col-xl-4 col-md-6">
			<a href="jobs-list-layout-leftside.html" class="photo-box" data-background-image="user/images/popular-location-05.jpg">
			  <div class="utf-opening-box-content-part">
				<h3>Cambodia</h3>
				<span>376 Jobs</span>
			  </div>
			</a>
		</div>
        <div class="col-xl-3 col-md-6">
			<a href="jobs-list-layout-leftside.html" class="photo-box" data-background-image="user/images/popular-location-06.jpg">
			  <div class="utf-opening-box-content-part">
				<h3>Czech Republic</h3>
				<span>645 Jobs</span>
			  </div>
			</a>
		</div>
        <div class="col-xl-3 col-md-6">
			<a href="jobs-list-layout-leftside.html" class="photo-box" data-background-image="user/images/popular-location-07.jpg">
			  <div class="utf-opening-box-content-part">
				<h3>Equatorial</h3>
				<span>832 Jobs</span>
			  </div>
			</a>
		</div>
        <div class="col-xl-4 col-md-6">
			<a href="jobs-list-layout-leftside.html" class="photo-box" data-background-image="user/images/popular-location-08.jpg">
			  <div class="utf-opening-box-content-part">
				<h3>Indonesia</h3>
				<span>513 Jobs</span>
			  </div>
			</a>
		</div>
		<div class="col-xl-5 col-md-6">
			<a href="jobs-list-layout-leftside.html" class="photo-box" data-background-image="user/images/popular-location-09.jpg">
			  <div class="utf-opening-box-content-part">
				<h3>Malaysia</h3>
				<span>832 Jobs</span>
			  </div>
			</a>
		</div>
		<div class="utf-centered-button margin-top-10">
			<a href="companies-location.html" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-20">Browse All Location <i class="icon-feather-chevron-right"></i></a>
	    </div>
      </div>
    </div>
  </div>
  <!-- Features Cities / End -->

  <!-- Photo Section -->
	<div class="utf-photo-section-block" data-background-image="user/images/section-background.jpg">
		<div class="text-content white-font">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-12 col-sm-12">
						<h2>Download Browse Hundreds of Jobs</h2>
						<p>Lorem Ipsum is simply dummy text of printing and type setting industry. Lorem Ipsum been industry standard dummy text ever since, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic type setting, remaining essentially unchanged. It was popularised.</p>
						<ul class="utf-download-text">
							<li>
								<a href="#" title="Windows App" data-tippy-placement="top">
									<i class="icon-line-awesome-windows"></i>
									<span>Windows</span>
									<p>Available Now</p>
								</a>
							</li>
							<li>
								<a href="#" title="App Store" data-tippy-placement="top">
									<i class="icon-line-awesome-apple"></i>
									<span>App Store</span>
									<p>Available Now</p>
								</a>
							</li>
							<li>
								<a href="#" title="Google Play" data-tippy-placement="top">
									<i class="icon-line-awesome-android"></i>
									<span>Google Play</span>
									<p>Get in On</p>
								</a>
							</li>
						</ul>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="download-img">
							<img src="user/images/mockup3.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  <!-- Photo Section / End -->

  <!-- Icon Boxes -->
  <div class="section padding-top-65 padding-bottom-50">
    <div class="container">
      <div class="row">
        <div class="col-xl-12">
          <div class="utf-section-headline-item centered margin-top-0 margin-bottom-40">
            <span>Business Support Service</span>
			<h3>How It Works?</h3>
			<div class="utf-headline-display-inner-item">Business Support Service</div>
			<p class="utf-slogan-text">Lorem Ipsum is simply dummy text printing and type setting industry Lorem Ipsum been industry standard dummy text ever since when unknown printer took a galley.</p>
          </div>
        </div>
		<div class="col-xl-3 col-md-6 col-sm-12">
          <div class="icon-box with-line">
            <div class="utf-icon-box-circle">
              <div class="utf-icon-box-circle-inner"> <i class="icon-line-awesome-user-secret"></i></div>
            </div>
            <h3>User Register</h3>
            <p>Lorem Ipsum is simply dummy text the printing and type setting industry Lorem Ipsum has been industry.</p>
          </div>
        </div>
		<div class="col-xl-3 col-md-6 col-sm-12">
          <div class="icon-box with-line">
            <div class="utf-icon-box-circle">
              <div class="utf-icon-box-circle-inner"> <i class="icon-line-awesome-user-plus"></i></div>
            </div>
            <h3>Create Account</h3>
            <p>Lorem Ipsum is simply dummy text the printing and type setting industry Lorem Ipsum has been industry.</p>
          </div>
        </div>
		<div class="col-xl-3 col-md-6 col-sm-12">
          <div class="icon-box">
            <div class="utf-icon-box-circle">
              <div class="utf-icon-box-circle-inner"> <i class="icon-line-awesome-edit"></i></div>
            </div>
            <h3>Search Jobs</h3>
            <p>Lorem Ipsum is simply dummy text the printing and type setting industry Lorem Ipsum has been industry.</p>
          </div>
        </div>
		<div class="col-xl-3 col-md-6 col-sm-12">
          <div class="icon-box">
            <div class="utf-icon-box-circle">
              <div class="utf-icon-box-circle-inner"> <i class="icon-line-awesome-save"></i></div>
            </div>
            <h3>Save & Apply</h3>
            <p>Lorem Ipsum is simply dummy text the printing and type setting industry Lorem Ipsum has been industry.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Icon Boxes / End -->

  <!-- Testimonials -->
  <div class="section gray padding-top-65 padding-bottom-55">
    <div class="container">
      <div class="row">
        <div class="col-xl-12">
          <div class="utf-section-headline-item centered margin-top-0 margin-bottom-30">
            <span>Clients Say About Us</span>
			<h3>Our Customers Says</h3>
			<div class="utf-headline-display-inner-item">Clients Say About Us</div>
			<p class="utf-slogan-text">Lorem Ipsum is simply dummy text printing and type setting industry Lorem Ipsum been industry standard dummy text ever since when unknown printer took a galley.</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Categories Carousel -->
    <div class="utf-carousel-container-block">
      <div class="utf-testimonial-carousel-block testimonials">
        <div class="utf-carousel-review-item">
          <div class="utf-testimonial-box">
            <div class="utf-testimonial-avatar-photo"> <img src="user/images/user_small_1.jpg" alt=""> </div>
            <div class="utf-testimonial-author-utf-detail-item">
              <h4>John Williams</h4>
              <span>Graphics Designer</span>
			</div>
            <div class="testimonial">Lorem Ipsum is simply dummy text of printing and type setting industry. Lorem Ipsum been industry standard dummy text ever since, when an unknown printer took a galley of type and laboris nisi ut aliquip ex minim veniam scrambled it to make a type specimen book. It has survived not only five into electronic type setting popularised.</div>
          </div>
        </div>
        <div class="utf-carousel-review-item">
          <div class="utf-testimonial-box">
            <div class="utf-testimonial-avatar-photo"> <img src="user/images/user_small_2.jpg" alt=""> </div>
            <div class="utf-testimonial-author-utf-detail-item">
              <h4>John Williams</h4>
              <span>IOS Developer</span>
			</div>
            <div class="testimonial">Lorem Ipsum is simply dummy text of printing and type setting industry. Lorem Ipsum been industry standard dummy text ever since, when an unknown printer took a galley of type and laboris nisi ut aliquip ex minim veniam scrambled it to make a type specimen book. It has survived not only five into electronic type setting popularised.</div>
          </div>
        </div>
        <div class="utf-carousel-review-item">
          <div class="utf-testimonial-box">
            <div class="utf-testimonial-avatar-photo"> <img src="user/images/user_small_3.jpg" alt=""> </div>
            <div class="utf-testimonial-author-utf-detail-item">
              <h4>John Williams</h4>
              <span>Android Developer</span>
			</div>
            <div class="testimonial">Lorem Ipsum is simply dummy text of printing and type setting industry. Lorem Ipsum been industry standard dummy text ever since, when an unknown printer took a galley of type and laboris nisi ut aliquip ex minim veniam scrambled it to make a type specimen book. It has survived not only five into electronic type setting popularised.</div>
          </div>
        </div>
        <div class="utf-carousel-review-item">
          <div class="utf-testimonial-box">
            <div class="utf-testimonial-avatar-photo"> <img src="user/images/user_small_1.jpg" alt=""> </div>
            <div class="utf-testimonial-author-utf-detail-item">
              <h4>John Williams</h4>
              <span>Web Developer</span>
			</div>
            <div class="testimonial">Lorem Ipsum is simply dummy text of printing and type setting industry. Lorem Ipsum been industry standard dummy text ever since, when an unknown printer took a galley of type and laboris nisi ut aliquip ex minim veniam scrambled it to make a type specimen book. It has survived not only five into electronic type setting popularised.</div>
          </div>
        </div>
        <div class="utf-carousel-review-item">
          <div class="utf-testimonial-box">
            <div class="utf-testimonial-avatar-photo"> <img src="user/images/user_small_2.jpg" alt=""> </div>
            <div class="utf-testimonial-author-utf-detail-item">
              <h4>John Williams</h4>
              <span>UI/UX Designer</span>
			</div>
            <div class="testimonial">Lorem Ipsum is simply dummy text of printing and type setting industry. Lorem Ipsum been industry standard dummy text ever since, when an unknown printer took a galley of type and laboris nisi ut aliquip ex minim veniam scrambled it to make a type specimen book. It has survived not only five into electronic type setting popularised.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Testimonials / End -->

  <!-- Counters -->
  <div class="section padding-top-60 padding-bottom-60">
    <div class="container">
      <div class="row">
	    <div class="col-xl-12">
			<div class="utf-section-headline-item centered margin-top-0 margin-bottom-40">
				<span>Success Business Award</span>
				<h3>Our Success & Award</h3>
				<div class="utf-headline-display-inner-item">Success Business Award</div>
				<p class="utf-slogan-text">Lorem Ipsum is simply dummy text printing and type setting industry Lorem Ipsum been industry standard dummy text ever since when unknown printer took a galley.</p>
			</div>
		</div>
        <div class="col-xl-12 counter_inner_block">
		  <div class="utf-counters-container-aera">
			<div class="col-xl-3">
				<div class="utf-single-counter"> <i class="icon-feather-briefcase"></i>
				  <div class="utf-counter-inner-item">
					<h3><span class="counter">12,376</span></h3>
					<span class="utf-counter-title">Live Jobs</span>
				  </div>
				</div>
			</div>
			<div class="col-xl-3">
				<div class="utf-single-counter"> <i class="icon-feather-users"></i>
				  <div class="utf-counter-inner-item">
					<h3><span class="counter">89,562</span></h3>
					<span class="utf-counter-title">Jobs Candidate</span>
				  </div>
				</div>
			</div>
			<div class="col-xl-3">
				<div class="utf-single-counter"> <i class="icon-material-outline-textsms"></i>
				  <div class="utf-counter-inner-item">
					<h3><span class="counter">28,166</span></h3>
					<span class="utf-counter-title">Active Resume</span>
				  </div>
				</div>
			</div>
			<div class="col-xl-3">
				<div class="utf-single-counter"> <i class="icon-material-outline-location-city"></i>
				  <div class="utf-counter-inner-item">
					<h3><span class="counter">8,966</span></h3>
					<span class="utf-counter-title">Companies</span>
				  </div>
				</div>
			</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Counters / End -->
@endsection
