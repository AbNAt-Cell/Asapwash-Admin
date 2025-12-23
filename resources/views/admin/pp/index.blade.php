@extends('layouts.app')

@section('content')
    @include('layouts.headers.header', [
        'class' => 'info',
        'title' => 'Privacy Policy',
        'description' => '',
        'icon' => 'fas fa-home',
        'breadcrumb' => [
            [
                'text' => 'Privacy Policy',
            ],
        ],
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header mb-3">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Privacy Policy') }}</h3>
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

                    <div class="col-md-12 mb-4">
                        <form action="{{ route('pp.update') }}" method="POST">
                            @csrf
                            <div class="card text-left">
                                <div class="card-header bg-transparent">
                                    <div class="row">
                                        <div class="col-6">
                                            <h3 class="card-title">
                                                {{ __('Privacy and Policy (for frontend app modules)') }}</h3>
                                            <p class="text-danger font-weight-500">
                                                {{ __('Please toggle off the Code-View to compile the html for preview') }}
                                            </p>
                                        </div>
                                        @can('privacy_edit')
                                            <div class="col-6 text-right mt-2 pr-0">
                                                <button type="submit" class="btn  btn-primary ">{{ __('Save') }}</button>

                                            </div>
                                        @endcan
                                    </div>
                                    <div>



                                    </div>
                                </div>
                                <div class="card-body row ">
                                    <div class=" col-md-8">
                                        <form method="post">
                                            <textarea id="editor1" name="pp">{{ $pp }}</textarea>
                                        </form>
                                    </div>
                                    <div class="col-md-4 border border-1 py-2">
                                        <p>{{__('Preview')}}</p>
                                        <div id="preview">
                                           {!! $pp !!} 
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
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

    <!-- Initialize CKEditor -->
    <script>
        CKEDITOR.replace('editor1', {
            removePlugins: 'image'
        });
         // Function to update the preview
         function updatePreview() {
            var editorData = CKEDITOR.instances.editor1.getData();
            document.getElementById('preview').innerHTML = editorData;
        }

        // Update the preview whenever there's a change in the editor
        CKEDITOR.instances.editor1.on('change', updatePreview);
    </script>
@endsection
@push('js')
@endpush
