@extends('layouts.fe.app')

@push('title')
    <title>Dasibana</title>
@endpush

@push('css')
    <link rel="stylesheet" href="{{asset('dist/fe/css/home.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('dist/vendors/slick-slider/slick/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('dist/vendors/slick-slider/slick/slick-theme.css')}}"/>
@endpush

@section('content')
    <section class="home-dasibana">
        <div class="banner-dasibana" style="background-image: url('{{asset('images/banner-home.jpg')}}')">
            <div class="bg-overlay-banner"></div>
            <div class="container content-banner-top">
                <div class="dasibana-icon-name">
                    <div class="ct-banner-text">
                        <h1 class="text-uppercase mb-4">
                            dasibana
                        </h1>
                        <p class="text-capitalize mt-4">
                            menyediakan keperluan dasi, grosir sarung dan sajadah
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="desc-singkat-dasibana section-ct">
            <div class="container">
                <h1 class="main-title" style="color: #ffffff !important;">deskripsi perusahaan</h1>
                <div class="box-desc">
                    <p class="text-center mb-0">
                        {{ $profil->deskripsi }}
                    </p>
                </div>
            </div>
        </div>

        <div class="produk-unggulan section-ct">
            <div class="container">
                <h1 class="main-title">produk terbaru</h1>
                <div class="gr_display gr-prodc">
                    @if(count($produk_terbaru) > 0)
                    @foreach($produk_terbaru as $newProducts)
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset($newProducts->fotoProduk)}}')">
                            <div class="bottom-hidden-btn">
                                <div class="gr_display gr-btn-prdc">
                                    <a class="pc-btn-prdct --shopee" target="_blank" href={{$newProducts->link_shopee}} style="background-image: url('{{asset('images/icons/shopee.png')}}')"></a>
                                    <a class="pc-btn-prdct --tokped" target="_blank" href={{$newProducts->link_tokopedia}} style="background-image: url('{{asset('images/icons/tokopedia.png')}}')"></a>
                                </div>
                                <div class="overlay-btns-prd"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="kategori-produk-dasibana section-ct parallax-bg" style="background-image: url('{{asset('images/parallax.jpg')}}')">
            <div class="overlay-bg-parallax"></div>
            <div class="container ct-parallax">
                <h1 class="main-title" style="color: #ffffff !important;">kategori produk</h1>
                <div class="sec-kategori-home">
                    @if(count($kategori_produk) > 0)
                    <div class="kategori-dsb-slick">
                        @foreach($kategori_produk as $productCathegory)
                        <div class="ct-cat-home">
                            <div class="parallax-slides"></div>
                            <a href="{{ route('detail_categhory', [$productCathegory->slug]) }}" class="mb-0 text-center">
                                {{$productCathegory->kategoriName}}
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script type="text/javascript" src="{{asset('dist/fe/js/jquery-migrate-1.2.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('dist/vendors/slick-slider/slick/slick.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.kategori-dsb-slick').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 3000,
                responsive: [
                    {
                        breakpoint: 992,
                        settings:
                            {
                                slidesToShow: 2,
                            }
                    },
                    {
                        breakpoint: 768,
                        settings:
                            {
                                slidesToShow: 1,
                            }
                    },
                ]
            });
        });
    </script>
@endpush
