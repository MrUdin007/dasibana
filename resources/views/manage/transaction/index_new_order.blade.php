@extends('layouts.be.be')

@push('css')

@endpush

@section('content')
	<div id='mainContent'>
		<div class="container-fluid">
            <div class="grid_layouts --two-auto">
                <div class="head-lst">
                    <h5 class="page-title">
                        New Order
                    </h5>
                </div>
                <div class="mn-rght">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li class="active">
                            <a href="{{ route('be.transaction.new') }}">
                                New Order
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
							<h3 class="page-title">New Order</h3>
						</div>
					</div>
					<table id="DataTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Trans Code</th>
                            <th>Date</th>
                            <th>Diskon</th>
                            <th>Shiiping Fee</th>
                            <th>Total</th>
                            <th>Payment Status</th>
                            <th>Trans Status</th>
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
        let dataTable;
        let payment_state = JSON.parse('{!! $payment_status !!}');
        let trans_state = JSON.parse('{!! $trans_status !!}');

        (function($) {
            'use strict';
            $(document).ready(function() {
                dataTable = $('#DataTable').DataTable({
                    responsive: true,
                    scrollX: true,
                    DisplayLength: 50,
                    processing: true,
                    serverSide: true,
                    deferRender : true,
                    stateSave: true,
                    language: {
                        search: '<i class="fas fa-search" aria-hidden="true"></i>',
                        searchPlaceholder: 'Search Order'
                    },
                    ajax: {
                        url: "{{ $api_url.'transaction/table' }}",
                        type: "post",
                        dataType: "json",
                		data: {
		                    _token: "{{csrf_token()}}",
                            new: true,
                            api_token: "{{ auth()->user()->api_token }}"
                        }
                    },
                    columnDefs: [{
                        searchable: false,
                        orderable: false,
                        targets: 0
                    }],
                    order:[[2,'asc']],
                    columns: [
                        { data: "DT_RowIndex", "width": "3%" },
                        { data: "transaction_code" },
                        { data: "created_at" },
                        { data: "diskon"},
                        { data: "shipping_fee"},
                        { data: "grandtotal"},
                        { data: "payment_status",
                            render : function(data, type, row) {
                                if (data == 1) {
                                    return "Unpaid";
                                } else if (data == 2) {
                                    return "Paid";
                                }
                            },
                        },
                        { data: "transaction_status",
                            render : function(data, type, row) {
                                if (data == 1) {
                                    return "New";
                                } else if (data == 2) {
                                    return "Process";
                                } else if (data == 3) {
                                    return "Shipped";
                                } else if (data == 4) {
                                    return "Complete";
                                } else if (data == 5) {
                                    return "Void";
                                }
                            },
                        },
                        {
                            orderable: false,
                            className: 'text-center',
                            render: function (data, type, row) {
                                return '<button class="btn cur-p btn-secondary"> <a title="Lihat" class="product-detail" href="javascript:void(0);" onclick="goTo('+row.id+')" aria-pressed="false">View</a></button>';
                            }
                        },
                    ],
                });
            });
        })(jQuery);

        function goTo(id){
           location.href = "{{route('be.transaction.view',['id'=>''])}}"+id;
        }

        function datatable_reload() {
            dataTable.ajax.reload();
        }

        $(document).on('click', '.transaction-post-detail', function(){
            let id = $(this).data('id');

            $('#modalBlogPost').modal();

            $.ajax({
                url : '{{ $api_url."transaction/post/detail/" }}'+id,
                method : 'post',
                data: {
                    _token: "{{csrf_token()}}"
                },
                beforeSend: function (xhr) {
                },
                success : function (response) {
                    $('#modalBlogPost .modal-body').empty();
                    if (response.modal) {
                        $('#modalBlogPost .modal-body').html(response.modal);
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
                        url : '{{ $api_url."transaction/post/delete" }}',
                        method : 'post',
                        data : {
                            token: "{{ csrf_token() }}",
                            id
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

    </script>
@endpush
