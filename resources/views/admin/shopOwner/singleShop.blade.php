@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"Shop Owner",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'Shop Owner List'
])))
<style>
    .avatar img {
        height: 100%;
    }
</style>
<div class="container-fluid mt--7">
    <div class="row">




        <div class="col-xl-4 ">
            <div class="card card-profile">
                <img src="{{ asset('upload') .'/'.$data->image}}" alt="Image placeholder" class="card-img-top">

                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    <div class="d-flex justify-content-between">

                        @if ($data->is_best)

                        <a href="#" class="badge badge-danger m-2 p-2">BEST</a>
                        @endif
                        @if ($data->is_popular)

                        <a href="#" class="badge badge-info m-2 p-2">POPULAR</a>
                        @endif
                    </div>
                </div>
                <div class="card-body pt-0">

                    <div class="text-center">
                        <h5 class="h3">
                            {{ $data->name}}<span class="font-weight-light"></span>
                        </h5>
                        <div class="h5 font-weight-300">
                            <i class="fas fa-street-view mr-2"></i>{{ $data->address}}
                        </div>
                        <div class="h5 mt-4">
                            <i class="far fa-clock mr-2"></i> {{ $data->start_time .' to '. $data->end_time}}
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="col-xl-4 ">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <!-- Title -->
                    <h5 class="h3 mb-0">Employee</h5>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- List group -->
                    <ul class="list-group list-group-flush list my--3">
                        @foreach ($data['employeeData'] as $item)

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <!-- Avatar -->
                                    <a href="#" class="avatar rounded-circle">
                                        <img alt="Image placeholder" src="{{ asset('upload') .'/'.$item->image}}">
                                    </a>
                                </div>
                                <div class="col ml--2">
                                    <h4 class="mb-0">
                                        <a href="#!">{{$item->name}}</a>

                                    </h4>
                                    <small class="text-muted">{{$item->email}}</small><br>
                                    <small class="text-muted">{{ $item->start_time .' to '. $item->end_time}}</small>


                                </div>
                                <div class="col-auto"><span
                                        class="text-{{$item->online ? 'success' : 'danger'}}">●</span>
                                    <small>{{$item->online ? 'Online' : 'Offline'}}</small></div>

                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Checklist -->


        </div>
        <div class="col-xl-4">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <!-- Title -->
                    <h5 class="h3 mb-0">Services</h5>
                </div>
                <!-- Card body -->
                <div class="card-body p-0">
                    <!-- List group -->
                    <ul class="list-group list-group-flush" data-toggle="checklist">
                        @foreach ($data['serviceData'] as $item)
                        <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
                            <div
                                class="checklist-item checklist-item-success checklist-item-checked d-flex justify-content-between">
                                <div class="checklist-info">
                                    <h5 class="checklist-title mb-0">{{$item->name}}</h5>
                                    <small>{{$item->duration}} min</small>
                                    <br>
                                    <small>{{$item->description}}</small>
                                </div>
                                <div class="text-primary">
                                    ${{$item->price}}
                                </div>
                            </div>

                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header border-0">
                            <h3 class="mb-0">booking`s</h3>
                        </div>
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Employee</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->bookings as $booking)

                                    <tr>
                                        <td>{{$booking->booking_id}}</td>
                                        <td>{{$booking->user->name}}</td>
                                        <td>{{$booking['employee']['name'] ?? ''}}</td>
                                        <td>{{$booking->currency}}{{$booking->amount}}</td>
                                        <td>{{$booking->start_time}}</td>
                                        <td>
                                            @if ($booking->status == '0')
                                            <a href="#" class="btn btn-sm btn-warning float-right">Waiting</a>
                                            @elseif($booking->status == '1')
                                            <a href="#" class="btn btn-sm btn-default float-right">Approved</a>
                                            @elseif($booking->status == '2')
                                            <a href="#" class="btn btn-sm btn-info float-right">Complete</a>
                                            @elseif($booking->status == '3')
                                            <a href="#" class="btn btn-sm btn-danger float-right">Cancel</a>
                                            @elseif($booking->status == '5')
                                            <a href="#" class="btn btn-sm btn-primary float-right">Rejected</a>

                                            @endif


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
    </div>
    <div class="row my-3">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <div class="card my-3">
                        <!-- Card header -->
                        <div class="card-header border-0">
                            <h3 class="mb-0">Reviews</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($data['reviews'] as $item)
        <div class="col-4">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <a href="#">
                            <img src="{{ asset('upload') .'/'.$item->user->image}}" class="avatar">
                        </a>
                        <div class="mx-3">
                            <a href="#" class="text-dark font-weight-600 text-sm">{{$item->user->name}}</a>
                            <small class="d-block text-muted">{{$item->created_at->diffForHumans()}}</small>

                        </div>

                    </div>
                    <div class="text-right ml-auto">
                        @for ($i =1 ; $i <= 5; $i++) <i class="fas fa-star {{ $i<= $item->star ? 'active-star' : ''}}">
                            </i>
                            @endfor</td>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
@endsection