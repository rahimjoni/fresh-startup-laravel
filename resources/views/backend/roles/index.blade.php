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
                                <a href="{{route('admin.roles.create')}}" class="btn btn-info" data-toggle="tooltip" title="Add Item">
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
                                            <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">#ID</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Name</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Permission</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Updated At</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($roles as $key=>$role)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{$key+1}}</td>
                                                <td>{{$role->name}}</td>
                                                <td class="text-center">
                                                    @if($role->permissions->count() > 0)
                                                        <span class="badge badge-info">{{$role->permissions->count()}}</span>
                                                    @else
                                                        <span class="badge badge-danger">No Permission</span>
                                                    @endif
                                                </td>
                                                <td>{{$role->updated_at->diffForHumans()}}</td>
                                                <td class="text-center">
                                                    <a type="button" href="" class="btn btn-sm btn-info waves-effect waves-light m-1"> <i class="fa fa-edit"></i> </a>
                                                    <a title="Delete Item" type="button" class="btn btn-sm btn-danger waves-effect waves-light m-1"> <i class="fa fa-trash-o"></i> </a>
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



