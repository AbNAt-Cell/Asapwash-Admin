@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Notification",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Notification'
])))
<style>
    .activeStar {
        color: goldenrod
    }
</style>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3 class="mb-0">{{ __('Notification') }}</h3>
                        </div>

                    </div>
                </div>
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3 class="mb-0">{{ __('Available Tag') }}</h3>
                            <p class="mb-0 mt-0">{{__('click to copy.')}}</p>
                            <li class="list-group-item border-0">
                                <span class="badge badge-primary  r-badge text-18 copy  text-lowercase" id="copy_1"
                                    onclick="copyToClipboard('copy_1')"
                                   >@{{user_name}}</span>
                                <span class="badge badge-dark r-badge text-18 copy  text-lowercase" id="copy_2"
                                    onclick="copyToClipboard('copy_2')">@{{shop_name}}
                                </span>
                                <span class="badge badge-primary r-badge text-18 copy text-lowercase" id="copy_3"
                                    onclick="copyToClipboard('copy_3')">@{{booking_date}}
                                </span>
                                <span class="badge badge-success r-badge text-18 copy text-lowercase" id="copy_4"
                                    onclick="copyToClipboard('copy_4')">@{{booking_id}}
                                </span>
                                <span class="badge badge-dark r-badge text-18 copy text-lowercase" id="copy_5"
                                    onclick="copyToClipboard('copy_5')">@{{employee_name}}
                                </span>
                                <span class="badge badge-info r-badge text-18 copy text-lowercase" id="copy_6"
                                    onclick="copyToClipboard('copy_6')">@{{user_address}}
                                </span>


                            </li>
                        </div>

                    </div>
                </div>

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
                <div class="card-body pb-0">
                    <ul class="nav nav-pills nav-fill flex-column flex-sm-row mb-4" id="myTab" role="tablist">
                        @foreach ($notis as $noti)

                        <li class="nav-item">
                            <a class="nav-link {{$loop->first ? 'active' : ''}}" id="home-basic-tab-{{ $noti->id}}"
                                data-toggle="tab" href="#noti-{{ $noti->id}}" role="tab" aria-controls="{{ $noti->id}}"
                                aria-selected="{{$loop->first ? 'true' : 'false'}}">{{ $noti->for_what}}</a>
                        </li>
                        @endforeach

                    </ul>
                    <div class="tab-content pb-0" id="myTabContent">
                        @foreach ($notis as $noti)

                        <div class="tab-pane fade {{$loop->first ? 'show active' : ''}}" id="noti-{{ $noti->id}}"
                            role="tabpanel" aria-labelledby="home-basic-tab-{{ $noti->id}}">
                            <form action="{{ route('notification.update',$noti->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row ">
                                    <div class="form-group col-12 ">
                                        <label for="inputEmail4" class="ul-form__label"> {{__('Title')}}</label>
                                        <input type="text" name="for_what"
                                            class="form-control  @error('for_what') invalid-input @enderror"
                                            placeholder="{{__('Please Enter Admin %')}}" required min="1"
                                            value="{{$noti->for_what}}">
                                        @error('for_what')
                                        <div class="invalid-div">{{ $message }}</div>
                                        @enderror

                                    </div>

                                    <div class="form-group col-12 ">
                                        <label for="inputEmail4" class="ul-form__label">
                                            {{__('Notification Title')}}</label>
                                        <input type="text" name="title"
                                            class="form-control  @error('title') invalid-input @enderror"
                                            placeholder="{{__('Please Enter Notification Title')}}" required min="1"
                                            value="{{$noti->title}}">
                                        @error('title')
                                        <div class="invalid-div">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="form-group col-12 ">
                                        <label for="inputEmail4" class="ul-form__label">
                                            {{__('Notification Subtitle')}}</label>
                                        <input type="text" name="sub_title"
                                            class="form-control  @error('sub_title') invalid-input @enderror"
                                            placeholder="{{__('Please Enter Notification Subtitle')}}" required min="1"
                                            value="{{$noti->sub_title}}">
                                        @error('sub_title')
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection