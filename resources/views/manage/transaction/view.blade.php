@extends('layouts.be.be')

@push('css')

@endpush

@section('content')
<div id='mainContent'>
	<div class="container-fluid">
        <div class="grid_layouts --two-auto">
            <div class="head-lst">
                <h5 class="page-title">
                     Transaction Detail View
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
                    <li>
                        <a href="javascript:void(0)">
                            View
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
						<h3 class="page-title">Transaction Detail View</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label><b>Transaction Code </b></label><br>
							<div id="transaction_code"></div>
						</div>
						<div class="form-group">
							<label><b>Customer Name</b></label><br>
							<div id="customer_name"></div>
						</div>
						<div class="form-group">
							<label><b>Customer Phone</b></label><br>
							<div id="customer_phone"></div>
						</div>
						<div class="form-group">
							<label><b>Customer Email</b></label><br>
							<div id="customer_email"></div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label><b>Delivery Name</b></label><br>
							<div id="delivery_name"></div>
						</div>
						<div class="form-group">
							<label><b>Delivery Address</b></label><br>
							<div id="delivery_address"></div>
						</div>
						<div class="form-group">
							<label><b>Delivery Postal Code</b></label><br>
							<div id="delivery_kodepos"></div>
						</div>
						<div class="form-group">
							<label><b>Delivery Phone</b></label><br>
							<div id="delivery_phone"></div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label><b>Total Transaksi</b></label><br>
							<div id="total_transaction"></div>
						</div>
						<div class="form-group">
							<label><b>Diskon</b></label><br>
							<div id="diskon"></div>
						</div>
						<div class="form-group">
							<label><b>Biaya Kirim</b></label><br>
							<div id="biaya_kirim"></div>
						</div>
                        <div class="form-group">
                            <label><b>Komisi Marketplace</b></label><br>
                            <div id="komisi"></div>
                        </div>
                        <div class="form-group">
                            <label><b>Biaya Admin</b></label><br>
                            <div id="bea_admin"></div>
                        </div>
                        <div class="form-group">
                            <label><b>Biaya Layanan</b></label><br>
                            <div id="bea_layanan"></div>
                        </div>
						<div class="form-group">
							<label><b>Grandtotal</b></label><br>
							<div id="grandtotal"></div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label><b>Payment Status</b></label><br>
							<div id="payment_status"></div>
						</div>
						<div class="form-group">
							<label><b>Kurir</b></label><br>
							<div id="kurir"></div>
						</div>
                        <div class="form-group">
                            <label><b>Layanan Kurir</b></label><br>
                            <div id="layanan_kurir"></div>
                        </div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
                        <hr>
                        <table id="pembelianDaftar" class="table table-striped table-bordered" cellspacing="0" width="auto">
                            <thead>
                                <tr>
                                    <th width="10">No</th>
                                    <th>Product</th>
                                    <th>Variant</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                        </table>
	                </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript"> 
    	var pembelian_table;
    	var counter = 1;
    	$(document).ready(function() {
    	    pembelian_table = $('#pembelianDaftar').DataTable({
                responsive: true,
                scrollX: true,
                language: {
                    search: '<i class="fas fa-search" aria-hidden="true"></i>',
                    searchPlaceholder: 'Search Order'
                },
                columns: [
                    { data:"no" },
                    { data:"item" },
                    { data:"variant" },
                    { data:"qty" },
                    {
                        data:"price",
                        className:'text-right',
                        render: function (data, type, row) {
                            return 'Rp '+format_number(parseInt(data));
                        }
                    },
                    {
                        data:"diskon",
                        className:'text-right',
                        render: function (data, type, row) {
                            return 'Rp '+format_number(parseInt(data));
                        }
                    },
                    {
                        data:"subtotal",
                        className:'text-right',
                        render: function (data, type, row) {
                            return 'Rp '+format_number(parseInt(data));
                        }
                    }
                ],
                rowCallback: function (row, data) {
                    if (!data.item_id) {
                        data.item_id = $(row).children().eq(1).data('item');
                    }

                    if (!data.detail_id) {
                        data.detail_id = $(row).children().eq(1).data('detail');
                    }

                    
                },
                initComplete: function (settings, json) {
                    setTimeout(function(){
                    
                    }, 500)
                }
            });
            getEditData();
        });
		function getEditData(){
         $.ajax({
                type:'post',
                url :'{{ $api_url."transaction/edit" }}' ,
                data: {
                    _token: '{{ csrf_token() }}',
                   id:'{{Request::get("id")}}',
                   api_token: "{{ auth()->user()->api_token }}"
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
                    $('#total_transaction').text(response.data.total_belanja);
                    $('#notes').text(response.data.notes);
                    $('#transaction_code').text(response.data.transaction_code);
                    $('#customer_name').text(response.data.customer.name);
                    $('#customer_email').text(response.data.customer.email);
                    $('#customer_phone').text(response.data.customer.phone);
                    $('#delivery_name').text(response.data.delivery_nama);
                    $('#delivery_address').text(response.data.delivery_alamat);
                    $('#delivery_kodepos').text(response.data.delivery_kodepos);
                    $('#delivery_phone').text(response.data.delivery_hp);
                    $('#diskon').text(response.data.diskon);
                    $('#biaya_kirim').text(response.data.shipping_fee);
                    $('#komisi').text(response.data.komisi);
                    $('#bea_admin').text(response.data.bea_admin);
                    $('#bea_layanan').text(response.data.bea_layanan);
                    $('#grandtotal').text(response.data.grandtotal);
                    $('#kurir').text(response.data.courier_id);
                    $('#layanan_kurir').text(response.data.shipping_type);
                   
                    var payment_status = '';
                    if(response.data.payment_status == '1'){
                    	payment_status = 'Unpaid';
                    }else{
                    	payment_status = 'Paid';
                    }

                    $('#payment_status').text(payment_status);

                    var transaction_status = '';
                    if(response.data.transaction_status == '1'){
                    	transaction_status = 'New';
                    }else if(response.data.transaction_status == '2'){
                    	transaction_status = 'Process';
                    }else if(response.data.transaction_status == '3'){
                    	transaction_status = 'Shipped';
                    }else if(response.data.transaction_status == '4'){
                    	transaction_status = 'Complete';
                    }else{
                    	transaction_status = 'Void';
                    }

                    $('#transaction_status').text(transaction_status);

                    var subtotals = 0;
                    jQuery.each(response.details, function(index, item) {
                       subtotals = item.price * item.qty;
                       
                       pembelian_table.row.add({
                            no        : counter,
                            item      : item.product.name,
                            variant   : item.size_name,
                            qty       : item.qty,
                            price     : item.price,
                            diskon    : item.diskon,
                            subtotal  : subtotals,
                            item_id   : item.product.id,
                            variant_id: item.product_size_id,
                            detail_id : item.id,
                        }).draw();
                        counter++;
                    });
                }
            });
    }
    function format_number(val) {
        return val.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
    }
    </script>
@endpush