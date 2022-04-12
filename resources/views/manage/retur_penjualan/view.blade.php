@extends('layouts.be.be')

@push('css')

@endpush

@section('content')
<div id='mainContent'>
	<div class="container-fluid">
        <div class="grid_layouts --two-auto">
            <div class="head-lst">
                <h5 class="page-title">
                     Retur Penjualan Detail View
                </h5>
            </div>
            <div class="mn-rght">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">
                        <a href="{{ route('be.transaction') }}">
                            Retur Penjualan
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
						<h3 class="page-title">Retur Penjualan Detail View</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label><b>Transaction Code </b></label><br>
							<div id="transaction_code"></div>
						</div>
                        <div class="form-group">
                            <label><b>No Nota </b></label><br>
                            <div id="nota"></div>
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
					<div class="col-md-4">
						<div class="form-group">
							<label><b>Tanggal Retur</b></label><br>
							<div id="tanggal_penjualan"></div>
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
                            <label><b>Kurir</b></label><br>
                            <div id="kurir"></div>
                        </div>
					</div>
					<div class="col-md-4">
                         <div class="form-group">
                            <label><b>Total Retur Penjualan</b></label><br>
                            <div id="total_penjualan"></div>
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
							<label><b>Retur Penjualan Status</b></label><br>
							<div id="status"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
                        <table id="penjualanDaftar" class="table table-striped table-bordered" width="auto">
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
    	var penjualan_table;
    	var counter = 1;
    	$(document).ready(function() {
    	penjualan_table = $('#penjualanDaftar').DataTable({
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
            url :'{{ $api_url."retur_penjualan/edit" }}' ,
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
                $('#total_penjualan').text(response.data.grandtotal);
                $('#notes').text(response.data.notes);
                $('#nota').text(response.data.nota_code);
                $('#transaction_code').text(response.data.transaction_code);
                $('#tanggal_penjualan').text(response.data.tanggal_retur);
                $('#customer_name').text(response.data.customer.name);
                $('#customer_email').text(response.data.customer.email);
                $('#customer_phone').text(response.data.customer.phone);
                $('#diskon').text('Rp '+response.data.diskon);
                $('#ongkir').text('Rp '+response.data.ongkir);
                $('#kurir').text(response.data.kurir_name);
                $('#total_penjualan').text('Rp '+response.data.total_belanja);
                $('#grandtotal').text('Rp '+response.data.grandtotal);
                //1 = New 2 = On Shipping 3 = Complete 4 = Void
                var status = '';
                if(response.data.status == '1'){
                	status = 'New';
                }else if(response.data.status == '2'){
                	status = 'Void';
                }

                $('#status').text(status);
                var subtotals = 0;
                jQuery.each(response.details, function(index, item) {
                   subtotals = item.price * item.qty;

                   penjualan_table.row.add({
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