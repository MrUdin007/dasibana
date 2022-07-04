@extends('layouts.be.app')

@push('title')
    <title>Dasibana - Admin</title>
@endpush

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@endpush

@section('content')
    <div class="row gap-20 pos-r">
        <div class="masonry-item col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <div class="grid_layouts --two-auto">
                    <div class="head-lst">
                        <h3 class="page-title text-uppercase">data Admin</h3>
                    </div>
                    <div class="mn-rght">
                        <button class="addbsnt --pluses">
                            <a href="http://127.0.0.2/vim-fe/public/manage/supplier/tambah">
                                <i class="ti-plus"></i>
                            </a>
                        </button>
                    </div>
                </div>

                <table id="adminTable" class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th width="5">No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th width="30px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDetail" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Admin</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <label for="nama_admin" class="col-sm-3 col-form-label">Nama</label>
                        <div id="nama_admin"></div>
                    </div>
                    <div class="input-group">
                        <label for="username_admin" class="col-sm-3 col-form-label">Username</label>
                        <div id="username"></div>
                    </div>
                    <div class="input-group">
                        <label for="email_admin" class="col-sm-3 col-form-label">Email</label>
                        <div id="email"></div>
                    </div>
                    <div class="input-group">
                        <label for="password_admin" class="col-sm-3 col-form-label">Password</label>
                        <div id="password_admin"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-customize" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script type="text/javascript">
        var dataTable;

        (function($) {
            'use strict';
            $(document).ready(function(){
                dataTable = $('#adminTable').DataTable({
                    responsive: true,
                    scrollX: true,
                    DisplayLength: 50,
                    processing: true,
                    serverSide: true,
                    deferRender : true,
                    stateSave: true,
                    language: {
                        search: '<i class="fas fa-search" aria-hidden="true"></i>',
                        searchPlaceholder: 'Search Voucher'
                    },
                    ajax: "{{ route('manage.admin') }}",
                    columnDefs: [{
                        searchable: false,
                        orderable: false,
                        targets: 0
                    }],
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'name', name: 'name'},
                        {data: 'username', name: 'username'},
                        {data: 'email', name: 'email'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                        {
                            orderable: false,
                            className: 'text-center',
                            render: function (data, type, row) {
                                return '<a title="Lihat" class="btn cur-p btn-secondary product-detail" data-id="' + row.id + '" href="javascript:void(0);" onclick=openDetail('+ row.id +') aria-pressed="false">View</a>'+
                                '<a class="btn cur-p btn-primary editForm" title="Ubah" href="{{ route("be.voucher.edit",["id"=>""]) }}' + row.id +'" aria-pressed="false" autocomplete="off">Edit</a>'+
                                '<a type="button" class="btn cur-p btn-danger" href="javascript:void(0)" onclick=deleteRow('+ row.id +')>Delete</a>';
                            }
                        },
                    ]
                });
            });
	    })(jQuery);
    </script>
@endpush
