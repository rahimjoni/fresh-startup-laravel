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
                        <li class="breadcrumb-item active" aria-current="page">Update Mail Settings</li>
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

            <form method="POST" action="{{route('settings.mail.update') }}" enctype="multipart/form-data">
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
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="MAIL_MAILER">MAIL_MAILER <code>{ key: MAIL_MAILER }</code></label>
                                    <input id="MAIL_MAILER" type="name" class="form-control @error('MAIL_MAILER') is-invalid @enderror" name="MAIL_MAILER" placeholder="Enter Your MAIL_MAILER" value="{{ setting('MAIL_MAILER') ?? old('MAIL_MAILER') }}">

                                    @error('MAIL_MAILER')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="MAIL_HOST">MAIL_HOST <code>{ key: MAIL_HOST }</code></label>
                                    <input id="MAIL_HOST" type="name" class="form-control @error('MAIL_HOST') is-invalid @enderror" name="MAIL_HOST" placeholder="Enter Your MAIL_HOST" value="{{ setting('MAIL_HOST') ?? old('MAIL_HOST') }}">

                                    @error('MAIL_HOST')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="MAIL_PORT">MAIL_PORT <code>{ key: MAIL_PORT }</code></label>
                                    <input id="MAIL_PORT" type="name" class="form-control @error('MAIL_PORT') is-invalid @enderror" name="MAIL_PORT" placeholder="Enter Your MAIL_PORT" value="{{ setting('MAIL_PORT') ?? old('MAIL_PORT') }}">

                                    @error('MAIL_PORT')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="MAIL_USERNAME">MAIL_USERNAME <code>{ key: MAIL_USERNAME }</code></label>
                                    <input id="MAIL_USERNAME" type="name" class="form-control @error('MAIL_USERNAME') is-invalid @enderror" name="MAIL_USERNAME" placeholder="Enter Your MAIL_USERNAME" value="{{ setting('MAIL_USERNAME') ?? old('MAIL_USERNAME') }}">

                                    @error('MAIL_USERNAME')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="MAIL_PASSWORD">MAIL_PASSWORD <code>{ key: MAIL_PASSWORD }</code></label>
                                    <input id="MAIL_PASSWORD" type="password" class="form-control @error('MAIL_PASSWORD') is-invalid @enderror" name="MAIL_PASSWORD" placeholder="Enter Your MAIL_PASSWORD" value="{{ setting('MAIL_PASSWORD') ?? old('MAIL_PASSWORD') }}">

                                    @error('MAIL_PASSWORD')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="MAIL_ENCRYPTION">MAIL_USERNAME <code>{ key: MAIL_ENCRYPTION }</code></label>
                                    <input id="MAIL_ENCRYPTION" type="name" class="form-control @error('MAIL_ENCRYPTION') is-invalid @enderror" name="MAIL_ENCRYPTION" placeholder="Enter Your MAIL_ENCRYPTION" value="{{ setting('MAIL_ENCRYPTION') ?? old('MAIL_ENCRYPTION') }}">

                                    @error('MAIL_ENCRYPTION')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="MAIL_FROM_ADDRESS">MAIL_FROM_ADDRESS <code>{ key: MAIL_FROM_ADDRESS }</code></label>
                                    <input id="MAIL_FROM_ADDRESS" type="email" class="form-control @error('MAIL_FROM_ADDRESS') is-invalid @enderror" name="MAIL_FROM_ADDRESS" placeholder="Enter Your MAIL_FROM_ADDRESS" value="{{ setting('MAIL_FROM_ADDRESS') ?? old('MAIL_FROM_ADDRESS') }}">

                                    @error('MAIL_FROM_ADDRESS')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="MAIL_FROM_NAME">MAIL_FROM_NAME <code>{ key: MAIL_FROM_NAME }</code></label>
                                    <input id="MAIL_FROM_NAME" type="name" class="form-control @error('MAIL_FROM_NAME') is-invalid @enderror" name="MAIL_FROM_NAME" placeholder="Enter Your MAIL_FROM_NAME" value="{{ setting('MAIL_FROM_NAME') ?? old('MAIL_FROM_NAME') }}">

                                    @error('MAIL_FROM_NAME')
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




