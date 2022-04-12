@extends('layouts.be.be')

@push('css')

@endpush

@section('content')
<div id='mainContent'>
	<div class="container-fluid">
        <div class="grid_layouts --two-auto">
            <div class="head-lst">
                <h5 class="page-title">
                     Purchase Detail View
                </h5>
            </div>
            <div class="mn-rght">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">
                        <a href="{{ route('be.transaction') }}">
                            Purchase
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
						<h3 class="page-title">Purchase Detail View</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label><b>Transaction Code </b></label><br>
							<div id="transaction_code"></div>
						</div>
						<div class="form-group">
							<label><b>Supplier Name</b></label><br>
							<div id="supplier_name"></div>
						</div>
						<div class="form-group">
							<label><b>Supplier Phone</b></label><br>
							<div id="supplier_phone"></div>
						</div>
						<div class="form-group">
							<label><b>Supplier Email</b></label><br>
							<div id="supplier_email"></div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label><b>Tanggal Pembelian</b></label><br>
							<div id="tanggal_pembelian"></div>
						</div>
						<div class="form-group">
							<label><b>Diskon</b></label><br>
							<div id="diskon"></div>
						</div>
						<div class="form-group">
							<label><b>Ongkir</b></label><br>
							<div id="ongkir"></div>
						</div>
                        <div class="form-group">
                            <label><b>Packing</b></label><br>
                            <div id="packing"></div>
                        </div>
                        <div class="form-group">
                            <label><b>Tax</b></label><br>
                            <div id="tax"></div>
                        </div>
                        <div class="form-group">
                            <label><b>Kurir</b></label><br>
                            <div id="kurir"></div>
                        </div>
					</div>
					<div class="col-md-4">
                         <div class="form-group">
                            <label><b>Total Purchase</b></label><br>
                            <div id="total_pembelian"></div>
                         </div>
                         <div class="form-group">
                            <label><b>Grand Total</b></label><br>
                            <div id="grandtotal"></div>
                        </div>
                        <div class="form-group">
                            <label><b>Notes</b></label><br>
                            <div id="notes"></div>
                        </div>
						<div class="form-group">
							<label><b>Purchase Status</b></label><br>
							<div id="status"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
                        <table id="pembelianDaftar" class="table table-striped table-bordered" width="auto">
                            <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="30%">Item</th>
                                    <th width="30%">Variant</th>
                                    <th width="5%">Expired</th>
                                    <th width="5%">Qty</th>
                                    <th width="10%">Harga Satuan</th>
                                    <th width="15%">Diskon</th>
                                    <th width="15%">Subtotal</th>
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
            columns: [
                { data:"no" },
                { data:"item" },
                { data:"variant" },
                { data:"exp" },
                {
                    data:"qty",
                    className:'text-right',
                    render: function (data, type, row) {
                        return format_number(parseInt(data));
                    }
                },
                {
                    data:"price",
                    className:'text-right',
                    render: function (data, type, row) {
                        return 'Rp '+format_number(parseInt(data));
                    }
                },
                {
                    data:"disc",
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
                url :'{{ $api_url."stockin/edit" }}' ,
                data: {
                    _token: '{{ csrf_token() }}',
                    api_token: "{{ auth()->user()->api_token }}",
                    id:'{{Request::get("id")}}'
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
                    $('#total_pembelian').text(response.data.grandtotal);
                    $('#notes').text(response.data.notes);
                    $('#transaction_code').text(response.data.transaction_code);
                    $('#tanggal_pembelian').text(response.data.tanggal_pembelian);
                    $('#supplier_name').text(response.data.supplier.name);
                    $('#supplier_email').text(response.data.supplier.email);
                    $('#supplier_phone').text(response.data.supplier.phone);
                    $('#diskon').text('Rp '+response.data.diskon);
                    $('#ongkir').text('Rp '+response.data.ongkir);
                    $('#packing').text('Rp '+response.data.packing);
                    $('#tax').text('Rp '+response.data.tax);
                    $('#kurir').text(response.data.kurir_name);
                    $('#total_pembelian').text('Rp '+response.data.total_pembelian);
                    $('#grandtotal').text('Rp '+response.data.grandtotal);
                    //1 = New 2 = On Shipping 3 = Complete 4 = Void
                    var status = '';
                    if(response.data.status == '1'){
                    	status = 'New';
                    }else if(response.data.status == '2'){
                    	status = 'On Shipping';
                    }else if(response.data.status == '3'){
                    	status = 'Complete';
                    }else{
                    	status = 'Void';
                    }

                    $('#status').text(status);
                    var subtotals = 0;
                    jQuery.each(response.details, function(index, item) {
                       subtotals = item.price * item.qty;

                       pembelian_table.row.add({
                            no        : counter,
                            item      : item.product.name,
                            variant   : item.size_name,
                            exp       : item.expired_date,
                            qty       : item.qty,
                            price     : item.price,
                            disc      : item.diskon,
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