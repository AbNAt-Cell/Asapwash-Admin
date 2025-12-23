@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Vehicle Model",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Vehicle Model',
'text'=>'Edit User'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header ">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Edit Vehicle Model') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('vehicleModel.index') }}"
                                class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <form enctype="multipart/form-data" action="{{ route("vehicleModel.update", [$vehicleModel->id]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="validationDefault01">{{__('Name:')}}</label>
                                    <input type="text" name="name" value="{{ old('name',$vehicleModel->name) }}"
                                        class="form-control  @error('name') invalid-input @enderror"
                                        placeholder="{{__('Please Enter Name')}}" autofocus required>

                                    @error('name')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-control-label"
                                            for="validationDefault03">{{__('Vehicle Brand:')}}</label>
                                        <select class="js-example-basic form-control" name="brand_id">
                                            @foreach ($brand as $per)

                                            <option value="{{$per['id']}}" {{old('name',$vehicleModel->name) == $per['id'] ? 'selected' : ''}}>{{$per['name']}}</option>
                                            @endforeach

                                        </select>
                                        @error('brand')
                                        <div class="invalid-div">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>


                        </div>

                        <button class="btn btn-primary" type="submit">{{__('Submit')}}</button>
                    </form>
                </div>



            </div>
        </div>
    </div>
</div>
@endsection