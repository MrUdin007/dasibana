@extends('layouts.fe.fe')

@section('metadata')
    <title>Veganesia - {{ $product->category }} - {{ $product->productname }}</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/produk/detail.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/content/card_product.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/vendor/slick_slider.css') }}">
@endpush

@section('content')
    <!-- Flow Menu Add To Cart -->
    <!-- ============================================================== -->
    <form class="form-vegan" action="#" method="post" enctype="multipart/form-data">
        @csrf
        <div class="fly-menu-addToCart" id="fly-addToCart">
            <div class="container">
                <div class="grid_layouts gr-menu-addToCart">
                    <div class="grid_layouts gr-desc">
                        <div class="slider-detail-prd slider-lazy big-lazy h-100">
                            <div class="slider-detail-for slider-temp">
                                @foreach($product->images as $p)
                                <div class="position-relative">
                                    <div class="img-cover-for img-slider img-lazy small-lazy" data-type="{{$p->type}}">
                                        <img data-lazy="{{ asset(env('APP_DOWNLOAD').$p->media) }}">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <h6>
                                {{ $product->productname }}
                            </h6>
                        </div>
                    </div>
                    <div class="grid_layouts gr-buy">
                        <div class="items-aa input-number-cart-vegan">
                            @if($product->stock > 0)
                            <input class="input-number form-control product_qtys" type="number" id="float_product_qtys" name="qty" value="1" step="1" min="1" data-min="1" max="{{$product->stock}}" data-max="{{$product->stock}}">
                            @else
                            <input class="input-number form-control product_qtys stokhabiss" type="number" id="float_product_qtys" name="qty" value="1" step="1" min="1" data-min="1" max="1" data-max="1">
                            @endif
                        </div>
                        <div class="items-bb">
                            <small class="text-capitalize clr-light-gry small-fnt">total harga</small>
                            <h6 class="main-sub-text mb-0">
                                {{ $product->final_price }}
                            </h6>
                        </div>
                        <div class="--lvs items-cc">
                            <div class="love-prod">
                                <input type="checkbox" name="likes_{{ $product->id }}" id="likes_{{ $product->id }}" @if($product->is_like_by_user) checked @endif>
                                @if(auth('fe')->check())
                                <label class="love-icn product_like_checkbox" for="likes_{{ $product->id }}" data-id="{{ $product->id }}"></label>
                                @else
                                <label class="love-icn" type="button" data-toggle="modal" data-target="#login" data-backdrop="static" data-keyboard="false"></label>
                                @endif
                            </div>
                        </div>
                        <div class="items-dd">
                            @if(auth('fe')->check())
                            <button class="btn-vegan orange-btn" data-sizechart="{{$product->is_variant}}" id="addCart" data-id="{{ $product->id }}">
                                Tambah ke keranjang
                            </button>
                            @else
                            <button class="btn-vegan orange-btn" type="button" data-toggle="modal" data-target="#login" data-backdrop="static" data-keyboard="false">
                                Tambah ke keranjang
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- ============================================================== -->
    <!-- End Flow Menu Add To Cart -->

    <div class="product-detail-section">
        <!-- Breadcrumb -->
        <!-- ============================================================== -->
        <div class="container">
            <div class="br-prdct-detail">
                <div class="sec-breadcrumb mb-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item text-capitalize">
                                <a href="{{ route('home' ) }}" class="mid-main-sub-text">Home</a>
                            </li>
                            <li class="breadcrumb-item text-capitalize">
                                <a href="{{ route('produk.category', [$product->productcategory()->first()->category()->first()->slug]) }}" class="mid-main-sub-text">
                                    {{$product->category}}
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-capitalize mid-main-sub-text" aria-current="page">
                                {{ $product->productname }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Breadcrumb -->

        <!-- Decribe Detail Product -->
        <!-- ============================================================== -->
        <section class="container sec-product-detail">
            <div class="grid_layouts ct-desc-prdct">
                <div class="slider-detail-prd slider-lazy big-lazy h-100">
                    <div class="slider-detail-for slider-temp">
                        @foreach($product->images as $p)
                        <div class="position-relative">
                            <a class="w-100" type="button" data-toggle="modal" data-target="#showGalery" data-backdrop="static" data-keyboard="false">
                                <div class="img-cover-for img-slider img-lazy big-lazy" data-type="{{$p->type}}">
                                    <img data-lazy="{{ asset(env('APP_DOWNLOAD').$p->media) }}">
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="slider-detail-nav">
                        @foreach($product->images as $p)
                        <div>
                            <div class="img-sldr img-slider img-lazy small-lazy" data-type="{{$p->type}}">
                                <img data-lazy="{{ asset(env('APP_DOWNLOAD').$p->media) }}">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="descrbs-detail-prd">
                    <h3 class="desc-main-text-lg clr-lght-gsh mb-3 f-Asap_medium">
                        {{ $product->productname }}
                    </h3>
                    <input type="hidden" value="{{$product->id}}" name="product_id" id="product_id">
                    <div class="price-det">
                        <h5 class="txt-price mb-2">
                            {{ $product->final_price }}
                        </h5>

                        @if($product->is_disc)
                        <div class="disc-sec mb-2">
                            <del class="clr-light-gry lbldsjgd">
                                Rp.{{ number_format($product->price,2,",",".")}}
                            </del>
                            <h6 class="disc-lbl">
                                Hemat {{ $product->disc_value }}
                            </h6>
                        </div>
                        @endif

                        <div class="komps">
                            @if($product->additional_note != null)
                            <h6 class="add-note mb-3 clr-light-gry">
                                Keterangan Tambahan
                                <span class="clr-lght-gsh f-Asap_medium text-capitalize">
                                    {{ $product->additional_note }}
                                </span>
                            </h6>
                            @endif

                            @if($product->is_bawang == true)
                            <h6 class="is_bawang mb-20">
                                Mengandung bawang
                            </h6>
                            @endif
                        </div>
                    </div>
                    <div class="desc-prod-detail">
                        <h6 class="f-Asap_medium main-sub-text text-uppercase">deskripsi produk</h6>
                        <article>
                            <p>
                                {!! strip_tags($product->description) !!}
                            </p>
                        </article>
                    </div>
                    @if($product->is_variant == true)
                    <div class="product_size sorts-list form-vegan">
                        @foreach($product->size as $sizee)
                        <div class="custom-radio form-check-inline variant_size_chart">
                            <input data-stock="{{$sizee->stock}}" value="{{$sizee->stock}}" data-id="{{$sizee->id}}" data-size="{{$sizee->name}}" class="variant_size size_kaos_{{$sizee->id}}" type="radio" name="size_kaos" id="size_{{$sizee->name}}">
                            <label for="size_{{$sizee->name}}" class="main-text">
                                <span>{{$sizee->name}}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            <div class="share-sec">
                <button class="btn-vegan green-white text-capitalize view-review" id="lihatulasans" data-target="#lihatulasan">
                    lihat ulasan pembeli
                </button>
                <div class="share-section position-relative">
                    <button class="btn-vegan share-btns text-capitalize" data-toggle="collapse" href="#share-oz{{ $product->id }}" role="button" aria-expanded="false" aria-controls="share-oz">
                        <span class="share-icons">
                            <img src="{{ asset('dist/fe/icons/share.png') }}" alt="share">
                        </span>
                        share
                    </button>
                    <div class="share-btn box-share-prdct clps-btn-shr box-share-prdct collapse" id="share-oz{{ $product->id }}" data-url="{{ route('produk.detail', [$product->urlcategory, $product->urlproduct]) }}" data-title="{{ $product->name }}" data-desc="{{ $product->name }}">
                        <div class="copy-clipboard-section position-relative mb-3">
                            <div class="grid_layouts gr-cpy-clbrd form-vegan">
                                <div>
                                    <input type="text" disabled class="inpts-shrajhd form-control field-main-oz" placeholder="{{ route('produk.detail', [$product->urlcategory, $product->urlproduct]) }}">
                                </div>
                                <div>
                                    <button data-target="{{ $product->id }}" class="copyclp-vegan-btn copyclp btn-shrajhd text-capitalize btn-vegan f-Asap_medium --transparent-btn small-fnt" data-clipboard-text="{{ route('produk.detail', [$product->urlcategory, $product->urlproduct]) }}" type="button">salin</button>
                                </div>
                            </div>
                            <div class="ct-tggle ct-tgglesc" id="copyclip-vegan{{ $product->id }}" style="display: none">
                                <div class="position-relative">
                                    <small class="small-fnt">Copied</small>
                                    <div class="mn-arrw"></div>
                                </div>
                            </div>
                        </div>
                        <h6 class="clr-lght-gsh f-Asap_medium mb-2">Atau bagikan di</h6>
                        <div class="grid_layouts gr-shramdjakd">
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
                                <a class="btn-telegram" data-id="tg"></a>
                            </div>
                            <div>
                                <a class="btn-whatsapp" data-id="wa">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Decribe Detail Product -->

        <!-- Slick Slider ARTKEL BERKAITAN DARI PRODUK TAG INI -->
        <!-- ============================================================== -->
        <section class="sec-sldr-news mb-detil-sec" id="infoterkait">
            @if(count($relatedNews) > 0)
            <div class="container">
                <div class="head-ct-slider pt-0">
                    <div class="head-ttle">
                        <h3 class="text-uppercase">
                            informasi terkait
                        </h3>
                    </div>
                    <div class="head-btn"></div>
                </div>
                <div class="ct-sldr-news slider-lazy big-lazy">
                    <div class="sldr-news --slider-main slick-arrow-custom slider-temp">
                        @foreach($relatedNews as $get_blog)
                            <div class="card-artikel ls-category" style="display: none;">
                                <a href="{{ route('blog.detail', [$get_blog->blog->category->slug, $get_blog->blog->slug]) }}" class="imgs-artikel">
                                    <div class="image-cvr img-lazy images-slider big-lazy" data-src="{{ asset(env('APP_DOWNLOAD').$get_blog->blog->image_cover) }}"></div>
                                </a>
                                <div class="desc-artikel">
                                    <div>
                                        <a style="margin-bottom: 10px !important;" href="{{ route('blog.detail', [$get_blog->category->slug, $get_blog->blog->slug]) }}" class="main-sub-text mb-1 text-left text-black truncate-texts --two f-Asap_reg title-hm-nws">
                                            {{ $get_blog->blog->title }}
                                        </a>
                                    </div>
                                    <div class="ctg-sec">
                                        <a href="{{ route('blog.category', [$get_blog->category->slug]) }}" class="f-Asap_light clr-light-gry truncate-texts">
                                            {{ $get_blog->category->name }}
                                        </a>
                                    </div>
                                    <div class="--date">
                                        <small class="clr-light-gry truncate-texts text-left f-Asap_medium">
                                            <span class="f-Asap_reg">{{ Carbon\Carbon::parse($get_blog->blog->post_time)->format('d M Y') }}</span>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </section>
        <!-- ============================================================== -->
        <!-- End Slick Slider ARTKEL BERKAITAN DARI PRODUK TAG INI -->

        <!-- Slick Slider PRODUK LAIN DARI PRODUK TAG INI -->
        <!-- ============================================================== -->
        <section class="sec-oth-sld mb-detil-sec">
            <div class="container">
                <div class="head-ct-slider pt-0">
                    <div class="head-ttle">
                        <h3 class="text-uppercase">
                            Produk terkait
                        </h3>
                    </div>
                    <div class="head-btn"></div>
                </div>
                @if(count($relatedProduct) > 0)
                <div class="ct-slider-ot slider-lazy big-lazy">
                    <div class="sldroth --slider-main slick-arrow-custom slider-temp">
                        @foreach($relatedProduct as $key=>$p)
                        <div>
                            @include('public.produk.card_product',['produk'=>$p])
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <!-- Start Tidak Ada Produk -->
                <div class="no-post-list">
                    <div class="img-no-post img-lazy small-lazy" data-src="{{ asset('dist/fe/icons/produk-empty.png') }}" style="background-size: contain;"></div>
                    <div class="desc-no-post">
                        <h6 class="text-capitalize f-Asap_medium main-sub-text">
                            Tidak ada produk tersedia
                        </h6>
                    </div>
                </div>
                <!-- End:/ Tidak Ada Produk -->
                @endif
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Slick Slider PRODUK LAIN DARI PRODUK TAG INI -->

        <!-- Review Produk -->
        <!-- ============================================================== -->
        <section class="sec-reviews mb-detil-sec" id="lihatulasan" name="lihatsulasans">
            <div class="container">
                <div class="head-ct-slider pt-0">
                    <div class="head-ttle">
                        <h3 class="text-uppercase">
                            ulasan produk
                        </h3>
                    </div>
                    <div class="head-btn"></div>
                </div>
                @if(count($reviews) > 0)
                <div class="content-reviews">
                    <div>
                        @foreach($reviews as $review)
                        <div class="ls-reviews">
                            <div class="grid_layouts gr-rvws">
                                <div class="grid_layouts user-profile rvws-1">
                                    <div class="rounded-circle img-lazy small-lazy user-rvw" @if($review->customer->image == null) style="background-size: contain;" @endif data-src="@if($review->customer->image != null) {{ asset(env('APP_DOWNLOAD').$review->customer->image) }} @else {{ asset($review->customer->avatar) }} @endif"></div>
                                    <div>
                                        <h6 class="f-Asap_medium main-sub-text" style="line-height: 20px;">
                                            {{$review->customer->name}}
                                        </h6>
                                        <small class="clr-light-gry truncate-texts small-fnt text-left f-Asap_reg">
                                            {{ Carbon\Carbon::parse($review->created_at)->format('d M Y') }}
                                        </small>
                                    </div>
                                </div>
                                <div class="desc-rvw rvws-2">
                                    <div class="grid_layouts gr-reviews-cover">
                                        @foreach($review->photo as $cover)
                                        @if($cover->type == 'image')
                                        <div class="img-lazy small-lazy img-rvw" data-src="{{$cover->media}}"></div>
                                        @elseif($cover->type == 'video')
                                        <div class="video-reviews --large-vid">
                                            <video>
                                                <source src="{{$cover->media}}">
                                            </video>
                                            <div id="time-ruler"></div>
                                            {{--<canvas id="canvas" width="300" height="300"></canvas>--}}
                                            <div id="thumbnailContainer"></div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                    <article>
                                        <p>
                                            {{ $review->comment}}
                                        </p>
                                    </article>
                                </div>
                                <div class="rvws-3">
                                    @if(auth('fe')->check())
                                    @if(auth('fe')->user()->id != $review->customer->id)
                                    <div class="report-sections">
                                        <button class="report-btns btn-vegan" data-id="{{ $review->id }}" type="button" style="background-image: url('{{ asset('dist/fe/icons/dots.png') }}')"></button>
                                        <div class="menu-rprt" id="report-{{ $review->id }}" style="display: none;">
                                            <button class="sub-rplyrpt txt-btn btn-vegan text-capitalize" id="laporreviewbtn" data-id="{{ $review->id }}">
                                                laporkan penyalahgunaan
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="pagination-reviews">
                    <!-- Pagination -->
                    <!-- ============================================================== -->
                    {{ $reviews->links('layouts.fe.pagination') }}
                    <!-- ============================================================== -->
                    <!-- End Pagination -->
                    </div>
                </div>
                @else
                <!-- Start Tidak Ada Review -->
                <div class="no-post-list">
                    <div class="img-no-post img-lazy small-lazy" data-src="{{ asset('dist/fe/icons/no_ulasan.png') }}" style="background-size: contain;"></div>
                    <div class="desc-no-post">
                        <h6 class="text-capitalize f-Asap_medium main-sub-text">
                            belum ada ulasan untuk produk ini
                        </h6>
                        <small class="clr-light-gry text-capitalize small-fnt">
                            jadilah yang pertama membeli produk ini dan memberikan ulasan
                        </small>
                    </div>
                </div>
                <!-- End:/ Tidak Ada Review -->
                @endif
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Review Produk -->

        @if(count($product_tags) > 0)
        <!-- Tags Produk -->
        <!-- ============================================================== -->
        <section class="sec-tags" id="tagsection">
            <div class="container">
                <div class="tags">
                    <ul>
                        @foreach($product_tags as $tags)
                        <li>
                            <h6>
                                {{$tags->name}}
                            </h6>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Tags Produk -->
        @endif
    </div>

    <!-- Modal Product Image -->
    <!-- ============================================================== -->
    <div class="modal-vegan">
        <div class="modal" id="showGalery" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="slider-gallery-modal">
                            @foreach($product->images as $p)
                            <div class="position-relative">
                                <div class="img-cover-for img-slider img-lazy big-lazy" data-type="{{$p->type}}">
                                    <img data-lazy="{{ asset(env('APP_DOWNLOAD').$p->media) }}">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Modal Product Image -->

    <!-- Start Modal Report Penyalahgunaan -->
    <div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
        <div class="modal fade" id="reportReviews" tabindex="-1" role="dialog" aria-labelledby="reportReviewsLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="" class="form-vegan" id="reportreviewform" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="review_id" name="review_id" value="">
                        <div class="modal-header">
                            <h5 class="modal-title text-capitalize text-left desc-main-text f-Asap_medium">
                                laporkan ulasan produk
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h6 class="text-capitalize clr-lght-gsh main-sub-text">pilih alasan</h6>
                            <div class="">
                                <div class="custom-radio main-form-vg mb-2">
                                    <input type="radio" id="alasan1" name="alasan" class="inpt-alasanreports alasanreports custom-control-input hide-alasanlainnya" value="Ulasan berupa spam (mengandung pengulangan emoticon/kata-kata yang berlebihan)">
                                    <label class="custom-control-label" for="alasan1">
                                        Ulasan berupa spam (mengandung pengulangan emoticon/kata-kata yang berlebihan)
                                    </label>
                                </div>
                                <div class="custom-radio main-form-vg mb-2">
                                    <input type="radio" id="alasan2" name="alasan" class="inpt-alasanreports alasanreports custom-control-input hide-alasanlainnya" value="Ulasan dianggap kurang sopan (mengandung kata-kata kasar atau bersifat penghinaan)">
                                    <label class="custom-control-label" for="alasan2">
                                        Ulasan dianggap kurang sopan (mengandung kata-kata kasar atau bersifat penghinaan)
                                    </label>
                                </div>
                                <div class="custom-radio main-form-vg mb-2">
                                    <input type="radio" id="lainnya" class="inpt-alasanreports custom-control-input" value="">
                                    <label class="custom-control-label text-capitalize" for="lainnya">
                                        lainnya
                                    </label>
                                </div>
                            </div>
                            <div class="main-form-vg mb-2" id="alasan2input"></div>
                            <div class="grid_layouts gr-mdl-reportdcd">
                                <button class="btn-vegan text-capitalize --transparent-btn" data-dismiss="modal">
                                    batalkan
                                </button>
                                <button class="btn-vegan text-capitalize green-bg-btn" type="submit">
                                    kirim laporan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End:/ Modal Report Penyalahgunaan -->
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('dist/vendors/slick-slider/slick/slick.js')}}"></script>
    <script type="text/javascript" src="{{ asset('dist/fe/js/pages/product_detail.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#laporreviewbtn').on('click',function(e){
                var id_review = $(this).data('id');
                $('#reportReviews').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#review_id').val(id_review);
            });

            $('#lainnya').on('click',function(e){
                $('#alasan2input').append(
                    '<input required type="text" class="form-control" id="alasan3" name="alasan" aria-describedby="alasan3" placeholder="Isi alasan di sini">'
                );
                $('.alasanreports').prop('checked',false);
            });

            $('.hide-alasanlainnya').on('click',function(e){
                $('#alasan2input').empty();
                $('#lainnya').prop('checked',false);
            });

            $('#reportreviewform').on('submit',function (e) {
                e.preventDefault();
                var review_id = $('#review_id').val();
                var alasan = $('.inpt-alasanreports').is(':checked');
                var alasan_val = $('.alasanreports:checked').val();
                var alasan_lainnya = $('#alasan3').val();

                if(!alasan){
                    Swal.fire({
                        type: 'Error',
                        title: 'Maaf!',
                        text: 'Mohon pilih salah satu alasan laporan anda!',
                        allowOutsideClick: false
                    });
                }
                else{
                    if($('#alasan3').val() == ''){
                        Swal.fire({
                            type: 'Error',
                            title: 'Maaf!',
                            text: 'Mohon isi kolom alasannya',
                            allowOutsideClick: false
                        }).then(function() {
                            $('#reportreviewform').valid();
                        });
                    }
                    else{
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('produk.report.review') }}",
                            data: {
                                review_id: review_id,
                                alasan: alasan_val,
                                alasan_lainnya: alasan_lainnya,
                                _token: "{{ csrf_token() }}"
                            },
                            dataType: 'JSON',
                            beforeSend: function () {
                                Swal.fire({
                                    title: "Mohon Menunggu",
                                    text: "Data Anda sedang diproses",
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });
                            },
                            success: function (response) {
                                if(response.reviewreport){
                                    Swal.fire({
                                        title: '<span class="title-reminder">Maaf</span>',
                                        text: response.msg_title,
                                        confirmButtonText: 'Ok',
                                        confirmButtonClass: 'notif-me',
                                        allowOutsideClick: false
                                    }).then(function() {
                                        window.location.reload(true);
                                    });
                                }
                                else{
                                    Swal.fire({
                                        title: 'Laporan berhasil dikirim!',
                                        type: 'success',
                                        text: 'Admin kami akan menindaklanjuti laporan yang anda buat',
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
                                }).then(function() {
                                    $('#reportreviewform').valid();
                                });
                            }
                        });
                    }
                }
            });

            // -----------------------------------------------------------------------------
            // Scroll Page To See Reviews
            var hgtHeader = $('#hgt-header').height();
            function scrollToAnchor(id){
                var aTag = $("section[name='"+ id +"']");
                $('html,body').animate(
                    { scrollTop: aTag.offset().top-hgtHeader }
                ,'slow');
            }

            $("#lihatulasans").click(function() {
                scrollToAnchor('lihatsulasans');
            });

            // -----------------------------------------------------------------------------
            // Input Size Chart
            $('.variant_size').on('click',function(e){
                var size_id = $(this).data('id');
                var stok_size = $(this).val();

                $(".product_qtys").attr({
                    "max" : stok_size,
                    "data-max" : stok_size,
                    "data-sizechartid" : size_id
                });
            });

            // -----------------------------------------------------------------------------
            // Add To Cart
            $('.variant_size').attr('checked', false);
            $('#addCart').on('click',function(e){
                e.preventDefault();
                var products_id = $(this).data('id');
                var qtys_id = $('#float_product_qtys').val();
                var variant_product_id = $('#float_product_qtys').data('sizechartid');
                var size_chart = $(this).data('sizechart');

                if(size_chart == 1){
                    if(!($('.variant_size').is(':checked'))){
                        Swal.fire({
                            type: 'error',
                            title: 'Maaf!',
                            text: 'Mohon pilih size terlebih dahulu',
                            allowOutsideClick: false
                        });
                    }
                    else{
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('cart') }}",
                            data: {
                                product_id: products_id,
                                variant_id: variant_product_id,
                                qty: qtys_id,
                                size_chart: size_chart,
                                _token: "{{ csrf_token() }}"
                            },
                            dataType: 'JSON',
                            beforeSend: function () {
                                Swal.fire({
                                    title: "Mohon Menunggu",
                                    text: "Data Anda sedang diproses",
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });
                            },
                            success: function (data) {
                                console.log('berhasil : '+data.qty_variant_available);
                                if(data.qty_variant == true){
                                    if(data.qty_variant_available < 1){
                                        Swal.fire({
                                            type: 'error',
                                            title: 'Error!',
                                            text: `Maaf stok telah habis`,
                                            allowOutsideClick: false
                                        }).then(function() {
                                            window.location.reload(true);
                                        });
                                    }
                                    else{
                                        Swal.fire({
                                            type: 'error',
                                            title: 'Error!',
                                            text: `Maaf stok tidak cukup, stok yang tersedia: ${data.qty_variant_available}`,
                                            allowOutsideClick: false
                                        }).then(function() {
                                            window.location.reload(true);
                                        });
                                    }
                                }
                                else{
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Yes!',
                                        text: 'Produk telah ditambahkan ke keranjang belanja',
                                        allowOutsideClick: false
                                    }).then(function() {
                                        window.location.reload(true);
                                    });
                                }
                            },
                            error : function (data) {
                                console.log(data.response);
                                Swal.fire({
                                    title: "Ups!",
                                    text: "Mohon cek kembali inputan Anda",
                                    type: "error",
                                    allowOutsideClick: false
                                }).then(function() {
                                    window.location.reload(true);
                                });
                            }
                        });
                    }
                }
                else{
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('cart') }}",
                        data: {
                            product_id: products_id,
                            variant_id: 0,
                            qty: qtys_id,
                            size_chart: size_chart,
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: 'JSON',
                        beforeSend: function () {
                            Swal.fire({
                                title: "Mohon Menunggu",
                                text: "Data Anda sedang diproses",
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
                        success: function (data) {
                            console.log('berhasil : '+data.qty_available);
                            if(data.qty == true){
                                if(data.qty_available < 1){
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Error!',
                                        text: `Maaf stok telah habis`,
                                        allowOutsideClick: false
                                    }).then(function() {
                                        window.location.reload(true);
                                    });
                                }
                                else{
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Error!',
                                        text: `Maaf stok tidak cukup, stok yang tersedia: ${data.qty_variant_available}`,
                                        allowOutsideClick: false
                                    }).then(function() {
                                        window.location.reload(true);
                                    });
                                }
                            }
                            else{
                                Swal.fire({
                                    type: 'success',
                                    title: 'Yes!',
                                    text: 'Produk telah ditambahkan ke keranjang belanja',
                                    allowOutsideClick: false
                                }).then(function() {
                                    window.location.reload(true);
                                });
                            }
                        },
                        error : function (data) {
                            console.log('gagal');
                            Swal.fire({
                                title: "Ups!",
                                text: "Mohon cek kembali inputan Anda",
                                type: "error",
                                allowOutsideClick: false
                            }).then(function() {
                                window.location.reload(true);
                            });
                        }
                    });
                }
            });

            $('#float_product_qtys').on('keyup change',function(){
                var max = $(this).data('max');
                var min = $(this).data('min');
                if($('#float_product_qtys').val() > max){
                    $('#float_product_qtys').val(max);
                }
                else if($('#float_product_qtys').val() < min){
                    $('#float_product_qtys').val(min);
                }
            });

            $("#number-plus-detail").bind('keyup mouseup change', function () {
                var max = $('.product_qtys').data('max') - 1;
                var product_id= $('.product_qtys').data('product');

                if($('.product_qtys').val() > max){
                    $('.product_qtys').val(max);
                }

                if($('#product_variants').val() == '0'){
                    Swal.fire({
                        type: 'error',
                        title: 'Ups!',
                        text: 'Mohon pilih variant terlebih dahulu!',
                    }).then((result) => {
                        $('.product_qtys').val(1);
                    });
                }
            });

            $("#number-minus-detail").bind('keyup mouseup change', function () {
                var min = $('.product_qtys').data('min') + 1;
                var product_id= $('.product_qtys').data('product');
                if($('.product_qtys').val() < min){
                    $('.product_qtys').val(min);
                }

                if($('#product_variants').val() == '0'){
                    Swal.fire({
                        type: 'error',
                        title: 'Ups!',
                        text: 'Mohon pilih variant terlebih dahulu!',
                    }).then((result) => {
                        $('.product_qtys').val(1);
                    });
                }
            });

            $('#showGalery').on('shown.bs.modal', function(e) {
                $('.slider-gallery-modal').slick({
                    lazyLoad: 'ondemand',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    // arrows: false,
                    fade: true,
                });
            });

            $('.slider-gallery-modal').on('lazyLoaded', function(event, slick, image, imageSource){
                $(image).parent().addClass('loaded');
            });
        });
    </script>
    <script type="text/javascript">
        // -----------------------------------------------------------------------------
        // JANGAN EDIT SELAIN UNTUK PRODUCT CARD
        // -----------------------------------------------------------------------------
        $(document).ready(function(){
            $('.sendmenotif').on('click',function(e){
                e.preventDefault();
                var id_product = $(this).data('product');
                var id_variant = $(this).data('variant');

                $.ajax({
                    url: "{{ route('produk.reminder') }}",
                    method: 'POST',
                    dataType: "json",
                    data: {
                        product_id: id_product,
                        variant_id: id_variant,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        console.log('status:'+response);
                        if(response.success ){
                            console.log('sukses');
                            Swal.fire({
                                type: 'success',
                                title: '<span class="title-reminder">Terimakasih</span>',
                                text: 'Pemberitahuan telah dikirim, harap menunggu konfirmasi diperbarui.',
                                confirmButtonText: 'Ok',
                                confirmButtonClass: 'notif-me',
                                allowOutsideClick: false
                            }).then(function() {
                                window.location.reload(true);
                            });
                        }
                        else if(response.productReminder){
                            console.log('gagal');
                            Swal.fire({
                                title: '<span class="title-reminder">Maaf</span>',
                                text: response.msg_title,
                                confirmButtonText: 'Ok',
                                confirmButtonClass: 'notif-me',
                                allowOutsideClick: false
                            }).then(function() {
                                window.location.reload(true);
                            });
                        }
                    }
                });
            });

            $('.add-to-cart').on('click',function(e){
                e.preventDefault();
                var products_id = $(this).data('id');
                var qtys_id = $('#qty').val();
                var stock = $(this).data('stock');
                var stockcart = $(this).data('stockcart');

                if(stock == 0 || stock == ''){
                    $('#emptyStock').modal('show');
                    $('#sendmenotif').attr({
                        'data-product' : products_id,
                        'data-variant' : 0
                    });
                }
                else{
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('cart.add') }}",
                        data: {
                            product_id: products_id,
                            variant_id: 0,
                            qty: qtys_id,
                            size_chart: 0,
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: 'JSON',
                        beforeSend: function () {
                            Swal.fire({
                                title: "Mohon Menunggu",
                                text: "Data Anda sedang diproses",
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
                        success: function (data) {
                            console.log(data);
                            if(data.qty == true){
                                if(data.qty_available < 1){
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Maaf!',
                                        text: 'Anda sudah mencapai batas pembelian',
                                        allowOutsideClick: false
                                    }).then(function() {
                                        window.location.reload(true);
                                    });
                                }
                            }
                            else{
                                Swal.fire({
                                    type: 'success',
                                    title: 'Yes!',
                                    text: 'Produk telah ditambahkan ke keranjang belanja',
                                    allowOutsideClick: false
                                }).then(function() {
                                    window.location.reload(true);
                                });
                            }
                        },
                        error : function (data) {
                            console.log('gagal');
                            Swal.fire({
                                title: "Ups!",
                                text: "Mohon cek kembali inputan Anda",
                                type: "error",
                                allowOutsideClick: false
                            }).then(function() {
                                window.location.reload(true);
                            });
                        }
                    });
                }
            });

            $(document).on('click','.add-to-cart-variant',function(e){
                e.preventDefault();
                var products_id = $(this).data('id');
                $('.qty-addctrsdsv').addClass('d-none');

                $.ajax({
                    url: "{{ route('produk.get.variant') }}",
                    method: 'POST',
                    dataType: "json",
                    data: {
                        products_id: products_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        var response = data.products;
                        $('#cover-variant').attr({
                            'style' : 'background-image:url('+response.image+')'
                        });
                        $('#name_product_variant').html(response.name);
                        if (response.discount_type == 0) {
                            $('#price_variant').html(response.harga_jual);
                        }
                        else{
                            $('#price_variant').html(response.finalprice);
                        }

                        $('.modal_qtys_addtocart').attr({
                            'data-product' : response.id,
                            'value' : 1,
                            'max' : response.stock,
                            'data-max' : response.stock
                        });

                        var variant_product = data.variants;
                        var html  = '';
                        html += '<div class="product_size sorts-list form-vegan">'
                        $.each(variant_product, function(i,v){
                            all_stock_varian = v.all_stock;
                            html += '<div class="custom-radio form-check-inline variant_size_chart ">'
                                if(all_stock_varian < 1){
                                    html += '<input data-product="'+response.id+'" data-stokproduct="'+v.stock+'" data-stock="0" value="0" data-id="'+v.id+'" data-size="'+v.name+'" class="variant_size variant_size_mdlcrts size_kaos_'+v.id+'" type="radio" name="size_kaos" id="size_'+v.name+'">'
                                }
                                else{
                                    html += '<input data-product="'+response.id+'" data-stokproduct="'+v.stock+'" data-stock="'+all_stock_varian+'" value="'+all_stock_varian+'" data-id="'+v.id+'" data-size="'+v.name+'" class="variant_size variant_size_mdlcrts size_kaos_'+v.id+'" type="radio" name="size_kaos" id="size_'+v.name+'">'
                                }
                                html += '<label for="size_'+v.name+'" class="main-text small-label-variant">'
                                    html += '<span>'+v.name+'</span>'
                                html += '</label>'
                            html += '</div>'
                        });
                        html += '</div>';
                        $('#size_variant_lists').html(html);

                        $('#Modal_addToCart-vegan').modal({
                            backdrop: 'static',
                            keyboard: false
                        });
                    }
                });
            });

            $(document).on('click','.variant_size_mdlcrts',function(e){
                var id_product = $(this).data('product');
                var id_variant = $(this).data('id');
                var name_variant = $(this).data('size');
                var stock = $(this).data('stock');;
                var stockproduct = $(this).data('stokproduct');

                $('.qty-addctrsdsv').removeClass('d-none');
                $('.modal_qtys_addtocart').attr({
                    'data-variant' : name_variant,
                    'data-id' : id_variant,
                    'data-product' : id_product,
                    'value' : 1,
                    'max' : stock,
                    'data-max' : stock
                });
                $('.addcartvariantproduk').attr({
                    'data-variant' : name_variant,
                    'data-id' : id_variant,
                    'data-product' : id_product,
                    'data-stock' : stock,
                    'data-stockproduct' : stockproduct,
                });
                if(stock < 6){
                    $('#sisa_stock').text('Stok Sisa : '+stock);
                }
                if(stockproduct < 1){
                    $('#sisa_stock').text('Stok Habis');
                }
            });

            $(document).on('click','.addcartvariantproduk',function(e){
                e.preventDefault();
                var products_id = $(this).data('product');
                var qtys_id = $('.modal_qtys_addtocart').val();
                var stock = $(this).data('stock');
                var stockproduct = $(this).data('stockproduct');
                var variant_id = $(this).data('id');
                var variant_name = $(this).data('variant');

                if(!($('.variant_size_mdlcrts').is(':checked'))){
                    Swal.fire({
                        type: 'error',
                        title: 'Maaf!',
                        text: 'Mohon pilih size terlebih dahulu',
                        allowOutsideClick: false
                    });
                }
                else{
                    if(stockproduct == 0 || stockproduct == ''){
                        $('#Modal_addToCart-vegan').modal('hide');
                        $('#emptyStock').modal('show');
                        $('#sendmenotif').attr({
                            'data-product' : products_id,
                            'data-variant' : variant_id
                        });
                    }
                    else{
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('cart.add') }}",
                            data: {
                                product_id: products_id,
                                variant_id: variant_id,
                                qty: qtys_id,
                                size_chart: 1,
                                _token: "{{ csrf_token() }}"
                            },
                            dataType: 'JSON',
                            beforeSend: function () {
                                Swal.fire({
                                    title: "Mohon Menunggu",
                                    text: "Data Anda sedang diproses",
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });
                            },
                            success: function (data) {
                                console.log(data);
                                if(data.qty_variant == true){
                                    if(data.qty_variant_available < 1){
                                        Swal.fire({
                                            type: 'error',
                                            title: 'Maaf!',
                                            text: 'Anda sudah mencapai batas pembelian',
                                            allowOutsideClick: false
                                        }).then(function() {
                                            window.location.reload(true);
                                        });
                                    }
                                }
                                else{
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Yes!',
                                        text: 'Produk telah ditambahkan ke keranjang belanja',
                                        allowOutsideClick: false
                                    }).then(function() {
                                        window.location.reload(true);
                                    });
                                }
                            },
                            error : function (data) {
                                console.log('gagal');
                                Swal.fire({
                                    title: "Ups!",
                                    text: "Mohon cek kembali inputan Anda",
                                    type: "error",
                                    allowOutsideClick: false
                                }).then(function() {
                                    window.location.reload(true);
                                });
                            }
                        });
                    }
                }
            });

            $('.close-addtocartvariant').on('click',function(e){
                $('#Modal_addToCart-vegan').modal('hide');
                window.location.reload(true);
            });

            $('.deleteCart').on('click',function(e){
                e.preventDefault();
                var products_id   = $(this).data('id');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('cart.delete') }}",
                    data: {
                        product_id: products_id,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: 'JSON',
                    beforeSend: function () {
                        Swal.fire({
                            title: "Mohon Menunggu",
                            text: "Data Anda sedang diproses",
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                    },
                    success: function (data) {
                        console.log('berhasil');
                        Swal.fire({
                            type: 'success',
                            title: 'Yes!',
                            text: 'Produk telah berhasil dihapus dari keranjang belanja',
                            allowOutsideClick: false
                        }).then(function() {
                            window.location.reload(true);
                        });
                    },
                    error : function (data) {
                        console.log('gagal');
                        Swal.fire({
                            title: "Ups!",
                            text: "Mohon Maaf, Produk gagal dihapus dari keranjang belanja",
                            type: "error",
                            allowOutsideClick: false
                        }).then(function() {
                            window.location.reload(true);
                        });
                    }
                })
            });

            //start: number for modal add to cart variant
            $(".number-plus").bind('keyup mouseup change', function () {
                if($(this).hasClass('number-plus-modlAddcart')){
                    var max = $(this).prev().data('max') - 1;
                    var maxInput = $('.size_variant_lists').find('.variant_size_mdlcrts:checked').data('max') - 1;

                    if($(this).prev().val() > max){
                        $(this).prev().val(max);
                    }
                    else if($(this).prev().val() > maxInput){
                        $(this).prev().val(maxInput);
                    }
                }
            });

            $(".number-minus").bind('keyup mouseup change', function () {
                if($(this).hasClass('number-minus-modlAddcart')){
                    var min = $(this).next().data('min') + 1;
                    var minInput = $('.size_variant_lists').find('.variant_size_mdlcrts:checked').data('min') + 1;

                    if($(this).next().val() < min){
                        $(this).next().val(min);
                    }
                    else if($(this).next().val() < minInput){
                        $(this).next().val(minInput);
                    }
                }
            });
            //end:/ number for modal add to cart variant
        });
    </script>
@endpush
