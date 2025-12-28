@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <!-- Hero Section -->
    <div class="header bg-gradient-primary py-6 py-lg-7">
        <div class="container">
            <div class="header-body text-center mb-5">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-12">
                        <h1 class="text-white display-3">Privacy Policy</h1>
                        <p class="text-lead text-white mt-3">
                            Your privacy is important to us. This policy explains how we collect, use, and protect your
                            personal information.
                        </p>
                        <p class="text-white text-sm">
                            <i class="ni ni-calendar-grid-58"></i> Last Updated: {{ date('F d, Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>

    <!-- Page content -->
    <div class="container mt--7 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Quick Links Card -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h3 class="mb-3"><i class="ni ni-bullet-list-67 text-primary"></i> Quick Navigation</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><a href="#information-collection">1. Information We Collect</a></li>
                                    <li class="mb-2"><a href="#how-we-use">2. How We Use Your Information</a></li>
                                    <li class="mb-2"><a href="#information-sharing">3. Information Sharing</a></li>
                                    <li class="mb-2"><a href="#data-security">4. Data Security</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><a href="#your-rights">5. Your Rights</a></li>
                                    <li class="mb-2"><a href="#cookies">6. Cookies and Tracking</a></li>
                                    <li class="mb-2"><a href="#children">7. Children's Privacy</a></li>
                                    <li class="mb-2"><a href="#contact">8. Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Privacy Policy Content -->
                <div class="card shadow">
                    <div class="card-body p-lg-5">

                        <!-- Introduction -->
                        <div class="mb-5">
                            <h2 class="text-primary mb-3">Introduction</h2>
                            <p>
                                Welcome to <strong>{{ config('app.name', 'Asapwash') }}</strong> ("we," "our," or "us"). We
                                are committed to protecting your personal information and your right to privacy. This
                                Privacy Policy explains how we collect, use, disclose, and safeguard your information when
                                you use our mobile application and services.
                            </p>
                            <p>
                                By using our services, you agree to the collection and use of information in accordance with
                                this policy. If you do not agree with our policies and practices, please do not use our
                                services.
                            </p>
                        </div>

                        <hr class="my-5">

                        <!-- 1. Information We Collect -->
                        <div id="information-collection" class="mb-5">
                            <h2 class="text-primary mb-3">
                                <span class="badge badge-primary badge-pill mr-2">1</span>
                                Information We Collect
                            </h2>

                            <h4 class="mt-4 mb-3">Personal Information</h4>
                            <p>We collect personal information that you voluntarily provide to us when you:</p>
                            <ul>
                                <li>Register for an account</li>
                                <li>Book a car wash service</li>
                                <li>Contact customer support</li>
                                <li>Participate in surveys or promotions</li>
                            </ul>

                            <p class="mt-3">This information may include:</p>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <ul>
                                        <li>Full name</li>
                                        <li>Email address</li>
                                        <li>Phone number</li>
                                        <li>Physical address</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul>
                                        <li>Vehicle information</li>
                                        <li>Payment information</li>
                                        <li>Profile picture (optional)</li>
                                        <li>Service preferences</li>
                                    </ul>
                                </div>
                            </div>

                            <h4 class="mt-4 mb-3">Location Information</h4>
                            <p>
                                With your permission, we collect and process information about your location to:
                            </p>
                            <ul>
                                <li>Find nearby car wash service providers</li>
                                <li>Provide accurate service delivery</li>
                                <li>Improve our location-based features</li>
                            </ul>

                            <h4 class="mt-4 mb-3">Automatically Collected Information</h4>
                            <p>When you use our app, we automatically collect certain information, including:</p>
                            <ul>
                                <li>Device information (model, operating system, unique device identifiers)</li>
                                <li>Usage data (features used, time spent, interactions)</li>
                                <li>Log data (IP address, browser type, access times)</li>
                                <li>Crash reports and performance data</li>
                            </ul>
                        </div>

                        <hr class="my-5">

                        <!-- 2. How We Use Your Information -->
                        <div id="how-we-use" class="mb-5">
                            <h2 class="text-primary mb-3">
                                <span class="badge badge-primary badge-pill mr-2">2</span>
                                How We Use Your Information
                            </h2>

                            <p>We use the information we collect for various purposes:</p>

                            <div class="card bg-light border-0 mt-3">
                                <div class="card-body">
                                    <h5><i class="ni ni-check-bold text-success"></i> Service Delivery</h5>
                                    <ul class="mb-0">
                                        <li>Process and fulfill your service bookings</li>
                                        <li>Connect you with car wash service providers</li>
                                        <li>Send booking confirmations and updates</li>
                                        <li>Process payments and prevent fraud</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card bg-light border-0 mt-3">
                                <div class="card-body">
                                    <h5><i class="ni ni-settings text-info"></i> Service Improvement</h5>
                                    <ul class="mb-0">
                                        <li>Analyze usage patterns to improve our app</li>
                                        <li>Develop new features and services</li>
                                        <li>Conduct research and analytics</li>
                                        <li>Monitor and improve service quality</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card bg-light border-0 mt-3">
                                <div class="card-body">
                                    <h5><i class="ni ni-email-83 text-warning"></i> Communication</h5>
                                    <ul class="mb-0">
                                        <li>Send service-related notifications</li>
                                        <li>Respond to your inquiries and support requests</li>
                                        <li>Send promotional offers (with your consent)</li>
                                        <li>Provide important updates about our services</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card bg-light border-0 mt-3">
                                <div class="card-body">
                                    <h5><i class="ni ni-lock-circle-open text-danger"></i> Legal and Security</h5>
                                    <ul class="mb-0">
                                        <li>Comply with legal obligations</li>
                                        <li>Protect against fraud and abuse</li>
                                        <li>Enforce our terms and conditions</li>
                                        <li>Resolve disputes and troubleshoot problems</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <hr class="my-5">

                        <!-- 3. Information Sharing -->
                        <div id="information-sharing" class="mb-5">
                            <h2 class="text-primary mb-3">
                                <span class="badge badge-primary badge-pill mr-2">3</span>
                                Information Sharing and Disclosure
                            </h2>

                            <p>We may share your information in the following situations:</p>

                            <h4 class="mt-4 mb-3">With Service Providers</h4>
                            <p>
                                We share necessary information with car wash shop owners and employees to fulfill your
                                service requests. This includes your name, contact information, location, and vehicle
                                details.
                            </p>

                            <h4 class="mt-4 mb-3">With Third-Party Service Providers</h4>
                            <p>We may share information with trusted third parties who assist us in:</p>
                            <ul>
                                <li>Payment processing</li>
                                <li>Data analytics</li>
                                <li>Cloud storage</li>
                                <li>Customer support</li>
                                <li>Marketing and advertising</li>
                            </ul>

                            <h4 class="mt-4 mb-3">For Legal Reasons</h4>
                            <p>We may disclose your information if required by law or in response to:</p>
                            <ul>
                                <li>Legal processes or government requests</li>
                                <li>Enforcement of our terms and conditions</li>
                                <li>Protection of our rights, property, or safety</li>
                                <li>Investigation of fraud or security issues</li>
                            </ul>

                            <div class="alert alert-info mt-4" role="alert">
                                <strong><i class="ni ni-bell-55"></i> Important:</strong> We do not sell your personal
                                information to third parties for their marketing purposes.
                            </div>
                        </div>

                        <hr class="my-5">

                        <!-- 4. Data Security -->
                        <div id="data-security" class="mb-5">
                            <h2 class="text-primary mb-3">
                                <span class="badge badge-primary badge-pill mr-2">4</span>
                                Data Security
                            </h2>

                            <p>
                                We implement appropriate technical and organizational security measures to protect your
                                personal information against unauthorized access, alteration, disclosure, or destruction.
                            </p>

                            <h4 class="mt-4 mb-3">Security Measures Include:</h4>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <ul>
                                        <li>Encryption of data in transit and at rest</li>
                                        <li>Secure server infrastructure</li>
                                        <li>Regular security audits</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul>
                                        <li>Access controls and authentication</li>
                                        <li>Employee training on data protection</li>
                                        <li>Incident response procedures</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="alert alert-warning mt-4" role="alert">
                                <strong><i class="ni ni-bell-55"></i> Note:</strong> While we strive to protect your
                                information, no method of transmission over the internet or electronic storage is 100%
                                secure. We cannot guarantee absolute security.
                            </div>
                        </div>

                        <hr class="my-5">

                        <!-- 5. Your Rights -->
                        <div id="your-rights" class="mb-5">
                            <h2 class="text-primary mb-3">
                                <span class="badge badge-primary badge-pill mr-2">5</span>
                                Your Privacy Rights
                            </h2>

                            <p>Depending on your location, you may have the following rights regarding your personal
                                information:</p>

                            <div class="table-responsive mt-4">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Right</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Access</strong></td>
                                            <td>Request a copy of the personal information we hold about you</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Correction</strong></td>
                                            <td>Request correction of inaccurate or incomplete information</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Deletion</strong></td>
                                            <td>Request deletion of your personal information</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Portability</strong></td>
                                            <td>Request transfer of your data to another service provider</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Objection</strong></td>
                                            <td>Object to processing of your personal information</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Restriction</strong></td>
                                            <td>Request restriction of processing your information</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Withdraw Consent</strong></td>
                                            <td>Withdraw your consent for data processing at any time</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="card bg-gradient-success text-white mt-4">
                                <div class="card-body">
                                    <h4 class="text-white mb-3">
                                        <i class="ni ni-archive-2"></i> Request Data Deletion
                                    </h4>
                                    <p class="mb-3">
                                        You have the right to request deletion of your personal data. We will process your
                                        request within 30 days.
                                    </p>
                                    <a href="{{ route('data-deletion.index') }}" class="btn btn-white btn-sm">
                                        <i class="ni ni-send"></i> Submit Deletion Request
                                    </a>
                                </div>
                            </div>

                            <p class="mt-4">
                                To exercise any of these rights, please contact us using the information provided in the
                                "Contact Us" section below.
                            </p>
                        </div>

                        <hr class="my-5">

                        <!-- 6. Cookies and Tracking -->
                        <div id="cookies" class="mb-5">
                            <h2 class="text-primary mb-3">
                                <span class="badge badge-primary badge-pill mr-2">6</span>
                                Cookies and Tracking Technologies
                            </h2>

                            <p>
                                We use cookies and similar tracking technologies to track activity on our service and store
                                certain information. You can instruct your browser to refuse all cookies or to indicate when
                                a cookie is being sent.
                            </p>

                            <h4 class="mt-4 mb-3">Types of Cookies We Use:</h4>
                            <ul>
                                <li><strong>Essential Cookies:</strong> Required for the operation of our service</li>
                                <li><strong>Preference Cookies:</strong> Remember your settings and preferences</li>
                                <li><strong>Analytics Cookies:</strong> Help us understand how you use our service</li>
                                <li><strong>Marketing Cookies:</strong> Track your activity to show relevant ads (with
                                    consent)</li>
                            </ul>
                        </div>

                        <hr class="my-5">

                        <!-- 7. Children's Privacy -->
                        <div id="children" class="mb-5">
                            <h2 class="text-primary mb-3">
                                <span class="badge badge-primary badge-pill mr-2">7</span>
                                Children's Privacy
                            </h2>

                            <p>
                                Our services are not intended for individuals under the age of 18. We do not knowingly
                                collect personal information from children. If you are a parent or guardian and believe your
                                child has provided us with personal information, please contact us immediately.
                            </p>
                        </div>

                        <hr class="my-5">

                        <!-- 8. Changes to Privacy Policy -->
                        <div class="mb-5">
                            <h2 class="text-primary mb-3">
                                <span class="badge badge-primary badge-pill mr-2">8</span>
                                Changes to This Privacy Policy
                            </h2>

                            <p>
                                We may update our Privacy Policy from time to time. We will notify you of any changes by
                                posting the new Privacy Policy on this page and updating the "Last Updated" date.
                            </p>
                            <p>
                                You are advised to review this Privacy Policy periodically for any changes. Changes to this
                                Privacy Policy are effective when they are posted on this page.
                            </p>
                        </div>

                        <hr class="my-5">

                        <!-- 9. Contact Us -->
                        <div id="contact" class="mb-5">
                            <h2 class="text-primary mb-3">
                                <span class="badge badge-primary badge-pill mr-2">9</span>
                                Contact Us
                            </h2>

                            <p>If you have any questions about this Privacy Policy or our privacy practices, please contact
                                us:</p>

                            <div class="card bg-light border-0 mt-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-2">
                                                <i class="ni ni-email-83 text-primary"></i>
                                                <strong> Email:</strong> <a
                                                    href="mailto:support@asapwash.cloud">support@asapwash.cloud</a>
                                            </p>
                                            <p class="mb-2">
                                                <i class="ni ni-square-pin text-primary"></i>
                                                <strong> Address:</strong> {{ config('app.name') }} Headquarters
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-2">
                                                <i class="ni ni-world text-primary"></i>
                                                <strong> Website:</strong> <a
                                                    href="https://asapwash.cloud">asapwash.cloud</a>
                                            </p>
                                            <p class="mb-0">
                                                <i class="ni ni-support-16 text-primary"></i>
                                                <strong> Support:</strong> Available 24/7
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Bottom CTA -->
                <div class="card shadow mt-4 bg-gradient-info">
                    <div class="card-body text-center text-white py-4">
                        <h3 class="text-white mb-3">Have Questions About Your Privacy?</h3>
                        <p class="mb-4">We're here to help. Contact our support team or submit a data deletion request.</p>
                        <div class="btn-wrapper">
                            <a href="mailto:support@asapwash.cloud" class="btn btn-white btn-icon mb-3 mb-sm-0">
                                <span class="btn-inner--icon"><i class="ni ni-email-83"></i></span>
                                <span class="btn-inner--text">Contact Support</span>
                            </a>
                            <a href="{{ route('data-deletion.index') }}"
                                class="btn btn-outline-white btn-icon mb-3 mb-sm-0">
                                <span class="btn-inner--icon"><i class="ni ni-archive-2"></i></span>
                                <span class="btn-inner--text">Delete My Data</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .card-body ul {
            line-height: 1.8;
        }

        .card-body h2 {
            scroll-margin-top: 100px;
        }

        .card-body a {
            color: #5e72e4;
            text-decoration: none;
        }

        .card-body a:hover {
            color: #324cdd;
            text-decoration: underline;
        }

        .table th {
            font-weight: 600;
        }
    </style>
@endpush