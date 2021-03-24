@extends('layouts.backend.app')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 4px;
            height: 37px !important;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="container-fluid">
            <!-- Breadcrumb-->
            <div class="row pt-2 pb-2">
                <div class="col-sm-9">
                    <h4 class="page-title">{{$pageTitle ? $pageTitle:''}}</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Setting</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Settings</li>
                    </ol>
                </div>
                <div class="col-md-3 text-right">
                    <div class="dataTables_length" id="default-datatable_length">
                        <a href="{{route('admin.dashboard')}}" class="btn btn-info" data-toggle="tooltip" title="Back to List">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Breadcrumb-->

            <form method="POST" action="{{route('settings.appearance.update') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                @include('backend.settings.settingSidebar')
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">How To Use:</h5>
                                <p>You can get the value of each setting anywhere on your site by calling <code>setting('key')</code></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="site_logo">{{ __('Logo') }}</label>
                                    <input id="site_logo" type="file" class="form-control dropify @error('site_logo') is-invalid @enderror"  name="site_logo" data-default-file="{{ setting('site_logo') != null ?  \Illuminate\Support\Facades\Storage::url(setting('site_logo')) : '' }}">

                                    @error('site_logo')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="site_favicon">{{ __('Favicon Icon') }}</label>
                                    <input id="site_favicon" type="file" class="form-control dropify @error('site_favicon') is-invalid @enderror"  name="site_favicon" data-default-file="{{ setting('site_favicon') != null ?  \Illuminate\Support\Facades\Storage::url(setting('site_favicon')) : '' }}">

                                    @error('site_favicon')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success px-4">Update</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection


@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            $('.dropify').dropify();
        });
    </script>
@endpush




