@extends('layouts.fe.template.template_fe')

@section('metadata')
    <title>Veganesia - Cara Belanja</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/order_step.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/vendor/slick_slider.css') }}">
@endpush

@section('content')
    <div class="order-step-section">
        <!-- Order Step Content -->
        <!-- ============================================================== -->
        <section class="sec-order-step container">
            <div>
                <div class="head-ct-slider pt-0 pb-3 mb-4" style="border-bottom: 1px solid #CECECE;">
                    <div class="head-ttle">
                        <h3 class="mb-0 f-Asap_bold text-capitalize">cara belanja</h3>
                    </div>
                </div>
                <div class="border-card-oz card--htorder">
                    <div class="grid_layouts gr-fr-auto">
                        <div class="list-ordrstp">
                            <a class="openmdlOrd" data-id="1" type="button">
                                <div data-src="{{ asset('assets/icons/cara-order/1.png') }}" class="img-lazy img-slider imgsrc imgsrc1"></div>
                            </a>
                            <p class="mb-0 mt-3 text-center main-sub-text descSrc1">
                                Masukkan produk ke keranjang dengan klik "beli sekarang"
                            </p>
                        </div>
                        <div class="list-ordrstp">
                            <a class="openmdlOrd" data-id="2" type="button">
                                <div data-src="{{ asset('assets/icons/cara-order/2.png') }}" class="img-lazy img-slider imgsrc imgsrc2"></div>
                            </a>
                            <p class="mb-0 mt-3 text-center main-sub-text descSrc2">
                                Klik tombol "checkout" untuk membuat pesanan
                            </p>
                        </div>
                        <div class="list-ordrstp">
                            <a class="openmdlOrd" data-id="3" type="button">
                                <div data-src="{{ asset('assets/icons/cara-order/3.png') }}" class="img-lazy img-slider imgsrc imgsrc3"></div>
                            </a>
                            <p class="mb-0 mt-3 text-center main-sub-text descSrc3">
                                Di halaman pengiriman, kamu bisa mengubah alamat pengiriman lewat "edit alamat". Pilihlah jasa pengiriman yang diinginkan dan berikan catatan pada kami.
                            </p>
                        </div>
                        <div class="list-ordrstp">
                            <a class="openmdlOrd" data-id="4" type="button">
                                <div data-src="{{ asset('assets/icons/cara-order/4.png') }}" class="img-lazy img-slider imgsrc imgsrc4"></div>
                            </a>
                            <p class="mb-0 mt-3 text-center main-sub-text descSrc4">
                                Di halaman pembayaran, pastikan jumlah yang dibayarkan sudah sesuai. Pilihlah metode pembayaran yang digunakan lalu klik "bayar sekarang"
                            </p>
                        </div>
                        <div class="list-ordrstp">
                            <a class="openmdlOrd" data-id="5" type="button">
                                <div data-src="{{ asset('assets/icons/cara-order/5.png') }}" class="img-lazy img-slider imgsrc imgsrc5"></div>
                            </a>
                            <p class="mb-0 mt-3 text-center main-sub-text descSrc5">
                                Menu edit alamat
                            </p>
                        </div>
                        <div class="list-ordrstp">
                            <a class="openmdlOrd" data-id="6" type="button">
                                <div data-src="{{ asset('assets/icons/cara-order/6.png') }}" class="img-lazy img-slider imgsrc imgsrc6"></div>
                            </a>
                            <p class="mb-0 mt-3 text-center main-sub-text descSrc6">
                                Menu pilih kurir
                            </p>
                        </div>
                        <div class="list-ordrstp">
                            <a class="openmdlOrd" data-id="7" type="button">
                                <div data-src="{{ asset('assets/icons/cara-order/7.png') }}" class="img-lazy img-slider imgsrc imgsrc7"></div>
                            </a>
                            <p class="mb-0 mt-3 text-center main-sub-text descSrc7">
                                Ada 2 metode pembayaran yang tersedia: Pemeriksaan  otomatis dan pemeriksaan secara manual (harus upload bukti transfer)
                            </p>
                        </div>
                        <div class="list-ordrstp">
                            <a class="openmdlOrd" data-id="8" type="button">
                                <div data-src="{{ asset('assets/icons/cara-order/8.png') }}" class="img-lazy img-slider imgsrc imgsrc8"></div>
                            </a>
                            <p class="mb-0 mt-3 text-center main-sub-text descSrc8">
                                Contoh pengisian di halaman Pengiriman
                            </p>
                        </div>
                        <div class="list-ordrstp">
                            <a class="openmdlOrd" data-id="9" type="button">
                                <div data-src="{{ asset('assets/icons/cara-order/9.png') }}" class="img-lazy img-slider imgsrc imgsrc9"></div>
                            </a>
                            <p class="mb-0 mt-3 text-center main-sub-text descSrc9">
                                Contoh halaman Pembayaran. Klik "bayar sekarang" untuk melanjutkan
                            </p>
                        </div>
                        <div class="list-ordrstp">
                            <a class="openmdlOrd" data-id="10" type="button">
                                <div data-src="{{ asset('assets/icons/cara-order/10.png') }}" class="img-lazy img-slider imgsrc imgsrc10"></div>
                            </a>
                            <p class="mb-0 mt-3 text-center main-sub-text descSrc10">
                                Di halaman "checkout", kamu bisa melihat batas waktu pembayaran serta rekening pembayaran.
                                Klik "tagihan pembayaran" untuk melihat info lebih lengkap dan upload bukti transfer.
                            </p>
                        </div>
                        <div class="list-ordrstp">
                            <a class="openmdlOrd" data-id="11" type="button">
                                <div data-src="{{ asset('assets/icons/cara-order/11.png') }}" class="img-lazy img-slider imgsrc imgsrc11"></div>
                            </a>
                            <p class="mb-0 mt-3 text-center main-sub-text descSrc11">
                                Kamu bisa melihat semua pesanan yang telah kamu buat di halaman "pesanan saya" klik untuk melihat detail
                            </p>
                        </div>
                        <div class="list-ordrstp">
                            <a class="openmdlOrd" data-id="12" type="button">
                                <div data-src="{{ asset('assets/icons/cara-order/12.png') }}" class="img-lazy img-slider imgsrc imgsrc12"></div>
                            </a>
                            <p class="mb-0 mt-3 text-center main-sub-text descSrc12">
                                Di halaman detail pesanan, kamu bisa melihat semua informasi tentang pesanan yang telah kamu buat. klik "konfirmasi pembayaran" untuk upload bukti transfer.
                            </p>
                        </div>
                        <div class="list-ordrstp">
                            <a class="openmdlOrd" data-id="13" type="button">
                                <div data-src="{{ asset('assets/icons/cara-order/13.png') }}" class="img-lazy img-slider imgsrc imgsrc13"></div>
                            </a>
                            <p class="mb-0 mt-3 text-center main-sub-text descSrc13">
                                Menu konfirmasi pembayaran untuk mengirimkan bukti pembayaran
                            </p>
                        </div>
                        <div class="list-ordrstp">
                            <a class="openmdlOrd" data-id="14" type="button">
                                <div data-src="{{ asset('assets/icons/cara-order/14.png') }}" class="img-lazy img-slider imgsrc imgsrc14"></div>
                            </a>
                            <p class="mb-0 mt-3 text-center main-sub-text descSrc14">
                                Agar transaksimu dapat segera dikonfirmasi, upload bukti transfer di halaman konfirmasi pembayaran. Setelah pembayaran terkonfirmasi, status menjadi "lunas" dan tim kami akan memproses pesananmu.
                            </p>
                        </div>
                    </div>

                    <!-- Start Modal Order Step -->
                    <div class="modal-ouzen mdl-dwn modal-stp-order" data-backdrop="static" data-keyboard="false">
                        <div class="modal fade" id="step-ordr" tabindex="-1" role="dialog" aria-labelledby="step-ordrLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5 class="modal-title text-capitalize text-left" id="step-ordrLabel">cara belanja</h5>
                                        <div class="ct-modal-body">
                                            <div class="slider-order slider-lazy big-lazy">
                                                <div class="sec-order-slider slider-temp">
                                                    <div data-id="1" class="ls-mdls dat1">
                                                        <div class="images-slider img-lazy big-lazy main-img-oz">
                                                            <img data-lazy="{{ asset('assets/icons/cara-order/1.png') }}">
                                                        </div>
                                                        <div>
                                                            <p class="mb-0 mt-3 text-center main-sub-text">
                                                                Masukkan produk ke keranjang dengan klik "beli sekarang"
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div data-id="2" class="ls-mdls dat2">
                                                        <div class="images-slider img-lazy big-lazy main-img-oz">
                                                            <img data-lazy="{{ asset('assets/icons/cara-order/2.png') }}">
                                                        </div>
                                                        <div>
                                                            <p class="mb-0 mt-3 text-center main-sub-text">
                                                                Klik tombol "checkout" untuk membuat pesanan
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div data-id="3" class="ls-mdls dat3">
                                                        <div class="images-slider img-lazy big-lazy main-img-oz">
                                                            <img data-lazy="{{ asset('assets/icons/cara-order/3.png') }}">
                                                        </div>
                                                        <div>
                                                            <p class="mb-0 mt-3 text-center main-sub-text">
                                                                Di halaman pengiriman, kamu bisa mengubah alamat pengiriman lewat "edit alamat". Pilihlah jasa pengiriman yang diinginkan dan berikan catatan pada kami.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div data-id="4" class="ls-mdls dat4">
                                                        <div class="images-slider img-lazy big-lazy main-img-oz">
                                                            <img data-lazy="{{ asset('assets/icons/cara-order/4.png') }}">
                                                        </div>
                                                        <div>
                                                            <p class="mb-0 mt-3 text-center main-sub-text">
                                                                Di halaman pembayaran, pastikan jumlah yang dibayarkan sudah sesuai. Pilihlah metode pembayaran yang digunakan lalu klik "bayar sekarang"
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div data-id="5" class="ls-mdls dat5">
                                                        <div class="images-slider img-lazy big-lazy main-img-oz">
                                                            <img data-lazy="{{ asset('assets/icons/cara-order/5.png') }}">
                                                        </div>
                                                        <div>
                                                            <p class="mb-0 mt-3 text-center main-sub-text">
                                                                Menu edit alamat
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div data-id="6" class="ls-mdls dat6">
                                                        <div class="images-slider img-lazy big-lazy main-img-oz">
                                                            <img data-lazy="{{ asset('assets/icons/cara-order/6.png') }}">
                                                        </div>
                                                        <div>
                                                            <p class="mb-0 mt-3 text-center main-sub-text">
                                                                Menu pilih kurir
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div data-id="7" class="ls-mdls dat7">
                                                        <div class="images-slider img-lazy big-lazy main-img-oz">
                                                            <img data-lazy="{{ asset('assets/icons/cara-order/7.png') }}">
                                                        </div>
                                                        <div>
                                                            <p class="mb-0 mt-3 text-center main-sub-text">
                                                                Ada 2 metode pembayaran yang tersedia: Pemeriksaan  otomatis dan pemeriksaan secara manual (harus upload bukti transfer)
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div data-id="8" class="ls-mdls dat8">
                                                        <div class="images-slider img-lazy big-lazy main-img-oz">
                                                            <img data-lazy="{{ asset('assets/icons/cara-order/8.png') }}">
                                                        </div>
                                                        <div>
                                                            <p class="mb-0 mt-3 text-center main-sub-text">
                                                                Contoh pengisian di halaman Pengiriman
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div data-id="9" class="ls-mdls dat9">
                                                        <div class="images-slider img-lazy big-lazy main-img-oz">
                                                            <img data-lazy="{{ asset('assets/icons/cara-order/9.png') }}">
                                                        </div>
                                                        <div>
                                                            <p class="mb-0 mt-3 text-center main-sub-text">
                                                                Contoh halaman Pembayaran. Klik "bayar sekarang" untuk melanjutkan
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div data-id="10" class="ls-mdls dat10">
                                                        <div class="images-slider img-lazy big-lazy main-img-oz">
                                                            <img data-lazy="{{ asset('assets/icons/cara-order/10.png') }}">
                                                        </div>
                                                        <div>
                                                            <p class="mb-0 mt-3 text-center main-sub-text">
                                                                Di halaman "checkout", kamu bisa melihat batas waktu pembayaran serta rekening pembayaran.
                                                                Klik "tagihan pembayaran" untuk melihat info lebih lengkap dan upload bukti transfer.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div data-id="11" class="ls-mdls dat11">
                                                        <div class="images-slider img-lazy big-lazy main-img-oz">
                                                            <img data-lazy="{{ asset('assets/icons/cara-order/11.png') }}">
                                                        </div>
                                                        <div>
                                                            <p class="mb-0 mt-3 text-center main-sub-text">
                                                                Kamu bisa melihat semua pesanan yang telah kamu buat di halaman "pesanan saya" klik untuk melihat detail
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div data-id="12" class="ls-mdls dat12">
                                                        <div class="images-slider img-lazy big-lazy main-img-oz">
                                                            <img data-lazy="{{ asset('assets/icons/cara-order/12.png') }}">
                                                        </div>
                                                        <div>
                                                            <p class="mb-0 mt-3 text-center main-sub-text">
                                                                Di halaman detail pesanan, kamu bisa melihat semua informasi tentang pesanan yang telah kamu buat. klik "konfirmasi pembayaran" untuk upload bukti transfer.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div data-id="13" class="ls-mdls dat13">
                                                        <div class="images-slider img-lazy big-lazy main-img-oz">
                                                            <img data-lazy="{{ asset('assets/icons/cara-order/13.png') }}">
                                                        </div>
                                                        <div>
                                                            <p class="mb-0 mt-3 text-center main-sub-text">
                                                                Menu konfirmasi pembayaran untuk mengirimkan bukti pembayaran
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div data-id="14" class="ls-mdls dat14">
                                                        <div class="images-slider img-lazy big-lazy main-img-oz">
                                                            <img data-lazy="{{ asset('assets/icons/cara-order/14.png') }}">
                                                        </div>
                                                        <div>
                                                            <p class="mb-0 mt-3 text-center main-sub-text">
                                                                Agar transaksimu dapat segera dikonfirmasi, upload bukti transfer di halaman konfirmasi pembayaran. Setelah pembayaran terkonfirmasi, status menjadi "lunas" dan tim kami akan memproses pesananmu.
                                                            </p>
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
                    <!-- End:/ Modal Order Step -->
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Order Step Content -->
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('dist/vendors/slick-slider/slick/slick.js')}}"></script>
    <script type="text/javascript" src="{{ asset('dist/fe/js/pages/order_step.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            {{--$('#step-ordr').on('shown.bs.modal', function (){
                console.log('tes slider');
                /********************************/
                /* Slides Slick Order Step */
                /********************************/
                $('.sec-order-slider').on('init', function (slick) {
                    $(this).parent().removeClass('slider-lazy');
                });

                $('.sec-order-slider').on('lazyLoaded', function(event, slick, image, imageSource){
                    var img = new Image(),
                        src = imageSource,
                        sib = $(image).parent(),
                        btn = $(image).next();
                    image.remove();
                    img.onload = function() {
                        sib.css("background-image", "url('"+src+"')");
                        sib.addClass('loaded');
                        btn.show();
                    }
                    img.src = src;
                });

                $('.sec-order-slider').slick({
                    lazyLoad: 'ondemand',
                    centerMode: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                    focusOnSelect: false,
                    arrows: true,
                    autoplay: false,
                    autoplaySpeed: 2000,
                    infinite: true,
                    nextArrow: '<button class="slick-next slick-arrow fa" aria-label="Next" type="button" aria-disabled="false">Next</button>',
                    prevArrow: '<button class="slick-prev slick-arrow fa" aria-label="Previous" type="button" aria-disabled="false">Previous</button>',
                });
            });

            $('.openmdlOrd').on('click', function(e){
                $('#step-ordr').modal();
                var data = $(this).data('id');
                var lsSlider = $('.dat'+$(this).data('id'));
                var idSlider = lsSlider.data('id');
                console.log('data : '+data);
                console.log('dats : '+idSlider);
                $('#step-ordr').on('shown.bs.modal', function (){
                    if(data == idSlider){
                        console.log('benul');
                        lsSlider.parent().parent().addClass('slick-active');
                        lsSlider.parent().parent().addClass('slick-current');
                        lsSlider.parent().parent().siblings().removeClass('slick-active');
                        lsSlider.parent().parent().siblings().removeClass('slick-current');
                    }
                });
            });--}}
        });
    </script>
@endpush
