@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Custom Notification",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Custom Notification List'
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
                            <h3 class="mb-0">{{ __('Custom Notification') }}</h3>
                        </div>

                    </div>
                </div>
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3 class="mb-0">{{ __('Available Tag') }}</h3>
                            <p class="mb-0 mt-0">{{__('click to copy.')}}</p>
                            <li class="list-group-item border-0">
                                <span class="badge badge-primary  r-badge text-18 copy text-lowercase" id="copy_1"
                                    onclick="copyToClipboard('copy_1')"
                                    >@{{user_name}}</span>
                          


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
                  <form method="POST" action="{{ route('custom.user') }}">
                        @csrf
                        <div class="row ">
                    
                            <div class="form-group col-12 ">
                                <label for="inputEmail4" class="ul-form__label">
                                    {{__('Notification Title')}}</label>
                                <input type="text" name="title" class="form-control  @error('title') invalid-input @enderror"
                                    placeholder="{{__('Please Enter Notification Title')}}" required min="1">
                                @error('title')
                                <div class="invalid-div">{{ $message }}</div>
                                @enderror
                    
                            </div>
                            <div class="form-group col-12 ">
                                <label for="inputEmail4" class="ul-form__label">
                                    {{__('Notification Subtitle')}}</label>
                                <input type="text" name="sub_title" class="form-control  @error('sub_title') invalid-input @enderror"
                                    placeholder="{{__('Please Enter Notification Subtitle')}}" required min="1">
                                @error('sub_title')
                                <div class="invalid-div">{{ $message }}</div>
                                @enderror
                            </div>
                    
                            <div class="form-group col-md-8">
                                <label for="inputEmail4" class="ul-form__label"> {{__('Users:')}}</label>
                                <select class="form-control" name="users[]" multiple="multiple" id="users">
                                    @foreach ($users as $user)
                    
                                    <option value="{{$user['id']}}">{{$user['name']}}</option>
                                    @endforeach
                    
                                </select>
                                @error('users')
                                <div class="invalid-div">{{ $message }}</div>
                                @enderror
                    
                            </div>
                            <div class="form-group col-md-4 mt-4" >
                                <button type="button" class="btn  btn-primary m-1"
                                    id="usersSelectAll">{{__('Select All')}}</button>
                                <button type="button" class="btn btn-secondary m-1"
                                    id="usersSelectDeAll">{{__('Deselect All')}}</button>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="mc-footer">
                                <div class="row">
                                    <div class="col-lg-12 text-right">
                                        <button type="submit" class="btn  btn-primary m-1">{{__('Submit')}}</button>
                                        <button type="reset"
                                            class=" btn  btn-secondary m-1">{{__('Reset')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection