@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Earning",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Earning List'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Earning List') }}</h3>
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
                    <table id="dataTable" class="table table-flush" >
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>{{__('Owner Name')}}</th>
                                <th>{{__('Total Task')}}</th>
                                <th>{{__('Total')}}</th>
                                <th>{{__('Owner Share')}}</th>
                                <th>{{__('Admin Share')}}</th>
                                <th>{{__('Balance')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($earingD as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    {{-- 
                                    <a href="{{ route('serviceProvider.show', ['id'=>$item->provider->id]) }}">
                                        {{$item->provider->name}}
                                    </a> --}}

                                    {{$item['owner']['name'] ?? ''}}

                                </td>
                                <td>
                                    {{$item->d_total_task}}
                                </td>
                                <td>
                                    {{$item->d_total_amount}}
                                </td>
                                <td>
                                    {{$item->d_owner_share}}
                                </td>
                                <td>
                                    {{$item->d_admin_share}}
                                </td>
                                <td>
                                    @if ($item->d_balance >= 0)
                                    <p class="text-success">{{ $item->d_balance}} </p>
                                    @else
                                    <p class="text-danger">{{ $item->d_balance}} </p>
                                    @endif

                                </td>
                                <td class="d-flex">
                                    @can('earning_show')

                                    <form action="{{ route('earning.show') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="owner_id" value="{{$item->owner->id}}">
                                        <button class="btn btn-sm btn-outline-info  m-1" type="submit">
                                            View
                                        </button>
                                    </form>
                                    @endcan
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection