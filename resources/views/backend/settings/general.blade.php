@extends('layouts.backend.app')

@push('css')

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
                        <li class="breadcrumb-item active" aria-current="page">Update General Settings</li>
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

            <form method="POST" action="{{route('settings.general.update') }}" autocomplete="off" enctype="multipart/form-data">
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
                                    <label for="site_title">Site Title <code>{ key: site_title }</code></label>
                                    <input id="name" type="name" class="form-control @error('site_title') is-invalid @enderror" name="site_title" placeholder="Enter Your Site Title" value="{{ setting('site_title') ?? old('site_title') }}">

                                    @error('site_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="site_description">Site Description <code>{ key: site_description }</code></label>
                                    <textarea name="site_description" id="site_description"
                                              class="form-control @error('site_description') is-invalid @enderror">{{ setting('site_description') ?? old('site_description') }}</textarea>
                                    @error('site_description')
                                    <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="site_address">Site Address <code>{ key: site_address }</code></label>
                                    <textarea name="site_address" id="site_address"
                                              class="form-control @error('site_address') is-invalid @enderror">{{ setting('site_address') ?? old('site_address') }}</textarea>
                                    @error('site_address')
                                    <span class="invalid-feedback" role="alert">
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

@endpush




