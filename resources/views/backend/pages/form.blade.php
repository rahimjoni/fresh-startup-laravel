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
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Pages</li>
                    </ol>
                </div>
                <div class="col-md-3 text-right">
                    <div class="dataTables_length" id="default-datatable_length">
                        <a href="{{route('admin.pages.index')}}" class="btn btn-info" data-toggle="tooltip" title="Back to List">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Breadcrumb-->
            <form method="POST" action="{{ isset($page)? route('admin.pages.update',$page->id) : route('admin.pages.store') }}" enctype="multipart/form-data">
                @csrf
                @isset($page)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">Page Info</div>
                                <hr>
                                <div class="form-group">
                                    <label for="title">{{ __('Title') }}</label>
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter Title" value="{{ $page->title ?? old('title') }}">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="excerpt">{{ __('Excerpt') }}</label>
                                    <textarea type="text" class="form-control @error('excerpt') is-invalid @enderror" id="summernoteEditor" name="excerpt">{{ $page->title ?? old('excerpt') }}</textarea>
                                    @error('excerpt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="body">{{ __('Description') }}</label>
                                    <textarea type="text" class="form-control @error('body') is-invalid @enderror" id="summernoteEditorBody" name="body">{{ $page->meta_description ?? old('body') }}</textarea>
                                    @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        @isset($page)
                                            <button type="submit" class="btn btn-success px-4 ">Update</button>
                                        @else
                                            <button type="submit" class="btn btn-success px-4 ">Save</button>
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">Select Image</div>
                                <hr>

                                <div class="form-group">
                                    <label for="image">{{ __('Feature Image') }}</label>
                                    <input id="image" type="file" class="form-control dropify @error('image') is-invalid @enderror"  name="image" data-default-file="{{ isset($page) ? $page->getFirstMediaUrl('image'):'' }}">

                                    @error('image')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="body">{{ __('Meta Description') }}</label>
                                    <textarea type="text" class="form-control @error('body') is-invalid @enderror" id="summernoteEditorMeta" name="meta_description">{{ $page->meta_description ?? old('meta_description') }}</textarea>
                                    @error('meta_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="body">{{ __('Meta Keyword') }}</label>
                                    <textarea type="text" class="form-control @error('body') is-invalid @enderror" id="summernoteEditorKeyword" name="meta_keyword">{{ $page->meta_keyword ?? old('meta_keyword') }}</textarea>
                                    @error('meta_keyword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status">{{ __('Status') }}</label>
                                    <select id="status" class="form-control @error('role') is-invalid @enderror"  name="status" value="{{ $page->status ?? old('status') }}">
                                        <option value="active" @isset($page) {{ $page->status == 'active' ? 'selected' : ''}} @endisset>Active</option>
                                        <option value="inactive" @isset($page) {{ $page->status == 'inactive' ? 'selected' : ''}} @endisset>Inactive</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
    <script>

    </script>
@endpush



