@extends('layouts.backend.app')

@push('css')

@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <!-- Breadcrumb-->
            <div class="row pt-2 pb-2">
                <div class="col-sm-9">
                    <h4 class="page-title">{{$pageTitle ? $pageTitle:''}}</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Role</li>
                    </ol>
                </div>
                <div class="col-md-3 text-right">
                    <div class="dataTables_length" id="default-datatable_length">
                        <a href="{{route('admin.roles.index')}}" class="btn btn-info" data-toggle="tooltip" title="Back to List">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Breadcrumb-->
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ isset($role)? route('admin.roles.update',$role->id) : route('admin.roles.store') }}" autocomplete="off">
                                @csrf
                                @isset($role)
                                    @method('PUT')
                                    @endisset
                                <div class="form-group row">
                                    <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-8">
                                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name ?? old('name') }}" autocomplete="name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <br><br>
                                <div class="text-center">
                                    <strong class=""> Manage Permission </strong><hr>

                                    @error('permissions')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div><br>


                                <div class="form-row">
                                    <div class="mb-3 ml-4">
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" class="custom-control-input" id="select-all">
                                            <label for="select-all" class="custom-control-label">Select All Permission</label>
                                        </div>
                                    </div>
                                </div>

                                @forelse($modules->chunk(3) as $key=>$chunks)

                                    <div class="form-row">
                                        @foreach($chunks as $key=>$module)

                                            <div class="col-lg-4">
                                                <div class="card">
                                                    <div class="card-header text-uppercase">{{$module->name}}</div>
                                                    <div class="card-body">
                                                        <div class="">
                                                            @foreach($module->permissions as $key=>$permission)
                                                                <div class="">
                                                                    <div class="custom-control custom-checkbox mb-2">
                                                                        <input type="checkbox" class="custom-control-input"
                                                                               id="permission-{{$permission->id}}"
                                                                               name="permissions[]"
                                                                               value="{{$permission->id}}"
                                                                               @isset($role)
                                                                                   @foreach($role->permissions as $rPermissions)
                                                                                       {{$permission->id == $rPermissions->id? 'checked': ''}}
                                                                                       @endforeach
                                                                                   @endisset
                                                                        >
                                                                        <label for="permission-{{$permission->id}}" class="custom-control-label">{{$permission->name}}</label>
                                                                    </div>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @empty
                                    <div class="text-center">
                                        <strong> No data found </strong>
                                    </div>
                                    @endforelse

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        @isset($role)
                                            <button type="submit" class="btn btn-success px-4 ">Update</button>
                                            @else
                                            <button type="submit" class="btn btn-success px-4 ">Save</button>
                                        @endisset
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
@push('js')
    <script>
        $('#select-all').click(function (event) {
            if(this.checked){
                $(':checkbox').each(function () {
                    this.checked=true;
                });
            }else{
                $(':checkbox').each(function () {
                    this.checked=false;
                });
            }
        })
    </script>
@endpush



