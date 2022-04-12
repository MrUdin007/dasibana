@extends('layouts.be.be')

@section('content')
<div id='mainContent'>
	<div class="container-fluid">
		<div class="grid_layouts --two-auto">
			<div class="head-lst">
				<h5 class="page-title">
					Report Stock History
				</h5>
			</div>
			<div class="mn-rght">
				<ol class="breadcrumb">
					<li><a href="javascript:void(0)">Home</a></li>
					<li class="active">
						<a href="{{ route('be.customer') }}">
							Report Stock History
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
            <div class="bgc-white p-20 bd">
                <div class="row form-vegan">
                    <div class="col-md-3">
                        <label>Product</label>
                        <select class="form-control" onchange="getProductInfo();" name="product" id="product"></select>
                    </div>
                    <div class="col-md-3">
                        <label>Variant</label>
                        <select class="form-control" name="product_variant" id="product_variant">
                            <option value="">- Select Variant</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>Start Date</label>
                        <input type="text" data-provide="datepicker" class="form-control" name="first_date" placeholder="Date Start" id="first_date">
                    </div>
                    <div class="col-md-2">
                        <label>End Date</label>
                        <input type="text" data-provide="datepicker" class="form-control" name="last_date" placeholder="Date End" id="last_date">
                    </div>
                    <div class="col-md-2">
                        <button type="button" style="margin-top: 30px !important;" id="filter" class="btn btn-success">Filter</button>
                    </div>
                </div>
            </div>
        </div>
	</div>
    <div class="row gap-20 pos-r" id="product_info">
        <div class="masonry-item col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <div class="grid_layouts --two-auto">
                    <div class="head-lst">
                        <h3 class="page-title">Product Info</h3>
                    </div>
                </div>
                <div>
                    <table id="table_stockHistory" class="table table-striped table-bordered" cellspacing="0" width="auto">
                        <tr>
                            <td width="200">Product Code</td>
                            <td>:</td>
                            <td id="product_code"></td>
                        </tr>
                        <tr>
                            <td>Product Name</td>
                            <td>:</td>
                            <td id="product_name"></td>
                        </tr>
                        <tr>
                            <td>Variant Name</td>
                            <td>:</td>
                            <td id="product_variant_name"></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>:</td>
                            <td id="product_description"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
	<div class="row gap-20 pos-r">
		<div class="masonry-item col-md-12">
			<div class="bgc-white bd bdrs-3 p-20 mB-20">
				<div class="grid_layouts --two-auto">
				</div>
				<table id="DataTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
					<thead>
						<tr>
							<th style="width:10px;">No</th>
							<th style="width:120px;">Tgl. Transaksi</th>
							<th>No Transaksi</th>
							<th class="text-center">Masuk</th>
							<th class="text-center">Keluar</th>
							<th class="text-center">Current Stock</th>
						</tr>
					</thead>
					<tbody id="trgtData">
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#table_stockHistory').DataTable({
            responsive: true,
            scrollX: true,
            language: {
                search: '<i class="fas fa-search" aria-hidden="true"></i>',
                searchPlaceholder: 'Search Order'
            }
        });
        $('#DataTable').DataTable({
            responsive: true,
            scrollX: true,
            language: {
                search: '<i class="fas fa-search" aria-hidden="true"></i>',
                searchPlaceholder: 'Search Order'
            }
        });
    });
	$(function(){
        $('#product_info').hide();
		$('#filter').on('click',function(){

            if($('#product').val() == ''){
                swal('Ups','Mohon produk terlebih dahulu','warning');

                return;
            }
            var variantz = '';
               
                if($('#product_variant :selected').html() != '- no variant'){
                    variantz = $('#product_variant :selected').html();
                }else{
                    variantz ='-';
                }

                $('#product_variant_name').text(variantz);
			 $.ajax({
                type: 'POST',
                data: {
                    token: "{{ csrf_token() }}",
                    product_id:$('#product').val(),
                    product_variant_id :$('#product_variant').val(),
                    first_date:$('#first_date').val(),
                    last_date:$('#last_date').val(),
                    api_token: "{{ auth()->user()->api_token }}"
                },
                beforeSend: function () {
                   swal({
                        title: "Please wait",
                        text: "Your request is being processed",
                        showConfirmButton: false,
                    });
                   
                },
                dataType: "json",
                url: '{{ $api_url."report/stock_history" }}',
                success: function(data){
                	swal.close();
                	
                	var html = '';
                	var no = 0;
                	var current = 0;
                	
                    if(data.data.length < 1){
                        html += '<tr>'
                              +'<td class="text-center" colspan="6">Data kosong</td>'
                            +'</tr>'; 
                    }
                	$('#product_info').show();
                    $('#product_code').text(data.product.code);
                    $('#product_name').text(data.product.name);
                    $('#product_description').html(data.product.description);

                    jQuery.each(data.data, function(index, item) {
                       
                	   no++;
                	   var inflow = '';
                	   if(item.type_trx == "in"){
                	   	inflow = item.qty;
                	   }else{
                	   	inflow = '';
                	   }
                	   
                       var outflow = '';
                	   if(item.type_trx == "out"){
                	   	outflow = item.qty;
                	   }else{
                	   	outflow = '';
                	   }

                	   if(item.type_trx == "out"){
                            current -= item.qty;
                       }else{
                            current += item.qty;
                       }

                     
                           html += '<tr>'
                           			  +'<td class="text-center">'+no+'</td>'
                           			  +'<td>'+item.dateorder+'</td>'
                           			  +'<td>'+item.no_trx+'</td>'
                           			  +'<td class="text-center">'+inflow+'</td>'
                           			  +'<td class="text-center">'+outflow+'</td>'
                           			  +'<td class="text-center">'+current+'</td>'
                           			+'</tr>';
                      
                    });
                    var total = data.saldoAwal + data.saldoAkhir + current;
                    if($('#first_date').val() !='' && $('#last_date').val() !=''){

                        html += '<tr>'
                                     +'<td colspan="5" align="right">Saldo Awal</td>'
                                     +'<td class="text-center" >'+data.saldoAwal+'</td>'
                                +'</tr>';
                        html += '<tr>'
                                     +'<td colspan="5" align="right">Saldo Akhir</td>'
                                     +'<td class="text-center" >'+data.saldoAkhir+'</td>'
                                +'</tr>';
                        html += '<tr>'
                                     +'<td colspan="5" align="right">Total</td>'
                                     +'<td class="text-center" >'+total+'</td>'
                                +'</tr>';
                    }

                    $('#trgtData').html(html);

                },
                error: function(data){
                    console.log(data);
                }
            });
		});

		getProduct();
	});

    function getProductInfo(){
        product_id = $('#product').val();

        $.ajax({
            type: 'POST',
            data: {
                token: "{{ csrf_token() }}",
                api_token: "{{ auth()->user()->api_token }}",
                id:product_id,
            },
             beforeSend: function () {
                   swal({
                        title: "Please wait",
                        text: "Your request is being processed",
                        showConfirmButton: false,
                    });
                   
                },
            dataType: "json",
            url: '{{ $api_url."product/info" }}',
            success: function(data){
                swal.close();

                var variant = '';
                if(data.product.size.length > 0){
                     $.each(data.product.size, function (i, e) {
                        variant += '<option value="'+e.id+'">'+e.name+'</option>';
                    });

                }else{
                    variant += '<option value="">- no variant</option>';
                }
                
                $('#product_variant').html(variant);

            },
            error: function(data){
                console.log(data);
            }
        });
    }

    function getProduct(){
        $.ajax({
                type: 'POST',
                data: {
                    token: "{{ csrf_token() }}",
                    api_token: "{{ auth()->user()->api_token }}"
                },
                beforeSend: function () {
                   swal({
                        title: "Please wait",
                        text: "Your request is being processed",
                        showConfirmButton: false,
                    });
                   
                },
                dataType: "json",
                url: '{{ $api_url."product/table" }}',
                success: function(data){
                	swal.close();
                   var dropProduct = '<option value=""> - Select product</option>';
                   jQuery.each(data.data, function(index, item) {
                        dropProduct += '<option value="'+item.id+'">'+item.name+'</option>'
                    });
                   $('#product').html(dropProduct);
                },
                error: function(data){
                    console.log(data);
                }
            });
    }	
</script>
@endpush