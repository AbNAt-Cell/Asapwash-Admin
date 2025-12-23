@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Owner Shop",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Owner Shop List'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Owner Shop') }}</h3>
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
                <div class="table-responsive py-4">
                    <table id="dataTable" class="table table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Phone No')}}</th>
                                <th>{{__('Address')}}</th>
                                <th>{{__('Timing')}}</th>
                                <th>{{__('Rating')}}</th>
                                <th>{{__('Image')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shop as $ss)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $ss->name}}
                                    @if ($ss->is_best)

                                    <a href="#" class="badge badge-danger m-2 p-2">BEST</a>
                                    @endif
                                    @if ($ss->is_popular)

                                    <a href="#" class="badge badge-info m-2 p-2">POPULAR</a>
                                    @endif
                                </td>

                                <td><a href="tel:{{$ss->phone_no}}">{{$ss->phone_no}}</a></td>
                                <td>{{$ss->address}}</td>
                                <td>{{$ss->start_time .' to '. $ss->end_time}}</td>
                                <td>
                                    @for ($i =1 ; $i <= 5; $i++) <i
                                        class="fas fa-star {{ $i<= $ss->avg_rating ? 'active-star' : ''}}"></i>
                                        @endfor</td>
                                <td>
                                    <img class="mt-2 img-fluid" src="{{ asset('upload') .'/'.$ss->image}}" alt=""
                                        height="50" width="50">
                                </td>
                                <td>
                                    @if ($ss->status)
                                    <span class="badge  badge-success m-1">{{__('Active')}}</span>
                                    @else
                                    <span class="badge  badge-warning  m-1">{{__('Block')}}</span>

                                    @endif
                                </td>
                                <td class="d-flex">



                                    @can('appuser_edit')
                                    <a href="{{ route('shopowner.detail', ['id'=>$ss->id]) }}"
                                        class="btn btn-primary btn-sm btn-outline-primary m-1"> View</a>
                                    <form action="{{ route('shopowner.popularChange', $ss) }}" method="post">
                                        @csrf

                                        <button type="button"
                                            class="btn btn-sm btn-outline-{{$ss->is_popular ?'danger' :'info'}} btn-icon m-1"
                                            onclick="confirm('{{ __("Are you sure you want to change status of this Shop?") }}') ? this.parentElement.submit() : ''">
                                            <span class="ul-btn__icon">
                                                @if ($ss->is_popular)
                                                UnPopular
                                                @else
                                                Popular
                                                @endif
                                            </span>
                                        </button>
                                    </form>
                                    <form action="{{ route('shopowner.bestChange', $ss) }}" method="post">
                                        @csrf

                                        <button type="button"
                                            class="btn btn-sm btn-outline-{{$ss->is_best ?'danger' :'primary'}} btn-icon m-1"
                                            onclick="confirm('{{ __("Are you sure you want to change status of this Shop?") }}') ? this.parentElement.submit() : ''">
                                            <span class="ul-btn__icon">
                                                @if ($ss->is_best)
                                                Remove From Best
                                                @else
                                                Best
                                                @endif
                                            </span>
                                        </button>
                                    </form>
                                    @endcan

                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection