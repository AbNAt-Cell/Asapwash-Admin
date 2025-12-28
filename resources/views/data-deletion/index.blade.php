@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <!-- Hero Section -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <h1 class="text-white display-3">Data Deletion Request</h1>
                        <p class="text-lead text-white mt-3">
                            Request the deletion of your personal data in compliance with GDPR and privacy regulations.
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
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-icon"><i class="ni ni-check-bold"></i></span>
                        <span class="alert-text"><strong>Success!</strong> {{ session('success') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-white">
                        <div class="text-center">
                            <h2 class="mb-0">Submit Deletion Request</h2>
                            <p class="text-muted mt-2">We take your privacy seriously. Fill out the form below to request
                                deletion of your personal data.</p>
                        </div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" method="POST" action="{{ route('data-deletion.store') }}">
                            @csrf

                            <!-- Name -->
                            <div class="form-group mb-3">
                                <label class="form-control-label" for="name">Full Name <span
                                        class="text-danger">*</span></label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                    </div>
                                    <input class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter your full name" type="text" name="name" id="name"
                                        value="{{ old('name') }}" required>
                                </div>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-group mb-3">
                                <label class="form-control-label" for="email">Email Address <span
                                        class="text-danger">*</span></label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control @error('email') is-invalid @enderror"
                                        placeholder="your.email@example.com" type="email" name="email" id="email"
                                        value="{{ old('email') }}" required>
                                </div>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Phone (Optional) -->
                            <div class="form-group mb-3">
                                <label class="form-control-label" for="phone">Phone Number (Optional)</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                    </div>
                                    <input class="form-control @error('phone') is-invalid @enderror"
                                        placeholder="+1234567890" type="tel" name="phone" id="phone"
                                        value="{{ old('phone') }}">
                                </div>
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- User Type -->
                            <div class="form-group mb-3">
                                <label class="form-control-label" for="user_type">Account Type <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('user_type') is-invalid @enderror" name="user_type"
                                    id="user_type" required>
                                    <option value="">Select your account type</option>
                                    <option value="app_user" {{ old('user_type') == 'app_user' ? 'selected' : '' }}>App User
                                        (Customer)</option>
                                    <option value="shop_owner" {{ old('user_type') == 'shop_owner' ? 'selected' : '' }}>Shop
                                        Owner</option>
                                    <option value="employee" {{ old('user_type') == 'employee' ? 'selected' : '' }}>Employee
                                    </option>
                                    <option value="other" {{ old('user_type') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('user_type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Reason (Optional) -->
                            <div class="form-group mb-3">
                                <label class="form-control-label" for="reason">Reason for Deletion (Optional)</label>
                                <textarea class="form-control @error('reason') is-invalid @enderror" name="reason"
                                    id="reason" rows="4"
                                    placeholder="Please let us know why you want to delete your data (optional)">{{ old('reason') }}</textarea>
                                @error('reason')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Privacy Notice -->
                            <div class="alert alert-info" role="alert">
                                <strong><i class="ni ni-bell-55"></i> Important:</strong>
                                <ul class="mb-0 mt-2">
                                    <li>Your request will be processed within 30 days</li>
                                    <li>You will receive a confirmation email</li>
                                    <li>Once deleted, your data cannot be recovered</li>
                                    <li>Some data may be retained for legal compliance</li>
                                </ul>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg mt-4">
                                    <i class="ni ni-send"></i> Submit Deletion Request
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="card shadow mt-4">
                    <div class="card-body">
                        <h3 class="mb-3"><i class="ni ni-support-16 text-primary"></i> Need Help?</h3>
                        <p class="text-muted mb-2">
                            If you have questions about data deletion or privacy, please contact our support team.
                        </p>
                        <p class="mb-0">
                            <strong>Email:</strong> <a href="mailto:support@asapwash.cloud">support@asapwash.cloud</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .alert ul {
            padding-left: 20px;
        }

        .alert ul li {
            margin-bottom: 5px;
        }
    </style>
@endpush