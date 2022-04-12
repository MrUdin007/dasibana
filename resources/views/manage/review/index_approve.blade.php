@extends('layouts.be.be')

@push('css')
	
@endpush

@section('content')
	<div id='mainContent'>
		<div class="container-fluid">
            <div class="grid_layouts --two-auto">
                <div class="head-lst">
                    <h5 class="page-title">
                        Approve Review List
                    </h5>
                </div>
                <div class="mn-rght">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li class="active">
                            <a href="{{ route('be.review_approve') }}">
                                Approve Review List
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>

		<!-- Datatables -->
    	<!-- ============================================================== -->
		<div class="row gap-20 pos-r">
			<div class="masonry-item col-md-12">
				<div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <div class="grid_layouts --two-auto">
                        <div class="head-lst">
                            <h3 class="page-title">Approve Review List</h3>
                        </div>
                    </div>
					<table id="ReviewAcceptDataTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Review</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
				</div>
			</div>
		</div>

	</div>

    <!-- Modal View -->
    <div id="modalReview" data-backdrop="static" data-keyboard="false" class="modal fade modal-pln" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">
                        Review Detail
                    </h4> 
                </div>
                <div class="modal-body lazy pt-0 pb-0">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-pln --view" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- End of Modal View -->
@endsection

@push('scripts')
	<script type="text/javascript">
        var dataTable;

        (function($) {
            'use strict';
            $(document).ready(function() {
                dataTable = $('#ReviewAcceptDataTable').DataTable({
                    responsive: true,
                    scrollX: true,
                    DisplayLength: 50,
                    processing: true,
                    serverSide: true,
                    deferRender : true,
                    stateSave: true,
                    language: {
                        search: '<i class="fas fa-search" aria-hidden="true"></i>',
                        searchPlaceholder: 'Search Review'
                    },
                    ajax: {
                        url: "{{ $api_url.'review/table' }}",
                        type: "post",
                        dataType: "json",
                		data: {
                            accept: 'yes',
		                    _token: "{{csrf_token()}}" ,
                            api_token: "{{ auth()->user()->api_token }}"
                        }

                    },
                    columnDefs: [{
                        searchable: false,
                        orderable: false,
                        targets: 0
                    }],
                    order:[[1,'asc']],
                    columns: [
                        { data: "DT_RowIndex" },
                        { data: "customer" },
                        { data: "product" },
                        { data: "comment" },
                        { data: "status" },
                        {
                            orderable: false,
                            className: 'text-center',
                            render: function (data, type, row) {
                                return '<button class="btn cur-p btn-info"><a href="#" title="view" class="btn-pln --view review-detail" data-id="'+row.id+'">View</a></button>'+'<button class="btn cur-p btn-success"><a class="btn-pln --delete" href="javascript:void(0)" onclick="acceptReject('+row.id+', 1);">Accept</a></button>'+
                                    '<button class="btn cur-p btn-danger"><a class="btn-pln --delete" href="javascript:void(0)" onclick="acceptReject('+row.id+', 2);">Reject</a></button>';
                            }
                        },
                    ],
                });
            });
        })(jQuery);

        $(document).on('click', '.review-detail', function(){
            var id = $(this).data('id');
            $('#modalReview').modal();
            console.log(id);
            $.ajax({
                url : '{{ $api_url."review/detail/" }}'+id,
                method : 'post',
                beforeSend: function (xhr) {
                },
                success : function (response) {
                    $('#modalReview .modal-body').empty();
                    if (response.modal) {
                        $('#modalReview .modal-body').append(response.modal);
                        $('#modalReview .modal-body').removeClass('lazy'); 
                    }
                },
                error : function (xhr) {
                    if (xhr.status == 401) {
                        swal({
                            type: "error",
                            title: "Your login status in invalid!",
                            text: "Please do login again.",
                        }, function (isConfirm) {
                            $('#formLogout').submit();
                        });
                    }
                }
            });
        });

        function acceptReject(id, status) {
            var id = id;
            var status = status;
            console.log(id);
            $.ajax({
                url : '{{ $api_url."review/save" }}',
                method : 'post',
                data : {
                    id : id,
                    status : status,
                    api_token: "{{ auth()->user()->api_token }}"
                },
                beforeSend: function (xhr) {
                },
                success : function (response) {
                    dataTable.ajax.reload();
                    swal({
                        title: response.title,
                        text: response.desc,
                        type: response.type,
                    });
                },
                error : function (xhr) {
                    if (xhr.status == 401) {
                        swal({
                            type: "error",
                            title: "Your login status in invalid!",
                            text: "Please do login again.",
                        }, function (isConfirm) {
                            $('#formLogout').submit();
                        });
                    }
                }
            });
        }

        function deleteRow(id) {
            swal({
                title: "Apakah Anda yakin",
                text: "Anda tidak dapat memulihkan data ini",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, hapus data",
                cancelButtonText: "Batalkan",
                closeOnConfirm: false
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url : '{{ $api_url."review/delete" }}',
                        method : 'post',
                        data : {
                            id : id,
                            api_token: "{{ auth()->user()->api_token }}"
                        },
                        success : function (response) {
                            dataTable.ajax.reload();
                            swal({
                                title: response.title,
                                text: response.desc,
                                type: response.type,
                            });
                        }
                    });
                }
            });
        }

        function datatable_reload() {
            // Reload datatable
            dataTable.ajax.reload();
        }
    </script>
@endpush