@extends('layouts.fe.fe')

@section('metadata')
    <title>Veganesia - Kupon Saya</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/akun/kupon/main.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/fe/css/content/sidebar_akun.css') }}">
@endpush

@section('content')
    <div class="akun-poin">
        <!-- Content Profile -->
        <!-- ============================================================== -->
        <section class="sec-akun-poin container">
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
                    <div class="box-akun-poin">
                        <div class="border-bottom-large menu-poin">
                            <div>
                                <h6 style="color: #1FBC9D;" class="ksjak main-sub-text f-Asap_medium text-capitalize mb-0 clr-lght-gsh">
                                    kupon saya
                                </h6>
                            </div>
                        </div>
                        
                        <!-- Start Main Poin  -->
                        <div class="menu-poin">
                            <p class="clr-light-gry mb-0">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim ullamcorper maecenas montes, arcu sit augue donec in porttitor. Aenean tellus et proin quis
                            </p>
                            <div class="pt-poin-menu">
                                @if(count($coupons) > 0)
                                <!-- Start: If there is voucher -->
                                <div class="grid_layouts --ls-ct-poin">
                                    @foreach($coupons as $voucher)
                                    <div class="crd-ct-poin">
                                        <a href="{{ route('akun_detail_mykupon', $voucher->kode) }}">
                                            <div class="img-crd-point img-lazy big-lazy" data-src="{{ asset($voucher->image) }}"></div>
                                        </a>
                                        <div class="bttm-ct-pon-crd">
                                            <div class="pad-hgh">
                                                <h5 class="mb-0 main-sub-text f-Asap_medium">
                                                    {{ $voucher->keterangan }}
                                                </h5>
                                            </div>
                                            <div class="grid_layouts gr-twolhsa masaberlaku pad-hgh">
                                                <div>
                                                    <h6 class="text-capitalize f-Asap_medium">
                                                        masa berlaku
                                                    </h6>
                                                    <small style="color: rgba(51, 51, 51, 0.6);">
                                                        {{ Carbon\Carbon::parse($voucher->end_date)->format('d F Y') }}
                                                    </small>
                                                </div>
                                                <div class="rightkshaha">
                                                    <h6 class="text-capitalize f-Asap_medium">
                                                        minimal transaksi
                                                    </h6>
                                                    <small class="text-capitalize" style="color: rgba(51, 51, 51, 0.6);">
                                                        @if($voucher->min_pembelanjaan > 0)
                                                        {{ $voucher->min_pembelanjaan }}
                                                        @else
                                                        tanpa minimal transaksi
                                                        @endif
                                                    </small>
                                                </div>
                                                <div class="circle-trnsp --tr-left"></div>
                                                <div class="circle-trnsp --tr-right"></div>
                                            </div>
                                            <div class="grid_layouts desc-point pad-hgh pt-3">
                                                <div class="lists-pointss">
                                                    <h5 class="mb-0 text-capitalize f-Asap_medium main-sub-text">
                                                        kode promo : <span style="color: #1FBC9D;">{{ $voucher->kode }}</span>
                                                    </h5>
                                                </div>
                                                <div class="howtogetpoint lists-pointss">
                                                    <a href="{{ route('akun_detail_mykupon', $voucher->kode) }}" class="mb-0 f-Asap_medium main-sub-text" style="color: #2F80ED;">S&K</a>
                                                </div>
                                            </div>
                                            <div class="btn-swtch position-relative">
                                                <button data-target="{{$voucher->id}}" class="copyclp-vegan-btn btn-vegan green-bg-btn text-capitalize f-Asap_medium main-sub-text" data-clipboard-text="{{$voucher->kode}}" type="button">
                                                    salin kode
                                                </button>
                                                <div class="ct-tggle tggl-lgrhfsbfjs" id="copyclip-vegan{{$voucher->id}}" style="display: none">
                                                    <div class="position-relative">
                                                        <small class="small-fnt">Copied</small>
                                                        <div class="mn-arrw"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- End:/ If there is voucher -->
                                
                                <!-- Pagination -->
                                <!-- ============================================================== -->
                                {{ $coupons->links('layouts.fe.pagination')}}
                                <!-- ============================================================== -->
                                <!-- End Pagination -->
                                @else
                                
                                <!-- Start Tidak Ada Voucher -->
                                <div class="no-post-list">
                                    <div class="img-no-post img-lazy small-lazy" data-src="{{ asset('dist/fe/icons/no_promo.png') }}"></div>
                                    <div class="desc-no-post">
                                        <h6 class="text-capitalize f-Asap_medium main-sub-text">maaf! tidak ada voucher tersedia</h6>
                                    </div>
                                </div>
                                <!-- End:/ Tidak Ada Voucher -->
                                @endif
                            </div>
                        </div>
                        <!-- End Main Poin  -->
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Content -->
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Content Profile -->
    </div>
@endsection

@push('scripts')

@endpush