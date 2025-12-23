@extends('layouts.app', ['class' => 'bg-default'])

@section('content')

    <!-- Hero Section with Image Background -->
    <div class="header py-8" 
         style="background-image: url('https://srv1511-files.hstgr.io/ea428c3dd02c0751/files/public_html/upload/HEROIMG.jpeg'); 
                background-size: cover; 
                background-position: center; 
                position: relative; 
                min-height: 70vh;">
        
        <div class="container" style="position: relative; z-index: 2;">
            <div class="header-body text-center mt-7">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <h1 class="display-3 font-weight-bold text-white mb-3">
                            Multivendor Mobile Carwash Admin
                        </h1>
                        <p class="lead text-white mt-3 mb-5">
                            Manage your entire carwash network, vendors, bookings, earnings, and customer experience from one powerful admin dashboard.
                        </p>
                        
                        <div class="d-flex justify-content-center gap-4 mt-5">
                            <a href="{{ route('login') }}" class="btn btn-lg btn-white btn-icon">
                                <span class="btn-inner--icon">
                                    <i class="ni ni-key-25"></i>
                                </span>
                                <span class="btn-inner--text">Admin Login</span>
                            </a>
                            <!-- Optional: Add Register button if needed -->
                            <!-- <a href="{{ route('register') }}" class="btn btn-lg btn-outline-white btn-icon">
                                <span class="btn-inner--icon">
                                    <i class="ni ni-circle-08"></i>
                                </span>
                                <span class="btn-inner--text">Register Vendor</span>
                            </a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Skew Separator -->
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mt--10 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card card-profile shadow-lg border-0 mb-5">
                    <div class="card-body p-5 text-center">
                        <h2 class="text-primary mb-4">Powerful Admin Features</h2>
                        <div class="row mt-5">
                            <div class="col-md-4 mb-4">
                                <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                                    <i class="ni ni-shop"></i>
                                </div>
                                <h5 class="mt-3">Vendor Management</h5>
                                <p class="text-muted">Approve, suspend, and monitor all carwash vendors</p>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                                    <i class="ni ni-calendar-grid-58"></i>
                                </div>
                                <h5 class="mt-3">Admin Dashboard</h5>
                                <p class="text-muted">Real-time overview and control</p>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                    <i class="ni ni-money-coins"></i>
                                </div>
                                <h5 class="mt-3">Revenue Analytics</h5>
                                <p class="text-muted">Track earnings, commissions, and payouts</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <style>
        .header {
            min-height: 70vh;
        }
        .overlay {
            z-index: 1;
        }
        .header-body {
            z-index: 2;
            position: relative;
        }
        .btn-white {
            background-color: #fff !important;
            color: #172b4d !important;
            border: none;
        }
        .btn-white:hover {
            background-color: #f8f9fa !important;
        }
    </style>
@endsection