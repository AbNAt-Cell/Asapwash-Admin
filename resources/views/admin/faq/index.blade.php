@extends('layouts.app')

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"FAQ",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'FAQ List'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('FAQ (for frontend app modules)') }}</h3>
                        </div>
                        @can('category_create')
                        <div class="col-4 text-right">
                            <a href="{{ route('faq.create') }}" class="btn btn-sm btn-primary">{{ __('Add FAQ') }}</a>
                        </div>
                        @endcan
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
                <div class="accordion" id="accordionRightIcon">
                    @foreach ($faq as $item)

                    <div class="card ul-card__v-space my-arrCard" >
                        <div class="card-header header-elements-inline">
                            <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0"
                                style="font-size: 20px">
                                <a data-toggle="collapse" class="text-default collapsed"
                                    href="#accordion-item-{{$item->id}}" aria-expanded="false">
                                    {{$loop->iteration}}) {{$item->question}}</a>
                            </h6>
                        </div>
                        <div id="accordion-item-{{$item->id}}" class="collapse" data-parent="#accordionRightIcon">
                            <div class="card-body">
                                {{$item->answer}} <br>
                                <div class="d-inline-flex">

                                    @can('faq_edit')
                                    <a class="btn btn-outline-info btn-icon m-1 btn-sm"
                                        href="{{ route('faq.edit', $item->id) }}">
                                        <span class="ul-btn__icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                    @endcan
                                    @can('faq_delete')
                                    <form action="{{ route('faq.destroy', $item) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-outline-danger btn-icon m-1 btn-sm"
                                            onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''">
                                            <span class="ul-btn__icon"><i class="far fa-trash-alt"></i></span>
                                        </button>
                                </div>
                                </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection