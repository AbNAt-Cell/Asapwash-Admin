@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Categories",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Category',
'text'=>'New Category',
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header ">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('New Category Detail') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('categories.index') }}"
                                class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>


                <div class="card-body">

                  <form action="{{ route('faq.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-row ">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4" class="ul-form__label">{{__('Question:')}}</label>
                                <input type="text" name="question" class="form-control  @error('question') invalid-input @enderror"
                                    placeholder="{{__('Please Enter question')}}" autofocus required>
                
                                @error('question')
                                <div class="invalid-div">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4" class="ul-form__label"> {{__('Answer:')}}</label>
                                <textarea class="form-control  @error('question') invalid-input @enderror" name="answer" cols="10"
                                    rows="10" required placeholder="{{__('Please Enter answer')}}"></textarea>
                                @error('answer')
                                <div class="invalid-div">{{ $message }}</div>
                                @enderror
                
                            </div>
                
                        </div>
                
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="mc-footer">
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    <button type="submit" class="btn   btn-primary m-1">{{__('Submit')}}</button>
                                   
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