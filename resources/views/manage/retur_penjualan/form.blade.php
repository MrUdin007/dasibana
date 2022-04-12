@extends('layouts.be.be')

@section('content')
    <div class="container-fluid">
        <div class="grid_layouts --two-auto">
            <div class="head-lst">
                <h5 class="page-title">
                    {{ Request::get('id') ? 'Edit Retur Penjualan' : 'Add Retur Penjualan' }}
                </h5>
            </div>
            <div class="mn-rght">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">
                        <a href="{{ Request::get('id') ? route('be.retur_penjualan.edit', Request::get('id')) : route('be.retur_penjualan.create') }}">
                            {{ Request::get('id') ? 'Edit Retur Penjualan' : 'Add Retur Penjualan' }}
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
                            <h3 class="page-title">{{ Request::get('id') ? 'Edit Retur Penjualan' : 'Add Retur Penjualan' }}</h3>
                        </div>
                    </div>
                    <div >
                        <form class="form-vegan" id="formPenjualan" method="POST" action="#">
                            @csrf
                            <input type="hidden" name="id" id="id" value="">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        @if(Request::get('id'))
                                        <label for="name">No Nota</label><br>
                                        <p id="nota_code"></p>
                                        <input type="hidden" name="nota" id="nota">
                                        @else
                                        <label for="name">Ambil Nota</label>
                                        <select class="form-control" id="nota" name="nota"></select>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Retur Penjualan Code</label>
                                        <input type="text" readonly="" class="form-control" id="transaction_code" name="transaction_code" value="" placeholder="Transaction Code (Auto)" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="customer">Customer</label>
                                        <select class="form-control" id="customer" name="customer"></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Penjualan Date</label>
                                        <input type="text" class="form-control start-date" value="" data-provide="datepicker" id="tanggal_belanja" name="tanggal_belanja" >
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Shipping Date</label>
                                        <input type="text" class="form-control start-date" value="" data-provide="datepicker" id="tanggal_pengiriman" name="tanggal_pengiriman" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tanggal">Received Date</label>
                                        <input type="text" class="form-control start-date" value="" data-provide="datepicker" id="tanggal_penerimaan" name="tanggal_penerimaan" >
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Retur Date</label>
                                        <input type="text" class="form-control start-date" value="" data-provide="datepicker" id="tanggal_retur" name="tanggal_retur" >
                                    </div>
                                    <div class="form-group">
                                        <label for="kurir">Kurir <small><i>*) yg dipakai untuk transaksi</i></small></label>
                                        <br><p id="kurir_name"></p>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="ongkir">Ongkir <small><i>*) yg dikeluarkan untuk pembelian</i></small></label>
                                        <input type="number" class="form-control" onkeyup="updateGrandTotal()" readonly="" value="" id="ongkir" name="ongkir" >
                                    </div>
                                    <div class="form-group">
                                        <label for="kurir">Kurir <small><i>*) yg dipakai untuk retur</i></small></label>
                                        <select class="form-control" id="kurir_kembali" name="kurir_kembali"></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ongkir">Ongkir <small><i>*) yg didapatkan dari customer</i></small></label>
                                        <input type="number" class="form-control" onkeyup="updateGrandTotal()" value="" id="ongkir_kembali" name="ongkir_kembali" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="total">Discount</label>
                                        <input type="number" class="form-control" value="0" onkeyup="updateGrandTotal()" id="discount_total" name="discount_total" >
                                    </div>
                                    <div class="form-group">
                                        <label for="total">Total Dana <small><i>*) yg dikembalikan pada customer</i></small></label>
                                        <input type="text" class="form-control" readonly="" value="0" id="total" name="total" >
                                        <input type="hidden" class="form-control" readonly="" value="0" id="total_hidden" name="total_hidden" >
                                        <input type="hidden" class="form-control" readonly="" value="0" id="total_belanja_hidden" name="total_belanja_hidden" >
                                    </div>
                                    <div class="form-group">
                                        <label for="total">Notes</label>
                                        <textarea class="form-control" id="notes" name="notes" style="min-height: 115px;" placeholder="Notes"></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="grid_layouts --two-auto">
                                <div class="head-lst">
                                    <h3 class="page-title">Retur Penjualan List</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table id="pembelianDaftar" class="table table-striped table-bordered" width="auto">
                                        <thead>
                                            <tr>
                                                <th width="5" align="center">No.</th>
                                                <th width="30%">Item</th>
                                                <th width="30%">Variant</th>
                                                <th width="5%">Qty</th>
                                                <th width="10%">Harga Satuan</th>
                                                <th width="15%">Diskon</th>
                                                <th width="15%">Subtotal</th>
                                                <th width="10%">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{route('be.retur_penjualan')}}" class="btn btn-warning">Cancel</a>
                                <button class="btn btn-sm btn-primary btn-customize" type="button" id="submitProduk">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDetail" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Detail</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-4">
                        <label for="product" class="col-sm-3 col-form-label">Item</label>
                        <div class="col-sm-9">
                            <select id="product" onchange="getProductInfo()" name="product" class="form-control select2" required="" style="width:100%">
                                <option value="">- pilih produk</option>
                               
                            </select>
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <label for="product" class="col-sm-3 col-form-label">Variant</label>
                        <div class="col-sm-9">
                            <select id="product_variant" onchange="" name="product_variant" class="form-control select2" required="" style="width:100%">
                                <option value="">- no variant</option>
                            </select>
                        </div>
                    </div>
                    <div id="stocks_place"></div>
                    <div class="input-group mb-4">
                        <label for="expired_date" class="col-sm-3 col-form-label">Expired Date</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" id="expired_date" name="expired_date" class="form-control start-date" value="" data-provide="datepicker" aria-label="Expired Date" aria-describedby="Expired Date" placeholder="Expired Date" required>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <label for="qty" class="col-sm-3 col-form-label">Qty</label>
                        <div class="col-sm-9">
                            <input type="number" id="qty" name="qty" class="form-control" value="0" aria-label="Qty" aria-describedby="Qty" placeholder="Qty" required pattern="[0-9]*" min="0">
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <label for="harga_satuan" class="col-sm-3 col-form-label">Harga Satuan</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        Rp
                                    </span>
                                </div>
                                <input type="number" id="harga_satuan" name="harga_satuan" class="form-control" value="0" aria-label="Harga Satuan" aria-describedby="Harga Satuan" placeholder="Harga Satuan" required pattern="[0-9]*" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <label for="diskon" class="col-sm-3 col-form-label">Diskon</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        Rp
                                    </span>
                                </div>
                                <input type="number" id="diskon" name="diskon" class="form-control" value="0" aria-label="Diskon" aria-describedby="Diskon" placeholder="Diskon" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <label for="subtotal" class="col-sm-3 col-form-label">Subtotal</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        Rp
                                    </span>
                                </div>
                                <input type="number" id="subtotal" name="subtotal" class="form-control" value="0" aria-label="Subtotal" aria-describedby="Subtotal" placeholder="Subtotal" readonly min="0">
                            </div>
                        </div>
                    </div>
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
   
    submitData('formPenjualan');
    getCustomer();
    getCourier();
    getProduct();
  
    @if(Request::get('id'))
    getEditData();
    @endif

    @if(!Request::get('id'))
    getNotaPenjualan();
    @endif

    $('#qty, #harga_satuan, #diskon').focusin(function () {
        if (!$(this).val() || $(this).val() == 0) {
            $(this).val('');
        }
    });

    $('#qty, #harga_satuan, #diskon').focusout(function () {
        if (!$(this).val()) {
            $(this).val(0);
        }
    });

    $('#qty, #harga_satuan, #diskon').on('keyup', function(){
        var total = ($('#qty').val() * $('#harga_satuan').val()) - $('#diskon').val();
        $('#subtotal').val(total);
    });

    $('#modalDetail').on('shown.bs.modal', function () {

        $(this).keydown(function (e) {
            if (e.keyCode == 13) {
                if (!Swal.isVisible()) {
                    insertDaftar();
                } else {
                    Swal.close();
                }
            }
        });
    });

    $('#modalDetail').on('hidden.bs.modal', function () {
        $(this).off('keydown');
        is_edit = false;
    });

    $('#nota').on('change',function(){
        getEditDataPenjualan($('#nota').val());
    });

    function getNotaPenjualan(id=null){
        
         $.ajax({
            type: 'POST',
            data: {
                token: "{{ csrf_token() }}",
                 api_token: "{{ auth()->user()->api_token }}"
            },
            dataType: "json",
            url: '{{ $api_url."retur_penjualan/get_nota_penjualan" }}',
            success: function(data){
                console.log(data);
             
               var dropSupplier = '<option value="">- pilih no nota</option>';
               jQuery.each(data.data, function(index, item) {
                    if(item.retur_penjualan_id_in_ret == null){
                        if(id == null){
                            dropSupplier += '<option value="'+item.id+'">'+item.transaction_code+'</option>';
                        }else{
                            var selected ='';
                            if(item.id == id){
                                selected = "selected=''";
                            }else{
                                selected ='';
                            }
                            dropSupplier += '<option value="'+item.id+'" '+selected+'>'+item.transaction_code+'</option>';
                        }
                    }
                });
               console.log(dropSupplier);
               $('#nota').html(dropSupplier);
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
                counter = 1;
                pembelian_table.clear().draw();
               
                $('#transaction_code').val(response.data.transaction_code);
                $('#discount_total').val(response.data.diskon);
                $('#discount_total').val(response.data.diskon);
                $('#ongkir').val(response.data.ongkir);
                $('#total_belanja_hidden').val(response.data.total_pembelian);
                $('#total').val(response.data.grandtotal);
                $('#notes').val(response.data.notes);
                $('#nota').val(response.data.nota);
                $('#nota_code').text(response.data.nota_code);
                $('#total_hidden').val(parseInt(response.data.grandtotal));
                $('#tanggal_belanja').val(response.data.tanggal_belanja);
                $('#tanggal_pengiriman').val(response.data.tanggal_pengiriman);
                $('#tanggal_penerimaan').val(response.data.tanggal_penerimaan);
                $('#tanggal_retur').val(response.data.tanggal_retur);
                getCustomer(response.data.supplier_id);
                getCourier(response.data.courier_id);
                var subtotals = 0;
                jQuery.each(response.details, function(index, item) {
                    console.log(item);
                   subtotals = (parseInt(item.price) - parseInt(item.diskon)) * parseInt(item.qty);
                   var button = '<a href="javascript:void(0)" class="btn btn-circle btn-danger delete-row"><i class="fas fa-trash"></i></a>';
                   var qty = '<input type="number" class="form-control qtys" value="'+item.qty+'">';
                   var retur_penjualan_id = '0';

                   @if(Request::get('id'))
                     retur_penjualan_id = item.id;
                   @endif

                   pembelian_table.row.add({
                        no        : counter,
                        item      : item.product.name,
                        variant   : item.size_name,
                        qty       : qty,
                        real_qty  : item.qty,
                        old_qty   : item.old_qty,
                        price     : item.price,
                        disc      : item.diskon,
                        subtotal  : subtotals,
                        action    : button,
                        item_id   : item.product.id,
                        retur_penjualan_id : retur_penjualan_id,
                        variant_id: item.product_size_id,
                    }).draw();
                    counter++;
                });
            }
        });
    }
    
    function getEditDataPenjualan(id){
      
     $.ajax({
            type:'post',
            url :'{{ $api_url."transaction/edit" }}' ,
            data: {
               _token: '{{ csrf_token() }}',
               id:id,
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
                counter = 1;
            
                pembelian_table.clear().draw();
                console.log(response);
                $('#discount_total').val(response.data.diskon);
                $('#ongkir').val(response.data.shipping_fee);
                $('#total_belanja_hidden').val(response.data.total_pembelian);
                $('#total').val(response.data.grandtotal);
                $('#notes').val(response.data.notes);
                $('#total_hidden').val(parseInt(response.data.grandtotal));
                $('#tanggal_belanja').val(response.data.transaction_date);
                $('#tanggal_pengiriman').val(response.data.tanggal_pengiriman);
                $('#tanggal_penerimaan').val(response.data.tanggal_penerimaan);
                $('#kurir_name').text(response.data.kurir_name);
                $('#ongkir_kembali').val(0);
                getCustomer(response.data.supplier_id);

                getCourier(response.data.kurir_id_kembali);

                var subtotals = 0;

                jQuery.each(response.details, function(index, item) {
                    console.log(item);
                   subtotals = (parseInt(item.price) - parseInt(item.diskon)) * parseInt(item.qty);
                   var button = '<a href="javascript:void(0)" class="btn btn-circle btn-danger delete-row"><i class="fas fa-trash"></i></a>';
                   var qty = '<input type="number" class="form-control qtys" value="'+item.qty+'">';
                   console.log(qty);
                   pembelian_table.row.add({
                        no        : counter,
                        item      : item.product.name,
                        variant   : item.size_name,
                        qty       : qty,
                        real_qty  : item.qty,
                        old_qty   : item.qty,
                        price     : item.price,
                        disc      : item.diskon,
                        subtotal  : subtotals,
                        action    : button,
                        item_id   : item.product.id,
                        variant_id: item.product_size_id,
                        retur_penjualan_id : '0',
                    }).draw();
                    counter++;
                });
            }
        });
    }

    function getCourier(id=null){

      $.ajax({
            type: 'POST',
            data: {
                token: "{{ csrf_token() }}",
                 api_token: "{{ auth()->user()->api_token }}"
            },
            dataType: "json",
            url: '{{ $api_url."kurir/table" }}',
            success: function(data){
                 console.log('COU '+data);
               var dropSupplier = '';
               jQuery.each(data, function(index, item) {
                    console.log(item.name);
                    if(id == null){
                        dropSupplier += '<option value="'+item.id+'">'+item.name+'</option>';
                    }else{
                        var selected ='';
                        if(item.id == id){
                            selected = "selected=''";
                        }else{
                            selected ='';
                        }
                        dropSupplier += '<option value="'+item.id+'" '+selected+'>'+item.name+'</option>';
                    }
                });
               
               $('#kurir_kembali').html(dropSupplier);
            },
            error: function(data){
                console.log(data);
            }
        });
    }

    function format_number(val) {
        return val.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
    }

    function isValidDate(s) {
        var bits = s.split('-');
        var d = new Date(bits[2] + '-' + bits[1] + '-' + bits[0]);
        return !!(d && (d.getMonth() + 1) == bits[1] && d.getDate() == Number(bits[0]));
    }

    $(document).ready(function() {

        $(".select2").select2({
            placeholder: function(){
                $(this).data('placeholder');
            }
        });

        pembelian_table = $('#pembelianDaftar').DataTable({
            responsive: true,
            scrollX: true,
            language: {
                search: '<i class="fas fa-search" aria-hidden="true"></i>',
                searchPlaceholder: 'Search Order'
            },
            columns: [
                {
                    data:"no",
                    className:'text-center'
                },
                { data:"item" },
                { data:"variant" },
                {
                    data:"qty",
                    className:'text-right'
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
                },
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

                if (!data.qty) {
                    data.real_qty = $(row).children().eq(1).data('real_qty');
                }

                if (!data.qty) {
                    data.old_qty = $(row).children().eq(1).data('old_qty');
                }

                
            },
            initComplete: function (settings, json) {
                setTimeout(function(){
                    updateGrandTotal();
                }, 500)
            }
        });

        $('#pembelianDaftar').on( 'click', 'tbody tr .btn-danger', function () {
            var e = pembelian_table.row( $(this).parents('tr') );
            var d = e.data();
            e.remove().draw();

            updateGrandTotal();
        });

        $('#pembelianDaftar').on( 'keyup', 'tbody tr .qtys', function () {
          
            var e     = pembelian_table.row( $(this).parents('tr') );
            var d     = e.data();
            is_edit   = true;
            data_edit = e;
            id_product_now = d.item_id;
            value_qty_now = $(this).val(); 
            value_qty_old = d.old_qty;
            console.log(d);
           if(parseInt(value_qty_now) > parseInt(value_qty_old)){
             swal('Ups!','Qty tidak boleh melebihi qty lama','error');
             $('#submitProduk').attr('disabled','disabled');
             return;
           }

           else if(parseInt(value_qty_now) == 0 || parseInt(value_qty_now) =='' ){
             swal('Ups!','Qty tidak boleh nol atau kosong','error');
             $('#submitProduk').attr('disabled','disabled');
             return;
           }

           else{
              $('#submitProduk').removeAttr('disabled','disabled');
               var subtotal = (parseInt(d.price) - parseInt(d.disc)) * value_qty_now; 
               var qtyz = '<input type="number" class="form-control qtys" value="'+value_qty_now+'">';
                data_edit.data({
                    no: data_edit.data().no,
                    item      : d.item,
                    variant   : d.variant,
                    qty       : qtyz,
                    real_qty  : value_qty_now,
                    old_qty   : value_qty_old,
                    price     : d.price,
                    disc      : d.disc,
                    subtotal  : subtotal,
                    action    : d.action,
                    item_id   : d.item_id,
                    variant_id : d.variant_id,
                    retur_penjualan_id : d.retur_penjualan_id,
                });

                updateGrandTotal();
           }
        });

        @if(Request('id'))
            getEditData();
            console.log(counter);
        @endif

        $('#submitProduk').click(function (e) {
           
           // e.preventDefault();
           
            var tgl = $('#tanggal_belanja').val();
            var tgl_pengiriman = $('#tanggal_pengiriman').val();
            var tgl_penerimaan = $('#tanggal_penerimaan').val();
            var customer = $('#customer').val();
            var ongkir = $('#ongkir').val();
            var discount_total = $('#discount_total').val();
           
            var temp_data = pembelian_table.rows().data().toArray();
           
            if (!customer) {
                 swal('Ups!','Customer tidak boleh kosong','error');
                 return;
            }
           
            if (!temp_data.length) {
                 swal('Ups!','List produk tidak boleh kosong','error');
                 return;
            }

            if (!tgl) {
                swal('Ups!','Tanggal Penjualan tidak boleh kosong','error');
                 return;
            }

            if (!tgl_pengiriman) {
                swal('Ups!','Tanggal Pengiriman tidak boleh kosong','error');
                 return;
            }

            if (!tgl_penerimaan) {
                swal('Ups!','Tanggal Penerimaan tidak boleh kosong','error');
                 return;
            }

            console.log(pembelian_table.rows().data().toArray());
            $.ajax({
                type:'post',
                url :'{{ $api_url."retur_penjualan/save" }}' ,
                data: {
                    id:'{{Request("id") ? Request("id") : 0 }}',
                    nota:$('#nota').val(),
                    _token: '{{ csrf_token() }}',
                    api_token: "{{ auth()->user()->api_token }}",
                    customer: $('#customer').val(),
                    tanggal_belanja: $('#tanggal_belanja').val(),
                    tanggal_pengiriman: $('#tanggal_pengiriman').val(),
                    tanggal_penerimaan: $('#tanggal_penerimaan').val(),
                    ongkir: parseInt($('#ongkir_kembali').val()),
                    discount_total: parseInt($('#discount_total').val()),
                    kurir:$('#kurir_kembali').val(),
                    notes:$('#notes').val(),
                    total_belanja: parseInt($('#total_belanja_hidden').val()),
                    grand_total: parseInt($('#total_hidden').val()),
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
                    console.log(response);
                   if(response.success == true){

                        location.href = "{{ route('be.retur_penjualan') }}";
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
    
    function getCustomer(id=null){
        $.ajax({
                type: 'POST',
                data: {
                    token: "{{ csrf_token() }}",
                     api_token: "{{ auth()->user()->api_token }}"
                },
                dataType: "json",
                url: '{{ $api_url."customer/table" }}',
                success: function(data){
                   var dropSupplier = '';
                   jQuery.each(data.data, function(index, item) {
                        if(id == null){
                            dropSupplier += '<option value="'+item.id+'">'+item.name+'</option>';
                        }else{
                            var selected ='';
                            if(item.id == id){
                                selected = "selected=''";
                            }else{
                                selected ='';
                            }
                            dropSupplier += '<option value="'+item.id+'" '+selected+'>'+item.name+'</option>';
                        }
                    });
                   $('#customer').html(dropSupplier);
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
                },
                error: function(data){
                    console.log(data);
                }
            });
    }

    function updateGrandTotal() {
        var temp           = 0;
        var diskon_total   = 0;
        var ongkir         = 0;
        var ongkir_kembali = 0;
        $.each(pembelian_table.rows().data().toArray(), function (i, e) {
         
            temp = temp + ((parseInt($(e.qty).val())*parseInt(e.price))-parseInt(e.disc));
        });

        var diskon_total   = $('#discount_total').val();
        var ongkir         = $('#ongkir').val();
        var ongkir_kembali = $('#ongkir_kembali').val();
        //grandtotal yg kembali ke kita kembalikan ke customer, kita kurangi dg ongkir yg customer keluarkan
        if(ongkir_kembali == ''){
            ongkir_kembali = 0;
        }
        var totals         = (temp - parseInt(diskon_total) + parseInt(ongkir)) - parseInt(ongkir_kembali);
        
        

        $('#total').val(format_number(totals));
        $('#total_hidden').val(totals);
        $('#total_belanja_hidden').val(temp);
    }

    </script>
@endpush