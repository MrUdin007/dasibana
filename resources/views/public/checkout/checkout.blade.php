@extends('layouts.fe.fe')

@section('metadata')
    <title>Veganesia - Checkout</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/checkout/checkout.css') }}">
@endpush

@section('content')
    <div class="checkout-section">
        <section class="container">
            <form id="formPenjualan" action="{{ route('order') }}" class="form-vegan" method="post" enctype="multipart/form-data">
                {{--<form action="" class="form-vegan" id="formPenjualan" autocomplete="off" enctype="multipart/form-data">--}}
                @csrf
                <input type="hidden" name="name_baru" id="name_baru">
                <input type="hidden" name="address_baru" id="address_baru">
                <input type="hidden" name="kodepos_baru" id="kodepos_baru">
                <input type="hidden" name="nohp_baru" id="nohp_baru">
                <input type="hidden" name="kecamatan_id_baru" id="kecamatan_id_baru">
                <input type="hidden" name="provinsi_id_baru" id="provinsi_id_baru">
                <input type="hidden" name="kabupaten_id_baru" id="kabupaten_id_baru">
                <input type="hidden" name="shipping_code" id="shipping_code">
                <input type="hidden" name="shipping_type" id="shipping_type">
                <input type="hidden" name="courier_id" id="courier_id">
                <input type="hidden" name="paymentmethod" id="payment_id">
                <input type="hidden" name="shipingFee" id="shipingFee">
                <input type="hidden" name="rebuy" value="{{$rebuy}}" id="isrebuy">
                <div class="head-content-checkout">
                    <h6 class="f-Asap_medium text-capitalize mb-0" style="color: color: rgba(0, 0, 0, 0.8);">checkout</h6>
                </div>
                <div class="body-content-checkout">
                    <div class="body-checks">
                        <div class="profile-sec">
                            <div id="addr_sec" @if($customer->name == null) style="padding-bottom: 30px;" @endif class="list-profile address-sec @if($customer->address != null || $customer->provinsi_id != null) --active-lists @endif">
                                <div class="chcks">
                                    <div class="chck-icn">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                                <div class="ct-profile-frms">
                                    <h5 class="subtitle-chk text-capitalize">
                                        alamat pengiriman
                                    </h5>
                                    <h6 class="profile-name" id="name_old">
                                        @if($customer->name != null)
                                        {{$customer->name}}
                                        @endif
                                        <input type="hidden" id="customer_id" name="customer_id" value="{{$customer->id}}">
                                    </h6>
                                    <article class="profile-address">
                                        <p class="mb-0">
                                            @if($customer->address != null)
                                            <span id="address_old">Alamat Lengkap : {!! strip_tags($customer->address) !!}</span><br>
                                            @endif
                                            @if($customer->provinsi_id != null)
                                            <span id="provinsi_old_lbl">Provinsi : {{$customer->fetch_destination('province')}}</span><br>
                                            @endif
                                            @if($customer->kecamatan_id != null)
                                            <span id="kecamatan_old_lbl">Kabupaten : {{$customer->fetch_destination('city')}}</span><br>
                                            @endif
                                            @if($customer->kabupaten_id != null)
                                            <span id="kebupaten_old_lbl">Kecamatan : {{$customer->fetch_destination('subdistrict_name')}}</span><br>
                                            @endif
                                            @if($customer->post_code != null)
                                            <span id="kode_pos_old_lbl">Kode Pos : {{$customer->post_code}}</span>
                                            @endif
                                        </p>
                                    </article>
                                </div>
                                <div class="btn-address">
                                    <a class="text-capitalize btn-vegan --transparent-btn edit-alamat">
                                        @if($customer->address == null || $customer->provinsi_id == null)
                                        tambah alamat
                                        @else
                                        ganti alamat
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <div id="crr_sec" class="list-profile courier-sec">
                                <div class="chcks">
                                    <div class="chck-icn">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                                <h5 class="subtitle-chk text-capitalize">
                                    pilih kurir
                                </h5>
                                <div class="dropdown choose-courier-dropdown">
                                    <div class="--scrlbrr courier_list form-vegan d-none" id="--mdl-kurir"></div>
                                    @if($customer->address == null || $customer->provinsi_id == null)
                                    <a class="text-capitalize btn-vegan choose-courier-pt choose-courier choose-courier-nonactive">
                                    @else
                                    <a class="text-capitalize btn-vegan choose-courier-pt" id="choose-courier">
                                    @endif
                                        <div id="labelkurir">
                                            <p class="mb-0 text-left">pilih kurir</p>
                                        </div>
                                        <span>
                                            <div class="icn icn-arrow"></div>
                                        </span>
                                    </a>
                                    <div class="dropdown-menu choose-courier-menu lg-pt-prfl">
                                        <div class="--scrlbrr courier_list form-vegan" id="--mdl-kurir"></div>
                                    </div>
                                </div>
                                <div>
                                    @if($customer->address == null || $customer->provinsi_id == null)
                                    <a class="btn-vegan add-notes text-capitalize choose-courier-nonactive">
                                    @else
                                    <a id="add-notes" class="btn-vegan add-notes text-capitalize">
                                    @endif
                                        <span>
                                            <div class="icn icn-pencil"></div>
                                        </span>
                                        Tambah catatan pengiriman
                                    </a>

                                    <div id="addcatatan" class="main-form-vg d-none">
                                        <div class="grid_layouts gr-edit-catatan">
                                            <div class="input-group search-inputs" id="input_notes">
                                                <input type="text" class="form-control add_notes" id="add_notes" maxlength="144" name="data_catatan" aria-describedby="notes" placeholder="Tambah Catatan">
                                                <div class="input-group-prepend group-prepend-notes d-none">
                                                    <span class="input-group-text" id="search">
                                                        <a id="icn-closed" class="icn-closed" type="button"></a>
                                                    </span>
                                                </div>
                                            </div>
                                            <div>
                                                <a id="editnotes" class="d-none btn-vegan txt-btn edit-catatan-btn f-Asap_medium text-capitalize">edit catatan pengirim</a>
                                            </div>
                                        </div>
                                        <p id="character-notes"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-list-sec">
                            <h5 class="subtitle-chk text-capitalize">
                                daftar belanja (<span id="total_all" class="constantformatnumberCN" data-content="{{count($carts)}}">{{count($carts)}}</span>)
                            </h5>
                            <div class="lists-carts --scrlbrr">
                                <div class="gr-mob-lst">
                                    @foreach($carts as $cart)
                                    @if($cart->product->stock != 0)
                                    <div class="grid_layouts gr-ls-carts">
                                        <div class="cover-product img-lazy" data-src="{{$cart->product->cover_image}}"></div>
                                        <div class="desc-product">
                                            <h6 class="f-Asap_medium mb-0">
                                                {{$cart->product->name}} 
                                                @if($cart->product->is_variant == true) 
                                                <div type="hidden" name="idvarian" value="{{$cart->product_variant->id}}">
                                                <div class="idvarians" data-id="{{$cart->product_variant->id}}"></div>
                                                - ({{$cart->product_variant->name}})
                                                @endif
                                            </h6>
                                            @if($cart->product->is_variant == true) 
                                            <small class="small-fnt" style="color: red" id="productkosong_{{$cart->product_variant->id}}"></small>
                                            @else
                                            <small class="small-fnt" style="color: red" id="productkosong_{{$cart->product->id}}"></small>
                                            @endif
                                        </div>
                                        <div class="qty-product">
                                            <small>
                                                x{{$cart->qty}}
                                            </small>
                                        </div>
                                        <div class="price-product">
                                            <h6 class="f-Asap_medium mb-0">
                                                {{ $cart->product->final_price }}
                                            </h6>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="total-shopping">
                        <div class="box-total-shopping">
                            <div class="pad-sec promo-sec choose-courier-nonactive" id="voucherpart">
                                <div class="grid_layouts gr-promos-sec">
                                    <div class="main-form-vg mb-0">
                                        <input type="hidden" id="voucher_id_vegan" name="voucher_id_vegan">
                                        <input type="hidden" id="price_diskon_vegan" name="price_diskon_vegan">
                                        <input class="form-control" disabled="true" style="border-radius: 8px;" type="text" value="" id="voucher_kode_vegan" name="voucher_kode_vegan" placeholder="Punya voucher promo ?">
                                    </div>
                                    <div>
                                        <a class="setVoucher btn-vegan green-border-btn text-capitalize">
                                            pakai
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="pad-sec payment-sec">
                                <div class="list-profile pay-sec">
                                    <h5 class="ttle-paym text-capitalize d-flex align-center main-sub-text">
                                        <span class="money-icn">
                                            <small class="f-Asap_medium">Rp</small>
                                        </span>
                                        pilih metode pembayaran
                                    </h5>
                                    <div>
                                        <button id="choose-payment" class="text-capitalize btn-vegan choose-payment" data-toggle="modal" data-target="#methodPay" data-backdrop="static" data-keyboard="false" type="button">
                                            <div class="d-block labl-inpts labl-mtdpy text-capitalize clr-light-gry f-brandonText_reg">pilih metode pembayaran</div>
                                            <p class="d-none mb-0 text-left">pilih metode pembayaran</p>
                                            <span>
                                                <div class="icn icn-arrow"></div>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="pad-sec list-shop">
                                <h5 class="text-capitalize main-sub-text">
                                    rincian belanja
                                </h5>
                                <div class="rincians">
                                    <div class="grid_layouts gr-lshds">
                                        <h6 class="mb-0 text-capitalize clr-light-gry">
                                            total harga barang
                                            <input name="total_belanja" id="total_belanja" value="{{$prc}}" type="hidden">
                                        </h6>
                                        <h6 class="mb-0 prcs" id="hrgaupdate">
                                            {{$prc_value}}
                                        </h6>
                                    </div>
                                    <div class="grid_layouts gr-lshds">
                                        <h6 class="mb-0 text-capitalize clr-light-gry">jasa pengiriman</h6>
                                        <h6 class="mb-0 prcs" id="jasakirim">
                                            Rp. 0
                                        </h6>
                                    </div>
                                    <div class="grid_layouts gr-lshds d-none" id="diskonvoucher">
                                        <h6 class="mb-0 text-capitalize clr-light-gry">potongan promo</h6>
                                        <h6 class="mb-0 prcs" id="potongandiskonvoucher"></h6>
                                    </div>
                                    <div class="grid_layouts gr-lshds d-none" id="diskonongkir">
                                        <h6 class="mb-0 text-capitalize clr-light-gry">potongan ongkir</h6>
                                        <h6 class="mb-0 prcs" id="potongandiskonongkir"></h6>
                                    </div>
                                </div>
                                <div class="total-box-flts">
                                    <div class="grid_layouts gr-lshds">
                                        <h5 class="mb-0 text-capitalize main-sub-text">
                                            total belanja :
                                            <input name="grand_total" id="grand_total" value="{{$prc}}" type="hidden">
                                        </h5>
                                        <input type="hidden" id="cektotalbelanja" value="{{$prc}}">
                                        <h5 class="mb-0 prcs main-sub-text" id="totalbelanjavegan" style="color: #E24667;">
                                            {{$prc_value}}
                                        </h5>
                                    </div>
                                </div>
                                <button class="btn-vegan btn-buys f-Asap_medium" id="save" type="submit">
                                    bayar belanjaan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Start Modal Edit Alamat -->
                <div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
                    <div class="modal fade" id="editAlamat"  role="dialog" aria-labelledby="editAlamatLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-capitalize text-left desc-main-text f-Asap_medium" id="editAlamatLabel">edit alamat</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="FormEditAlamat" method="post" class="form-vegan" data-toggle="validator">
                                    @csrf
                                    <input type="hidden" id="id_cust" name="id_cust" value="{{$customer->id}}">
                                    <div class="modal-body">
                                        <div>
                                            <p class="mb-0">
                                                Info untuk menjelaskan alamat ini untuk ke checout, consectetur adipiscing elit. Dignissim ullamcorper maecenas montes, arcu sit augue donec in porttitor. 
                                            </p>
                                        </div>
                                        <div class="mt-2">
                                            <div>
                                                <label for="name_penerima" class="clr-grey-txt mb-2 f-Asap_medium">Nama Penerima <span style="color: red">*</span></label>
                                                <div class="main-form-vg">
                                                    <input required type="text" class="form-control name_old_modal" id="name_new" name="name_new" aria-describedby="username" value="{{ isset($customer) ? $customer->name : ''}}" placeholder="Nama Pengguna">
                                                </div>
                                            </div>
                                            <div>
                                                <label for="phone_penerima" class="clr-grey-txt mb-2 f-Asap_medium">Nomor HP Penerima <span style="color: red">*</span></label>
                                                <div class="main-form-vg">
                                                    <input required type="number" class="form-control" id="nohp_new" name="nohp_new" aria-describedby="nohp" value="{{ isset($customer) ? $customer->phone : ''}}" placeholder="No. HP Penerima">
                                                </div>
                                            </div>
                                            <div>
                                                <label for="provinsi_penerima" class="clr-grey-txt mb-2 f-Asap_medium">Provinsi <span style="color: red">*</span></label>
                                                <div class="main-form-vg">
                                                    <input type="hidden" id="old_provinsi_id" value="{{old('provinsi_id') ?? (isset($customer) ? $customer->fetch_destination('provinsi_id') : '')}}" required>
                                                    <div class="--custom-select">
                                                        <select class="form-control destinasi" id="provinsi_id" name="provinsi_id">
                                                            <option value="0" selected>-- Pilih Provinsi --</option>
                                                            @foreach($provinsi as $value)
                                                            @if(old('provinsi_id') == $value['province_id'])
                                                            <option value="{{$value['province_id']}}" selected>{{$value['province']}}</option>
                                                            @elseif(isset($customer) && $customer->fetch_destination('province') == $value['province_id'])
                                                            <option value="{{$value['province_id']}}" selected>{{$value['province']}}</option>
                                                            @else
                                                            <option value="{{$value['province_id']}}">{{$value['province']}}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <label for="kota_penerima" class="clr-grey-txt mb-2 f-Asap_medium">Kota / Kabupaten <span style="color: red">*</span></label>
                                                <div class="main-form-vg">
                                                    <input type="hidden" id="old_kabupaten_id" value="{{old('kabupaten_id') ?? (isset($customer) ? $customer->fetch_destination('city') : '')}}" required>
                                                    <div class="--custom-select">
                                                        <select class="text-capitalize destinasi" id="kabupaten_id" name="kabupaten_id">
                                                            <option disabled selected class="selected">-- Pilih Kabupaten --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <label for="kecamatan_penerima" class="clr-grey-txt mb-2 f-Asap_medium">Kecamatan <span style="color: red">*</span></label>
                                                <div class="main-form-vg">
                                                    <input type="hidden" id="old_kecamatan_id" value="{{old('kecamatan_id') ?? ($customer->destination_code ?? '')}}" required>
                                                    <div class="--custom-select">
                                                        <select class="text-capitalize" id="kecamatan_id" name="kecamatan_id">
                                                            <option disabled selected class="selected">-- Pilih Kecamatan --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <label for="kode_pos_penerima" class="clr-grey-txt mb-2 f-Asap_medium">Kode POS <span style="color: red">*</span></label>
                                                <div class="main-form-vg">
                                                    <div class="--custom-select">
                                                        <input required type="number" class="form-control" id="post_code" name="post_code" aria-describedby="post_code" value="{{ isset($customer) ? $customer->post_code : ''}}" placeholder="Kode POS">
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <label for="address_penerima" class="clr-grey-txt mb-2 f-Asap_medium">Alamat Lengkap <span style="color: red">*</span></label>
                                                <div class="main-form-vg">
                                                    <textarea required value="{{ isset($customer) ? $customer->address : ''}}" class="form-control address_old_modal" id="address_new" name="address_new" rows="3" placeholder="Ketik Alamat Lengkap"></textarea>
                                                </div>
                                            </div>
                                            <div class="custom-control main-form-vg custom-checkbox">
                                                <input class="custom-control-input" type="checkbox"id="simpan" name="simpan">
                                                <label class="custom-control-label text-black" for="simpan">
                                                    Jadikan sebagai alamat utama
                                                </label>
                                            </div>
                                            <div>
                                                <button class="text-capitalize btn-vegan green-bg-btn" id="saveAddress" type="button">simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:/ Modal Edit Alamat -->

                <!-- Start Modal Metode Pembayaran -->
                <div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
                    <div class="modal fade" id="methodPay" tabindex="-1" role="dialog" aria-labelledby="methodPayLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-capitalize text-left desc-main-text f-Asap_medium" id="methode">metode pembayaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body p-0">
                                    <div class="form-vegan">
                                        @foreach($payment_methods as $key => $method)
                                        @if($method->status == true)
                                        <div class="lst-mdl-kurir --method-payments">
                                            <div class="custom-radio main-form-vg">
                                                <input data-id="{{$method->id}}" type="radio" id="paymethod_{{$method->id}}" name="paymethod" class="custom-control-input payment-method-radio" value="{{$method->id}}">
                                                <label class="text-capitalize custom-control-label main-sub-text text-black" for="paymethod_{{$method->id}}">
                                                    @if($method->id == 1)
                                                    Menggunakan QRIS
                                                    @elseif($method->id == 2)
                                                    Konfirmasi Manual
                                                    @elseif($method->id == 3)
                                                    Konfirmasi Otomatis (Midtrans)
                                                    @endif
                                                </label>
                                            </div>
                                            <div>
                                                <p class="mb-0 clr-gry">
                                                    @if($method->id == 1)
                                                    Pembayaran bisa lebih cepat , pembayaran bisa dilakukan dengan aplikasi di bawah ini
                                                    @elseif($method->id == 2)
                                                    Metode ini perlu konfirmasi bukti pembayaran. transfer dapat dilakukan disalah satu nomor rekening dibank bawah ini
                                                    @elseif($method->id == 3)
                                                    Pembayaran akan di konformasi secara otomatis, bisa menggunakan salah satu metode pembayaran yang sudah disediakan.
                                                    @endif
                                                </p>
                                            </div>
                                            
                                            @if($method->id == 2)
                                            <div class="mt-3">
                                                <div class="grid_layouts --crd-mthd">
                                                    @foreach($payment_bank as $bank)
                                                        <div class="ls-bnks">
                                                            <div class="img-lazy small-lazy icon-bank-ls" data-src="{{ asset($bank->icon) }}" data-name="{{$bank->title}}"></div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        @endif
                                        @endforeach
                                        <div class="lst-mdl-kurir btn-sbmt-pymnt">
                                            <a class="text-capitalize btn-vegan green-bg-btn" id="payMthod" data-dismiss="modal">pilih</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:/ Modal Metode Pembayaran -->
            </form>
        </section>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.custom-radio input').attr('checked', false);
            $('.custom-control-input').attr('checked', false);
            $('#shipping_code').val();
            $('#shipping_type').val();
            $('#courier_id').val();
            $('#payment_id').val();
            var heigth_adrr = $('#addr_sec').height();
            var count_heigth_adrr = heigth_adrr+41;
            $('#addr_sec').css('--varHeight', count_heigth_adrr+'px');

            /********************************/
            /*Change Destination*/
            /********************************/
            $(document).on('change','.destinasi',function(){
                var provinsi_id               = $('#provinsi_id').val();
                var kabupaten_id              = $('#kabupaten_id').val();
                var kecamatan_id              = $('#kecamatan_id').val();
                var old_provinsi_id           = $('#old_provinsi_id').val();
                var old_kabupaten_id          = $('#old_kabupaten_id').val();
                var old_kecamatan_id          = $('#old_kecamatan_id').val();
                var customer_destination_code = $('#customer_id option:selected').data('destination_code');
                var customer_kecamatan_id     = $('#customer_id option:selected').data('subdistrict');
                var customer_kabupaten_id     = $('#customer_id option:selected').data('city');
                var customer_provinsi_id      = $('#customer_id option:selected').data('province');

                var current = $(this).attr('id');

                $.ajax({
                    type: 'POST',
                    url: '{{route("destination")}}',
                    data: {
                        province : provinsi_id,
                        city : kabupaten_id,
                        current : current,
                        _token: "{{csrf_token()}}"
                    },
                    dataType: 'JSON',
                    success: function(data){
                        console.log(data);
                        if (current == "kabupaten_id") {
                            $('#kecamatan_id').find('option').remove();
                            $('#kecamatan_id').append('<option value="">-- Pilih Kecamatan --</option>');

                            $.each(data,function(k,v){
                                if(customer_destination_code != old_kecamatan_id && customer_destination_code == v.subdistrict_id){
                                    $('#kecamatan_id').append('<option value="'+v.subdistrict_id+'" selected>'+v.subdistrict_name+'</option>');
                                }else if(old_kecamatan_id == v.subdistrict_id){
                                    $('#kecamatan_id').append('<option value="'+v.subdistrict_id+'" selected>'+v.subdistrict_name+'</option>');
                                }else{
                                    $('#kecamatan_id').append('<option value="'+v.subdistrict_id+'">'+v.subdistrict_name+'</option>');
                                }
                            });
                            $('#kecamatan_id').change();
                        }else if (current == "provinsi_id") {
                            $('#kabupaten_id').find('option').remove();
                            $('#kabupaten_id').append('<option value="">-- Pilih Kabupaten --</option>');
                            $('#kecamatan_id').find('option').remove();
                            $('#kecamatan_id').append('<option value="">-- Pilih Kecamatan --</option>');

                            $.each(data,function(k,v){
                                if(customer_kabupaten_id != old_kabupaten_id && customer_kabupaten_id == v.city_id){
                                    $('#kabupaten_id').append('<option value="'+v.city_id+'" selected>'+v.city_name+'</option>');
                                }else if(old_kabupaten_id == v.city_id){
                                    $('#kabupaten_id').append('<option value="'+v.city_id+'" selected>'+v.city_name+'</option>');
                                }else{
                                    $('#kabupaten_id').append('<option value="'+v.city_id+'">'+v.city_name+'</option>');
                                }
                            });
                            $('#kabupaten_id').change();
                        }
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            }).change();

            /********************************/
            /*Tambah atau Edit Alamat*/
            /********************************/
            $(document).on('click','.edit-alamat',function(){
                $.ajax({
                    type: 'GET',
                    url: '{{route("akun_setting")}}',
                    data: {
                        _token: "{{csrf_token()}}"
                    },
                    dataType: 'JSON',
                    beforeSend: function () {
                        Swal.fire({
                            title: "Mohon Menunggu",
                            text: "System sedang memproses permintaan Anda",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                        });
                    },
                    success: function(response){
                        Swal.close();
                        console.log(response);
                        if(response.success){
                            // $('#name_new').val(response.customer.name);
                            // $('#post_code').val(response.customer.kodepos);
                            // $('#address_new').val(response.customer.address);
                            // $('#nohp_new').val(response.customer.phone);

                            $.each(response.provinsi, function(i,v){
                                if (response.customer.provinsi_id == v.province_id) {
                                    $('#provinsi_id').append($('<option>', { 
                                        value: v.province_id,
                                        text : v.province,
                                        selected : true
                                    }));
                                } else {
                                    $('#provinsi_id').append($('<option>', { 
                                        value: v.province_id,
                                        text : v.province
                                    }));
                                }

                            });

                            if (response.customer.provinsi_id) {
                                $('#provinsi_id').trigger('change');
                            }
                            
                            $('#editAlamat').modal();
                        }
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            });

            $(document).on('change','#provinsi_id',function(){
                $('#old_provinsi_id').val($('#provinsi_id').val());
            });

            $(document).on('change','#kecamatan_id',function(){
                $('#old_kecamatan_id').val($('#kecamatan_id').val());
            });

            $(document).on('change','#kabupaten_id',function(){
                $('#old_kabupaten_id').val($('#kabupaten_id').val());
            });

            /********************************/
            /*Simpan Tambah atau Edit Alamat*/
            /********************************/
            $('#saveAddress').on('click', function(e){
                e.preventDefault();
                var name_new     = $('#name_new').val();
                var nohp_new     = $('#nohp_new').val();
                var provinsi_id  = $('#provinsi_id option:selected').val();
                var kecamatan_id = $('#kecamatan_id option:selected').val();
                var kabupaten_id = $('#kabupaten_id option:selected').val();
                var kode_pos_new = $('#post_code').val();
                var address_new  = $('#address_new').val();
                var id_cust      = $('#id_cust').val();
                var simpan       = $('#simpan').is(":checked");

                if(!name_new || !nohp_new || !provinsi_id || !kecamatan_id || !kabupaten_id || !kode_pos_new || !address_new || !id_cust){
                    Swal.fire({
                        title: 'Maaf',
                        text: 'Mohon diisi dengan benar semua kolom informasi yang telah disediakan',
                        type: 'error',
                        allowOutsideClick: false,
                    }).then(function() {
                        $("#FormEditAlamat").valid();
                    });
                }
                else{
                    $.ajax({
                        type: 'POST',
                        url: '{{route("checkout.address")}}',
                        data: {
                            name_new : name_new,
                            nohp_new : nohp_new,
                            provinsi_id : provinsi_id,
                            kecamatan_id : kecamatan_id,
                            kabupaten_id : kabupaten_id,
                            kode_pos_new : kode_pos_new,
                            address_new : address_new,
                            id_cust : id_cust,
                            simpan : simpan,
                            _token: "{{csrf_token()}}"
                        },
                        dataType: 'JSON',
                        beforeSend: function () {
                            Swal.fire({
                                title: "Mohon Menunggu",
                                text: "System sedang memproses permintaan Anda",
                                showConfirmButton: false,
                                allowOutsideClick: false,
                            });
                        },
                        success: function (data) {
                            Swal.close();
                            if (data.success) {
                                $('#editAlamat').modal('hide');
                                $('#--mdl-kurir').empty();
                                var html_service = '';
                                $.each(data.kurirs, function(i,v){
                                    html_service += '<div class="lst-mdl-kurir pt-kurir-sc">';
                                    if(v.kode == 'jnt'){
                                        html_service += '<div class="icn-kurirs --jnt"></div>';
                                    }
                                    else if(v.kode == 'jne'){
                                        html_service += '<div class="icn-kurirs --jne"></div>';
                                    }
                                    else if(v.kode == 'pos'){
                                        html_service += '<div class="icn-kurirs --pos"></div>';
                                    }
                                    else if(v.kode == 'sicepat'){
                                        html_service += '<div class="icn-kurirs --sicepat"></div>';
                                    }
                                        html_service += '<div class="mt-3">';
                                            $.each(v.result, function(i,r){
                                                var subid = v.name;
                                                var kurir = v.kode;
                                                var idkurir = v.id;
                                                var value = r.cost[0].value;
                                                var service =r.service;
                                                var description = r.description;

                                                var final_value = parseInt(value);
                                                var reverse = final_value.toString().split('').reverse().join(''),
                                                    ribuan  = reverse.match(/\d{1,3}/g);
                                                    ribuan  = ribuan.join('.').split('').reverse().join('');

                                                html_service += '<div class="grid_layouts gr-pckg">';
                                                html_service += '<div class="label-input-kurir">';
                                                html_service += '<div class="custom-radio main-form-vg">'; 
                                                html_service += '<input type="radio" data-namekurir="'+description+'" data-pricekurir="'+final_value+'" data-subid="'+subid+'" data-idkurir="'+idkurir+'_'+i+'" data-id="'+kurir+'_'+i+'" id="'+kurir+'_'+i+'" name="kurir" class="custom-control-input courier radio-courier" value="'+kurir+'" data-kurir="'+kurir+'" data-service="'+service+'">';
                                                html_service += '<label class="custom-control-label mid-main-sub-text text-black" for="'+kurir+'_'+i+'">'+description+'</label>';
                                                html_service += '</div>';
                                                html_service += '<h6>3-4 Hari kerja</h6>';
                                                html_service += '</div>';
                                                html_service += '<div class="--prc">';
                                                html_service += '<p class="mb-0 text-black mid-main-sub-text hargaKurir" data-kurir="'+final_value+'"> Rp'+ribuan+',00</p>';
                                                html_service += '</div>';
                                                html_service += '</div>';
                                            });
                                        html_service += '</div>';
                                    html_service += '</div>';
                                });

                                $('.courier_list').html(html_service);
                                
                                // if(data.modal){
                                //     $('#pilihKurir').modal();
                                //     $("#editNewAlamat").removeClass('edit-alamat');
                                //     $("#editNewAlamat").addClass('edit-new-alamat');
                                //     $("#choose-courier").removeClass('choose-courier');
                                //     $("#choose-courier").addClass('choose-new-courier');
                                // }

                                $('#name_old').html(name_new);
                                $('#address_old').html('Alamat Lengkap : '+address_new);
                                $('#provinsi_old_lbl').html('Provinsi : '+$('#old_provinsi_id').val());
                                $('#kecamatan_old_lbl').html('Kecamatan : '+$('#old_kecamatan_id').val());
                                $('#kebupaten_old_lbl').html('Kabupaten : '+$('#old_kabupaten_id').val());
                                $('#kode_pos_old_lbl').html('Kode Pos : '+$('#post_code').val());
                                $('.name_old_modal').val(name_new);
                                $('.address_old_modal').html(address_new);
                                $('.edit-alamat').html('ganti alamat');
                                $('#addr_sec').addClass('--active-lists');
                                $('.choose-courier').removeClass('choose-courier-nonactive');
                                $('.choose-courier').attr({
                                    'id' : 'choose-courier-new',
                                    'role' : 'button',
                                    'data-toggle' : 'dropdown',
                                    'aria-haspopup' : 'true',
                                    'aria-expanded' : 'false'
                                });
                                $('.add-notes').removeClass('choose-courier-nonactive');
                                $('.add-notes').attr('id', 'add-notes');

                                $('#name_baru').val($('#name_new').val());
                                $('#address_baru').val($('#address_new').val());
                                $('#kodepos_baru').val($('#post_code').val());
                                $('#nohp_baru').val($('#nohp_new').val());
                                $('#kecamatan_id_baru').val($('#old_kecamatan_id').val());
                                $('#kabupaten_id_baru').val($('#old_kabupaten_id').val());
                                $('#provinsi_id_baru').val($('#old_provinsi_id').val());
                                var heigth_adrr = $('#addr_sec').height();
                                var count_heigth_adrr = heigth_adrr+41;
                                $('#addr_sec').css('--varHeight', count_heigth_adrr+'px');
                            }
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                }
            });

            $(document).on('click','#choose-courier',function(){
                $.ajax({
                    url: "{{ route('cart.customer') }}",
                    method: 'GET',
                    dataType: "json",
                    beforeSend: function () {
                        Swal.fire({
                            title: "Mohon Menunggu",
                            text: "System sedang memproses permintaan Anda",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                        });
                    },
                    success: function (response) {
                        Swal.close();
                        if(response.success){
                            $('.choose-courier-menu').css('margin-top', '-10px');
                            $('#choose-courier').attr({
                                'role' : 'button',
                                'data-toggle' : 'dropdown',
                                'aria-haspopup' : 'true',
                                'aria-expanded' : 'true'
                            });
                            
                            $('.choose-courier-menu').attr('aria-labelledby', 'choose-courier-old');
                            $('#choose-courier').addClass('courier-old-menu');
                            $('.choose-courier-menu').addClass('show');
                            $('#--mdl-kurir').empty();
                            var html = '';
                            $.each(response.data, function(i,v){
                                html += '<div class="lst-mdl-kurir pt-kurir-sc">';
                                if(v.kode == 'jnt'){
                                    html += '<div class="icn-kurirs --jnt"></div>';
                                }
                                else if(v.kode == 'jne'){
                                    html += '<div class="icn-kurirs --jne"></div>';
                                }
                                else if(v.kode == 'pos'){
                                    html += '<div class="icn-kurirs --pos"></div>';
                                }
                                else if(v.kode == 'sicepat'){
                                    html += '<div class="icn-kurirs --sicepat"></div>';
                                }
                                html += '   <div class="mt-3">';
                                $.each(v.type, function(j,k){
                                    html += '   <div class="grid_layouts gr-pckg">';
                                    html += '       <div class="label-input-kurir">';
                                    html += '           <div class="custom-radio main-form-vg">';
                                    html += '               <input type="radio" data-idkurir="'+k.id+'" data-namekurir="'+k.description+'" data-pricekurir="'+k.cost[0].value+'" data-subid="'+v.name+'" data-id="'+k.service+'_'+j+'" id="'+k.service+'_'+j+'" name="kurir" class="custom-control-input radio-courier" value="'+k.service+'" data-kurir="'+v.kode+'" data-service="'+k.service+'">';
                                    html += '               <label class="custom-control-label mid-main-sub-text text-black" for="'+k.service+'_'+j+'">'+k.description+'</label>';
                                    html += '           </div>';
                                    html += '           <h6>3-4 Hari kerja</h6>';
                                    html += '       </div>';
                                    html += '       <div class="--prc">';
                                    html += '           <p class="mb-0 text-black mid-main-sub-text hargaKurir" data-kurir="'+k.cost[0].value+'">Rp. '+k.cost[0].value.toLocaleString()+',00</p>';
                                    html += '       </div>';
                                    html += '   </div>';
                                });
                                html += '   </div>';
                                html += '</div>';
                            });
                            $('.courier_list').html(html);
                        }
                    },
                    error : function (xhr) {
                    }
                })
            });

            $(document).on('click','#choose-courier-old',function(e){
                $('.choose-courier-menu').addClass('show');
                $('.choose-courier-menu').css('margin-top', '10px');
                $(this).attr({
                    'aria-expanded' : 'true'
                });
            });

            $(document).on('click','.radio-courier',function(e){
                var id_kurir = $('.radio-courier:checked').data('id');
                var data_id_kurir = $('.radio-courier:checked').data('idkurir');
                var data_code_kurir = $('.radio-courier:checked').data('kurir');
                var price_kurir = $('.radio-courier:checked').data('pricekurir');
                var sub_name_kurir = $('.radio-courier:checked').data('subid');
                var name_kurir = $('.radio-courier:checked').data('namekurir');
                $('#labelkurir p').text(sub_name_kurir+' - '+name_kurir);
                $('.choose-courier-pt').css({
                    'color' : '#000000',
                    'width' : 'auto'
                });
                $('.courier-old-menu').attr({
                    'aria-expanded' : 'false',
                    'id' : 'choose-courier-old'
                });
                $('.choose-courier-menu').removeClass('show');
                $('#crr_sec').addClass('--active-lists');
                $('#shipping_code').val(data_id_kurir);
                $('#shipping_type').val(data_code_kurir);
                $('#courier_id').val(id_kurir);
                $('#shipingFee').val(price_kurir);
                var reverse_fee_kurir = price_kurir.toString().split('').reverse().join(''),
                    ribuan_fee_kurir  = reverse_fee_kurir.match(/\d{1,3}/g);
                    ribuan_fee_kurir  = ribuan_fee_kurir.join('.').split('').reverse().join('');
                $('#jasakirim').text('Rp. '+ribuan_fee_kurir+',00');

                var hitungtotal_belanja= $('#total_belanja').val();
                var price_totalbelanja = parseInt(hitungtotal_belanja) + parseInt(price_kurir);
                var reverse_hitungs = price_totalbelanja.toString().split('').reverse().join(''),
                    ribuan_hitungs  = reverse_hitungs.match(/\d{1,3}/g);
                    ribuan_hitungs  = ribuan_hitungs.join('.').split('').reverse().join('');
                $('#totalbelanjavegan').text('Rp. '+ribuan_hitungs+',00');
                $('#grand_total').val(price_totalbelanja);
                $('#voucherpart').removeClass('choose-courier-nonactive');
                $('#voucher_kode_vegan').attr('disabled', false);
                $('.setVoucher').attr('id', 'setVoucher');
            });

            /********************************/
            /*Add Notes Input Width Auto*/
            /********************************/
            var widths = $('#add_notes').val().length;
            var count_width = (widths + 1) * 8;
            if(widths > 34){
                $('#input_notes').css('width', count_width+'px');
                $('#input_notes').css('max-width', 'calc(100% - 150px)');
                $('#input_notes').addClass('inactive-notes');
                $('#editnotes').removeClass('d-none');
            }
            else{
                $('#input_notes').css('width', '280px');
                $('#input_notes').removeClass('inactive-notes');
                $('#editnotes').addClass('d-none');
            }
            $('#character-notes').html(widths+'/144');
            
            $(document).on('click','#add-notes',function(e){
                var widths = $('#add_notes').val().length;
                var count_width = (widths + 1) * 8;
                $('#addcatatan').removeClass('d-none');
                $(this).hide();
                $('#input_notes').removeClass('inactive-notes');
                $('#editnotes').addClass('d-none');
                if($('#add_notes').val().length > 1){
                    $('.group-prepend-notes').removeClass('d-none');
                }
                if(widths > 34){
                    $('#input_notes').css('width', count_width+'px');
                }
                else{
                    $('#input_notes').css('width', '280px');
                }
                $('#character-notes').html(widths+'/144');
            });

            $(document).on('keyup','#input_notes',function(){
                var widths = $('#add_notes').val().length;
                var count_width = (widths + 1) * 8;
                $('.group-prepend-notes').removeClass('d-none');
                $('#character-notes').html(widths+'/144');
                if(widths > 34){
                    $('#input_notes').css('width', count_width+'px');
                }
                else{
                    $('#input_notes').css('width', '280px');
                }
            });

            $(document).on('click','#icn-closed',function(){
                var widths = $('#add_notes').val().length;
                $('#add_notes').val('');
                $('.group-prepend-notes').addClass('d-none');
                $('#input_notes').css('width', '280px');
                $('#character-notes').html(widths+'/144');
                $('#input_notes').removeClass('inactive-notes');
                $('#editnotes').addClass('d-none');
            });

            $('#add_notes').focusin(function() {
                var widths = $('#add_notes').val().length;
                var count_width = (widths + 1) * 8;
                if(widths > 34){
                    $('#input_notes').css('width', count_width+'px');
                }
                else{
                    $('#input_notes').css('width', '280px');
                }
                $('#input_notes').css('width', '280px');
                if($('#add_notes').val() != ''){
                    $('#input_notes').removeClass('inactive-notes');
                    $('#editnotes').addClass('d-none');
                }
                else{
                    $('#add_notes').attr('readonly', false);
                }
            }).focusout(function() {
                var widths = $('#add_notes').val().length;
                var count_width = (widths + 1) * 8;
                if(widths > 34){
                    $('#input_notes').css('width', count_width+'px');
                }
                else{
                    $('#input_notes').css('width', '280px');
                }
                $('#character-notes').html(widths+'/144');
                if($('#add_notes').val() != ''){
                    $('#add_notes').attr('readonly', true);
                    $('#input_notes').addClass('inactive-notes');
                    $('#editnotes').removeClass('d-none');
                }
                else{
                    $('#add_notes').attr('readonly', false);
                }
            });

            $(document).on('click','#editnotes',function(){
                var widths = $('#add_notes').val().length;
                $('#input_notes').removeClass('inactive-notes');
                $('#add_notes').attr('readonly', false);
                $('#editnotes').addClass('d-none');
                if(widths > 1){
                    $('.group-prepend-notes').removeClass('d-none');
                }
                else{
                    $('.group-prepend-notes').addClass('d-none');
                }
            });

            /********************************/
            /*Pakai Voucher*/
            /********************************/
            $(document).on('click', '#setVoucher', function(e){
                var kode_voucher = $('#voucher_kode_vegan').val();
                var cektotalbelanja = $('#cektotalbelanja').val();
                e.preventDefault();

                $.ajax({
                    type: 'GET',
                    url: '{{route("set_voucher")}}',
                    data: {
                        kode_voucher : kode_voucher,
                        cektotalbelanja : cektotalbelanja,
                        _token: "{{csrf_token()}}"
                    },
                    dataType: 'JSON',
                    beforeSend: function () {
                        Swal.fire({
                            title: "Mohon Menunggu",
                            text: "System sedang memproses permintaan Anda",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                        });
                    },
                    success: function (data) {
                        Swal.close();
                        if(data.success) {
                            Swal.fire({
                                type: 'success',
                                title: 'Yes!',
                                text: 'Voucher berhasil dipakai',
                                allowOutsideClick: false
                            }).then(function() {
                                var value = data.data;
                                if(value.type == '1'){ //voucher
                                    var priceidr = value.disc_idr;
                                    var pricepercent = value.disc_percent;
                                    $('#diskonvoucher').removeClass('d-none');
                                    if(priceidr != 0){
                                        var reverse = priceidr.toString().split('').reverse().join(''),
                                            ribuan  = reverse.match(/\d{1,3}/g);
                                            ribuan  = ribuan.join('.').split('').reverse().join('');
                                            
                                        var totalbelanjaawal = $('#total_belanja').val();
                                        var ongkirawal = $('#shipingFee').val();
                                        var countbelanjaakhir = parseInt(totalbelanjaawal) - parseInt(priceidr);
                                        var finalprice = parseInt(ongkirawal) + parseInt(countbelanjaakhir);
                                        var reverse_akhir = finalprice.toString().split('').reverse().join(''),
                                            ribuan_akhir  = reverse_akhir.match(/\d{1,3}/g);
                                            ribuan_akhir  = ribuan_akhir.join('.').split('').reverse().join('');

                                        $('#potongandiskonvoucher').text('-Rp.'+ribuan);
                                        $('#grand_total').val(finalprice);
                                        $('#totalbelanjavegan').text('Rp. '+ribuan_akhir);
                                        
                                        $('#price_diskon_vegan').val(priceidr);
                                    }
                                    else if(pricepercent != 0){
                                        // harga - ((diskon/100) X harga)
                                        var totalbelanjaawal = $('#total_belanja').val();
                                        var ongkirawal = $('#shipingFee').val();
                                        var persen = pricepercent/100;
                                        var finalpercent = persen * totalbelanjaawal;
                                        var hitung_persen_awal = parseInt(totalbelanjaawal) - parseInt(finalpercent);
                                        var hitung_persen = parseInt(ongkirawal) + parseInt(hitung_persen_awal);
                                        var reverse_akhir = hitung_persen.toString().split('').reverse().join(''),
                                            ribuan_akhir  = reverse_akhir.match(/\d{1,3}/g);
                                            ribuan_akhir  = ribuan_akhir.join('.').split('').reverse().join('');

                                        $('#potongandiskonvoucher').text('-'+pricepercent+'%');
                                        $('#grand_total').val(hitung_persen);
                                        $('#totalbelanjavegan').text('Rp. '+ribuan_akhir);

                                        $('#price_diskon_vegan').val(finalpercent);
                                    }
                                }
                                else if(value.type == '2'){ //ongkir
                                    var ongkirprice = value.disc_ongkir;
                                    var reverse = ongkirprice.toString().split('').reverse().join(''),
                                        ribuan  = reverse.match(/\d{1,3}/g);
                                        ribuan  = ribuan.join('.').split('').reverse().join('');
                                    $('#diskonongkir').removeClass('d-none');
                                    $('#potongandiskonongkir').text('-Rp.'+ribuan);

                                    var ongkirawal = $('#shipingFee').val();
                                    var totalbelanjaawal = $('#total_belanja').val();
                                    var countongkirakhir = parseInt(ongkirawal) - parseInt(ongkirprice);
                                    var finalprice = parseInt(totalbelanjaawal) + parseInt(countongkirakhir);
                                    var reverse_akhir = finalprice.toString().split('').reverse().join(''),
                                        ribuan_akhir  = reverse_akhir.match(/\d{1,3}/g);
                                        ribuan_akhir  = ribuan_akhir.join('.').split('').reverse().join('');
                                    $('#grand_total').val(finalprice);
                                    $('#totalbelanjavegan').text('Rp. '+ribuan_akhir);

                                    $('#price_diskon_vegan').val(ongkirprice);
                                }
                                $('#voucher_id_vegan').val(value.id);
                            });
                        }
                        else if(data.min_belanja){
                            Swal.fire({
                                title: "Maaf!",
                                text: "Pesanan anda belum mencapai minimal belanja",
                                type: "error",
                                allowOutsideClick: false,
                            });
                        }
                        else{
                            Swal.fire({
                                title: "Maaf!",
                                text: "Voucher tidak valid",
                                type: "error",
                                allowOutsideClick: false,
                            }).then(function() {
                                $('#diskonongkir').addClass('d-none');
                                $('#diskonvoucher').addClass('d-none');
                                $('#potongandiskonongkir').text('-Rp.0');
                                $('#potongandiskonvoucher').text('-Rp.0');
                                var ongkirawal = $('#shipingFee').val();
                                var totalbelanjaawal = $('#total_belanja').val();
                                var finalprice = parseInt(totalbelanjaawal) + parseInt(ongkirawal);
                                var reverse_akhir = finalprice.toString().split('').reverse().join(''),
                                    ribuan_akhir  = reverse_akhir.match(/\d{1,3}/g);
                                    ribuan_akhir  = ribuan_akhir.join('.').split('').reverse().join('');
                                $('#grand_total').val(finalprice);
                                $('#totalbelanjavegan').text('Rp. '+ribuan_akhir);
                            });
                        }
                    },
                    error: function (data) {
                        Swal.fire({
                            title: "Maaf!",
                            text: "Voucher tidak tersedia",
                            type: "error",
                            allowOutsideClick: false,
                        });
                    }
                });
            });

            /********************************/
            /*Pilih metode pembayaran*/
            /********************************/
            $('.payment-method-radio').prop('checked', false);
            $("#payMthod").click(function(){
                var radioPay = $('#methodPay').find('.payment-method-radio:checked');
                if($('.payment-method-radio').is(':checked')){
                    var jenisPay = $(radioPay).next().text();
                    $("#choose-payment p").html(jenisPay);
                    $("#choose-payment p").addClass('clr-blck');
                    $("#choose-payment p").removeClass('d-none');
                    $("#choose-payment p").addClass('d-block');
                    $("#choose-payment .labl-mtdpy").addClass('d-none');
                    $("#choose-payment .labl-mtdpy").removeClass('d-block');
                    $('#payment_id').val($(radioPay).data('id'));
                }
                else{
                    Swal.fire({
                        title: "Maaf!",
                        text: "Mohon pilih metode pembayaran",
                        type: "error",
                        allowOutsideClick: false,
                    });
                }
            });

            {{--$('#formPenjualan').on('submit',function (e) {
                e.preventDefault();
                var name_baru = $('#name_baru').val();
                var address_baru = $('#address_baru').val();
                var kodepos_baru = $('#kodepos_baru').val();
                var nohp_baru = $('#nohp_baru').val();
                var kecamatan_id_baru = $('#kecamatan_id_baru').val();
                var provinsi_id_baru = $('#provinsi_id_baru').val();
                var kabupaten_id_baru = $('#kabupaten_id_baru').val();
                var shipping_code = $('#shipping_code').val();
                var shipping_type = $('#shipping_type').val();
                var courier_id = $('#courier_id').val();
                var payment_id = $('#payment_id').val();
                var shipingFee = $('#shipingFee').val();
                var isrebuy = $('#isrebuy').val();
                var customer_id = $('#customer_id').val();
                var id_variants   = [];

                $.each($('.idvarians'),function(index){
                    id_variants[index] = $(this).data('id');
                });

                $.ajax({
                    url: "{{ route('order') }}",
                    method: 'POST',
                    dataType: "json",
                    data: {
                        id_carts: id_carts,
                        prc: hasilchck,
                        id_products: id_products,
                        id_variants: id_variants,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        
                    },
                    error : function (xhr) {
                        Swal.fire({
                            title: "Ups!",
                            text: "Mohon cek kembali inputan Anda",
                            type: "error",
                            allowOutsideClick: false
                        });
                        // .then(function() {
                        //     window.location.reload();
                        // });
                    }
                });
            });--}}
        });
    </script>
@endpush

@section('postWithAjax')
    @if(session('status'))
    Swal.fire({
        title: "Warning",
        text: "Pilih Metode Pembayaran terlebih dahulu!",
        type: "error",
        allowOutsideClick: false
    });
    @endif
    postWithAjax("formPenjualan","{{ route('payment')}}");
@endsection