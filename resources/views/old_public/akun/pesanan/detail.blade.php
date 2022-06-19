@extends('layouts.fe.fe')

@section('metadata')
    <title>Veganesia - Pesanan {{$order_detail->transaction_code}}</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/akun/pesanan/detail_pesanan.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/fe/css/content/sidebar_akun.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendors/css/datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendors/image-uploader/dist/image-uploader.min.css') }}">
@endpush

@section('content')
    <div class="akun-detailorder">
        <!-- Content Profile -->
        <!-- ============================================================== -->
        <section class="sec-akun-detailorder container">
            <!-- Sidebar Akun Mobile -->
            <!-- ============================================================== -->
            <div class="mob-sdbr-acc mobl-sdbr-acc">
                <button id="filter-akun" class="btn-vegan green-bg-btn text-capitalize" type="button">
                    <span><i class="fas fa-sliders-h"></i></span>
                    &nbsp;filter
                </button>
            </div>
            <!-- ============================================================== -->
            <!-- End Sidebar Akun Mobile -->

            <div class="grid_layouts gr-akun">
                <div>
                    <!-- Sidebar Akun Desktop -->
                    <!-- ============================================================== -->
                    <div id="desk-sdbr">
                        @include('layouts.fe.sidebar.sidebar-akun')
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Sidebar Akun Desktop -->
                </div>
                <div class="order-content">
                    <!-- Content -->
                    <!-- ============================================================== -->
                    <div class="box-akun-orderdetail">
                        <div class="border-bottom-large menu-orderdetail">
                            <a href="{{route('akun_pesanan')}}" class="ksjak main-sub-text f-Asap_medium text-capitalize mb-0 clr-lght-gsh">
                                <span class="arrow-icns"></span>
                                rincian pesanan
                            </a>
                        </div>

                        <!-- Start Header Menu Order -->
                        <div class="menu-orderdetail">
                            <div class="grid_layouts head-pt-list-order">
                                <div class="bx-head-mns code-order">
                                    <h6 class="clr-light-gry">
                                        ID Pesanan :
                                    </h6>
                                    <h5 class="nocode main-sub-text f-Asap_medium mb-0">
                                        {{$order_detail->transaction_code}}
                                    </h5>
                                </div>
                                <div class="bx-head-mns ttl-order">
                                    <h6 class="clr-light-gry small-fnt text-capitalize">tanggal pesanan :</h6>
                                    <h5 class="mb-0">
                                        {{ Carbon\Carbon::parse($order_detail->created_at)->format('d F Y') }}
                                    </h5>
                                </div>
                                <div class="bx-head-mns stts-order">
                                    <h6 class="clr-light-gry small-fnt text-capitalize">status pesanan :</h6>
                                    <div class="stts-listjhdd --trsgc">
                                        @if ($order_detail->transaction_status == 1 && $order_detail->payment_status == 2)
                                        {{--sudah dibayar--}}
                                        <div class="status-order --new-order">
                                        @elseif ($order_detail->transaction_status == 1 && $order_detail->payment_status == 1)
                                        {{--Menunggu Pembayaran--}}
                                        <div class="status-order --waiting">
                                        @elseif ($order_detail->transaction_status == 2 && $order_detail->payment_status == 2)
                                        {{--Diproses--}}
                                        <div class="status-order --process">
                                        @elseif ($order_detail->transaction_status == 3 && $order_detail->payment_status == 2)
                                        {{--Dikirim--}}
                                        <div class="status-order --sent">
                                        @elseif ($order_detail->transaction_status == 4 && $order_detail->payment_status == 2)
                                        {{--Selesai--}}
                                        <div class="status-order --done">
                                        @elseif ($order_detail->transaction_status == 5 && $order_detail->payment_status == 1)
                                        {{--Dibatalkan--}}
                                        <div class="status-order --cancel">
                                        @endif
                                            <h6 class="small-fnt text-capitalize mb-0 stts-order-text">{{$order_detail->p_status}}</h6>
                                        </div>
                                        @if($order_detail->transaction_status == 2 && $order_detail->payment_status == 2)
                                        <div class="tracking-section">
                                            <button class="btn-vegan txt-btn text-capitalize f-Asap_medium small-fnt --nonactive-track">lacak pesanan</h6>
                                        </div>
                                        @elseif($order_detail->transaction_status == 3 || $order_detail->transaction_status == 4 && $order_detail->payment_status == 2)
                                        <div class="tracking-section">
                                            <button class="btn-vegan txt-btn text-capitalize f-Asap_medium small-fnt" data-toggle="modal" data-target="#detStts" data-backdrop="static" data-keyboard="false">lacak pesanan</h6>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Header Menu Order -->

                        <!-- Start Status Tracking Order -->
                        <div class="border-bottom-small tracking-stepper">
                            <div class="menu-orderdetail">
                                <div class="stts-ordered">
                                    <ul>
                                        <li id="newOrd" class="mnu-stts @if(($order_detail->transaction_status == 1 && $order_detail->payment_status == 2 || $order_detail->transaction_status == 2 && $order_detail->payment_status == 2) || ($order_detail->transaction_status == 3 && $order_detail->payment_status == 2) || ($order_detail->transaction_status == 4 && $order_detail->payment_status == 2)) active @endif">
                                            <div class="chcks">
                                                <div class="chck-icn"></div>
                                            </div>
                                            <h6 class="lnk-stts">sudah dibayar</h6>
                                        </li>
                                        <li id="prcOrd" class="mnu-stts @if(($order_detail->transaction_status == 2 && $order_detail->payment_status == 2) || ($order_detail->transaction_status == 3 && $order_detail->payment_status == 2) || ($order_detail->transaction_status == 4 && $order_detail->payment_status == 2)) active @endif">
                                            <div class="chcks">
                                                <div class="chck-icn"></div>
                                            </div>
                                            <h6 class="lnk-stts">diproses</h6>
                                        </li>
                                        <li id="sentOrd" class="mnu-stts @if(($order_detail->transaction_status == 3 && $order_detail->payment_status == 2) || ($order_detail->transaction_status == 4 && $order_detail->payment_status == 2)) active @endif">
                                            <div class="chcks">
                                                <div class="chck-icn"></div>
                                            </div>
                                            <h6 class="lnk-stts">dikirim</h6>
                                        </li>
                                        <li id="doneOrd" class="mnu-stts @if($order_detail->transaction_status == 4 && $order_detail->payment_status == 2) active @endif">
                                            <div class="chcks">
                                                <div class="chck-icn"></div>
                                            </div>
                                            <h6 class="lnk-stts">selesai</h6>
                                        </li>
                                    </ul>
                                </div>
                                <div class="warning-orders">
                                    <p class="mb-0">
                                        Mohon tunggu pesanan anda akan di peroses, akan segera dikirim ke kurir yang sudah di pilih sebelumnya. mohon di tunggu paling lambat 1x24 jam pesanan anda akan dikirim
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- End Status Tracking Order -->

                        <!-- Start Upload Order Letter -->
                        @if($order_detail->transaction_status == 1 && $order_detail->payment_status == 1)
                        <div class="border-bottom-large menu-orderdetail">
                            <div class="grid_layouts footer-pt-list-order waiting-mode">
                                <div class="pay-shopping">
                                    @if($order_detail->payment_id == 1)
                                    <a class="btn-vegan text-capitalize orange-btn text-center f-Asap_medium" href="{{ route('akun_pesanan_bayar.detail', $order_detail->transaction_code) }}">
                                        bayar belanjaan
                                    </a>
                                    @elseif($order_detail->payment_id == 2)
                                    <button class="btn-vegan text-capitalize green-bg-btn f-Asap_medium" data-toggle="modal" data-target="#uploadbuktibayar" data-backdrop="static" data-keyboard="false">
                                        upload bukti bayar
                                    </button>
                                    @elseif($order_detail->payment_id == 3)
                                    <button id="midtransPay" data-payment="{{$order_detail->payment_id}}" data-id="{{$order_detail->id}}" data-total="{{$order_detail->grandtotal}}" class="btn-vegan text-capitalize green-bg-btn f-Asap_medium">
                                        bayar belanjaan
                                    </button>
                                    @endif
                                </div>
                                <div>
                                    <h6 class="clr-light-gry small-fnt text-capitalize mb-0">bayar sebelum : </h6>
                                </div>
                                <div class="ft-date-order">
                                    <div class="icn-bell img-lazy small-lazy loaded" data-src="{{ asset('dist/fe/icons/bell.png') }}"></div>
                                    <h6 class="clr-lght-gsh mb-0">
                                        {{ Carbon\Carbon::parse($order_detail->transaction_date)->format('d F Y H:i') }}
                                    </h6>
                                </div>
                                <div class="rincian-view-btns">
                                    <a href="{{ route('akun_pesanan_bayar.detail', $order_detail->transaction_code) }}" class="view-rincian btn-vegan txt-btn text-capitalize">
                                        informasi pembayaran
                                        <span class="icn-arrow" style="background-image: url('{{ asset('dist/fe/icons/arrow-grey.png') }}')"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- End Upload Order Letter -->

                        <!-- Start Received Order -->
                        @if($order_detail->transaction_status == 3 && $order_detail->payment_status == 2)
                        <div class="border-bottom-large menu-orderdetail">
                            <div class="grid_layouts footer-pt-list-order received-mode">
                                <div class="pay-shopping">
                                    <button class="btn-vegan text-capitalize orange-btn f-Asap_medium" data-toggle="modal" data-target="#terimabarang" data-backdrop="static" data-keyboard="false">
                                        terima barang
                                    </button>
                                </div>
                                <div class="ft-date-order">
                                    <div class="icn-bell img-lazy small-lazy loaded" data-src="{{ asset('dist/fe/icons/bell.png') }}"></div>
                                    <h6 class="clr-light-gry mb-0 text-capitalize f-Asap_italic">
                                        mohon konfirmasi jika barang sudah diterima
                                    </h6>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- End Received Order -->

                        <!-- Start Order Done -->
                        @if($order_detail->transaction_status == 4 && $order_detail->payment_status == 2)
                        <div class="border-bottom-large menu-orderdetail">
                            <div class="grid_layouts footer-pt-list-order done-mode">
                                <div class="pay-shopping">
                                    <button id="buyagainbtn" style="width: 145px;" class="btn-vegan text-capitalize @if($order_detail->is_review == false)--transparent-btn @else green-bg-btn @endif f-Asap_medium" data-toggle="modal" data-target="#rebuy" data-backdrop="static" data-keyboard="false">
                                        beli lagi
                                    </button>
                                </div>
                                @if($order_detail->is_review == false)
                                <div id="givevaluebtn" class="pay-shopping">
                                    <button style="width: 155px;" class="btn-vegan text-capitalize orange-btn f-Asap_medium" data-toggle="modal" data-target="#givereviewproducts" data-backdrop="static" data-keyboard="false">
                                        berikan penilaian
                                    </button>
                                </div>
                                @else
                                <div id="viewreviewdone" class="pay-shopping">
                                    <button style="width: 155px;" class="btn-vegan text-capitalize --transparent-btn f-Asap_medium" id="viewreviewproducts" data-id="{{$order_detail->id}}" data-code="{{$order_detail->transaction_code}}">
                                        lihat review
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                        @elseif($order_detail->transaction_status == 5 && $order_detail->payment_status == 1)
                        <div class="border-bottom-large menu-orderdetail">
                            <div class="grid_layouts footer-pt-list-order">
                                <div class="pay-shopping">
                                    <button id="buyagainbtn" style="width: 145px;" class="btn-vegan text-capitalize --transparent-btn f-Asap_medium"  data-toggle="modal" data-target="#rebuy" data-backdrop="static" data-keyboard="false">
                                        beli lagi
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- End Order Done -->

                        <!-- Start Description Customer Order -->
                        <div class="border-bottom-small menu-orderdetail">
                            <div class="grid_layouts bottom-menu-orders gr-desc-cust-section">
                                <div class="desc-cstss">
                                    <div class="ct-profile-frms">
                                        <h5 class="f-Asap_medium text-capitalize main-sub-text">
                                            alamat pengiriman
                                        </h5>
                                        <h6 class="profile-name" id="name_old">
                                            {{$order_detail->delivery_nama}}
                                        </h6>
                                        <article class="profile-address">
                                            <p class="mb-0 clr-light-gry" id="address_old">
                                                {{$order_detail->delivery_alamat}}
                                            </p>
                                            <p class="mb-0 clr-light-gry" id="address_old">
                                                {{$order_detail->delivery_hp}}
                                            </p>
                                        </article>
                                    </div>
                                    <div class="ct-profile-frms">
                                        <h5 class="f-Asap_medium text-capitalize main-sub-text">
                                            kurir pengiriman :
                                        </h5>
                                        <div class="grid_layouts gr-krss mb-3">
                                            <div class="kurir-descs">
                                                @if ($order_detail->shipping_code == 'jnt')
                                                <div class="icn-kurirs --jnt"></div>
                                                @elseif ($order_detail->shipping_code == 'jne')
                                                <div class="icn-kurirs --jne"></div>
                                                @elseif ($order_detail->shipping_code == 'pos')
                                                <div class="icn-kurirs --pos"></div>
                                                @elseif ($order_detail->shipping_code == 'sicepat')
                                                <div class="icn-kurirs --sicepat"></div>
                                                @endif
                                                <h6 class="mb-0 text-capitalize clr-gry">
                                                    Reguler 2-3 Hari
                                                </h6>
                                            </div>
                                            <div class="rg-sect">
                                                <h6 class="mb-0">
                                                    Rp {{ number_format($order_detail->shipping_fee ,2,",",".")}}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ct-profile-frms">
                                        <h5 class="f-Asap_medium text-capitalize main-sub-text">
                                            nomor resi :
                                        </h5>
                                        <div class="grid_layouts gr-krss">
                                            <div class="kurir-descs">
                                                <h6 class="mb-0 text-capitalize">
                                                    @if(isset($order_detail->no_resi))
                                                    {{$order_detail->no_resi}}
                                                    @else
                                                    -
                                                    @endif
                                                </h6>
                                            </div>
                                            @if(isset($order_detail->no_resi))
                                            <div class="rg-sect">
                                                <div class="position-relative shares-smd share-btn" id="share-vg99" data-url="{{$order_detail->no_resi}}">
                                                    <div>
                                                        <a id="copyclp199" class="copyclp position-relative btn-vegan txt-btn clr-blue text-capitalize" data-clipboard-text="{{$order_detail->no_resi}}" type="button">
                                                            salin
                                                        </a>
                                                    </div>
                                                    <div class="ct-tggle ct-tggle1" id="ct-tggle199" style="display: none">
                                                        <div class="position-relative">
                                                            <small class="small-fnt">Copied</small>
                                                            <div class="mn-arrw"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div style="margin-top: 10px" class="pad-ls-crd-mn">
                                            <h6 class="mb-0 text-capitalize clr-gry">
                                                catatan pembeli :
                                                <span class=" text-black" style="text-transform: initial">
                                                    @if(isset($order_detail->notes))
                                                    {{$order_detail->notes}}
                                                    @else
                                                    -
                                                    @endif
                                                </span>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="desc-paymss">
                                    <div class="head-desc-paymss grid_layouts gr-ls-menu-crd pad-ls-crd-mn">
                                        <div>
                                            <h5 class="f-Asap_medium text-capitalize main-sub-text mb-0">
                                                metode pembayaran :
                                            </h5>
                                        </div>
                                        <div class="rgthtklfjs">
                                            <h6 class="mb-0">
                                                @if($order_detail->payment_id == 1)
                                                Menggunakan QRIS
                                                @elseif($order_detail->payment_id == 2)
                                                Konfirmasi Manual
                                                @elseif($order_detail->payment_id == 3)
                                                Konfirmasi Otomatis (Midtrans)
                                                @endif
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="body-desc-paymss">
                                        <div class="pad-ls-crd-mn">
                                            <div class="mb-3">
                                                <h5 class="mb-0 text-capitalize main-sub-text f-Asap_medium">
                                                    detail harga
                                                </h5>
                                            </div>
                                            <div>
                                                <div class="grid_layouts gr-ls-menu-crd">
                                                    <div>
                                                        <h6 class="text-capitalize clr-light-gry mb-0">total harga barang</h6>
                                                    </div>
                                                    <div class="rgthtklfjs">
                                                        <h6 class="text-capitalize clr-light-gry mb-0">Rp. {{ number_format($order_detail->total_belanja ,2,",",".")}}</h6>
                                                    </div>
                                                </div>
                                                <div class="grid_layouts gr-ls-menu-crd">
                                                    <div>
                                                        <h6 class="text-capitalize clr-light-gry mb-0">jasa pengiriman</h6>
                                                    </div>
                                                    <div class="rgthtklfjs">
                                                        <h6 class="text-capitalize clr-light-gry mb-0">Rp. {{ number_format($order_detail->shipping_fee ,2,",",".")}}</h6>
                                                    </div>
                                                </div>
                                                @if($order_detail->voucher_id != 0 || $order_detail->voucher_id != null)
                                                <div class="grid_layouts gr-ls-menu-crd">
                                                    <div>
                                                        <h6 class="text-capitalize clr-light-gry mb-0">potongan promo</h6>
                                                    </div>
                                                    <div class="rgthtklfjs">
                                                        <h6 class="text-capitalize clr-light-gry mb-0">
                                                            Rp. {{ number_format($order_detail->diskon ,2,",",".")}}
                                                        </h6>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="grid_layouts btm-shsdjfs gr-ls-menu-crd mb-0 mt-2">
                                                <div>
                                                    <h5 class="mb-0 text-capitalize main-sub-text f-Asap_medium">
                                                        total belanja :
                                                    </h5>
                                                </div>
                                                <div class="rgthtklfjs">
                                                    <h5 class="mb-0 text-capitalize main-text f-Asap_medium" style="color: #E24667;">
                                                        Rp. {{ number_format($order_detail->grandtotal ,2,",",".")}}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Description Customer Order -->

                        <!-- Start List Products Order -->
                        <div class="border-bottom-small menu-orderdetail">
                            <h5 class="f-Asap_medium text-capitalize main-sub-text">
                                daftar belanja (<span id="total_all" class="constantformatnumberCN" data-content="{{count($order_detail->details)}}">{{count($order_detail->details)}}</span>)
                            </h5>
                            <div class="grid_layouts product-list-sec mt-3">
                                @foreach($order_detail->details as $item)
                                <div class="lists-carts">
                                    <div class="gr-mob-lst">
                                        <div class="grid_layouts gr-ls-carts">
                                            <div class="cover-product img-lazy" data-src="{{ asset($item->item->cover_image) }}"></div>
                                            <div class="desc-product">
                                                <h6 class="f-Asap_medium mb-0">
                                                    @if($item->product->is_variant == true)
                                                    {{ $item->item->name }} - {{ $item->product_variant->name }}
                                                    @else
                                                    {{ $item->item->name }}
                                                    @endif
                                                </h6>
                                            </div>
                                            <div class="qty-product">
                                                <small>
                                                    x{{ $item->qty}}
                                                </small>
                                            </div>
                                            <div class="price-product">
                                                <h6 class="f-Asap_medium mb-0">
                                                    Rp. {{ number_format($item->price ,2,",",".")}}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- End List Products Order -->
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Content -->

                    @if($order_detail->transaction_status == 1 && $order_detail->payment_status == 1)
                    <!-- Start Modal Upload Bukti Bayar -->
                    <div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
                        <div class="modal fade" id="uploadbuktibayar" tabindex="-1" role="dialog" aria-labelledby="uploadbuktibayarLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-capitalize text-left desc-main-text f-Asap_medium" id="uploadbuktibayarLabel">
                                            upload bukti bayar
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div id="FormUploadBukti" class="modal-body">
                                        <div class="mb-4">
                                            <p class="mb-0">
                                                Info untuk menjelaskan alamat ini untuk ke checout, consectetur adipiscing elit. Dignissim ullamcorper maecenas montes, arcu sit augue donec in porttitor.
                                            </p>
                                        </div>
                                        <form action="" class="form-vegan" id="saveBuktiBayar" autocomplete="off" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" id="id_order" name="id_order" value="{{ $order_detail->id}}">
                                            <div>
                                                <label class="clr-grey-txt mb-2 f-Asap_medium text-capitalize">nama bank</label>
                                                <div class="main-form-vg">
                                                    <div class="--custom-select">
                                                        <select class="text-capitalize select2" id="namabank" name="namabank" required>
                                                            <option disabled selected class="selected">Pilih Nama Bank</option>
                                                            @foreach($payment_bank as $bank)
                                                            <option value="{{$bank->id}}" selected>{{$bank->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <label class="clr-grey-txt mb-2 f-Asap_medium text-capitalize">nama pengirim</label>
                                                <div class="main-form-vg">
                                                    <input required type="text" class="form-control" id="namapengirim" name="namapengirim" aria-describedby="namapengirim" placeholder="Nama Pengirim">
                                                </div>
                                            </div>
                                            <div>
                                                <label class="clr-grey-txt mb-2 f-Asap_medium text-capitalize">nomor rekening</label>
                                                <div class="main-form-vg">
                                                    <input required type="number" class="form-control" id="norek" name="norek" aria-describedby="norek" placeholder="Nomor Rekening" value="{{ isset($order_detail) ? $order_detail->rekening_bukti_bayar : '' }}">
                                                </div>
                                            </div>
                                            <div>
                                                <label class="clr-grey-txt mb-2 f-Asap_medium text-capitalize">jumlah transfer</label>
                                                <div class="main-form-vg">
                                                    <input required type="number" class="form-control" id="total" name="total" aria-describedby="total" placeholder="Jumlah Transfer" value="{{ isset($order_detail) ? $order_detail->jumlah_transfer : '' }}">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="main-form-vg">
                                                    <div class="brw-fields">
                                                        <div class="file-upload-wrapper truncate-texts --upld" data-text="Slahkan Upload foto bukti transaksi">
                                                            <input accept="image/x-png,image/gif,image/jpeg" required name="cover" id="cover" name="cover" type="file" class="upload file-upload-field" value=""/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-3 pt-2">
                                                <button type="submit" class="btn-vegan green-bg-btn text-capitalize">kirim bukti bayar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End:/ Modal Upload Bukti Bayar -->
                    @endif

                    @if($order_detail->transaction_status == 3 || $order_detail->transaction_status == 4 && $order_detail->payment_status == 2)
                    <!-- Start Modal Lacak Order -->
                    <div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
                        <div class="modal fade" id="detStts" tabindex="-1" role="dialog" aria-labelledby="detSttsLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-capitalize text-left desc-main-text f-Asap_medium" id="detSttsLabel">
                                            status pengiriman
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body p-0">
                                        <div class="mdl-stts">
                                            <div class="grid_layouts gr-head-mnsdhshs mdl-padd">
                                                <div class="lhsajsha">
                                                    <div>
                                                        <h5 class="mb-0 small-fnt clr-light-gry">
                                                            ID Pesanan
                                                        </h5>
                                                    </div>
                                                    <div class="mn-right sub-mn-right">
                                                        <h5 class="text-uppercase mb-0 f-Asap_medium">
                                                            {{ $order_detail->transaction_code}}
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="lhsajsha">
                                                    <div>
                                                        <h5 class="mb-0 text-capitalize small-fnt clr-light-gry">
                                                            tanggal pesanan
                                                        </h5>
                                                    </div>
                                                    <div class="mn-right sub-mn-right">
                                                        <h5 class="mb-0 f-Asap_medium">
                                                            {{ Carbon\Carbon::parse($order_detail->created_at)->format('d F Y') }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mdl-padd order-detl">
                                                <div class="grid_layouts gr-krss">
                                                    <div class="kurir-descs">
                                                        @if ($order_detail->shipping_type == 'jnt')
                                                        <div class="icn-kurirs --jnt"></div>
                                                        @elseif ($order_detail->shipping_type == 'jne')
                                                        <div class="icn-kurirs --jne"></div>
                                                        @elseif ($order_detail->shipping_type == 'pos')
                                                        <div class="icn-kurirs --pos"></div>
                                                        @elseif ($order_detail->shipping_type == 'sicepat')
                                                        <div class="icn-kurirs --sicepat"></div>
                                                        @endif
                                                        <h6 class="mb-0 text-capitalize clr-gry">
                                                            Reguler 2-3 Hari
                                                        </h6>
                                                    </div>
                                                    <div class="rg-sect">
                                                        @if(($order_detail->no_resi) != null)
                                                        <h5 class="text-capitalize main-sub-text f-Asap_medium">
                                                            {{$order_detail->no_resi}}
                                                        </h5>
                                                        <div class="position-relative">
                                                            <a data-target="resivegan" class="copyclp-vegan-btn btn-vegan txt-btn clr-blue f-Asap_medium text-right" data-clipboard-text="{{$order_detail->no_resi}}" type="button">
                                                                Salin
                                                            </a>
                                                            <div class="ct-tggle" id="copyclip-veganresivegan" style="display: none; top: 25px;">
                                                                <div class="position-relative">
                                                                    <small class="small-fnt">Copied</small>
                                                                    <div class="mn-arrw"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @else
                                                            -
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mdl-padd lst-mn-stts">
                                                <div class="stts-order">
                                                    <ul>
                                                        @if($waybill != '')
                                                            @foreach($waybill as $w)
                                                            <li class="mnu-stts">
                                                                <div>
                                                                    <h6 class="lnk-stts">{{$w->manifest_date}}</h6>
                                                                    <h6 class="small-fnt lnk-stts">{{$w->manifest_time}}</h6>
                                                                </div>
                                                                <div class="chcks">
                                                                    <div class="chck-icn"></div>
                                                                </div>
                                                                <div>
                                                                    <h6 class="truncate-texts --two text-capitalize f-Asap_medium">{{ $w->manifest_description}} - {{ $w->city_name}}</h6>
                                                                </div>
                                                            </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End:/ Modal Lacak Order -->
                    @endif

                    @if($order_detail->transaction_status == 4 && $order_detail->payment_status == 2)
                    <!-- Start Modal Rebuy Products -->
                    <div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
                        <div class="modal fade" id="rebuy" tabindex="-1" role="dialog" aria-labelledby="rebuyLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-capitalize text-left desc-main-text f-Asap_medium" id="rebuyLabel">
                                            beli lagi
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body p-0">
                                        <div class="rebuy-products">
                                            <div class="sec-cart form-vegan" id="modl-rebuy">
                                                <div id="products-lists-mdl" class="products-lists-mdl --scrlbrr">
                                                    <div class="middle-cart">
                                                        <input id="rebuy_total_lama" type="hidden">
                                                        @foreach($order_detail->details as $cart)
                                                        @if($cart->product->is_variant == true)
                                                        @if($cart->product_variant->stock == 0)
                                                        <div class="grid_layouts gr-cart-prdct" style="opacity: .5;">
                                                        @else
                                                        <div class="grid_layouts gr-cart-prdct">
                                                        @endif
                                                        @else
                                                        @if($cart->product->stock == 0)
                                                        <div class="grid_layouts gr-cart-prdct" style="opacity: .5;">
                                                        @else
                                                        <div class="grid_layouts gr-cart-prdct">
                                                        @endif
                                                        @endif
                                                            <div class="rebuys_a custom-control main-form-vg custom-checkbox cart-checkbox">
                                                                @if($cart->product->is_variant == true)
                                                                <input class="custom-control-input checkbox-cart-input checkbox-rebuy" data-variant="{{$cart->product_variant->id}}" data-harga="{{$cart->product->only_final_price * $cart->qty }}" type="checkbox" id="rebuy-{{$cart->id}}" name="rebuy-{{$cart->product->id}}" data-id="{{$cart->id}}" data-product="{{$cart->product->id}}" data-qty="{{$cart->qty}}" data-stock="{{$cart->product_variant->stock}}">
                                                                @else
                                                                <input class="custom-control-input checkbox-cart-input checkbox-rebuy" data-variant="0" data-harga="{{$cart->product->only_final_price * $cart->qty }}" type="checkbox" id="rebuy-{{$cart->id}}" name="rebuy-{{$cart->product->id}}" data-id="{{$cart->id}}" data-product="{{$cart->product->id}}" data-qty="{{$cart->qty}}" data-stock="{{$cart->product->stock}}">
                                                                @endif
                                                                <input type="hidden" value="{{$cart->product->only_final_price * $cart->qty }}" id="price_{{$cart->product->id}}" class="totalPrice">
                                                                <label class="custom-control-label" for="rebuy-{{ $cart->product->id }}"></label>
                                                            </div>
                                                            <div class="rebuys_b cover-img icon-cart img-slider img-lazy" data-src="{{ asset($cart->product->cover_image) }}"></div>
                                                            <div class="rebuys_c position-relative h-100">
                                                                <div class="desc">
                                                                    <h6 class="prd-title med-small-fntf-Asap_medium truncate-texts mb-1">
                                                                        @if($cart->product->is_variant == true)
                                                                        {{ $cart->product->name }} - {{$cart->product_variant->name}}
                                                                        @else
                                                                        {{ $cart->product->name }}
                                                                        @endif
                                                                    </h6>
                                                                    @if($cart->product->is_variant == true)
                                                                    @if($cart->product_variant->stock == 0)
                                                                    <small id="not_enough_stock_{{ $cart->product_variant->id }}" style="color: red;" class="mb-0 small-fnt">Maaf Stok Yang Tersedia : {{$cart->product_variant->stock}}</small>
                                                                    @endif
                                                                    @else
                                                                    @if($cart->product->stock == 0)
                                                                    <small id="not_enough_stock_{{ $cart->product->id }}" style="color: red;" class="mb-0 small-fnt">Maaf Stok Yang Tersedia : {{$cart->product->stock}}</small>
                                                                    @endif
                                                                    @endif
                                                                    <input data-qty="{{ $cart->qty }}" class="listsprice rebuy-listsprice rebuyproducts-{{$cart->product->id}}" value="{{ $cart->product->only_final_price }}" id="cart-{{$cart->id}}" data-product="{{$cart->product->id}}" type="hidden">
                                                                    <input id="price_{{ $cart->product->id }}" type="hidden" class="listHarga rebuy_listsHarga" data-id="{{ $cart->product->id }}" value="{{ $cart->product->only_final_price }}">
                                                                    <h6 class="prd-price med-small-fnt truncate-texts mb-2 clr-warn">
                                                                        {{ $cart->product->final_price }}
                                                                    </h6>
                                                                </div>
                                                                <div class="form-vegan">
                                                                    <input class="input-number form-control qty_input qty_buyagain" data-id="{{ $cart->id }}" data-product="{{ $cart->product->id }}" type="number" name="qty" value="{{ $cart->qty }}" step="1" min="1" data-min="1" max="{{ $cart->product->stock }}" data-max="{{ $cart->product->stock }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="grid_layouts bottom-cart" id="bottom-lists-mdl">
                                                    <div class="list-menu-cart-top">
                                                        <div class="custom-control main-form-vg custom-checkbox mb-0">
                                                            <input class="custom-control-input checkbox-cart-input-total checkbox-rebuy-all" type="checkbox" value="all" id="rebuy-pilihsemua">
                                                            <label class="custom-control-label text-black text-capitalize pb-0" for="rebuy-pilihsemua">
                                                                pilih semua (<span id="total_check">0</span>/<span id="total_chart"></span>)
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="gr-bhsbjsf">
                                                        <div class="totalCart">
                                                            <small class="text-capitalize clr-light-gry small-fnt">total belanja</small>
                                                            <h6 class="totalCount" id="rebuy_totalCount">Rp 0,00</h6>
                                                        </div>
                                                        <div class="btn-chk">
                                                            <input type="hidden" id="rebuy_totalPrice">
                                                            <button id="checkoutRebuy" class="btn-vegan orange-btn text-capitalize">checkout</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End:/ Modal Rebuy Products -->
                    @endif

                    <!-- Start Modal Terima Barang -->
                    <div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
                        <div class="modal fade" id="terimabarang" tabindex="-1" role="dialog" aria-labelledby="terimabarangLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header pb-0" style="border: unset;">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body pt-0">
                                        <div class="cover-review" style="background-image: url('{{ asset('dist/fe/icons/beri_review.png') }}')"></div>
                                        <p class="clr-light-gry text-center" style="width: calc(100% - 50px); margin: 30px auto;">
                                            Terimakasih sudah berbelanja di Veganesia, yuk review produknya agar kamu bisa dapatkan tambahan <span style="color: #EE4D2D;">100 poin</span>
                                        </p>
                                        <div class="grid_layouts gr-btndjhsdjhsds">
                                            <button id="transactionDone" class="clr-light-gry btn-vegan text-capitalize f-Asap_medium --transparent-btn" data-code="{{$order_detail->transaction_code}}" data-id="{{$order_detail->id}}">
                                                selesai
                                            </button>
                                            <button class="btn-vegan text-capitalize f-Asap_medium green-bg-btn" id="givereview1">
                                                beri review
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End:/ Modal Terima Barang -->

                    <!-- Start Modal Beri Review -->
                    <div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
                        <div class="modal fade" id="givereviewproducts" tabindex="-1" role="dialog" aria-labelledby="givereviewproductsLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form id="reviewprodukform" action="" class="form-vegan" enctype="multipart/form-data">
                                        <div class="modal-header" id="headerheightreview">
                                            <h5 class="modal-title text-capitalize text-left desc-main-text f-Asap_medium" id="rebuyLabel">
                                                beri review ({{count($order_detail->details)}})
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-0">
                                            <div class="mdl-give-review">
                                                <div class="warning-orders --mdl-wrnngs">
                                                    <p class="mb-0">
                                                        Yuk ka ,tambahkan foto biar dapat point tambahan dari veganesia
                                                    </p>
                                                </div>
                                                <div class="menu-barang-review --scrlbrr" id="bodyheightreview">
                                                    @foreach($order_detail->details as $item)
                                                    <input class="id_transaksi_review" type="hidden" id="id_transaksi_review" name="id_transaksi_review" value="{{$order_detail->id}}">
                                                    <div class="lists-barang-review">
                                                        <div class="grid_layouts gr-product-lisstss">
                                                            <div class="cover-prdcts img-lazy small-lazy" data-src="{{ asset($item->item->cover_image) }}"></div>
                                                            <div>
                                                                <h6 class="f-Asap_medium mb-0">
                                                                    @if($item->item->is_variant == true)
                                                                    {{ $item->item->name }} - {{$item->product_variant->name}}
                                                                    <input class="id_produk_review" type="hidden" id="id_produk_review" name="id_produk_review" value="{{ $item->item->id }}">
                                                                    <input class="id_produk_review_varian" type="hidden" id="id_produk_review_varian" name="id_produk_review_varian" value="{{ $item->product_variant->id }}">
                                                                    @else
                                                                    {{ $item->item->name }}
                                                                    <input class="id_produk_review" type="hidden" id="id_produk_review" name="id_produk_review" value="{{ $item->item->id }}">
                                                                    <input class="id_produk_review_varian" type="hidden" id="id_produk_review_varian" name="id_produk_review_varian" value="0">
                                                                    @endif
                                                                </h6>
                                                            </div>
                                                        </div>
                                                        <div class="input-gallery-products">
                                                            <div>
                                                                <!-- <input id="imagereviews" class="input-imagereviews" name="imagereviews" type="file" multiple value=""> -->
                                                                <div class="input-field">
                                                                    <div class="input-imagereviews input-images-{{$order_detail->id}}" style="padding-top: .5rem;"></div>
                                                                </div>
                                                            </div>
                                                            <div class="comment-sectionss">
                                                                <div class="main-form-vg mb-0">
                                                                    <textarea class="ulasanproduk" value="" class="form-control" id="ulasanproduk" name="ulasanproduk" rows="3" placeholder="Berikan ulasanmu tentang produk ini"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer" id="footerheightreview">
                                            <button id="add-reviewprodukform" role="button" class="btn-vegan green-bg-btn text-capitalize" type="submit" style="width: 145px;" data-form="reviewprodukform">
                                                kirim
                                            </button>
                                            <button id="add-reviewprodukform1" role="button" class="btn-vegan green-bg-btn text-capitalize d-none" type="submit" style="width: 145px;" data-form="reviewprodukform">
                                                kirim
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End:/ Modal Beri Review -->

                    <!-- Start Modal Review Berhasil Ditambahkan -->
                    <div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
                        <div class="modal fade" id="reviewSuccess" tabindex="-1" role="dialog" aria-labelledby="reviewSuccessLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="cover-review" style="background-image: url('{{ asset('dist/fe/icons/got_poin.png') }}'); background-size: cover;"></div>
                                        <p class="clr-light-gry text-center" style="width: calc(100% - 50px); margin: 10px auto 30px;">
                                            Terimakasih ya sudah memberikan review belanjaannya, Selamat kamu mendapatkan <span style="color: #EE4D2D;">100 poin</span>
                                        </p>
                                        <div class="mt-3 mb-3">
                                            <button class="btn-vegan text-capitalize f-Asap_medium green-bg-btn m-auto" style="width: 145px" id="doneAddReview" data-code="{{$order_detail->transaction_code}}" data-id="{{$order_detail->id}}">
                                                selesai
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End:/ Modal Review Berhasil Ditambahkan -->

                    <!-- Start Modal Lihat Review -->
                    <div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
                        <div class="modal fade" id="modalviewreviewproducts" tabindex="-1" role="dialog" aria-labelledby="modalviewreviewproductsLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form id="viewreviewprodukform" action="" class="form-vegan" enctype="multipart/form-data">
                                        <div class="modal-header" id="viewheaderheightreview">
                                            <h5 class="modal-title text-capitalize text-left desc-main-text f-Asap_medium" id="viewrebuyLabel"></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-0">
                                            <div class="mdl-give-review">
                                                <div class="menu-barang-review --scrlbrr" id="viewbodyheightreview"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="border-top: unset;" id="viewfooterheightreview"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End:/ Modal Lihat Review -->
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Content Profile -->
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('dist/vendors/js/datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dist/vendors/image-uploader/dist/image-uploader.min.js') }}"></script>
    <script type="text/javascript">
        //GET POIN-REVIEW-REWARD (Tiap produk yg direview)
        $(document).ready(function(){
            /*start: jquery input uploader image gallery */
            $('.input-images-{{$order_detail->id}}').imageUploader({
                imagesInputName: 'imagereviews',
                label: '',
            });

            $('#givereviewproducts').on('shown.bs.modal', function(e) {
                var mxHght = $(window).height();
                var headerheight = $('#headerheightreview').height();
                var footerheight = $('#footerheightreview').height();
                var bodyheightreview = headerheight + footerheight;
                var count_height_bodies = mxHght - (bodyheightreview + 230);
                $('#bodyheightreview').css({
                    'overflow-x' : 'scroll',
                    'max-height' : count_height_bodies
                });
            });
            $('#viewreviewproducts').on('shown.bs.modal', function(e) {
                var mxHght = $(window).height();
                var headerheight = $('#viewheaderheightreview').height();
                var footerheight = $('#viewfooterheightreview').height();
                var bodyheightreview = headerheight + footerheight;
                var count_height_bodies = mxHght - (bodyheightreview + 230);
                $('#viewbodyheightreview').css({
                    'overflow-x' : 'scroll',
                    'max-height' : count_height_bodies
                });
            });
            /*end:/ jquery input uploader image gallery */

            /*start: Check and Unchecked Cart Rebuy */
            $('#rebuy').on('shown.bs.modal', function(e) {
                $(".checkbox-rebuy").prop('checked', false);
                $("#rebuy-pilihsemua").prop('checked', false);
                var check_cart = $('.checkbox-rebuy:checkbox');
                var check_cart_total = $('.checkbox-rebuy-all:checkbox');
                var total_all_check= $('.checkbox-rebuy').length;
                $('#total_chart').html(total_all_check);
                $('#rebuy-pilihsemua').val(0);
                $('#rebuy_total_lama').val(0);
                $('.qty_input').prev().addClass('number-minus-rebuy');
                $('.qty_input').next().addClass('number-plus-rebuy');

                // start: checked every input
                $(".checkbox-rebuy").click(function(){
                    var total_check= $('.checkbox-rebuy:checked').length;
                    $('#total_check').html(total_check);

                    if($(this).is(':checked')) {
                        if($('#total_check').text() == $('#total_chart').text()){
                            $('#rebuy-pilihsemua').prop('checked', true);
                        }
                        else{
                            $('#rebuy-pilihsemua').prop('checked', false);
                        }

                        if($('#rebuy_total_lama').val() == 0){
                            var prices = parseInt($(this).data('harga'));
                            var qty = $(this).data('qty');

                            var jumlah = prices*qty;
                            $('#rebuy_total_lama').val(jumlah);
                            $('#rebuy_totalPrice').val(jumlah);
                        }
                        else{
                            var lama = parseInt($('#rebuy_total_lama').val());
                            var prices = parseInt($(this).data('harga'));
                            var qty = $(this).data('qty');
                            var baru = prices*qty;

                            var jumlah =  lama+baru;
                            $('#rebuy_total_lama').val(jumlah);
                            $('#rebuy_totalPrice').val(jumlah);
                        }
                    }
                    else{
                        if($('#total_check').text() == $('#total_chart').text()){
                            $('#rebuy-pilihsemua').prop('checked', true);
                        }
                        else{
                            $('#rebuy-pilihsemua').prop('checked', false);
                        }

                        if($('#rebuy_total_lama').val() == 0){
                            var prices = parseInt($(this).data('harga'));
                            var qty = $(this).data('qty');

                            var jumlah = prices*qty;
                            $('#rebuy_total_lama').val(jumlah);
                            $('#rebuy_totalPrice').val(jumlah);
                        }
                        else{
                            var lama = parseInt($('#rebuy_total_lama').val());
                            var prices = parseInt($(this).data('harga'));
                            var qty = $(this).data('qty');
                            var baru = prices*qty;

                            var jumlah =  lama-baru;
                            $('#rebuy_total_lama').val(jumlah);
                            $('#rebuy_totalPrice').val(jumlah);
                        }
                    }

                    var harga = parseInt($('#rebuy_total_lama').val());
                    var reverse = harga.toString().split('').reverse().join(''),
                        ribuan  = reverse.match(/\d{1,3}/g);
                        ribuan  = ribuan.join('.').split('').reverse().join('');

                    $('#rebuy_totalCount').html('Rp '+ribuan+',00');
                    $('#rebuy_totalPrice').val(harga);
                });
                // end:/ checked every input

                function hitungTotalRebuy() {
                    var total = 0;
                    var average = 0;
                    $('.checkbox-rebuy').each(function () {
                        var prices = parseInt($(this).data('harga'));
                        var qty = $(this).data('qty');
                        var counttotal = parseInt(prices*qty);
                        if (!isNaN(prices) && prices.length != 0) {
                            total += counttotal;
                        }
                    });

                    if (!isNaN(total) && total != 0) {
                        var txtboxes = $('.checkbox-rebuy').length;
                        average = parseInt(total) / txtboxes;
                    }

                    var reverse = total.toString().split('').reverse().join(''),
                        ribuan  = reverse.match(/\d{1,3}/g);
                        ribuan  = ribuan.join('.').split('').reverse().join('');

                    $('#rebuy_totalCount').text('Rp '+ribuan+',00');
                    $('#rebuy_total_lama').val(total);
                    $('#rebuy_totalPrice').val(total);
                }

                // start: checked all input
                $("#rebuy-pilihsemua").click(function(){
                    if($('.checkbox-rebuy').length == 1){
                        if($('.checkbox-rebuy').data('stock') == 0){
                            Swal.fire({
                                type: 'error',
                                title: 'Mohon maaf',
                                text: 'Produk ini telah habis terjual',
                                allowOutsideClick: false
                            })
                            $('#rebuy-pilihsemua').prop('checked', false);
                        }
                    }
                    else if($(this).is(":checked")) {
                        $(".checkbox-rebuy").attr({
                            "data-checked" : 'yes',
                        });

                        $('.checkbox-rebuy').each(function () {
                            // if( $(this).data('stock') == 0){
                            //     $(this).prop('checked', false);
                            // }else{
                                $(this).prop('checked', true);
                            // }
                        });
                        var total_check= $('.checkbox-rebuy:checked').length;
                        $('#total_check').html(total_check);

                        if($('#total_check').text() == $('#total_chart').text()){
                            hitungTotalRebuy();
                        }
                    }
                    else if(!$(this).is(":checked")) {
                        $(".checkbox-rebuy").attr({
                            "data-checked" : 'no',
                        });
                        $(".checkbox-rebuy").prop('checked', false);
                        $('#total_check').html(0);
                        $('#rebuy_totalCount').text('Rp '+0+',00');
                        $('#rebuy_total_lama').val(0);
                    }
                });
                // end:/ checked all input

                // start: input number
                $(".number-plus").bind('keyup mouseup change', function () {
                    if($(this).hasClass('number-plus-rebuy')){
                        var max = $(this).prev().data('max');
                        var qtys= +$(this).prev().val() + 1 > max ? max : +$(this).prev().val() + 1;
                        var products_id= $(this).prev().data('product');
                        var cart_id = $(this).prev().data('id');
                        $('.rebuyproducts-'+products_id+'').attr('data-qty', qtys);
                        $('input[name="rebuy-'+products_id+'"]').attr('data-qty', qtys);
                        $('input[name="rebuy-'+products_id+'"]').data('qty', qtys);

                    }
                });

                $(".number-minus").bind('keyup mouseup change', function () {
                    if($(this).hasClass('number-minus-rebuy')){
                        var min = $(this).next().data('min');
                        var cart_id = $(this).next().data('id')
                        var qtys = +$(this).next().val() - 1 < min ? min : +$(this).next().val() - 1;
                        var products_id= $(this).next().data('product');
                        $('.rebuyproducts-'+products_id+'').attr('data-qty', qtys);
                        $('input[name="rebuy-'+products_id+'"]').attr('data-qty', qtys);
                        $('input[name="rebuy-'+products_id+'"]').data('qty', qtys);
                    }
                });
                // end:/ input number

                $('#checkoutRebuy').on('click',function (e) {
                    e.preventDefault();
                    var id_product   = [];
                    var qty_buy_again   = [];
                    var id_variant   = [];
                    var hasilchck = $('#rebuy_totalPrice').val();

                    $.each($('.checkbox-rebuy'),function(index){
                        if($(this).is(":checked")){
                            id_product[index] = $(this).data('product');
                        }
                    });

                    $.each($('.checkbox-rebuy'),function(index){
                        if($(this).is(":checked")){
                            qty_buy_again[index] = $(this).data('qty');
                        }
                    });

                    $.each($('.checkbox-rebuy'),function(index){
                        if($(this).is(":checked")){
                            id_variant[index] = $(this).data('variant');
                        }
                    });

                    $.ajax({
                        url: "{{ route('rebuy') }}",
                        method: 'POST',
                        dataType: "json",
                        data: {
                            id_product: id_product,
                            qty: qty_buy_again,
                            variant: id_variant,
                            prc: hasilchck,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            if(response.success == true){
                                console.log(response);
                                Swal.fire({
                                    type: 'success',
                                    title: 'Terimakasih',
                                    text: 'Anda akan diarahkan ke halaman checkout',
                                    allowOutsideClick: false
                                }).then(function() {
                                    window.location = response.redirect;
                                });
                                // window.location = '{{ route("checkout.index") }}';
                            }
                            // else if(response.no_stock == true){
                            //     Swal.fire({
                            //         type: 'error',
                            //         title: 'Maaf!',
                            //         text: 'Stok Produk Tidak Tersedia!',
                            //     }).then(function() {
                            //         if(response.product.is_variant == true){
                            //             $('#not_enough_stock_'+response.cart.id+'').html('Maaf, jumlah stok yang tersisa adalah '+response.cart.stock+'')
                            //         }
                            //         else{
                            //             $('#not_enough_stock_'+response.product.id+'').html('Maaf, jumlah stok yang tersisa adalah '+response.product.stock+'')
                            //         }
                            //     });
                            // }
                            else{
                                Swal.fire({
                                    type: 'error',
                                    title: 'Error!',
                                    text: 'Mohon cek kembali inputan Anda',
                                    allowOutsideClick: false
                                });
                            }
                        },
                        error : function (xhr) {
                            Swal.fire({
                                title: "Ups!",
                                text: "Mohon cek kembali inputan Anda",
                                type: "error",
                                allowOutsideClick: false
                            });
                            // .then(function() {
                            //     window.location.reload()
                            // });
                        }
                    });
                });
            });
            /*end:/ Check and Unchecked Cart Rebuy */

            /********************************/
            /*Tambah Review Produk*/
            /********************************/
            $(document).on('click','#givereview1',function(e){
                $(this).closest(".modal").modal('hide');
                $('#givereviewproducts').modal('show');
                $('#add-reviewprodukform').removeClass('d-block');
                $('#add-reviewprodukform').addClass('d-none');
                $('#add-reviewprodukform1').removeClass('d-none');
                $('#add-reviewprodukform1').addClass('d-block');
            });

            $(document).on('click','#add-reviewprodukform', function (e) {
                e.preventDefault();
                var comment = [];
                var product = [];
                var order   = [];
                var imagereviews   = [];
                var data = new FormData();

                $(".ulasanproduk").each(function(index) {
                    comment[index] = $(this).val();
                });

                $(".id_produk_review").each(function(index) {
                    product[index] = $(this).val();
                });

                $(".id_transaksi_review").each(function(index) {
                    order[index] = $(this).val();
                });

                $(".input-imagereviews").each(function(index) {
                    var files = [];
                    files = $(this)[0].files;

                    $.each(files, function(key, v) {
                        data.append("imagereviews["+index+"][]", files[key]);
                    });
                });

                data.append("comment", comment);
                data.append("product", product);
                data.append("order", order);

                $.ajaxSetup({
                    headers: { "X-CSRF-Token" : $("meta[name=csrf-token]").attr("content") }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{ route('akun_pesanan.review.save') }}",
                    data: data,
                    dataType: "json",
                    processData : false,
                    contentType : false,
                    beforeSend: function () {
                        Swal.fire({
                            title: "Mohon Menunggu",
                            text: "System sedang memproses permintaan Anda",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                        });
                    },
                    success: function (response) {
                        if(response.success == true){
                            Swal.close();
                            $('#add-reviewprodukform').closest(".modal").modal('hide');
                            $('#reviewSuccess').modal({
                                backdrop: 'static',
                                keyboard: false
                            });
                        }
                        else{
                            Swal.fire({
                                title: "Maaf!",
                                text: "Mohon beri input penilaian anda pada masing-masing produk",
                                type: "error",
                                allowOutsideClick: false,
                            });
                        }
                    },
                    error: function (data) {
                        var res = data.responseJSON;
                        Swal.fire({
                            title: "Ups!",
                            text: "Mohon cek kembali inputan Anda",
                            type: "error",
                        });
                    }
                });
            });

            $(document).on('click','#add-reviewprodukform1', function (e) {
                e.preventDefault();
                var comment = [];
                var product = [];
                var order   = [];
                var imagereviews   = [];
                var data = new FormData();

                $(".ulasanproduk").each(function(index) {
                    comment[index] = $(this).val();
                });

                $(".id_produk_review").each(function(index) {
                    product[index] = $(this).val();
                });

                $(".id_transaksi_review").each(function(index) {
                    order[index] = $(this).val();
                });

                $(".input-imagereviews").each(function(index) {
                    var files = [];
                    files = $(this)[0].files;

                    $.each(files, function(key, v) {
                        data.append("imagereviews["+index+"][]", files[key]);
                    });
                });

                data.append("comment", comment);
                data.append("product", product);
                data.append("order", order);

                $.ajaxSetup({
                    headers: { "X-CSRF-Token" : $("meta[name=csrf-token]").attr("content") }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{ route('akun_pesanan.review.save') }}",
                    data: data,
                    dataType: "json",
                    processData : false,
                    contentType : false,
                    beforeSend: function () {
                        Swal.fire({
                            title: "Mohon Menunggu",
                            text: "System sedang memproses permintaan Anda",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                        });
                    },
                    success: function (response) {
                        if(response.success == true){
                            Swal.close();
                            $('#add-reviewprodukform').closest(".modal").modal('hide');
                            $('#reviewSuccess').modal({
                                backdrop: 'static',
                                keyboard: false
                            });
                        }
                        else{
                            Swal.fire({
                                title: "Maaf!",
                                text: "Mohon beri input penilaian anda pada masing-masing produk",
                                type: "error",
                                allowOutsideClick: false,
                            });
                        }
                    },
                    error: function (data) {
                        var res = data.responseJSON;
                        Swal.fire({
                            title: "Ups!",
                            text: "Mohon cek kembali inputan Anda",
                            type: "error",
                        });
                    }
                });
            });

            $('#doneAddReview').on('click',function (e) {
                e.preventDefault();
                var id_order = $(this).data('id');

                $.ajax({
                    url: "{{ route('akun_pesanan.done') }}",
                    method: 'POST',
                    dataType: "json",
                    data : {
                        _token: "{{ csrf_token() }}",
                        id: id_order,
                        is_review: true,
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#reviewSuccess').modal('hide');
                            Swal.fire({
                                type: 'success',
                                title: 'Terima kasih telah setia berbelanja di Veganesia!',
                                text: 'Anda akan tetap dialihkan ke halaman detail pesanan anda.',
                                confirmButtonText: 'Ok',
                                allowOutsideClick: false
                            }).then(function() {
                                window.location.reload();
                            });
                        }
                    },
                    error : function (xhr) {
                        var res = xhr.responseJSON;
                        console.log(res);
                        // Return Form Validation if Exist
                        if ($.isEmptyObject(res) == false) {
                            $.each(res.errors, function (key, value) {
                                $('#' + key)
                                    .closest('.input-group')
                                    // .closest('div')
                                    .addClass('has-error')
                                    .append('<div class="invalid-feedback">' + value + '</div>');
                                $('#' + key).addClass('is-invalid');
                            });
                            // Flush Submit Status
                            form.data('submitted', false);
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Ups!',
                            text: 'Mohon cek kembali inputan Anda',
                        });
                    }
                })
            });

            $('#viewreviewproducts').on('click',function (e) {
                e.preventDefault();
                var data_id = $(this).data('id');
                var data_code = $(this).data('code');

                $.ajax({
                    url: "{{ route('akun_pesanan.review.all') }}",
                    method: 'POST',
                    dataType: "json",
                    data: {
                        id_transaction: data_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        var html  = '';
                        var response = data.product;
                        $('#viewrebuyLabel').text('lihat review ('+data.total_product+')');
                        $.each(response, function(i,v){
                            html += '<div class="lists-barang-review">'
                                html += '<div class="grid_layouts gr-product-lisstss">'
                                    html += '<div class="cover-prdcts" style="background-image:url('+v.media+')"></div>'
                                    html += '<div>'
                                        html += '<h6 class="f-Asap_medium mb-0">'+v.name+'</h6>'
                                    html += '</div>'
                                html += '</div>'

                                html += '<div class="input-gallery-products view-review-sections">'
                                    html += '<div class="comment-sectionss">'
                                        html += '<p class="mb-0">'+v.comment+'</p>'
                                    html += '</div>'
                                    html += '<div class="grid_layouts gallery-grid-review">'
                                        $.each(v.photo, function(i,p){
                                            if(p.type == 'image'){
                                                html += '<div class="cover-prdcts --for-rvws" style="background-image: url('+p.media+')"></div>'
                                            }
                                            else if(p.type == 'video'){
                                                html += '<div class="video-reviews --small-vid">'
                                                    html += '<video>'
                                                        html += '<source src="'+p.media+'">'
                                                    html += '</video>'
                                                    html += '<div id="time-ruler"></div>'
                                                    {{--html += '<canvas id="canvas" width="300" height="300"></canvas>'--}}
                                                    html += '<div id="thumbnailContainer"></div>'
                                                html += '</div>'
                                            }
                                        });
                                    html += '</div>'
                                    const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                                                        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                                                       ];
                                    const date = new Date(v.created_at);
                                    html += '<div class="mt-3"><small class="clr-light-gry small-fnt">'+date.getDate()+' '+monthNames[date.getMonth()]+' '+date.getFullYear()+' '+date.getHours()+':'+date.getMinutes()+'</small></div>'
                                html += '</div>'
                            html += '</div>';
                        });
                        $('#viewbodyheightreview').html(html);
                        $('#modalviewreviewproducts').modal({
                            backdrop: 'static',
                            keyboard: false
                        });
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var winds = $(window).height();
            var count_hgts_mdl = winds - 250;
            $('#products-lists-mdl').css('max-height', count_hgts_mdl);

            /********************************/
            /*Pembayaran Midtrans*/
            /********************************/
            $('#midtransPay').on('click',function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var total = $(this).data('total');

                $.ajax({
                    url: "{{ route('akun_pesanan.bayarmidtrans') }}",
                    method: 'POST',
                    dataType: "json",
                    data : {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        total: total
                    },
                    success: function (response) {
                        if(response.midtrans == true){
                            var transactionData = response.total;
                            var snapToken = response.getPayment.token;
                            var midtrans_route = response.getPayment.redirect_url;
                            console.log('token : '+response.getPayment.token);
                            console.log('route : '+response.getPayment.redirect_url);
                            if (snapToken) {
                                // window.location = midtrans_route;
                                snap.pay(snapToken,{
                                    onSuccess: function(result){
                                        console.log('success');
                                        console.log('token : '+response.getPayment.token);
                                        console.log('route : '+response.getPayment.redirect_url);
                                        console.log(result);
                                        Swal.close();
                                        window.location.reload()
                                    },
                                    onPending: function(result){
                                        console.log('pending');
                                        console.log(result);
                                        Swal.close();
                                        window.location.reload()
                                    },
                                    onError: function(result){
                                        console.log('error');
                                        console.log(result);
                                        Swal.close();
                                    },
                                    onClose: function(){
                                        console.log('customer closed the popup without finishing the payment');
                                        Swal.close();
                                    }
                                });
                            }
                        }
                    },
                    error : function (xhr) {
                        var res = xhr.responseJSON;
                        console.log(res);
                        // Return Form Validation if Exist
                        if ($.isEmptyObject(res) == false) {
                            $.each(res.errors, function (key, value) {
                                $('#' + key)
                                    .closest('.input-group')
                                    // .closest('div')
                                    .addClass('has-error')
                                    .append('<div class="invalid-feedback">' + value + '</div>');
                                $('#' + key).addClass('is-invalid');
                            });
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Ups!',
                            text: 'Mohon cek kembali inputan Anda',
                        });
                    }
                })
            });

            /********************************/
            /*Pembayaran Bank Transfer*/
            /********************************/
            $('#saveBuktiBayar').on('submit',function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                console.log(formData);

                $.ajax({
                    url: "{{ route('akun_pesanan.bayar') }}",
                    method: 'POST',
                    dataType: "json",
                    data : formData,
                    processData : false,
                    contentType : false,
                    success: function (response) {
                        console.log(response.success);
                        if (response.success) {
                            Swal.fire({
                                title: 'Bukti pembayaran berhasil di upload !',
                                type: 'success',
                                text: 'Admin kami mengkonfirmasi pembayaran yang anda lakukan. Kami akan mengirimkan pemberitahuan tentang status pembayaran anda. Terima kasih telah berbelanja di Veganesia.',
                                confirmButtonText: 'Ok',
                                allowOutsideClick: false
                            }).then(function() {
                                window.location.reload();
                            });
                        }
                        else{
                            Swal.fire({
                                type: 'Error',
                                title: 'Maaf!',
                                text: 'Mohon masukkan data dengan benar',
                                confirmButtonText: 'Ok',
                                allowOutsideClick: false
                            }).then(function() {
                                $('#saveBuktiBayar').valid();
                            });
                        }
                    },
                    error : function (xhr) {
                        var res = xhr.responseJSON;
                        console.log(res);
                        // Return Form Validation if Exist
                        if ($.isEmptyObject(res) == false) {
                            $.each(res.errors, function (key, value) {
                                $('#' + key)
                                    .closest('.input-group')
                                    // .closest('div')
                                    .addClass('has-error')
                                    .append('<div class="invalid-feedback">' + value + '</div>');
                                $('#' + key).addClass('is-invalid');
                            });
                            // Flush Submit Status
                            form.data('submitted', false);
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Ups!',
                            text: 'Mohon cek kembali inputan Anda',
                        }).then(function() {
                            $('#saveBuktiBayar').valid();
                        });
                    }
                })
            });

            /********************************/
            /*Transaksi Selesai*/
            /********************************/
            $('#transactionDone').on('click',function (e) {
                e.preventDefault();
                var id_order = $(this).data('id');

                $.ajax({
                    url: "{{ route('akun_pesanan.done') }}",
                    method: 'POST',
                    dataType: "json",
                    data : {
                        _token: "{{ csrf_token() }}",
                        id: id_order
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#terimabarang').hide();
                            Swal.fire({
                                type: 'success',
                                title: 'Terima kasih telah setia berbelanja di Veganesia!',
                                text: 'Anda akan tetap dialihkan ke halaman detail pesanan anda.',
                                confirmButtonText: 'Ok',
                                allowOutsideClick: false
                            }).then(function() {
                                window.location.reload();
                            });
                        }
                    },
                    error : function (xhr) {
                        var res = xhr.responseJSON;
                        console.log(res);
                        // Return Form Validation if Exist
                        if ($.isEmptyObject(res) == false) {
                            $.each(res.errors, function (key, value) {
                                $('#' + key)
                                    .closest('.input-group')
                                    // .closest('div')
                                    .addClass('has-error')
                                    .append('<div class="invalid-feedback">' + value + '</div>');
                                $('#' + key).addClass('is-invalid');
                            });
                            // Flush Submit Status
                            form.data('submitted', false);
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Ups!',
                            text: 'Mohon cek kembali inputan Anda',
                        });
                    }
                })
            });
        });
    </script>
@endpush
