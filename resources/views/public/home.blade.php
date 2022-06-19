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
        <div class="banner-dasibana" style="background-image: url('{{asset('images/banner.jpg')}}')">
            <div class="bg-overlay-banner"></div>
            <div class="container content-banner-top">
                <div class="dasibana-icon-name">
                    <h1>
                        dasibana
                    </h1>
                </div>
            </div>
        </div>

        <div class="desc-singkat-dasibana section-ct">
            <div class="container">
                <p class="text-center mb-0">
                    Kami produsen Dasi menyediakan berbagai macam dasi untuk kebutuhan kantor, wedding, sekolah, dll. Seperti Dasi Panjang dan Dasi Kupu-kupu, serta aksesoris lainnya seperti Penjepit Dasi dan Suspender. Menerima pesanan dalam jumlah banyak atau partai besar, bisa juga tambah sablon atau bordir sesuai keinginan anda dengan harga yang sangat terjangkau. Tidak hanya itu saja kami juga menyediakan grosir Oleh-oleh Haji berupa Sarung Tenun, Sajadah, Peci, Tasbih dan Sorban..
                </p>
            </div>
        </div>

        <div class="produk-unggulan section-ct">
            <div class="container">
                <h1 class="main-title">produk unggulan</h1>
                <div class="gr_display gr-prodc">
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset('images/product1.jpg')}}')">
                            <div class="bottom-hidden-btn">
                                <div class="gr_display gr-btn-prdc">
                                    <a class="pc-btn-prdct --shopee" target="_blank" href="https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a" style="background-image: url('{{asset('images/icons/shopee.png')}}')"></a>
                                    <a class="pc-btn-prdct --tokped" target="_blank" href="https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik" style="background-image: url('{{asset('images/icons/tokopedia.png')}}')"></a>
                                </div>
                                <div class="overlay-btns-prd"></div>
                            </div>
                        </div>
                    </div>
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset('images/product5.jpg')}}')">
                            <div class="bottom-hidden-btn">
                                <div class="gr_display gr-btn-prdc">
                                    <a class="pc-btn-prdct --shopee" target="_blank" href="https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a" style="background-image: url('{{asset('images/icons/shopee.png')}}')"></a>
                                    <a class="pc-btn-prdct --tokped" target="_blank" href="https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik" style="background-image: url('{{asset('images/icons/tokopedia.png')}}')"></a>
                                </div>
                                <div class="overlay-btns-prd"></div>
                            </div>
                        </div>
                    </div>
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset('images/product8.jpg')}}')">
                            <div class="bottom-hidden-btn">
                                <div class="gr_display gr-btn-prdc">
                                    <a class="pc-btn-prdct --shopee" target="_blank" href="https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a" style="background-image: url('{{asset('images/icons/shopee.png')}}')"></a>
                                    <a class="pc-btn-prdct --tokped" target="_blank" href="https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik" style="background-image: url('{{asset('images/icons/tokopedia.png')}}')"></a>
                                </div>
                                <div class="overlay-btns-prd"></div>
                            </div>
                        </div>
                    </div>
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset('images/product1.jpg')}}')">
                            <div class="bottom-hidden-btn">
                                <div class="gr_display gr-btn-prdc">
                                    <a class="pc-btn-prdct --shopee" target="_blank" href="https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a" style="background-image: url('{{asset('images/icons/shopee.png')}}')"></a>
                                    <a class="pc-btn-prdct --tokped" target="_blank" href="https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik" style="background-image: url('{{asset('images/icons/tokopedia.png')}}')"></a>
                                </div>
                                <div class="overlay-btns-prd"></div>
                            </div>
                        </div>
                    </div>
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset('images/product1.jpg')}}')">
                            <div class="bottom-hidden-btn">
                                <div class="gr_display gr-btn-prdc">
                                    <a class="pc-btn-prdct --shopee" target="_blank" href="https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a" style="background-image: url('{{asset('images/icons/shopee.png')}}')"></a>
                                    <a class="pc-btn-prdct --tokped" target="_blank" href="https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik" style="background-image: url('{{asset('images/icons/tokopedia.png')}}')"></a>
                                </div>
                                <div class="overlay-btns-prd"></div>
                            </div>
                        </div>
                    </div>
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset('images/product5.jpg')}}')">
                            <div class="bottom-hidden-btn">
                                <div class="gr_display gr-btn-prdc">
                                    <a class="pc-btn-prdct --shopee" target="_blank" href="https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a" style="background-image: url('{{asset('images/icons/shopee.png')}}')"></a>
                                    <a class="pc-btn-prdct --tokped" target="_blank" href="https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik" style="background-image: url('{{asset('images/icons/tokopedia.png')}}')"></a>
                                </div>
                                <div class="overlay-btns-prd"></div>
                            </div>
                        </div>
                    </div>
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset('images/product8.jpg')}}')">
                            <div class="bottom-hidden-btn">
                                <div class="gr_display gr-btn-prdc">
                                    <a class="pc-btn-prdct --shopee" target="_blank" href="https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a" style="background-image: url('{{asset('images/icons/shopee.png')}}')"></a>
                                    <a class="pc-btn-prdct --tokped" target="_blank" href="https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik" style="background-image: url('{{asset('images/icons/tokopedia.png')}}')"></a>
                                </div>
                                <div class="overlay-btns-prd"></div>
                            </div>
                        </div>
                    </div>
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset('images/product1.jpg')}}')">
                            <div class="bottom-hidden-btn">
                                <div class="gr_display gr-btn-prdc">
                                    <a class="pc-btn-prdct --shopee" target="_blank" href="https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a" style="background-image: url('{{asset('images/icons/shopee.png')}}')"></a>
                                    <a class="pc-btn-prdct --tokped" target="_blank" href="https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik" style="background-image: url('{{asset('images/icons/tokopedia.png')}}')"></a>
                                </div>
                                <div class="overlay-btns-prd"></div>
                            </div>
                        </div>
                    </div>
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset('images/product8.jpg')}}')">
                            <div class="bottom-hidden-btn">
                                <div class="gr_display gr-btn-prdc">
                                    <a class="pc-btn-prdct --shopee" target="_blank" href="https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a" style="background-image: url('{{asset('images/icons/shopee.png')}}')"></a>
                                    <a class="pc-btn-prdct --tokped" target="_blank" href="https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik" style="background-image: url('{{asset('images/icons/tokopedia.png')}}')"></a>
                                </div>
                                <div class="overlay-btns-prd"></div>
                            </div>
                        </div>
                    </div>
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset('images/product1.jpg')}}')">
                            <div class="bottom-hidden-btn">
                                <div class="gr_display gr-btn-prdc">
                                    <a class="pc-btn-prdct --shopee" target="_blank" href="https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a" style="background-image: url('{{asset('images/icons/shopee.png')}}')"></a>
                                    <a class="pc-btn-prdct --tokped" target="_blank" href="https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik" style="background-image: url('{{asset('images/icons/tokopedia.png')}}')"></a>
                                </div>
                                <div class="overlay-btns-prd"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="kategori-produk-dasibana section-ct parallax-bg" style="background-image: url('{{asset('images/parallax.jpg')}}')">
            <div class="overlay-bg-parallax"></div>
            <div class="container ct-parallax">
                <h1 class="main-title" style="color: #ffffff;">kategori produk</h1>
                <div class="sec-kategori-home">
                    <div class="kategori-dsb-slick">
                        <div>kategori 1</div>
                        <div>kategori 2</div>
                        <div>kategori 3</div>
                        <div>kategori 4</div>
                        <div>kategori 5</div>
                        <div>kategori 6</div>
                        <div>kategori 7</div>
                        <div>kategori 8</div>
                        <div>kategori 9</div>
                    </div>
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
                autoplay: true,
                autoplaySpeed: 3000,
            });
        });
    </script>
@endpush
