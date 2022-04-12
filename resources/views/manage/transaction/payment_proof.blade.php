@extends('layouts.be.be')

@push('css')

@endpush

@section('content')
	<div id='mainContent'>
		<div class="container-fluid">
            <div class="grid_layouts --two-auto">
                <div class="head-lst">
                    <h5 class="page-title">
                        Payment Proof
                    </h5>
                </div>
                <div class="mn-rght">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li class="active">
                            <a href="{{ route('be.payment_proof') }}">
                                Payment Proof
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
							<h3 class="page-title">Payment Proof</h3>
						</div>
					</div>
					<table id="DataTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Transaksi</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Bank</th>
                            <th>Rekening</th>
                            <th>Total</th>
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
    <div id="modalPayment" data-backdrop="static" data-keyboard="false" class="modal fade modal-pln" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        searchPlaceholder: 'Search Payment Proof'
                    },
                    ajax: {
                        url: "{{ $api_url.'payment/payment_proof' }}",
                        type: "post",
                        dataType: "json",
                		data: {
		                    _token: "{{ csrf_token() }}",
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
                        { data: "bukti_bayar",
                            render : function(data, type, row) {
                                return '<center> <img src="{{ env('APP_DOWNLOAD') }}'+data+'" class="img-responsive" style="width: 120px;"> </center>';
                            },
                            "width": "20%",
                            orderable: false,
                        },
                        { data: "nama_pengirim" },
                        { data: "bank" },
                        { data: "rekening_bukti_bayar", orderable: false, },
                        { data: "jumlah_transfer" },
                        {
                            orderable: false,
                            className: 'text-center',
                            "width": "20%",
                            render: function (data, type, row) {
                                return '<button class="btn cur-p btn-info"><a href="#" title="view" class="btn-pln --view payment-detail" data-id="'+row.id+'">View</a></button>'+
                                    '<button class="btn cur-p btn-success"><a class="btn-pln --delete" href="javascript:void(0)" onclick="acceptReject('+row.id+', 2, '+ row.id +');">Accept</a></button>'+
                                    '<button class="btn cur-p btn-danger"><a class="btn-pln --delete" href="javascript:void(0)" onclick="acceptReject('+row.id+', 1, '+ row.id +');">Reject</a></button>';
                            }
                        },
                    ],
                });
            });
        })(jQuery);

        function datatable_reload() {
            dataTable.ajax.reload();
        }

        $(document).on('click', '.payment-detail', function(){
            var id = $(this).data('id');
            $('#modalPayment').modal();
            console.log(id);
            $.ajax({
                url : '{{ $api_url."payment/payment_proof/detail/" }}'+id,
                method : 'post',
                beforeSend: function (xhr) {
                },
                data: {
                    _token: "{{ csrf_token() }}",
                    api_token: "{{ auth()->user()->api_token }}"
                },
                success : function (response) {
                    $('#modalPayment .modal-body').empty();
                    if (response.modal) {
                        $('#modalPayment .modal-body').append(response.modal);
                        $('#modalPayment .modal-body').removeClass('lazy');
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

        function acceptReject(id, data, transaction_id) {
            let status  = parseInt(data)
            let message = status === 2
                        ? "Status dari transaksi ini akan berubah menjadi 'Terbayar / Paid'."
                        : "Status dari transaksi ini akan tetap menjadi 'Belum terbayar / Unpaid'.";
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
                        url : '{{ $api_url."payment/payment_proof/update" }}',
                        method : 'post',
                        data : {
                            id,
                            status,
                            transaction_id,
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

    </script>
@endpush
