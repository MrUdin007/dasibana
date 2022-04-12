@extends('layouts.be.be')

@section('content')
    <div class="container-fluid">
        <div class="grid_layouts --two-auto">
            <div class="head-lst">
                <h5 class="page-title">
                    {{ Request::get('id') ? 'Edit Stock Adjustment' : 'Add Stock Adjustment' }}
                </h5>
            </div>
            <div class="mn-rght">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">
                        <a href="{{ Request::get('id') ? route('be.stock_adjustment.edit', Request::get('id')) : route('be.stock_adjustment.add') }}">
                            {{ Request::get('id') ? 'Edit Stock Adjustment' : 'Add Stock Adjustment' }}
                        </a>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row gap-20 pos-r">
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                    <div class="grid_layouts --two-auto">
						<div class="head-lst">
							<h3 class="page-title">{{ Request::get('id') ? 'Edit Stock Adjustment' : 'Add Stock Adjustment' }}</h3>
						</div>
					</div>
                    <div>
                        <form class="form-vegan" id="formAdjustment" method="POST" action="#">
                            @csrf
                            <input type="hidden" name="id" id="id" value="">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="product">Product</label>
                                        <select class="form-control" id="product" onclick="getProductInfo($(this).val())" name="product"></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="variant">Variant</label>
                                        <select id="product_variant" onchange="changeVariant()" name="product_variant" class="form-control" required="" style="width:100%">
                                            <option value="">- no variant</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="adjustment_date">Stock Adjustment Date</label>
                                        <input type="text" class="form-control start-date" value="" data-provide="datepicker" id="adjustment_date" name="adjustment_date" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control" value="" id="price" name="price" >
                                    </div>
                                    <div class="form-group">
                                        <label for="diskon">Discount</label>
                                        <input type="number" class="form-control" value="" id="discount" name="discount">
                                    </div>
                                    <div class="form-group">
                                        <label for="current_stock">Current Stock</label>
                                        <input type="number" class="form-control" readonly="" value="" id="current_stock" name="current_stock" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="adjustment_stock">Qty Adjustment</label>
                                        <input type="number" class="form-control" value="" id="adjustment_stock" name="adjustment_stock" >
                                    </div>
                                    <div class="form-group">
                                        <label>Notes</label>
                                        <textarea class="form-control" name="notes" id="notes" placeholder="Notes" style="min-height: 110px;"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{route('be.stock_adjustment')}}" class="btn btn-danger">Cancel</a>
                                <button class="btn btn-sm btn-primary btn-customize" type="button" id="submitProduk">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript"> 
getProduct();
$(document).ready(function() {
    $('#submitProduk').click(function (e) {
      var product          = $('#product').val();
      var adjustment_date  = $('#adjustment_date').val();
      var current_stock    = $('#current_stock').val();
      var adjustment_stock = $('#adjustment_stock').val();
     
       
        if (!product) {
             swal('Ups!','Produk tidak boleh kosong','error');
             return;
        }
       
        if (!adjustment_date) {
             swal('Ups!','Tanggal Adjustment tidak boleh kosong','error');
             return;
        }

        if (!current_stock) {
            swal('Ups!','Current Stock tidak boleh kosong','error');
             return;
        }

        if (!adjustment_stock) {
            swal('Ups!','Jumlah penambahan/pengurangan stok tidak boleh kosong','error');
             return;
        }

       // console.log(pembelian_table.rows().data().toArray());
        $.ajax({
            type:'post',
            url :'{{ $api_url."stock_adjustment/save" }}' ,
            data: {
                id:'{{Request("id") ? Request("id") : 0 }}',
                _token: '{{ csrf_token() }}',
                api_token: "{{ auth()->user()->api_token }}",
                product: $('#product').val(),
                product_variant: $('#product_variant').val(),
                price: $('#price').val(),
                discount: $('#discount').val(),
                current_stock: $('#current_stock').val(),
                adjustment_stock: $('#adjustment_stock').val(),
                notes: $('#notes').val()
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
                console.log(response.success);

                if(response.success == true){

                    location.href = "{{ route('be.stock_adjustment') }}";
                }else{
                   // swal.close();
                    swal('Ups!','Terjadi kesalahan!','error');
                    console.log(response);
                }
            },
            error:function(xhr){
                console.log(xhr);
            }
        });
    });
});

function getProduct(){
    $.ajax({
            type: 'POST',
            data: {
                token: "{{ csrf_token() }}",
                api_token: "{{ auth()->user()->api_token }}",
            },
            dataType: "json",
            url: '{{ $api_url."product/table" }}',
            success: function(data){
               var dropProduct = '';
               jQuery.each(data.data, function(index, item) {
                    dropProduct += '<option value="'+item.id+'">'+item.name+'</option>'
                });
               $('#product').html(dropProduct);
               getProductInfo($('#product').val());
            },

            error: function(data){
                console.log(data);
            }
        });
}

function getProductInfo(product_id){

    $.ajax({
        type: 'POST',
        data: {
            token: "{{ csrf_token() }}",
            api_token: "{{ auth()->user()->api_token }}",
            id:product_id,
        },
        dataType: "json",
        url: '{{ $api_url."product/info" }}'/*,
        beforeSend: function () {
           swal({
                title: "Please wait",
                text: "Get data product info",
                showConfirmButton: false,
            });
        }*/,
        success: function(data){
            var variant = '';
            if(data.product.size.length > 0){
                 $.each(data.product.size, function (i, e) {
                    variant += '<option data-stock="'+e.stock+'" value="'+e.id+'">'+e.name+'</option>';
                });
                

            }else{
                variant += '<option value="">- no variant</option>';
            }

            $('#current_stock').val(data.product.stock);
            $('#product_variant').html(variant);

            if(data.product.size.length > 0){   
              $('#current_stock').val($('#product_variant').children('option:selected').data('stock'));
            }else{
              $('#current_stock').val(data.product.stock);
            }
            $('#price').val(data.product.price);
            if(data.product.discount == null){
                $('#discount').val(0);
            }else{

                $('#discount').val(data.product.discount);
            }
        },
        error: function(data){
            console.log(data);
        }
    });
}

 function changeVariant(){
     var stock = $('#product_variant').children('option:selected').data('stock');
     $('#current_stock').val(stock);
}

</script>
@endpush
