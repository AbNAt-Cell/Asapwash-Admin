@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <!-- Hero Section -->
    <div class="hero-section position-relative overflow-hidden">
        <div class="hero-background"
            style="background: linear-gradient(135deg, rgba(94, 114, 228, 0.95) 0%, rgba(130, 94, 228, 0.95) 100%), url('{{ asset('.gemini/antigravity/brain/8cf2c1cf-ef63-41b2-b80d-a8d663f4119d/car_wash_hero_1766921109727.png') }}') center/cover;">
            <div class="container">
                <div class="row align-items-center min-vh-100 py-5">
                    <div class="col-lg-6 text-white">
                        <h1 class="display-2 font-weight-bold mb-4 animate-fade-in">
                            Premium Car Wash<br>At Your Doorstep
                        </h1>
                        <p class="lead mb-4">
                            Book professional car wash and detailing services with just a few taps. Quality service,
                            convenience, and care for your vehicle.
                        </p>
                        <div class="app-download-badges mb-4">
                            <a href="#" class="d-inline-block mr-3 mb-3">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                                    alt="Get it on Google Play" style="height: 60px;">
                            </a>
                            <a href="#" class="d-inline-block mb-3">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Download_on_the_App_Store_Badge.svg"
                                    alt="Download on App Store" style="height: 60px;">
                            </a>
                        </div>
                        <div class="hero-stats mt-5">
                            <div class="row text-center">
                                <div class="col-4">
                                    <h3 class="font-weight-bold mb-0">500+</h3>
                                    <small>Happy Customers</small>
                                </div>
                                <div class="col-4">
                                    <h3 class="font-weight-bold mb-0">50+</h3>
                                    <small>Service Providers</small>
                                </div>
                                <div class="col-4">
                                    <h3 class="font-weight-bold mb-0">4.8★</h3>
                                    <small>Average Rating</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center d-none d-lg-block">
                        <img src="{{ asset('.gemini/antigravity/brain/8cf2c1cf-ef63-41b2-b80d-a8d663f4119d/mobile_app_mockup_1766921128652.png') }}"
                            alt="Asapwash Mobile App" class="img-fluid phone-mockup" style="max-width: 400px;">
                    </div>
                </div>
            </div>
        </div>
        <!-- Wave Separator -->
        <div class="wave-separator">
            <svg viewBox="0 0 1440 120" xmlns="http://www.w3.org/2000/svg">
                <path fill="#f7fafc"
                    d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z">
                </path>
            </svg>
        </div>
    </div>

    <!-- Features Section -->
    <section class="features-section py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-3 font-weight-bold">Why Choose Asapwash?</h2>
                <p class="lead text-muted">Experience the future of car care</p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-lg h-100 hover-lift">
                        <div class="card-body text-center p-5">
                            <div class="icon-box bg-gradient-primary text-white rounded-circle mx-auto mb-4"
                                style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                <i class="ni ni-mobile-button" style="font-size: 2rem;"></i>
                            </div>
                            <h4 class="font-weight-bold mb-3">Easy Booking</h4>
                            <p class="text-muted">Book your car wash service in seconds with our intuitive mobile app.
                                Choose your preferred time and location.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-lg h-100 hover-lift">
                        <div class="card-body text-center p-5">
                            <div class="icon-box bg-gradient-success text-white rounded-circle mx-auto mb-4"
                                style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                <i class="ni ni-badge" style="font-size: 2rem;"></i>
                            </div>
                            <h4 class="font-weight-bold mb-3">Verified Business Owners</h4>
                            <p class="text-muted">All our service providers are thoroughly vetted and trained to deliver
                                exceptional car care services.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-lg h-100 hover-lift">
                        <div class="card-body text-center p-5">
                            <div class="icon-box bg-gradient-info text-white rounded-circle mx-auto mb-4"
                                style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                <i class="ni ni-pin-3" style="font-size: 2rem;"></i>
                            </div>
                            <h4 class="font-weight-bold mb-3">Doorstep Service</h4>
                            <p class="text-muted">We come to you! Get your car washed at your home, office, or any
                                convenient location.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-lg h-100 hover-lift">
                        <div class="card-body text-center p-5">
                            <div class="icon-box bg-gradient-warning text-white rounded-circle mx-auto mb-4"
                                style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                <i class="ni ni-money-coins" style="font-size: 2rem;"></i>
                            </div>
                            <h4 class="font-weight-bold mb-3">Transparent Pricing</h4>
                            <p class="text-muted">No hidden fees. See exact prices upfront and pay securely through the app.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-lg h-100 hover-lift">
                        <div class="card-body text-center p-5">
                            <div class="icon-box bg-gradient-danger text-white rounded-circle mx-auto mb-4"
                                style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                <i class="ni ni-time-alarm" style="font-size: 2rem;"></i>
                            </div>
                            <h4 class="font-weight-bold mb-3">Flexible Scheduling</h4>
                            <p class="text-muted">Choose a time that works for you. We offer same-day and scheduled
                                bookings.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-lg h-100 hover-lift">
                        <div class="card-body text-center p-5">
                            <div class="icon-box bg-gradient-primary text-white rounded-circle mx-auto mb-4"
                                style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                <i class="ni ni-satisfied" style="font-size: 2rem;"></i>
                            </div>
                            <h4 class="font-weight-bold mb-3">Quality Guaranteed</h4>
                            <p class="text-muted">100% satisfaction guaranteed. If you're not happy, we'll make it right.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works-section py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-3 font-weight-bold">How It Works</h2>
                <p class="lead text-muted">Get your car cared for in 3 simple steps</p>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-4 text-center mb-4">
                    <div class="step-number bg-gradient-primary text-white rounded-circle mx-auto mb-4"
                        style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; font-size: 3rem; font-weight: bold;">
                        1
                    </div>
                    <h4 class="font-weight-bold mb-3">Download & Book</h4>
                    <p class="text-muted">Download the app, create your account, and select your desired service and time
                        slot.</p>
                </div>
                <div class="col-lg-4 text-center mb-4">
                    <div class="step-number bg-gradient-success text-white rounded-circle mx-auto mb-4"
                        style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; font-size: 3rem; font-weight-bold;">
                        2
                    </div>
                    <h4 class="font-weight-bold mb-3">We Come To You</h4>
                    <p class="text-muted">Our professional team arrives at your location with all necessary equipment and
                        supplies.</p>
                </div>
                <div class="col-lg-4 text-center mb-4">
                    <div class="step-number bg-gradient-info text-white rounded-circle mx-auto mb-4"
                        style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; font-size: 3rem; font-weight-bold;">
                        3
                    </div>
                    <h4 class="font-weight-bold mb-3">Enjoy Clean Car</h4>
                    <p class="text-muted">Relax while we work. Pay through the app and enjoy your sparkling clean vehicle!
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section py-5 bg-gradient-primary">
        <div class="container py-5">
            <div class="text-center text-white mb-5">
                <h2 class="display-3 font-weight-bold">Some Services on the App</h2>
                <p class="lead">Professional car care solutions for every need</p>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-card bg-white rounded shadow-lg p-4 text-center h-100">
                        <i class="ni ni-ui-04 text-primary mb-3" style="font-size: 3rem;"></i>
                        <h5 class="font-weight-bold mb-2">Exterior Wash</h5>
                        <p class="text-muted small mb-0">Complete exterior cleaning with premium products</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-card bg-white rounded shadow-lg p-4 text-center h-100">
                        <i class="ni ni-atom text-success mb-3" style="font-size: 3rem;"></i>
                        <h5 class="font-weight-bold mb-2">Interior Detailing</h5>
                        <p class="text-muted small mb-0">Deep cleaning of seats, carpets, and dashboard</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-card bg-white rounded shadow-lg p-4 text-center h-100">
                        <i class="ni ni-diamond text-info mb-3" style="font-size: 3rem;"></i>
                        <h5 class="font-weight-bold mb-2">Polishing</h5>
                        <p class="text-muted small mb-0">Restore your car's shine with professional polishing</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-card bg-white rounded shadow-lg p-4 text-center h-100">
                        <i class="ni ni-settings text-warning mb-3" style="font-size: 3rem;"></i>
                        <h5 class="font-weight-bold mb-2">Engine Wash</h5>
                        <p class="text-muted small mb-0">Safe and thorough engine bay cleaning</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Download CTA Section -->
    <section class="download-cta-section py-5 bg-white">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="display-3 font-weight-bold mb-4">Ready to Get Started?</h2>
                    <p class="lead text-muted mb-4">
                        Download the Asapwash app today and experience the convenience of professional car care at your
                        fingertips.
                    </p>
                    <div class="app-badges">
                        <a href="#" class="d-inline-block mr-3 mb-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                                alt="Get it on Google Play" style="height: 70px;">
                        </a>
                        <a href="#" class="d-inline-block mb-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Download_on_the_App_Store_Badge.svg"
                                alt="Download on App Store" style="height: 70px;">
                        </a>
                    </div>
                    <div class="mt-4">
                        <p class="text-muted mb-2">
                            <i class="ni ni-check-bold text-success mr-2"></i> Free to download
                        </p>
                        <p class="text-muted mb-2">
                            <i class="ni ni-check-bold text-success mr-2"></i> No subscription required
                        </p>
                        <p class="text-muted mb-2">
                            <i class="ni ni-check-bold text-success mr-2"></i> Pay only for services you use
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('.gemini/antigravity/brain/8cf2c1cf-ef63-41b2-b80d-a8d663f4119d/mobile_app_mockup_1766921128652.png') }}"
                        alt="Download Asapwash App" class="img-fluid" style="max-width: 400px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h4 class="font-weight-bold mb-3">Asapwash</h4>
                    <p class="text-muted">
                        Premium car wash and detailing services at your doorstep. Quality, convenience, and care for your
                        vehicle.
                    </p>
                    <div class="social-links mt-3">
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle mr-2">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle mr-2">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle mr-2">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h5 class="font-weight-bold mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-muted">About Us</a></li>
                        <li class="mb-2"><a href="#" class="text-muted">Services</a></li>
                        <li class="mb-2"><a href="#" class="text-muted">Pricing</a></li>
                        <li class="mb-2"><a href="#" class="text-muted">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h5 class="font-weight-bold mb-3">Legal</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('privacy-policy') }}" class="text-muted">Privacy Policy</a></li>
                        <li class="mb-2"><a href="#" class="text-muted">Terms of Service</a></li>
                        <li class="mb-2"><a href="{{ route('data-deletion.index') }}" class="text-muted">Data Deletion</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="font-weight-bold mb-3">Contact</h5>
                    <p class="text-muted mb-2">
                        <i class="ni ni-email-83 mr-2"></i> support@asapwash.cloud
                    </p>
                    <p class="text-muted mb-2">
                        <i class="ni ni-support-16 mr-2"></i> 24/7 Support
                    </p>
                </div>
            </div>
            <hr class="my-4 bg-secondary">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-left">
                    <p class="text-muted mb-0">&copy; {{ date('Y') }} Asapwash. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <p class="text-muted mb-0">Made by Abnat <i class="ni ni-favourite-28 text-danger"></i> for car owners
                    </p>
                </div>
            </div>
        </div>
    </footer>
@endsection

@push('css')
    <style>
        /* Hero Section */
        .hero-section {
            position: relative;
        }

        .hero-background {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .phone-mockup {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Wave Separator */
        .wave-separator {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .wave-separator svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 120px;
        }

        /* Cards */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-10px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
        }

        /* Icon Box */
        .icon-box {
            transition: transform 0.3s ease;
        }

        .hover-lift:hover .icon-box {
            transform: scale(1.1);
        }

        /* Step Numbers */
        .step-number {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, .15);
            transition: transform 0.3s ease;
        }

        .step-number:hover {
            transform: scale(1.1);
        }

        /* Service Cards */
        .service-card {
            transition: transform 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        /* Footer Links */
        footer a {
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #fff !important;
            text-decoration: none;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .hero-background {
                min-height: auto;
                padding: 80px 0;
            }

            .display-2 {
                font-size: 2.5rem;
            }

            .display-3 {
                font-size: 2rem;
            }
        }

        /* App Store Badges */
        .app-download-badges img,
        .app-badges img {
            transition: transform 0.3s ease;
        }

        .app-download-badges img:hover,
        .app-badges img:hover {
            transform: scale(1.05);
        }
    </style>
@endpush