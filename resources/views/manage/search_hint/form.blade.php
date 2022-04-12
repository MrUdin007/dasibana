@extends('layouts.be.be')

@section('content')
    <div class="container-fluid">
        <div class="grid_layouts --two-auto">
            <div class="head-lst">
                <h5 class="page-title">
                    {{ Request::get('id') ? 'Edit Search Hint' : 'Add Search Hint' }}
                </h5>
            </div>
            <div class="mn-rght">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">
                        <a href="{{ Request::get('id') ? route('be.stock_adjustment.edit', Request::get('id')) : route('be.stock_adjustment.add') }}">
                            {{ Request::get('id') ? 'Edit Search Hint' : 'Add Search Hint' }}
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
							<h3 class="page-title">{{ Request::get('id') ? 'Edit Search Hint' : 'Add Search Hint' }}</h3>
						</div>
					</div>
                    <div>
                        <form class="form-vegan" id="formAdjustment" method="POST" action="#">
                            @csrf
                            <input type="hidden" name="id" id="id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tagname">Hint Name</label>
                                        <input type="text" class="form-control" placeholder="Hint Name" value="" id="name" name="name" >
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" class="description" placeholder="Description" id="description" style="min-height: 150px;"></textarea>
                                    </div>
                                     <div class="form-group">
                                        <label for="description">Status</label>
                                        <select id="status" name="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                               <!--  <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Instant Generate</label><br>
                                        <button class="btn btn-success" type="button" onclick="instantGenerate('diskon')" style="margin-top:10px;">Sedang Diskon</button><br>
                                        <button class="btn btn-success" type="button" onclick="instantGenerate('cuci_gudang')" style="margin-top:10px;">Cuci Gudang</button><br>
                                        <button class="btn btn-success" type="button" onclick="instantGenerate('diskon_spesial')" style="margin-top:10px;">Diskon Spesial (more than 20 %)</button><br>
                                        <button class="btn btn-success" type="button" onclick="instantGenerate('terpopuler')" style="margin-top:10px;">Terpopuler</button><br>
                                        <button class="btn btn-success" type="button" onclick="instantGenerate('terlaris')" style="margin-top:10px;">Terlaris</button><br>
                                    </div>
                                </div> -->
                            </div>
                          
                        </form>
                    </div>
                    <hr>
                    <div class="grid_layouts --two-auto">
                        <div class="head-lst">
                            <h3 class="page-title">Product List</h3>
                        </div>
                        <div class="mn-rght">
                            <button class="addbsnt --pluses" type="button">
                                <a onclick="openModalDaftar()" >
                                    <i class="ti-plus"></i>
                                </a>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table id="pembelianDaftar" class="table table-striped table-bordered" width="auto">
                                <thead>
                                    <tr>
                                        <th width="10" align="center">No.</th>
                                        <th width="90%">Item</th>
                                      <!--   <th width="30%">Discount</th> -->
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                            
                            </table>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{route('be.search_hint')}}" class="btn btn-danger">Cancel</a>
                        <button class="btn btn-sm btn-primary btn-customize" type="button" id="submitProduk">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <div class="modal fade" id="modalDetail" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Produk & Variant</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-4">
                        <label for="product" class="col-sm-3 col-form-label">Item</label>
                        <div class="col-sm-9">
                            <select id="product" name="product" class="form-control select2" required="" style="width:100%">
                                <option value="">- pilih produk</option>
                               
                            </select>
                        </div>
                    </div>
                   <!--  <div class="input-group mb-4">
                        <label for="product" class="col-sm-3 col-form-label">Variant</label>
                        <div class="col-sm-9">
                            <select id="product_variant" onchange="" name="product_variant" class="form-control select2" required="" style="width:100%">
                                <option value="">- no variant</option>
                            </select>
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-customize" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-customize" onclick="insertDaftar()">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript"> 
var is_edit = false;
var counter = 1;
var pembelian_table;
var data_edit;
var id_product_now=0;
var id_product_variant_now = 0;
getProduct();

$(document).ready(function() {

        pembelian_table = $('#pembelianDaftar').DataTable({
            responsive: true,
            scrollX: true,
            language: {
                search: '<i class="fas fa-search" aria-hidden="true"></i>',
                searchPlaceholder: 'Search Item'
            },
            columns: [
                {
                    data:"no",
                    className:'text-center'
                },
                { data:"item" },
               /* { data:"discount" },*/
                {
                    data:"action",
                    className:'text-center'
                },
            ],
            rowCallback: function (row, data) {
                if (!data.item_id) {
                    data.item_id = $(row).children().eq(1).data('item');
                }

                if (!data.detail_id) {
                    data.detail_id = $(row).children().eq(1).data('detail');
                }
            }
        });
         $('#pembelianDaftar').on( 'click', 'tbody tr .btn-danger', function () {
            var e = pembelian_table.row( $(this).parents('tr') );
            var d = e.data();
            e.remove().draw();
        });

        @if(Request::get('id'))
            getEditData();
         @endif

        $('#submitProduk').click(function (e) {
           
           // e.preventDefault();
           
            var name        = $('#name').val();
            var description = $('#description').val();
           
            var temp_data = pembelian_table.rows().data().toArray();
           
            if (!name) {
                 swal('Ups!','Tag name tidak boleh kosong','error');
                 return;
            }
           
            if (!temp_data.length) {
                 swal('Ups!','List produk tidak boleh kosong','error');
                 return;
            }

            console.log(pembelian_table.rows().data().toArray());
            $.ajax({
                type:'post',
                url :'{{ $api_url."search_hint/save" }}' ,
                data: {
                    id:'{{Request("id") ? Request("id") : 0 }}',
                    _token: '{{ csrf_token() }}',
                    api_token: "{{ auth()->user()->api_token }}",
                    name: $('#name').val(),
                    description: $('#description').val(),
                    status:$('#status').val(),
                    detail: pembelian_table.rows().data().toArray(),
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
                    if(response.success == true){

                        location.href = "{{ route('be.search_hint') }}";
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

    function instantGenerate(kode){
         $.ajax({
                type: 'POST',
                data: {
                    token: "{{ csrf_token() }}",
                    api_token: "{{ auth()->user()->api_token }}",
                    kode:kode
                },
                beforeSend: function () {
                   swal({
                        title: "Please wait",
                        text: "Your request is being processed",
                        showConfirmButton: false,
                    });
                   
                },
                dataType: "json",
                url: '{{ $api_url."search_hint/instant_generate" }}',
                success: function(data){

                  swal.close();

                  console.log(data);
                  pembelian_table.clear().draw();
                  jQuery.each(data.data, function(index, item) {
                      
                       var button = '<a href="javascript:void(0)" class="btn btn-circle btn-danger delete-row"><i class="fas fa-trash"></i></a>';

                       pembelian_table.row.add({
                            no        : counter,
                            item      : item.name,
                            /*discount  : item.discount,*/
                            action    : button,
                            item_id   : item.id,
                            variant_id: '',
                        }).draw();
                        counter++;
                    });
                },
                error: function(data){
                    console.log(data);
                }
            });
    }

    function openModalDaftar(){
          
        is_edit = false;
      
        $('#modalDetail').modal();
    }

    function getProduct(){
        $.ajax({
                type: 'POST',
                data: {
                    token: "{{ csrf_token() }}",
                    api_token: "{{ auth()->user()->api_token }}"
                },
                dataType: "json",
                url: '{{ $api_url."product/table" }}',
                success: function(data){
                   var dropProduct = '';
                   jQuery.each(data.data, function(index, item) {
                        dropProduct += '<option value="'+item.id+'">'+item.name+'</option>'
                    });
                   $('#product').html(dropProduct);
                   getProductInfo();
                },
                error: function(data){
                    console.log(data);
                }
            });
    }

     function getProductInfo(){
        product_id = $('#product').val();

        $.ajax({
            type: 'POST',
            data: {
                token: "{{ csrf_token() }}",
                api_token: "{{ auth()->user()->api_token }}",
                id:product_id,
            },
            dataType: "json",
            url: '{{ $api_url."product/info" }}',
            success: function(data){
                console.log(data.product.size.length);

                var variant = '';
                if(data.product.size.length > 0){
                     $.each(data.product.size, function (i, e) {
                        variant += '<option value="'+e.id+'">'+e.name+'</option>';
                    });

                }else{
                    variant += '<option value="">- no variant</option>';
                }
                
                $('#product_variant').html(variant);
                $('#qty').val(1);
                $('#harga_satuan').val(0);
                $('#diskon').val(0);
                $('#expired_date').val('');
                $('subtotal').val(0);
            },
            error: function(data){
                console.log(data);
            }
        });
    }

    function insertDaftar(){

        var err = 0;
        var exp = $('#expired_date').val();
        var qty = $('#qty').val();
        var sat = $('#harga_satuan').val();
        var msg = [];


        if (!err) {
           $.each(pembelian_table.rows().data().toArray(), function (i, e) {
                console.log(e);
               
                if($('#product').val() != id_product_now){
                    if($('#product').val() == e.item_id){
                        swal('Warning','Produk sudah pernah ada di daftar','error');
                         e.remove();
                        return;
                    }
                }  
               
            });

            if($('#product_variant :selected').html() != '- no variant'){
                variantz = $('#product_variant :selected').html();
            }else{
                variantz ='';
            }

            if (is_edit) {
                data_edit.data({
                    no: data_edit.data().no,
                    item      : $('#product :selected').html(),
                    variant   : variantz,
                    action    : data_edit.data().action,
                    item_id   : $('#product').val(),
                    variant_id: $('#product_variant').val(),
                    detail_id : data_edit.data().detail_id,
                });
                $('#modalDetail').modal('hide');
            } else {
                var button = '<a href="javascript:void(0)" class="btn btn-circle btn-danger delete-row"><i class="fas fa-trash"></i></a>';

                pembelian_table.row.add({
                    no        : counter,
                    item      : $('#product :selected').html(),
                    variant   : variantz,
                    action    : button,
                    item_id   : $('#product').val(),
                    variant_id: $('#product_variant').val(),
                    detail_id : '0',
                }).draw();
                counter++;
            }
            
            updateGrandTotal(); 
        }else{
             swal('Ups!','Terdapat kesalahan input pada '+msg.join(', '),'error');
        }
    }


    function getEditData(){
        
     $.ajax({
            type:'post',
            url :'{{ $api_url."search_hint/edit" }}' ,
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
                console.log(response.data.detail);
                $('#name').val(response.data.name);
                $('#description').val(response.data.description);

                var sel_0 = '';

                if(response.data.status == false){
                    sel_0 = "selected=''";
                }

                var sel_1 = '';

                if(response.data.status == true){
                    sel_1 = "selected=''";
                }

                var htxl = '<option value="1" '+sel_1+'>Active</option>'+
                            '<option value="0" '+sel_0+'>Inactive</option>';

                $('#status').html(htxl);


                jQuery.each(response.data.detail, function(index, item) {
                    console.log(item);
                   var button = '<a href="javascript:void(0)" class="btn btn-circle btn-danger delete-row"><i class="fas fa-trash"></i></a>';
                   var detail_id = '0';

                   @if(Request::get('id'))
                     detail_id = item.id;
                   @endif

                   pembelian_table.row.add({
                        no        : counter,
                        item      :  item.product.name,
                        variant   : '',
                        action    : button,
                        item_id   : item.product_id,
                        variant_id: '',
                        detail_id : detail_id,
                    }).draw();
                    counter++;
                });
               console.log(response);
            }
        });
    }
</script>
@endpush
