<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>

                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            {{-- <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended"
                        placeholder="{{ __('Search') }}" aria-label="Search">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fa fa-search"></span>
                </div>
            </div>
        </div>
        </form> --}}
        <!-- Navigation -->
        <ul class="navbar-nav ">
            <h6 class="navbar-heading text-muted" style="padding: 0rem 1.5rem;">Navigation</h6>
            @can('dashboard')
            <li class="nav-item ">
                <a class="nav-link {{request()->is('home') ? 'font-weight-bold text-primary'  : ''}}" href="{{ route('home') }}">
                    <i class="fas fa-tachometer-alt text-blue"></i> {{ __('Dashboard') }}
                </a>
            </li>
            @endcan
           
            @can('role_access')
            <li class="nav-item">
                <a class="nav-link {{request()->is(['roles','roles/create','roles/*/edit']) ? 'font-weight-bold text-primary'  : ''}}" href="{{route('roles.index')}}">
                    <i class="fas fa-id-badge text-blue"></i> {{ __('Role') }}
                </a>
            </li>
            @endcan
            @can('user_access')

            <li class="nav-item ">
                <a class="nav-link {{request()->is(['users','users/create','users/*/edit']) ? 'font-weight-bold text-primary'  : ''}}" href="{{route('users.index')}}">
                    <i class="fas fa-user text-blue"></i> {{ __('User') }}
                </a>
            </li>
            @endcan
            @can('category_access')
            <li class="nav-item">
                <a class="nav-link {{request()->is(['categories','categories/create','categories/*/edit']) ? 'font-weight-bold text-primary'  : ''}}" href="{{route('categories.index')}}">
                    <i class="fas fa-folder text-blue"></i> {{ __('Category') }}
                </a>
            </li>
            @endcan
            @can('vehicleBrand_access')
            <li class="nav-item">
                <a class="nav-link {{request()->is(['vehicleBrand','vehicleBrand/create','vehicleBrand/*/edit']) ? 'font-weight-bold text-primary'  : ''}}" href="{{route('vehicleBrand.index')}}">
                    <i class="fas fa-bullseye text-blue"></i> {{ __('Vehicle Brand') }}
                </a>
            </li>
            @endcan
            @can('vehicleModel_access')
            <li class="nav-item">
                <a class="nav-link {{request()->is(['vehicleModel','vehicleModel/create','vehicleModel/*/edit']) ? 'font-weight-bold text-primary'  : ''}}" href="{{route('vehicleModel.index')}}">
                    <i class="fas fa-car-side text-blue"></i> {{ __('Vehicle Model') }}
                </a>
            </li>
            @endcan
            @can('appuser_access')
            <li class="nav-item ">
                {{-- appuser.index --}}
                <a class="nav-link {{request()->is(['appuser','appuser/create','appuser/*/edit']) ? 'font-weight-bold text-primary'  : ''}}" href="{{route('appuser.index')}}">
                    <i class="fas fa-shower text-blue"></i> {{ __('Customer') }}
                </a>
            </li>
            @endcan
            <li class="nav-item">
                {{-- appuser.index --}}
                <a class="nav-link {{request()->is(['shopowner','shopowner/create','shopowner/*/edit','shopowner/*','/showowner/*/detail']) ? 'font-weight-bold text-primary'  : ''}}" href="{{route('shopowner.index')}}">
                    <i class="fas fa-store-alt text-blue"></i> {{ __('Shop Owner') }}
                </a>
            </li>
            {{-- @canany(['booking_access','branch_booking_access'])
            <li class="nav-item">
                <a class="nav-link" href="{{ route('booking.index') }}">
                    <i class="fas fa-cut text-blue"></i> {{ __('Booking') }}
                </a>
            </li>
            @endcan --}}
            @can('notification_access')
            <li class="nav-item">
                <a class="nav-link {{request()->is(['notification','notification/create','notification/*/edit']) ? 'font-weight-bold text-primary'  : ''}}" href="{{ route('notification.index') }}">
                    <i class="fas fa-bell text-blue"></i> {{ __('Notification') }}
                </a>
            </li>
            @endcan
            @can('earning_access')
            <li class="nav-item ">
                <a class="nav-link {{request()->is(['earning']) ? 'font-weight-bold text-primary'  : ''}}" href="{{ route('earning.index') }}">
                    <i class="fas fa-dollar-sign text-blue"></i> {{ __('Earning') }}
                </a>
            </li>
            @endcan
            {{-- @can('report_access')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('report.index') }}">
                    <i class="far fa-file-word text-blue"></i> {{ __('Report') }}
                </a>
            </li>
            @endcan --}}
            @can('custom_notification_access')
            <li class="nav-item">
                <a class="nav-link {{request()->is(['custom/notification']) ? 'font-weight-bold text-primary'  : ''}}" href="{{ route('custom.index') }}">
                    <i class="fas fa-concierge-bell text-blue"></i> {{ __('Custom Notification') }}
                </a>
            </li>
            @endcan
            @can('setting_access')
            <li class="nav-item">
                <a class="nav-link {{request()->is(['setting']) ? 'font-weight-bold text-primary'  : ''}}" href="{{ route('setting.index') }}">
                    <i class="fas fa-cog text-blue"></i> {{ __('Setting') }}
                </a>
            </li>
            @endcan
            @can('privacy_access')
            <li class="nav-item">
                <a class="nav-link {{request()->is(['privacy-policy']) ? 'font-weight-bold text-primary'  : ''}}" href="{{ route('pp') }}">
                    <i class="far fa-handshake text-blue"></i> {{ __('Privacy and Policy') }}
                </a>
            </li>
            @endcan
            @can('faq_access')
            <li class="nav-item">
                <a class="nav-link {{request()->is(['faq','faq/create','faq/*/edit']) ? 'font-weight-bold text-primary'  : ''}}" href="{{ route('faq.index') }}">
                    <i class="fas fa-question text-blue"></i> {{ __('FAQ') }}
                </a>
            </li>
            @endcan
            {{-- @canany(['review_access','branch_review_access'])
            <li class="nav-item">
                <a class="nav-link" href="{{ route('review.index') }}">
                    <i class="far fa-smile-beam text-blue"></i> {{ __('Review') }}
                </a>
            </li>
            @endcan --}}
        

        </ul>
   
        <hr class="my-3">
    </div>
    </div>
</nav>