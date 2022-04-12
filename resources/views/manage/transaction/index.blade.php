@extends('layouts.be.be')

@push('css')

@endpush

@section('content')
	<div id='mainContent'>
		<div class="container-fluid">
            <div class="grid_layouts --two-auto">
                <div class="head-lst">
                    <h5 class="page-title">
                        Transaction
                    </h5>
                </div>
                <div class="mn-rght">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li class="active">
                            <a href="{{ route('be.transaction') }}">
                                Transaction
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
							<h3 class="page-title">Transaction</h3>
						</div>
						<div class="mn-rght">
                            <button class="addbsnt --pluses">
                                <a href="{{ route('be.transaction.create') }}">
                                    <i class="ti-plus"></i>
                                </a>
                            </button>
                        </div>  
					</div>
					<table id="DataTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Trans Code</th>
                            <th>Date</th>
                            <th>Diskon</th>
                            <th>Shipping Fee</th>
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
    
    <!-- Modal View -->
    <div id="modalPaymentConfirmation" data-backdrop="static" data-keyboard="false" class="modal fade modal-pln" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">
                        Payment Confirmation
                    </h4> 
                </div>
                <div class="modal-body lazy pt-0 pb-0">
                    <div class="row" id="paymentConf">
                        <div class="col-md-12">
                            <label><b>Tanggal Bayar</b></label>
                            <div id="tanggal_bayar"></div>
                        </div>
                        <div class="col-md-12">
                            <label><b>Metode Pembayaran</b></label>
                            <div id="metode_pembayaran"></div>
                        </div>
                        <div class="col-md-12">
                            <label><b>No Rekening</b></label>
                            <div id="no_rekening"></div>
                        </div>
                        <div class="col-md-12">
                            <label><b>Bank Rekening</b></label>
                            <div id="bank_rekening"></div>
                        </div>
                        <div class="col-md-12">
                            <label><b>Atas Nama Rekening</b></label>
                            <div id="atas_nama_rekening"></div>
                        </div>
                        <div class="col-md-12">
                            <label><b>Bukti Bayar</b></label>
                            <div id="bukti_bayar"><img src=""></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                 <!--    <button class="btn btn-success" type="button">Accept</button>
                    <button class="btn btn-danger" type="button">Reject</button> -->
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
                        searchPlaceholder: 'Search Transaction'
                    },
                    ajax: {
                        url: "{{ $api_url.'transaction/table' }}",
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
                    order:[[2,'asc']],
                    columns: [
                        { data: "DT_RowIndex", "width": "3%",className:"text-center" },
                        { data: "transaction_code" ,className:"text-center"},
                        { data: "transaction_date" ,className:"text-center"},
                        { data: "diskon",className:"text-right"},
                        { data: "shipping_fee",className:"text-right"},
                        { data: "grandtotal",className:"text-right"},
                        { data: "payment_status",
                            render : function(data, type, row) {
                                
                                var select = $("<select class='select form-control' onchange='stateChangePayment(this,"+row.id+")'></select>", {
                                    "id": row.id,
                                    "value": data
                                });

                                $.each(payment_state, function(key, value){
                                    var option = $("<option></option>", {
                                        "text": value,
                                        "value": key
                                    });

                                    if(parseInt(row.payment_status) === parseInt(key)){

                                        option.attr("selected", "selected")
                                    }

                                    select.append(option);
                                });

                                return select.prop("outerHTML");
                                }
                        },
                        { data: "transaction_status",
                          className:'text-center',
                            render : function(data, type, row) {
                               if(row.transaction_status == 5){
                                    return "Void";
                               }else{
                                    var select = $("<select class='select form-control' onchange='stateChangeTransaction(this,"+row.id+")'></select>", {
                                        "id": row.id,
                                        "value": data
                                    });

                                    $.each(trans_state, function(key, value){
                                        var option = $("<option></option>", {
                                            "text": value,
                                            "value": key
                                        });
                                        console.log(row.transaction_status);
                                        if(parseInt(row.transaction_status) === parseInt(key)){
                                            option.attr("selected", "selected")
                                        }

                                        select.append(option);
                                    });

                                    return select.prop("outerHTML");
                                    }
                               }
                                
                        },
                        {
                            orderable: false,
                            className: 'text-center',
                            render: function (data, type, row) {
                                return '<button class="btn cur-p btn-secondary"> <a title="Lihat" class="product-detail" href="{{route("be.transaction.view",["id"=>""])}}'+row.id+'" aria-pressed="false">View</a></button>'
                                      +'<button class="btn cur-p btn-primary"><a title="Edit" class="product-detail" href="{{route("be.transaction.edit",["id"=>""])}}'+row.id+'" aria-pressed="false">Edit</a></button>'
                                      +'<button class="btn cur-p btn-success"><a title="Pay" onclick="openModal('+row.id+')" class="product-detail" href="javascript:void(0);" aria-pressed="false">Pay</a></button>';

                            }
                        },
                    ],
                });
            });
        })(jQuery);

        function datatable_reload() {
            dataTable.ajax.reload();
        }

        function stateChangePayment(e, id) {
            let status = $(e).val();

            $.ajax({
                type: 'POST',
                data: {
                    id : id,
                    payment_status : status,
                    token: "{{ csrf_token() }}",
                    api_token: "{{ auth()->user()->api_token }}"
                },
                dataType: "json",
                url: '{{ $api_url."transaction/payment_status" }}',
                success: function(data){
                    if (data.success) {
                        swal({
                            title: "Sukses",
                            text: "Sukses Mengganti Status Pembayaran",
                            type: "success",
                        });
                    }
                },
                error: function(data){
                    console.log(data);
                }
            });
        }

        function stateChangeTransaction(e, id) {
            let status = $(e).val();

            $.ajax({
                type: 'POST',
                data: {
                    id : id,
                    transaction_status : status,
                    token: "{{ csrf_token() }}",
                    api_token: "{{ auth()->user()->api_token }}"
                },
                dataType: "json",
                url: '{{ $api_url."transaction/transaction_status" }}',
                success: function(data){
                    if (data.success) {
                        swal({
                                title: "Sukses",
                                text: "Sukses Mengganti Status Transaksi",
                                type: "success",
                            });
                        datatable_reload();
                       
                    }
                },
                error: function(data){
                    console.log(data);
                }
            });
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
                            id:id,
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

        function openModal(id){
             $.ajax({
                type:'post',
                url :'{{ $api_url."transaction/edit" }}' ,
                data: {
                    _token: '{{ csrf_token() }}',
                    api_token: "{{ auth()->user()->api_token }}",
                    id:id
                },
                dataType:"json",
                beforeSend: function () {
                   swal({
                        title: "Please wait",
                        text: "Your request is being processed",
                        showConfirmButton: false,
                    });
                   
                },
                success: function (response) {
                    swal.close();
                    console.log(response);

                    $('#tanggal_bayar').text(response.data.tgl_bukti_bayar);
                    $('#metode_pembayaran').text(response.data.payment_method);
                    $('#bank_rekening').text(response.data.namabank);
                    $('#no_rekening').text(response.data.norekening);
                    $('#atas_nama_rekening').text(response.data.atasnama);

                }
            });
            $('#modalPaymentConfirmation').modal('show');
        }

    </script>
@endpush
