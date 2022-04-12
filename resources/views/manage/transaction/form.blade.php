@extends('layouts.be.be')
@section('content')
<div class="container-fluid">
    <div class="grid_layouts --two-auto">
        <div class="head-lst">
            <h5 class="page-title">
                {{ Request::get('id') ? 'Edit Transaction' : 'Add Transaction' }}
            </h5>
        </div>
        <div class="mn-rght">
            <ol class="breadcrumb">
                <li><a href="javascript:void(0)">Home</a></li>
                <li class="active">
                    <a href="{{ Request::get('id') ? route('be.transaction.edit', Request::get('id')) : route('be.transaction.create') }}">
                        {{ Request::get('id') ? 'Edit Transaction' : 'Add Transaction' }}
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
                        <h3 class="page-title">{{ Request::get('id') ? 'Edit Transaction' : 'Add Transaction' }}</h3>
                    </div>
                </div>
                <div>
                    <form class="form-vegan" id="formPenjualan" method="POST" action="#">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Transaction Code</label>
                                    <input type="hidden" name="id" id="id" value="">
                                    <input type="text" readonly="" class="form-control" id="transaction_code" name="transaction_code" value="" placeholder="Transaction Code (Auto)" required>
                                </div>
                                <div class="form-group">
                                    <label for="customer">Customer</label>
                                    <select class="form-control" id="customer" name="customer"></select>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Transaction Date</label>
                                    <input type="text" class="form-control start-date" value="" data-provide="datepicker" id="tanggal_transaksi" name="tanggal_transaksi" >
                                </div>
                                <div class="form-group">
                                    <label for="total">Notes</label>
                                    <textarea class="form-control" id="notes" name="notes" style="min-height: 150px;" placeholder="Notes"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="payment_method">Voucher</label>
                                    <select class="form-control" id="voucher" name="voucher"></select>
                                </div>
                                <div class="form-group">
                                    <label for="channel">Channel</label>
                                    <select class="form-control" id="channel" name="channel"></select>
                                </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                                    <label for="delivery_name">Delivery Name</label>
                                    <input type="text" class="form-control" id="delivery_name" name="delivery_name" value="" placeholder="Delivery Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="delivery_address">Delivery Address</label>
                                    <textarea class="form-control" id="delivery_address" name="delivery_address" style="min-height: 150px;" placeholder="Delivery Address"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="delivery_kodepos">Delivery Postal Code</label>
                                    <input type="text" class="form-control" value="" id="delivery_kodepos" name="delivery_kodepos" placeholder="Delivery Kodepos">
                                </div>
                                <div class="form-group">
                                    <label for="delivery_phone">Delivery Phone</label>
                                    <input type="text" class="form-control" value="" id="delivery_phone" name="delivery_phone" placeholder="Delivery Phone">
                                </div>
                                <div class="form-group">
                                    <label for="payment_method">Payment Method</label>
                                    <select class="form-control" id="payment_method" name="payment_method"></select>
                                </div>
                                <div class="form-group">
                                    <label for="nomor_resi">Nomor Resi</label>
                                    <input type="text" name="nomor_resi" id="nomor_resi" class="form-control" placeholder="Nomor Resi">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="province">Province</label>
                                    <select class="form-control" id="province" onchange="getCity()" name="province"></select>
                                </div>
                                <div class="form-group">
                                    <label for="district">District / City</label>
                                    <select class="form-control" id="district" onchange="getSubDistrict()" name="district"></select>
                                </div>
                                <div class="form-group">
                                    <label for="subdistrict">Sub District</label>
                                    <select  onchange="getCost()" class="form-control" id="subdistrict" name="subdistrict"></select>
                                </div>
                                <div class="form-group">
                                    <label for="kurir">Courier</label>
                                    <select onchange="getCost()" class="form-control" id="kurir" name="kurir"></select>
                                </div>
                                <div class="form-group">
                                    <label for="weight">Weight (gram)</label>
                                    <input onkeyup="getCost()" type="number" value="1000" class="form-control" id="weight" name="weight">
                                </div>
                                <div class="form-group">
                                    <label for="weight">Service</label>
                                    <select onchange="showCost()" class="form-control" id="service" name="service"></select>
                                </div>
                                <div class="form-group">
                                    <label for="discount">Discount</label>
                                    <input type="text" class="form-control" value="0" id="discount" onkeyup="updateGrandTotal();" name="discount">
                                    <input type="hidden" class="form-control" value="0" id="discount_hidden" name="discount_hidden">
                                </div>
                                <div class="form-group">
                                    <label for="shipping_fee">Shipping Fee</label>
                                    <input type="text" class="form-control" readonly="" value="0" id="shipping_fee" onkeyup="updateGrandTotal();" name="shipping_fee">
                                    <input type="hidden" class="form-control" value="0" id="shipping_fee_hidden" name="shipping_fee_hidden">
                                </div>
                                 <div class="form-group">
                                    <label for="komisi">Komisi Marketplace<small><i>*) opsional</i></small></label>
                                    <input type="text" class="form-control" value="0" id="komisi" onkeyup="updateGrandTotal();" name="komisi">
                                </div>
                                <div class="form-group">
                                    <label for="bea_admin">Bea Admininstrasi<small><i>*) opsional</i></small></label>
                                    <input type="text" class="form-control" value="0" id="bea_admin" onkeyup="updateGrandTotal();" name="bea_admin">
                                </div>
                                  <div class="form-group">
                                    <label for="bea_layanan">Bea Layanan<small><i>*) opsional</i></small></label>
                                    <input type="text" class="form-control" value="0" id="bea_layanan" onkeyup="updateGrandTotal();" name="bea_layanan">
                                </div>
                                <div class="form-group">
                                    <label for="total">Total</label>
                                    <input type="text" class="form-control" readonly="" value="0" id="total" name="total">
                                    <input type="hidden" class="form-control" readonly="" value="0" id="total_hidden" name="total_hidden" >
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="grid_layouts --two-auto">
                            <div class="head-lst">
                                <h3 class="page-title">Transaction List</h3>
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
                                            <th width="5%">No.</th>
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
                            <a href="{{route('be.transaction')}}" class="btn btn-warning">Cancel</a>
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
                        <select id="product_variant" onchange="changeVariant()" name="product_variant" class="form-control select2" required="" style="width:100%">
                            <option value="">- no variant</option>
                        </select>
                    </div>
                </div>
                <div class="input-group mb-4">
                    <label for="stock" class="col-sm-3 col-form-label">Stock</label>
                    <div class="col-sm-9">
                        <input type="number" id="stock" readonly="" name="stock" class="form-control" value="0" aria-label="Stock" aria-describedby="Stock" placeholder="Stock" required pattern="[0-9]*" min="0">
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
        var pembelian_table;
        var counter = 1;
        var data_edit;
        var province_id;
        var id_product_now = 0;
        var id_product_variant_now = 0;
        var current_shipping_fee = 0; 
        var current_service;
        var current_subdistrict;
        var current_customer_id = 0;
        var total_belanja = 0;
     
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
              getProductInfo();
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

        $('#discount').on('keyup',function(){
            
            $('#discount_hidden').val(eval($('#discount').val()));

            if($('#discount').val() == ''){
                $('#discount_hidden').val(0);
            }

            updateGrandTotal();
        });

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
                    { data:"no" },
                    { data:"item" },
                    { data:"variant" },
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

            $('#voucher').on('change',function(){
                console.log(this);

                $.ajax({
                    type: 'POST',
                    data: {
                        token: "{{ csrf_token() }}",
                         api_token: "{{ auth()->user()->api_token }}",
                         voucher_id: $('#voucher').find(":selected").val(),
                         customer_id: $('#customer').find(":selected").val(),
                         total_belanja:total_belanja
                    },
                    dataType: "json",
                    url: "{{ $api_url.'voucher/detail' }}",
                    success: function(data){
                        if(data.success == false){
                            swal('Ups!',data.data,'error');

                            return;
                        }else{
                            var temp = 0;
                            $.each(pembelian_table.rows().data().toArray(), function (i, e) {
                                temp = temp + ((parseInt(e.qty)*parseInt(e.price))-parseInt(e.disc));
                            });
                          
                            if(temp < data.data.min_pembelanjaan){
                                swal('Ups!','Minimal belanja belum memenuhi','error');

                                return;
                            }else{
                                swal('Success','Anda dapat diskon sebesar '+data.data.disc_idr,'success');
                                
                                $('#discount').val(data.data.disc_idr);
                                $('#discount_hidden').val(data.data.disc_idr);
                            }
                        }
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            })

            $('#pembelianDaftar').on( 'click', 'tbody tr .editDetail', function () {
                var e     = pembelian_table.row( $(this).parents('tr') );
                var d     = e.data();
                is_edit   = true;
                console.log(d);
                data_edit = e;
                id_product_now = d.item_id;
                id_product_variant_now = d.variant_id;

                $('#modalDetail #product').val(d.item_id);
                $('#modalDetail #qty').val(d.qty);
                $('#modalDetail #harga_satuan').val(d.price);
                $('#modalDetail #diskon').val(d.disc);
                $('#modalDetail #subtotal').val(d.subtotal);
                $('#modalDetail').modal();
            });

            $('#district').on('change',function(){
                current_shipping_fee = 0;
                 swal({
                            title: "Please wait",
                            text: "Your request is being processed",
                            showConfirmButton: false,
                        });
                getCost();
            });

            @if(Request('id'))
                getEditData();

                //console.log(counter);
            @else
               getCustomer();
               getProvince();
               getPaymentMethod();
               //getVoucher();
               getChannel();
            @endif
            
            getProduct();   
          
            $('#submitProduk').click(function (e) {
              var customer         = $('#customer').val();
              var tanggal_transaksi = $('#tanggal_transaksi').val();
              var delivery_name    = $('#delivery_name').val();
              var delivery_address = $('#delivery_address').val();
              var delivery_phone   = $('#delivery_phone').val();
              var delivery_kodepos = $('#delivery_kodepos').val();
              var province         = $('#province').val();
              var district         = $('#district').val();
              var total            = $('#total').val();
              var service            = $('#service').val();
              var payment_method            = $('#payment_method').val();
              var temp_data        = pembelian_table.rows().data().toArray();
               
                if (!customer) {
                     swal('Ups!','Customer tidak boleh kosong','error');
                     return;
                }

                if (!payment_method) {
                     swal('Ups!','Payment Method tidak boleh kosong','error');
                     return;
                }
               
                if (!temp_data.length) {
                     swal('Ups!','List produk tidak boleh kosong','error');
                     return;
                }

                if (!tanggal_transaksi) {
                    swal('Ups!','Tanggal Transaksi tidak boleh kosong','error');
                     return;
                }

                if (!delivery_name) {
                    swal('Ups!','Delivery Name tidak boleh kosong','error');
                     return;
                }

                if (!delivery_address) {
                    swal('Ups!','Delivery Address tidak boleh kosong','error');
                     return;
                }

                if (!delivery_phone) {
                    swal('Ups!','Delivery Phone tidak boleh kosong','error');
                     return;
                }

                if (!delivery_kodepos) {
                    swal('Ups!','Delivery Kodepos tidak boleh kosong','error');
                     return;
                }

                if (!province) {
                    swal('Ups!','Province tidak boleh kosong','error');
                     return;
                }

                if (!district) {
                    swal('Ups!','District tidak boleh kosong','error');
                     return;
                }

                if (!total) {
                    swal('Ups!','Total tidak boleh kosong','error');
                     return;
                }

               // console.log(pembelian_table.rows().data().toArray());
                $.ajax({
                    type:'post',
                    url :'{{ $api_url."transaction/save" }}' ,
                    data: {
                        id:'{{Request("id") ? Request("id") : 0 }}',
                        _token: '{{ csrf_token() }}',
                        api_token: "{{ auth()->user()->api_token }}",
                        customer: $('#customer').val(),
                        tanggal_transaksi: $('#tanggal_transaksi').val(),
                        delivery_name: $('#delivery_name').val(),
                        delivery_address: $('#delivery_address').val(),
                        delivery_phone: $('#delivery_phone').val(),
                        delivery_kodepos: $('#delivery_kodepos').val(),
                        service: $('#service').val(),
                        province: $('#province').val(),
                        district: $('#district').val(),
                        subdistrict : $('#subdistrict').val(),
                        notes:$('#notes').val(),
                        shipping_fee:$('#shipping_fee_hidden').val(),
                        komisi:$('#komisi').val(),
                        bea_admin:$('#bea_admin').val(),
                        bea_layanan:$('#bea_layanan').val(),
                        discount:parseInt($('#discount_hidden').val()),
                        grand_total: parseInt($('#total_hidden').val()),
                        courier_id : $('#kurir').val(),
                        payment_method : $('#payment_method').val(),
                        voucher : $('#voucher').val(),
                        nomor_resi:$('#nomor_resi').val(),
                        channel:$('#channel').val(),
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
                        console.log(response.success);
 
                        if(response.success == true){

                            location.href = "{{ route('be.transaction') }}";
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

        function getChannel(id=null){
            let channels = [
                    ['WhatsApp', 1],
                    ['Instagram', 2],
                    ['Marketplace', 3]
                ];

            var dropChannel = '<option value="">- Pilih channel</option>';
                   jQuery.each(channels, function(index, item) {
                    console.log(item[0]);
                    if(id == null){
                        dropChannel += '<option value="'+item[1]+'">'+item[0]+'</option>';
                    }else{
                        var selected ='';
                        if(item[1] == id){
                            selected = "selected=''";
                        }else{
                            selected ='';
                        }
                        dropChannel += '<option value="'+item[1]+'" '+selected+'>'+item[0]+'</option>';
                    }
                });
               //console.log(dropChannel);
               $('#channel').html(dropChannel);
        }

        function getEditData(){
         $.ajax({
                type:'post',
                url :'{{ $api_url."transaction/edit" }}' ,
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
                  
                    current_service = response.data.shipping_type;
                    current_shipping_fee = response.data.shipping_fee;
                    current_subdistrict = response.data.kecamatan_id;  
                    getCustomer(response.data.customer_id);    
                    getProvince(response.data.provinsi_id,response.data.kabupaten_id);
                    getCourier(response.data.courier_id);
                    getPaymentMethod(response.data.payment_id);
                    getVoucher(response.data.voucher_id);
                    getChannel(response.data.channel);

                    $('#total').val(response.data.grandtotal);
                    $('#notes').val(response.data.notes);
                    $('#total_hidden').val(parseInt(response.data.grandtotal));
                    $('#transaction_code').val(response.data.transaction_code);
                    $('#tanggal_transaksi').val(response.data.transaction_date);
                    $('#delivery_name').val(response.data.delivery_nama);
                    $('#delivery_address').val(response.data.delivery_alamat);
                    $('#delivery_phone').val(response.data.delivery_hp);
                    $('#delivery_kodepos').val(response.data.delivery_kodepos);
                    $('#notes').val(response.data.notes);
                    $('#shipping_fee_hidden').val(parseInt(response.data.shipping_fee));
                    $('#shipping_fee').val(format_number(response.data.shipping_fee));
                    $('#bea_admin').val(response.data.bea_admin);
                    $('#bea_layanan').val(response.data.bea_layanan);
                    $('#komisi').val(response.data.komisi);
                    $('#discount_hidden').val(eval(response.data.diskon));
                    $('#discount').val(response.data.diskon);
                    $('#total_hidden').val(eval(response.data.grandtotal));
                    $('#total').val(format_number(response.data.grandtotal));
                    $('#nomor_resi').val(response.data.no_resi);

                    var subtotals = 0;
                    jQuery.each(response.details, function(index, item) {
                       subtotals = item.price * item.qty;
                       var button = '<a href="javascript:void(0)" class="btn btn-circle btn-danger delete-row"><i class="fas fa-trash"></i></a>';
                      
                       pembelian_table.row.add({
                            no        : counter,
                            item      : item.product.name,
                            variant   : item.size_name,
                            qty       : item.qty,
                            price     : item.price,
                            disc      : item.diskon,
                            subtotal  : subtotals,
                            action    : button,
                            item_id   : item.product.id,
                            variant_id: item.product_size_id,
                            detail_id : item.id,
                        }).draw();
                        counter++;
                    });
                      swal.close();
                }
            });
        }

        function getVoucher(id=null){
            console.log('vb '+total_belanja);
            $.ajax({
                type: 'POST',
                data: {
                    token: "{{ csrf_token() }}",
                     api_token: "{{ auth()->user()->api_token }}",
                     customer_id: $('#customer').find(":selected").val()
                },
                dataType: "json",
                url: "{{ $api_url.'voucher/by_customer' }}",
                success: function(data){
                    
                   var dropSupplier = '<option value="">- Pilih Voucher</option>';
                   jQuery.each(data.data, function(index, item) {
                        if(id == null){
                            dropSupplier += '<option value="'+item.id+'">'+item.title+'</option>';
                        }else{
                            var selected ='';
                            if(item.id == id){
                                selected = "selected=''";
                            }else{
                                selected ='';
                            }
                            dropSupplier += '<option value="'+item.id+'" '+selected+'>'+item.title+'</option>';
                        }
                    });
                   //console.log(dropSupplier);
                   $('#voucher').html(dropSupplier);
                },
                error: function(data){
                    console.log(data);
                }
            });
        }

        
        function getPaymentMethod(id=null){
          $.ajax({
                type: 'POST',
                data: {
                    token: "{{ csrf_token() }}",
                     api_token: "{{ auth()->user()->api_token }}"
                },
                dataType: "json",
                url: '{{ $api_url."payment/get_method" }}',
                success: function(data){
                    
                   var dropMethod = '<option value="">- Pilih method</option>';
                   jQuery.each(data.data, function(index, item) {
                        if(id == null){
                            dropMethod += '<option value="'+item.id+'">'+item.method+'</option>';
                        }else{
                            var selected ='';
                            if(item.id == id){
                                selected = "selected=''";
                            }else{
                                selected ='';
                            }
                            dropMethod += '<option value="'+item.id+'" '+selected+'>'+item.method+'</option>';
                        }
                    });
                   //console.log(dropMethod);
                   $('#payment_method').html(dropMethod);
                },
                error: function(data){
                    console.log(data);
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
                    
                   var dropSupplier = '';
                   
                   jQuery.each(data, function(index, item) {
                        if(id == null){
                            dropSupplier += '<option value="'+item.kode+'">'+item.name+'</option>';
                        }else{
                            var selected ='';
                            if(item.kode == id){
                                selected = "selected=''";
                            }else{
                                selected ='';
                            }
                            dropSupplier += '<option value="'+item.kode+'" '+selected+'>'+item.name+'</option>';
                        }
                    });
                   //console.log(dropSupplier);
                   $('#kurir').html(dropSupplier);
                },
                error: function(data){
                    console.log(data);
                }
            });
        }

        function getProvince(prov_id=null,kab_id = null){
           
             $.ajax({
                type: 'POST',
                data: {
                    token: "{{ csrf_token() }}",
                },
                url: '{{ $api_url."shipping/get_province" }}',
                dataType: "json",
                beforeSend: function () {
                   swal({
                        title: "Please wait",
                        text: "Downloading data Province & City",
                        showConfirmButton: false,
                    });
                },
                success: function(data){
                 // console.log(data);
                 
                   var dropProvince = '';
                   jQuery.each(data.rajaongkir.results, function(index, item) {
                         if(prov_id == null){
                            dropProvince += '<option value="'+item.province_id+'">'+item.province+'</option>';
                        }else{
                            var selected ='';
                            if(item.province_id == prov_id){
                                selected = "selected=''";
                            }else{
                                selected ='';
                            }
                            dropProvince += '<option value="'+item.province_id+'" '+selected+'>'+item.province+'</option>';
                        }
                    });
                   $('#province').html(dropProvince);
                   @if(Request::get('id') == null)
                   getCity();
                   getCourier();
                   @else
                   getCity(prov_id,kab_id);
                   @endif
                },
                error: function(data){
                    console.log(data);
                }
            });
        }

        function getCity(prov_id=null,kab_id=null){

            var province_id;

            if(prov_id){
                province_id = prov_id;
            }else{
                province_id = $('#province').val();
            }

             $.ajax({
                type: 'POST',
                beforeSend: function () {
                   swal({
                        title: "Please wait",
                        text: "Downloading data Province & City",
                        showConfirmButton: false,
                    });
                },
                data: {
                    token: "{{ csrf_token() }}",
                    province_id:province_id,
                },
                dataType: "json",
                url: '{{ $api_url."shipping/get_city" }}',
                success: function(data){
                  //console.log(data);
                 
                   var dropCity = '';
                   jQuery.each(data.rajaongkir.results, function(index, item) {
                         if(kab_id == null){
                            dropCity += '<option value="'+item.city_id+'">'+item.type+' '+item.city_name+'</option>';
                        }else{
                            var selected ='';
                            if(item.city_id == kab_id){
                                selected = "selected=''";
                            }else{
                                selected ='';
                            }
                            dropCity += '<option value="'+item.city_id+'" '+selected+'>'+item.type+' '+item.city_name+'</option>';
                        }
                    });
                   $('#district').html(dropCity);
                  // getCost();
                  getSubDistrict();
                },
                error: function(data){
                    console.log(data);
                }
            });
        }

        function getSubDistrict(){
            swal.close();
            var province_id = $('#province').val();
            var city_id = $('#district').val();
             $.ajax({
                type: 'POST',
                data: {
                    token: "{{ csrf_token() }}",
                    city_id:city_id,
                },
                dataType: "json",
                url: '{{ $api_url."shipping/get_subdistrict" }}',
                success: function(data){
                 
                   var dropProduct = '';
                  // console.log(data.rajaongkir.results);
                   jQuery.each(data.rajaongkir.results, function(index, item) {
                    
                        if(current_subdistrict == item.subdistrict_id){
                            var selected ='';
                            selected = "selected=''";

                            dropProduct += '<option value="'+item.subdistrict_id+'" '+selected+'>'+item.subdistrict_name+'</option>'
                        }else{
                            dropProduct += '<option value="'+item.subdistrict_id+'">'+item.subdistrict_name+'</option>'
                        }
                    });
                   $('#subdistrict').html(dropProduct);
                   getCost();
                },
                error: function(data){
                    console.log(data);
                }
            });
        }

        function getCost(){
            
            var subdistrict = $('#subdistrict').val();
             $.ajax({
                type: 'POST',
                data: {
                    token: "{{ csrf_token() }}",
                    destination:subdistrict,
                    weight:$('#weight').val(),
                    courier:$('#kurir').val()
                },
                beforeSend: function () {
                   swal({
                        title: "Please wait",
                        text: "Downloading data Shipping Service",
                        showConfirmButton: false,
                    });
                },
                dataType: "json",
                url: '{{ $api_url."shipping/get_cost" }}',
                success: function(data){
                    var dropProduct = ''
                    jQuery.each(data.data.rajaongkir.results[0].costs, function(index, item) {
                        console.log(item);
                        if(item.service == current_service){
                            var selected ='';
                            selected = "selected=''";
                            
                            dropProduct += '<option data-cost="'+item.cost[0].value+'" value="'+item.service+'" '+selected+'>'+item.service+' - '+item.description+' | '+item.cost[0].etd+' hari</option>';
                        }else{
                            dropProduct += '<option data-cost="'+item.cost[0].value+'" value="'+item.service+'">'+item.service+' - '+item.description+' | '+item.cost[0].etd+' hari</option>';
                        }
                    });

                    $('#service').html(dropProduct);
               
                         if(current_shipping_fee == 0){
                           var cost = $('#service').children('option:selected').data('cost');
                           $('#shipping_fee').val(format_number(cost));
                           $('#shipping_fee_hidden').val(cost);
                            updateGrandTotal();
                       }
                  
                   swal.close();
                },
                error: function(data){
                    console.log(data);
                }
            });
        }

        function showCost(){
            var cost = $('#service').children('option:selected').data('cost');
           
             //if(current_shipping_fee == 0){
                   $('#shipping_fee').val(format_number(cost));
                   $('#shipping_fee_hidden').val(cost);
               //}
            updateGrandTotal();
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
                            variant += '<option data-stock="'+e.stock+'" value="'+e.id+'">'+e.name+'</option>';
                        });
                        

                    }else{
                        variant += '<option value="">- no variant</option>';
                    }
                    

                    
                    $('#product_variant').html(variant);

                    if(data.product.size.length > 0){   
                      $('#stock').val($('#product_variant').children('option:selected').data('stock'));
                    }else{
                      $('#stock').val(data.product.stock);
                    }

                    $('#modalDetail #harga_satuan').val(data.product.price);

                    if(data.product.discount_type == 1)
                    {
                        //nominal
                        $('#modalDetail #diskon').val(data.product.discount);
                    }
                    else if(data.product.discount_type == 2)
                    {
                        //persen    
                        var harga_satuan = data.product.price;
                        var diskon       = data.product.discount;
                        var findiskon    = diskon/100 * harga_satuan;


                        $('#qty').val(1);

                        $('#modalDetail #diskon').val(findiskon);
                    }

                    var total = ($('#qty').val() * $('#harga_satuan').val()) - $('#diskon').val();
                    $('#subtotal').val(total);
                },
                error: function(data){
                    console.log(data);
                }
            });
        }

        function changeVariant(){
             var stock = $('#product_variant').children('option:selected').data('stock');
             $('#stock').val(stock);
        }

        function format_number(val) {
            return val.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        }

        function updateGrandTotal() {
            var temp = 0;
            $.each(pembelian_table.rows().data().toArray(), function (i, e) {
                 temp = temp + ((parseInt(e.qty)*parseInt(e.price))-parseInt(e.disc));
            });

            total_belanja = temp;
            console.log('n '+total_belanja)
            var shipping_fee = $('#shipping_fee_hidden').val();
            var discount     = $('#discount_hidden').val();

            if(isNaN(discount)){
                discount  = 0;
            }
            var ttl          = temp + parseInt(shipping_fee) - discount;
           
            $('#total').val(format_number(ttl));
            $('#total_hidden').val(ttl);
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
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
        }

        function getCustomer(id=null){
        $.ajax({
                type: 'POST',
                data: {
                    token: "{{ csrf_token() }}",
                    api_token: "{{ auth()->user()->api_token }}",
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
                   getVoucher();
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
            var stock = $('#stock').val();
            var sat = $('#harga_satuan').val();
            var msg = [];

            if (!qty || qty == 0) {
                err++;
                msg.push('Qty');
            }
         
            if(parseInt(qty) > parseInt(stock)){
               swal('Ups!','Qty tidak boleh melebih stock','error');
               
               return;
            }  

            if (!sat || sat == 0) {
                err++;
                msg.push('Harga Satuan');
            }

            if (!err) {
                $.each(pembelian_table.rows().data().toArray(), function (i, e) {
                    console.log(e);
                    if(e.variant_id == ""){
                        if($('#product').val() != id_product_now){
                            if($('#product').val() == e.item_id){
                                swal('Warning','Produk sudah pernah ada di daftar','error');
                                 e.remove();
                                return;
                            }
                        }  
                    }else{
                        if($('#product_variant').val() != id_product_variant_now){
                            if($('#product_variant').val() == e.variant_id){
                                swal('Warning','Produk Variant / size sudah pernah ada di daftar','error');
                                 e.remove();
                                return;
                            }
                        }  
                    }
                });

                var variantz = '';

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
                        qty       : $('#qty').val(),
                        price     : $('#harga_satuan').val(),
                        disc      : $('#diskon').val(),
                        subtotal  : $('#subtotal').val(),
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
                        qty       : $('#qty').val(),
                        price     : $('#harga_satuan').val(),
                        disc      : $('#diskon').val(),
                        subtotal  : $('#subtotal').val(),
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
    </script>
@endpush
