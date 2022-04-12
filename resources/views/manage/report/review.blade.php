@extends('layouts.be.be')

@push('css')

@endpush

@section('content')
	<div id='mainContent'>
		<div class="container-fluid">
            <div class="grid_layouts --two-auto">
                <div class="head-lst">
                    <h5 class="page-title">
                        Review Report
                    </h5>
                </div>
                <div class="mn-rght">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li class="active">
                            <a href="{{ route('be.report.review') }}">
                                Review Report
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
                            <h3 class="page-title">Review Report</h3>
                        </div>
                    </div>
					<table id="ReviewListDataTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Customer</th>
                            <th>Report Comment</th>
                            <th>Review</th>
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

@endsection

@push('scripts')
	<script type="text/javascript">
        var dataTable;

        (function($) {
            'use strict';
            $(document).ready(function() {
                dataTable = $('#ReviewListDataTable').DataTable({
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
                        url: "{{ $api_url.'report/review' }}",
                        type: "post",
                        dataType: "json",
                		data: {
		                    _token: "{{csrf_token()}}",
                            api_token: "{{ auth()->user()->api_token }}"
                        }
                    },
                    columnDefs: [{
                        searchable: false,
                        orderable: false,
                        targets: 0
                    }],
                    order:[[1, 'asc']],
                    columns: [
                        { data: "DT_RowIndex" },
                        { data: "customer.name" },
                        { data: "comment" },
                        { data: "review.comment" },
                        {
                            orderable: false,
                            className: 'text-center',
                            render: function (data, type, row) {
                                return '<button class="btn cur-p btn-danger"><a class="btn-pln --delete" href="javascript:void(0)" onclick="acceptReject('+ row.id +', 1, '+ row.review.id +');">Reject</a></button>\
                                    <button class="btn cur-p btn-success"><a class="btn-pln --delete" href="javascript:void(0)" onclick="acceptReject('+ row.id +', 2, '+ row.review.id +');">Accept</a></button>';
                            }
                        },
                    ],
                });
            });
        })(jQuery);

        $(document).on('click', '.review-report-detail', function(){
            var id = $(this).data('id');
            $('#modalReview').modal();
            console.log(id);
            $.ajax({
                url : '{{ $api_url."report/review/detail/" }}'+id,
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
                        url : '{{ $api_url."report/review/delete" }}',
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

        function acceptReject(id, data, review_id) {
            let status  = parseInt(data)
            let message = status === 2
                        ? "Status dari review yang dilaporkan akan berubah menjadi 'Banned / Rejected'."
                        : "Review yang dilaporkan akan tetap muncul pada halaman user.";
            swal({
                title: "Apakah Anda yakin?",
                text: message,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya",
                cancelButtonText: "Batalkan",
                closeOnConfirm: false
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url : '{{ $api_url."report/review/act" }}',
                        method : 'post',
                        data : {
                            id,
                            status,
                            review_id,
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
            });


        }

        function datatable_reload() {
            // Reload datatable
            dataTable.ajax.reload();
        }
    </script>
@endpush
