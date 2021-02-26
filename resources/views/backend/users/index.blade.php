@extends('layouts.backend.app')

@push('css')
    <!--Data Tables -->
    <link href="{{asset('backend/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('backend/assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 float-left">
                            <i class="fa fa-table"></i> {{$pageTitle ? $pageTitle:''}}
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="dataTables_length" id="default-datatable_length">
                                <a href="{{route('admin.users.create')}}" class="btn btn-info" data-toggle="tooltip" title="Add Item">
                                    <i class="fa fa-plus-square"></i> Add new
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <div id="example_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example" class="table table-bordered dataTable" role="grid" aria-describedby="example_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc">#ID</th>
                                            <th class="sorting">Name</th>
                                            <th class="sorting">Email</th>
                                            <th class="sorting">Status</th>
                                            <th class="sorting">Joined At</th>
                                            <th class="sorting">Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($users as $key=>$user)
                                            <tr role="row">
                                                <td>{{$key+1}}</td>
                                                <td>
                                                    <div class="media align-items-center user-pointer collapsed" data-toggle="collapse" data-target="#user-dropdown">
                                                        <div class="avatar">
                                                            <img width="40" class="rounded-circle"
                                                                 src="{{ $user->getFirstMediaUrl('avatar') != null ? $user->getFirstMediaUrl('avatar') : config('app.placeholder').'160' }}" alt="User Avatar">
                                                        </div>
                                                        <div class="media-body" style="margin-left: 15%">
                                                            <h6 class="side-user-name" style="line-height: 0% !important;">{{ $user->name }}</h6>
                                                            <div class="widget-subheading">
                                                                @if ($user->role)
                                                                    <span class="badge badge-info">{{ $user->role->name }}</span>
                                                                @else
                                                                    <span class="badge badge-danger">No role found :(</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>{{$user->email}}</td>
                                                <td class="text-center">
                                                    @if($user->status == 'active')
                                                        <span class="badge badge-info">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>{{$user->created_at->diffForHumans()}}</td>
                                                <td class="text-center">
                                                    <a type="button" href="{{route('admin.users.show',$user->id)}}" class="btn btn-sm btn-success waves-effect waves-light m-1">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a type="button" href="{{route('admin.users.edit',$user->id)}}" class="btn btn-sm btn-info waves-effect waves-light m-1">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{ $user->id }})">
                                                            <i class="fa fa-trash-o"></i>
                                                        </button>
                                                        <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy',$user->id) }}" method="POST" style="display: none;">
                                                            @csrf()
                                                            @method('DELETE')
                                                        </form>
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
        </div>
    </div>
    @endsection

@push('js')
    <!--Data Tables js-->
    <script src="{{asset('backend/assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/bootstrap-datatable/js/jszip.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/bootstrap-datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/bootstrap-datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/bootstrap-datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/bootstrap-datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            //Default data table
            $('#default-datatable').DataTable();


            var table = $('#example').DataTable( {
                lengthChange: false,
                buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
            } );

            table.buttons().container()
                .appendTo( '#example_wrapper .col-md-6:eq(0)' );

        } );
    </script>
@endpush



