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
                                <button onclick="event.preventDefault();
                                   document.getElementById('new-backups').submit()" type="button" href="{{route('admin.users.create')}}" class="btn btn-info" data-toggle="tooltip" title="Add Item">
                                    <i class="fa fa-plus-square"></i> Create New Backup
                                </button>
                                <form id="new-backups" method="post" action="{{ route('admin.backups.store') }}" style="display: none">
                                    @csrf
                                </form>

                                <button onclick="event.preventDefault();
                          document.getElementById('clean-old-backups').submit();"
                                        class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-trash fa-w-20"></i>
                        </span>
                                    {{ __('Clean Old Backups') }}
                                </button>
                                <form id="clean-old-backups" action="{{ route('admin.backups.clean') }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
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
                                            <th class="sorting">Size</th>
                                            <th class="sorting">Created At</th>
                                            <th class="sorting">Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($backups as $key=>$backup)
                                            <tr>
                                                <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                                <td class="text-center">
                                                    <code>{{ $backup['file_name'] }}</code>
                                                </td>
                                                <td class="text-center">{{ $backup['file_size'] }}</td>
                                                <td class="text-center">{{ $backup['created_at'] }}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-info btn-sm" href="{{ route('admin.backups.download',$backup['file_name']) }}"><i
                                                            class="fa fa-download"></i>
                                                        <span>Download</span>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="deleteData({{ $key }})">
                                                        <i class="fa fa-trash"></i>
                                                        <span>Delete</span>
                                                    </button>
                                                    <form id="delete-form-{{ $key }}"
                                                          action="{{ route('admin.backups.destroy',$backup['file_name']) }}" method="POST"
                                                          style="display: none;">
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



