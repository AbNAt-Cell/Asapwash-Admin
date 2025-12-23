@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Setting",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Setting'
])))
<div class="container-fluid mt--7">
    <div class="col-12">
        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-header ">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Setting') }}</h3>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body pb-0">
                

                    <ul class="nav nav-pills nav-fill flex-column flex-sm-row mb-4" id="myTab" role="tablist">
                        <li class="nav-item ">
                            <a class="nav-link mb-sm-3 mb-md-0 active" id="home-basic-tab" data-toggle="tab" href="#homeBasic"
                                role="tab" aria-controls="homeBasic" aria-selected="true">Basic</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 " id="home-basic-tab" data-toggle="tab" href="#contact" role="tab"
                                aria-controls="homeBasic" aria-selected="true">Contact us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 " id="home-basic-tab" data-toggle="tab" href="#appInfo" role="tab"
                                aria-controls="homeBasic" aria-selected="true">App Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="profile-basic-tab" data-toggle="tab" href="#profileBasic" role="tab"
                                aria-controls="profileBasic" aria-selected="false">SMS Gateway</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="contact-basic-tab" data-toggle="tab" href="#contactBasic" role="tab"
                                aria-controls="contactBasic" aria-selected="false">Payment Gateway</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="contact-basic-tab" data-toggle="tab" href="#pushNoti" role="tab"
                                aria-controls="pushNoti" aria-selected="false">Push Notification</a>
                        </li>
                    </ul>
                    <div class="tab-content pb-0" id="myTabContent">
                        <div class="tab-pane fade show active" id="homeBasic" role="tabpanel"
                            aria-labelledby="home-basic-tab">
                            <form enctype="multipart/form-data" action="{{ route('setting.basic') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="form-group col-6 mb-4">
                                        <label for="inputEmail4" class="ul-form__label"> {{__('Currency:')}}</label>
                                        <select class="js-example-basic-multiple form-control" name="currency">
                                            @foreach ($currency as $curr)

                                            <option {{$master['currency'] === $curr->code ? 'selected' : ''}}
                                                value="{{$curr->code}}">
                                                {{$curr->country .' - '.$curr->code.'('. $curr->symbol.')'}}</option>
                                            @endforeach

                                        </select>
                                        @error('currency')
                                        <div class="invalid-div">{{ $message }}</div>
                                        @enderror

                                    </div>
                                  <div class="form-group col-6 mb-4">
                                        <label for="inputEmail4" class="ul-form__label"> {{__('Admin Commission:')}}</label>
                                        <input type="text" name="admin_per" class="form-control  @error('admin_per') invalid-input @enderror"
                                            placeholder="{{__('Please Enter Admin %')}}" required min="1" value="{{$master['admin_per']}}">
                                        @error('admin_per')
                                        <div class="invalid-div">{{ $message }}</div>
                                        @enderror
                                    
                                    </div>
                                   <div class="form-group col-6 mb-4">
                                        <label for="inputEmail4" class="ul-form__label"> {{__('Time Slot Length:')}}</label>
                                        <input type="text" name="time_slot_length" class="form-control  @error('time_slot_length') invalid-input @enderror" required min="1"
                                            value="{{$master['time_slot_length']}}">
                                        @error('time_slot_length')
                                        <div class="invalid-div">{{ $message }}</div>
                                        @enderror
                                    
                                    </div>
                                 {{--  --}}
                                 <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="validationDefault01">{{__('Main Image:')}}</label>
                                            <input type="file" name="main_logo" class="form-control file-input "
                                                accept="image/*">
                                          
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <h5> {{__('Enable notification')}}</h5>

                                    </div>
                                    <div class="col-4 pr-0">
                                        <label class="switch switch-primary mr-3">
                                            <span> {{__('')}}</span>
                                            <input type="checkbox" value="1" name="notification"
                                                {{$master['notification'] ? 'checked' : ''}}>
                                            <span class="slider"></span>
                                        </label>


                                    </div>
                                    <div class="col-2">
                                        <h5> {{__('Offline Payment')}}</h5>

                                    </div>
                                    <div class="col-4 pr-0" >
                                        <label class="switch switch-primary mr-3">
                                            <span> {{__('')}}</span>
                                            <input type="checkbox" value="1" name="offline_payment"
                                                {{$master['offline_payment'] ? 'checked' : ''}}>
                                            <span class="slider"></span>
                                        </label>


                                    </div>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <div class="mc-footer">
                                        <div class="row">
                                            <div class="col-lg-12 text-right">
                                                <button type="submit"
                                                    class="btn  btn-primary m-1">{{__('Submit')}}</button>
                                                <button type="reset"
                                                    class=" btn  btn-secondary m-1">{{__('Reset')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade " id="contact" role="tabpanel" aria-labelledby="home-basic-tab">
                            <form enctype="multipart/form-data" action="{{ route('base.update') }}" method="POST">
                                @csrf
                                <div class="row mb-3">

                                    <div class="form-group col-6 mb-4">
                                        <label for="inputEmail4" class="ul-form__label"> {{__('Phone No:')}}</label>
                                        <input type="text" name="phone_no"
                                            class="form-control  @error('phone_no') invalid-input @enderror" required
                                            min="1" value="{{$master['phone_no']}}">
                                        @error('phone_no')
                                        <div class="invalid-div">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="form-group col-6 mb-4">
                                        <label for="inputEmail4" class="ul-form__label"> {{__('Email:')}}</label>
                                        <input type="text" name="email"
                                            class="form-control  @error('email') invalid-input @enderror" required
                                            min="1" value="{{$master['email']}}">
                                        @error('email')
                                        <div class="invalid-div">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="form-group col-12 mb-4">
                                        <label for="inputEmail4" class="ul-form__label"> {{__('Address:')}}</label>
                                        <textarea name="address"
                                            class="form-control  @error('address') invalid-input @enderror" cols="30"
                                            rows="10">{{$master['address']}}</textarea>

                                        @error('email')
                                        <div class="invalid-div">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <div class="mc-footer">
                                        <div class="row">
                                            <div class="col-lg-12 text-right">
                                                <button type="submit"
                                                    class="btn  btn-primary m-1">{{__('Submit')}}</button>
                                                <button type="reset"
                                                    class=" btn  btn-secondary m-1">{{__('Reset')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade " id="appInfo" role="tabpanel" aria-labelledby="home-basic-tab">
                            <form enctype="multipart/form-data" action="{{ route('base.update') }}" method="POST">
                                @csrf
                                <div class="row mb-3">

                                    <div class="form-group col-6 mb-4">
                                        <label for="inputEmail4" class="ul-form__label"> {{__('IOS version:')}}</label>
                                        <input type="text" name="ios_version"
                                            class="form-control  @error('ios_version') invalid-input @enderror" required
                                            min="1" value="{{$master['ios_version']}}">
                                        @error('ios_version')
                                        <div class="invalid-div">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="form-group col-6 mb-4">
                                        <label for="inputEmail4" class="ul-form__label">
                                            {{__('Android version:')}}</label>
                                        <input type="text" name="android_version"
                                            class="form-control  @error('android_version') invalid-input @enderror"
                                            required min="1" value="{{$master['android_version']}}">
                                        @error('android_version')
                                        <div class="invalid-div">{{ $message }}</div>
                                        @enderror

                                    </div>

                                </div>
                                <div class="card-footer bg-transparent">
                                    <div class="mc-footer">
                                        <div class="row">
                                            <div class="col-lg-12 text-right">
                                                <button type="submit"
                                                    class="btn  btn-primary m-1">{{__('Submit')}}</button>
                                                <button type="reset"
                                                    class=" btn  btn-secondary m-1">{{__('Reset')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="profileBasic" role="tabpanel"
                            aria-labelledby="profile-basic-tab">
                            @if (View::exists('admin.twilio.index') && Route::has('twilio.update'))
                            @include('admin.twilio.index')
                            @else
                            <h3 class="m-3 text-danger">Please Add SMS Module To access this TAB</h3>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="pushNoti" role="tabpanel" aria-labelledby="der">
                            @if (View::exists('admin.onesignal.index') && Route::has('onesignal.update'))
                            @include('admin.onesignal.index')
                            @else
                            <h3 class="m-3 text-danger">Please Add one signal Module To access this TAB</h3>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="contactBasic" role="tabpanel"
                            aria-labelledby="contact-basic-tab">

                            @if (View::exists('admin.paymentGateway.stripeIndex') && Route::has('stripe.update'))
                            @include('admin.paymentGateway.stripeIndex')
                            @else
                            <h3 class="m-3 text-danger">Please Add Stripe Module To access this TAB</h3>
                            @endif

                            @if (View::exists('admin.paymentGateway.paypalIndex') && Route::has('paypal.update'))
                            @include('admin.paymentGateway.paypalIndex')
                            @else
                            <h3 class="m-3 text-danger">Please Add PayPal Module To access this TAB</h3>
                            @endif

                            @if (View::exists('admin.paymentGateway.razorIndex') && Route::has('razor.update'))
                            @include('admin.paymentGateway.razorIndex')
                            @else
                            <h3 class="m-3 text-danger">Please Add PayPal Module To access this TAB</h3>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> {{-- end of breadcrumb --}}
</div>
@endsection