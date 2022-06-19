@extends('layouts.fe.fe')

@section('metadata')
    <title>Veganesia - Promo {{$vouchers->title}}</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/promo/detail.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/content/card_product.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/vendor/slick_slider.css') }}">
@endpush

@section('content')
    <div class="detailpromo-section">
        <!-- Content Promo -->
        <!-- ============================================================== -->
        <section class="sec-detailpromo container">
            <!-- Content -->
            <!-- ============================================================== -->
            <div class="box-detailpromo">
                <!-- Breadcrumb -->
                <!-- ============================================================== -->
                <div class="sec-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('promo')}}">Promo</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{$vouchers->title}}
                            </li>
                        </ol>
                    </nav>
                </div>
                <!-- ============================================================== -->
                <!-- End Breadcrumb -->

                <!-- Start Content Detail Promo -->
                <div class="menu-detailpromo">
                    <div class="grid_layouts gr-detailvchs">
                        <div class="detail-mns">
                            <div class="img-crd-point img-lazy big-lazy" data-src="{{ asset($cover) }}"></div>
                            <h5 class="mb-0 clr-grey-txt desc-main-text f-Asap_medium">{{$vouchers->title}}</h5>
                            <div class="tabmenu-detail-voucher navs-vegan">
                                <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active text-uppercase" id="deskripsi-tab" data-toggle="tab" href="#deskripsi" role="tab" aria-controls="deskripsi" aria-selected="true">
                                            deskripsi
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase" id="sandk-tab" data-toggle="tab" href="#sandk" role="tab" aria-controls="sandk" aria-selected="false">
                                            syarat dan ketentuan
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="deskripsi" role="tabpanel" aria-labelledby="deskripsi-tab">
                                        <article>
                                            <p class="mb-0">
                                                @if(isset($vouchers->keterangan))
                                                {!! strip_tags($vouchers->keterangan) !!}
                                                @else
                                                -
                                                @endif
                                            </p>
                                        </article>
                                    </div>
                                    <div class="tab-pane fade" id="sandk" role="tabpanel" aria-labelledby="sandk-tab">
                                        <article>
                                            <p class="mb-0">
                                                @if(isset($vouchers->ketentuan))
                                                {!! strip_tags($vouchers->ketentuan) !!}
                                                @else
                                                -
                                                @endif
                                            </p>
                                        </article>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="detail-promo-info">
                            <div class="ls-detail-promo-info">
                                <h6 class="mb-0 text-uppercase desc-main-text text-center" style="color: #333333;">info promo</h6>
                            </div>
                            <div class="ls-detail-promo-info grid_layouts text-center">
                                <div>
                                    <h6 class="text-capitalize f-Asap_medium">
                                        masa berlaku
                                    </h6>
                                    <small style="color: rgba(51, 51, 51, 0.6);">
                                        {{ Carbon\Carbon::parse($vouchers->end_date)->format('d F Y') }}
                                    </small>
                                </div>
                                <div class="rightkshaha">
                                    <h6 class="text-capitalize f-Asap_medium">
                                        minimal transaksi
                                    </h6>
                                    <small class="text-capitalize" style="color: rgba(51, 51, 51, 0.6);">
                                        @if($vouchers->min_pembelanjaan > 0)
                                        {{ $vouchers->min_pembelanjaan }}
                                        @else
                                        tanpa minimal transaksi
                                        @endif
                                    </small>
                                </div>
                            </div>
                            <div class="ls-detail-promo-info d-block">
                                <div>
                                    <h5 class="mb-0 text-capitalize f-Asap_medium main-sub-text">
                                        kode promo : <span style="color: #1FBC9D;">{{ $vouchers->kode }}</span>
                                    </h5>
                                </div>
                                <div class="position-relative">
                                    <button data-target="{{$vouchers->id}}" class="copyclp-vegan-btn mt-2 btn-vegan green-bg-btn text-capitalize f-Asap_medium" data-clipboard-text="{{$vouchers->kode}}" type="button">
                                        salin kode
                                    </button>
                                    <div class="ct-tggle" id="copyclip-vegan{{$vouchers->id}}" style="display: none">
                                        <div class="position-relative">
                                            <small class="small-fnt">Copied</small>
                                            <div class="mn-arrw"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ls-detail-promo-info grid_layouts">
                                <div>
                                    <h6 class="mb-0 text-capitalize" style="color: rgba(51, 51, 51, 0.6);">bagikan</h6>
                                </div>
                                <div class="dsdhs">
                                    <div class="position-relative shares-smd share-btn" id="share-oz01" data-url="{{ route('akun_detail_voucher', $vouchers->kode) }}" data-title="{{ $vouchers->title }}" data-desc="{{ $vouchers->title }}">
                                        <div>
                                            <a class="btn-facebook" data-id="fb">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </div>
                                        <div>
                                            <a class="btn-twitter" data-id="tw">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </div>
                                        <div>
                                            <a id="copyclp101" class="copyclp position-relative" data-clipboard-text="{{ route('akun_detail_voucher', $vouchers->kode) }}" type="button">
                                                <i class="fas fa-link"></i>
                                            </a>
                                        </div>
                                        <div class="ct-tggle ct-tggle1" id="ct-tggle101" style="display: none">
                                            <div class="position-relative">
                                                <small class="small-fnt">Copied</small>
                                                <div class="mn-arrw"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Content Detail Promo -->
            </div>
            <!-- ============================================================== -->
            <!-- End Content -->
        </section>
        <!-- ============================================================== -->
        <!-- End Content Promo -->

        @if(count($promoWeekly) > 0)
        <!-- Weekly Product Slider -->
        <!-- ============================================================== -->
        <section class="weekly-slider-product mb-detil-sec">
            <div class="container">
                <div class="head-ct-slider pt-0">
                    <div class="head-ttle">
                        <h3 class="text-uppercase mb-0">
                            weekly promo
                        </h3>
                    </div>
                    <div class="head-btn"></div>
                </div>
                @if(count($promoWeekly) > 0)
                <div class="ct-slider-ot slider-lazy big-lazy">
                    <div class="sldroth --slider-main slick-arrow-custom slider-temp">
                        @foreach($promoWeekly as $key=>$p)
                        <div>
                            @include('public.produk.card_product',['produk'=>$p])
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <!-- Start: If there is no voucher -->
                <div class="no-post-list">
                    <div>
                        <img src="{{ asset('dist/fe/icons/produk-empty.png') }}" alt="no post">
                    </div>
                    <div>
                        <p class="text-center">
                            Tidak ada postingan
                        </p>
                    </div>
                </div>
                <!-- End:/ If there is no post -->
                @endif
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Weekly Product Slider -->
        @endif
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('dist/vendors/slick-slider/slick/slick.js')}}"></script>
    <script type="text/javascript" src="{{ asset('dist/fe/js/pages/promo_detail.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            /*Start: Global Clipboard Copy*/
            function setToggle1(message) {
                $("#ct-tggle101").slideDown();
            }

            function hideToggle1() {
                setTimeout(function() {
                    $('#ct-tggle101').slideUp();
                }, 1200);
            }

            var clp1 = new ClipboardJS('#copyclp101');
            clp1.on('success', function(e) {
                setToggle1();
                hideToggle1();
            });
            /*End:/ Global Clipboard Copy*/
        });
    </script>
@endpush