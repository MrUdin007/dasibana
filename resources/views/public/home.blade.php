@extends('layouts.fe.fe')

@section('metadata')
    <title>Veganesia</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/home.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/content/card_product.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/vendor/slick_slider.css') }}">
    <style>
        .test-dgit p[lang~="fr"]{
            color: red !important;
        }
        .test-dgit p[lang]{
            color: yellow;
        }
    </style>
@endpush

@section('content')
    <div class="home-section">
        @if(count($sliders) > 0)
        <!-- Banner -->
        <!-- ============================================================== -->
        <section class="sec-banner grid_layouts container slider-lazy big-lazy">
            <div class="sec-slider-banner">
                <div class="slider-banner slider-temp mb-0">
                    @foreach($sliders as $slidersBanner)
                    <div class="pd-sldr">
                        <a href="{{ ($slidersBanner->target_url) ? $slidersBanner->target_url : 'javascript:void(0)' }}" @if($slidersBanner->target_url) target="blank" @endif>
                            <div class="images-slider img-lazy big-lazy">
                                <img data-lazy="{{ asset($slidersBanner->image) }}" data="{{ asset($slidersBanner->image) }}">
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="banner-nonslider">
                <div class="cover-banner-nonslider img-lazy images-slider big-lazy" data-src="{{ asset('dist/fe/icons/cover.png') }}"></div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Banner -->
        @endif

        <div>
            <div class="test-dgit">
                <p lang="fr">testing</p>
                <p lang="tes">testing</p>
                <p lang="ye">testing</p>
            </div>
            <form id="insertData" action="post" method="">
                <input type="text" id="insert">
                <button id="addItem" type="button">Insert</button>
            </form>
            <button id="tes">tes</button>
            <ul id="dataHasilInsert">
                <li>
                    <p>tes</p>
                </li>
            </ul>

            <div id="hasiltest1"></div>
            <div>
                <div class="headertess">
                    <a href="#">register</a>
                    <ul class="menu">
                        <li><a href="#">home</a></li>
                        <li><a href="#">about</a></li>
                    </ul>
                </div>
            </div>
            <div class="tesnumbernya"></div>
            <div class="tesproduknya"></div>
            <div class="containertes">
                <button class="btn-show">tes</button>
            </div>
            <div class="testp">
                <p>paragraf 1</p>
                <p>paragraf 2</p>
                <p>paragraf 3</p>
            </div>
        {{$testTable[1]['color']}}
        <img src="{{ asset('dist/fe/icons/covers.png') }}" alt="testgambar" style="width: 100px">
        </div>

        @if(count($newProduct) > 0)
        <!-- New Product Slider -->
        <!-- ============================================================== -->
        <section class="new-slider-product">
            <div class="container bg-slider-prdct">
                <div class="bg-title-newPrdct">
                    <div class="title-newPrdct">
                        <a class="djagae" href="{{ route('produk.newproduct', ['newproduct'=>'true']) }}">produk <span class="f-Asap_bold">terbaru</span></a>
                    </div>
                </div>
                <div class="slider-lazy big-lazy --main-sldr">
                    <div class="slider-prdct slider-temp --slider-main">
                        @foreach($newProduct as $newProducts)
                        <div class="box-sldr">
                            @include('public.produk.card_product', ['produk'=>$newProducts])
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End New Product Slider -->
        @endif

        @if(count($promoWeekly) > 0)
        <!-- Weekly Product Slider -->
        <!-- ============================================================== -->
        <section class="weekly-slider-product container">
            <div class="bg-title">
                <a href="{{ route('produk.sale', ['sale'=>'true']) }}" class="link_produk_sale title-sales f-Asap_medium">weekly promo</a>
            </div>
            <div class="bg-white-slider">
                <div class="slider-lazy big-lazy --main-sldr">
                    <div class="slider-prdct slider-temp --slider-main">
                        @foreach($promoWeekly as $promosWeekly)
                        <div class="box-sldr">
                            @include('public.produk.card_product', ['produk'=>$promosWeekly])
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Weekly Product Slider -->
        @endif

        @if(count($BlogCategories) > 0)
        <!-- Vegan News -->
        <!-- ============================================================== -->
        <section class="vegan-news container">
            <a class="pts-bg-title" href="{{ route('blog') }}">
                <div class="bg-title"></div>
            </a>
            <div class="vegan-news-sec">
                <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                    @foreach($BlogCategories->take(4) as $key => $cat)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link @if($loop->first) active @endif" id="cat_blog_{{$cat->id}}-tab" data-toggle="pill" href="#cat_blog_{{$cat->id}}" role="tab" aria-controls="cat_blog_{{$cat->id}}" aria-selected="true">
                            {{$cat->name}}
                        </a>
                    </li>
                    @endforeach
                    @if(count($BlogCategories) > 3)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="#">
                            lainnya
                        </a>
                    </li>
                    @endif
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    @foreach($BlogCategories as $key => $cat)
                    <div class="tab-pane fade @if($loop->first) show active @endif" id="cat_blog_{{$cat->id}}" role="tabpanel" aria-labelledby="cat_blog_{{$cat->id}}-tab">
                        <div class="slider-artikel">
                            <div class="main-news-slider slider-lazy big-lazy webversions">
                                <div class="news-slider slider-temp --slider-main ">
                                    @foreach($cat->blog_item_list()->take(3) as $BlogPosts)
                                    <div class="gr-artkl">
                                        <div class="card-artikel">
                                            <div class="cover-sldr img-lazy images-slider big-lazy" data-src="{{ asset($BlogPosts->image_cover) }}">
                                                <div class="bg-overlay"></div>
                                                <div class="kategories">
                                                    <a href="{{ route('blog.category', [$BlogPosts->category_slug]) }}" class="catg-ttl">{{$BlogPosts->category}}</a>
                                                </div>
                                                <div class="contents">
                                                    <a href="{{ route('blog.detail', [$BlogPosts->category_slug, $BlogPosts->urlblog]) }}" class="ttle-blg truncate-texts --two">
                                                        {{$BlogPosts->blogname}}
                                                    </a>
                                                    <div class="small-txt rhegr">
                                                        <small class="sml-tct small-fnt" style="color: rgba(255, 255, 255, 0.8);">
                                                            {{ Carbon\Carbon::parse($BlogPosts->post_time)->format('d M Y') }}
                                                        </small>
                                                        @if($BlogPosts->hits > 0)
                                                        <small class="sml-tct viewers-pts small-fnt">
                                                            <div class="viewers-icn --whts"></div>
                                                            <span class="constantformatnumber" data-content="{{$BlogPosts->hits}}">{{$BlogPosts->hits}}</span>
                                                        </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="sldr-gr-artkles">
                                <div class="main-vegan-news-slider slider-lazy big-lazy">
                                    <div class="vegan-news-slider slider-temp --slider-main webversions">
                                        @foreach($cat->blog_item_list()->skip(3) as $BlogPosts)
                                        <div class="gr-artkl">
                                            <div class="card-artikel">
                                                <a href="{{ route('blog.detail', [$BlogPosts->category_slug, $BlogPosts->urlblog]) }}" class="imgs-artikel">
                                                    <div class="image-cvr img-lazy images-slider" data-src="{{ asset($BlogPosts->image_cover) }}"></div>
                                                </a>
                                                <div class="desc-artikel">
                                                    <div>
                                                        <a style="margin-bottom: 2px !important;" href="{{ route('blog.detail', [$BlogPosts->category_slug, $BlogPosts->urlblog]) }}" class="main-sub-text mb-1 text-left text-black truncate-texts f-Asap_reg --two">
                                                            {{$BlogPosts->blogname}}
                                                        </a>
                                                    </div>
                                                    <div class="ctg-sec">
                                                        <a href="{{ route('blog.category', [$BlogPosts->category_slug]) }}" class="sml-tct f-Asap_light clr-green truncate-texts">
                                                            {{$BlogPosts->category}}
                                                        </a>
                                                    </div>
                                                    <div class="--date rhegr">
                                                        <small class="clr-light-gry small-fnt truncate-texts text-left f-Asap_medium">
                                                            {{ Carbon\Carbon::parse($BlogPosts->post_time)->format('d M Y') }}
                                                        </small>
                                                        @if($BlogPosts->hits > 0)
                                                        <small class="sml-tct viewers-pts small-fnt">
                                                            <div class="viewers-icn --blck"></div>
                                                            <span class="constantformatnumber" data-content="{{$BlogPosts->hits}}">{{$BlogPosts->hits}}</span>
                                                        </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="vegan-news-slider slider-temp --slider-main" id="mobileversions">
                                        @foreach($cat->blog_item_list() as $BlogPosts)
                                        <div class="gr-artkl">
                                            <div class="card-artikel">
                                                <a href="{{ route('blog.detail', [$BlogPosts->category_slug, $BlogPosts->urlblog]) }}" class="imgs-artikel">
                                                    <div class="image-cvr img-lazy images-slider" data-src="{{ asset($BlogPosts->image_cover) }}"></div>
                                                </a>
                                                <div class="desc-artikel">
                                                    <div>
                                                        <a style="margin-bottom: 2px !important;" href="{{ route('blog.detail', [$BlogPosts->category_slug, $BlogPosts->urlblog]) }}" class="main-sub-text mb-1 text-left text-black truncate-texts f-Asap_reg --three">
                                                            {{$BlogPosts->blogname}}
                                                        </a>
                                                    </div>
                                                    <div class="ctg-sec">
                                                        <a href="{{ route('blog.category', [$BlogPosts->category_slug]) }}" class="sml-tct f-Asap_light clr-green truncate-texts">
                                                            {{$BlogPosts->category}}
                                                        </a>
                                                    </div>
                                                    <div class="--date rhegr">
                                                        <small class="clr-light-gry small-fnt truncate-texts text-left f-Asap_medium">
                                                            {{ Carbon\Carbon::parse($BlogPosts->post_time)->format('d M Y') }}
                                                        </small>
                                                        @if($BlogPosts->hits > 0)
                                                        <small class="sml-tct viewers-pts small-fnt">
                                                            <div class="viewers-icn --blck"></div>
                                                            <span class="constantformatnumber" data-content="{{$BlogPosts->hits}}">{{$BlogPosts->hits}}</span>
                                                        </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Vegan News -->
        @endif

        @if(count($productCategories) > 0)
        <!-- Slick Slider Product -->
        <!-- ============================================================== -->
        <section class="sec-slider-prodct p-0">
            <div class="container ct-sec-trnd">
                <div class="scroll-menu-tab">
                    <div class="arrow-scrl prev-scr">
                        <button id="saleLeft" type="button"></button>
                    </div>
                    <ul class="nav nav-tabs dv-scrbamn dv-scrbamn-hotItems --scrlbrr" id="produkTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link nav-hot-item active" id="cat_product_rekomendasi-tab" data-toggle="tab" href="#cat_product_rekomendasi" role="tab" aria-controls="rekomendasi" aria-selected="true">
                                rekomendasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-hot-item" id="cat_product_diskon-tab" data-toggle="tab" href="#cat_product_diskon" role="tab" aria-controls="sedang diskon" aria-selected="true">
                                sedang diskon
                            </a>
                        </li>
                        @foreach($productCategories as $key => $productCateg)
                        @if($productCateg->product != null)
                        <li class="nav-item">
                            <a class="nav-link nav-hot-item" id="cat_product_{{$productCateg->id}}-tab" data-toggle="tab" href="#cat_product_{{$productCateg->id}}" role="tab" aria-controls="{{$productCateg->id}}" aria-selected="false">
                                {{$productCateg->name}}
                            </a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                    <div class="arrow-scrl next-scr">
                        <button id="saleRight" type="button"></button>
                    </div>
                </div>
                <div class="sc-slidr-flsh">
                    <div class="tab-content" id="ProductTabContent">
                        <div class="tab-pane fade --main-sldr show active" id="cat_product_rekomendasi" role="tabpanel" aria-labelledby="rekomendasi-tab">
                            <div class="grid_layouts prdct-gr-shop">
                                @foreach($rekomendasi as $rcmnd)
                                <div class="ls-box-sldr-all box-sldr" id="box-all"data-id="cat_product_all" style="display: none;">
                                    @include('public.produk.card_product', ['produk'=>$rcmnd])
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade --main-sldr show active" id="cat_product_diskon" role="tabpanel" aria-labelledby="diskon-tab">
                            <div class="grid_layouts prdct-gr-shop">
                                @foreach($diskon as $dis)
                                <div class="ls-box-sldr-all box-sldr" id="box-all"data-id="cat_product_all" style="display: none;">
                                    @include('public.produk.card_product', ['produk'=>$dis])
                                </div>
                                @endforeach
                            </div>
                            <div class="load-prdct" style="width: 200px; margin: 50px auto 0;">
                                <button id="loadMore-all" class="btn-vegan green-border-btn text-capitalize">
                                    muat lebih banyak
                                </button>
                            </div>
                        </div>
                        @foreach($productCategories as $key => $productCateg)
                        <div class="tab-pane tab-pane-lists fade --main-sldr" data-id="{{$productCateg->id}}" id="cat_product_{{$productCateg->id}}" role="tabpanel" aria-labelledby="{{$productCateg->id}}-tab">
                            @if(count($productCateg->product_item_list()) > 0)
                            <div class="grid_layouts prdct-gr-shop">
                                @foreach($productCateg->product_item_list() as $allProducts)
                                <div id="box-{{$productCateg->id}}" class="box-test ls-box-sldrs-{{$productCateg->id}} box-sldr" data-product="{{$allProducts->id}}" data-tab="{{$productCateg->id}}" data-id="cat_product_{{$productCateg->id}}" style="display: none;">
                                    @include('public.produk.card_product', ['produk'=>$allProducts])
                                </div>
                                @endforeach
                            </div>
                            @if(count($productCateg->product_item_list()) > 10)
                            <div class="load-prdct" style="width: 200px; margin: 50px auto 0;">
                                <a onclick="loadMore({{$productCateg->id}})"><button class="loadMore-{{$productCateg->id}} btn-vegan green-border-btn text-capitalize">
                                    muat lebih banyak
                                </button></a>
                            </div>
                            @endif
                            @else
                            <!-- Start: If there is no product -->
                            <div class="no-post-list">
                                <div>
                                    <img src="{{ asset('dist/fe/icons/produk-empty.png') }}" alt="no post">
                                </div>
                                <div>
                                    <p class="text-center text-capitalize f-Asap_medium mb-0">
                                        produk tidak ditemukan
                                    </p>
                                </div>
                            </div>
                            <!-- End:/ If there is no product -->
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Slick Slider Product -->
        @endif
    </div>
@endsection

@section('seoContent')
    <section class="container">
        <article>
            <h5>Veganesia</h5>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fermentum neque a a justo, nisi ac. Placerat mauris nibh ac id velit pellentesque tincidunt vitae. Diam quis sem mattis nisi, sed quisque hendrerit. Eu nibh malesuada urna sit tellus porttitor. Sit malesuada accumsan odio sed porta suspendisse.
                Tellus aliquam id dui urna quam tellus purus sit facilisis. Sit malesuada amet orci at. Nulla nunc, eget neque, vulputate interdum viverra urna. In bibendum sagittis adipiscing tincidunt laoreet. Lacus viverra bibendum consectetur est id lacus amet sagittis tellus. Sed eros adipiscing ac tristique ultricies nibh vulputate pretium, blandit. Sit pharetra vitae, pellentesque adipiscing. Scelerisque ut ut quis quis semper. Vestibulum aliquam ut scelerisque curabitur dolor id duis mi. Pharetra adipiscing adipiscing ut morbi risus ante aliquam. Integer feugiat netus diam malesuada sed turpis ut. Sit purus bibendum enim tellus sem eget scelerisque.
            </p>
        </article>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('dist/vendors/slick-slider/slick/slick.js')}}"></script>
    <script type="text/javascript" src="{{ asset('dist/fe/js/pages/home.js') }}"></script>
    <script type="text/javascript">
        // KHUSUS HOME
        $(document).ready(function(){
            $("#addItem").click(function(){
                // alert('tes');
                var insert = $("#insert").val();
                
                $("#dataHasilInsert").append("<li><p>"+insert+"</p></li>");
            });
            
            $("#insertData").on('submit', function(e){
                e.preventDefault();
                return false; 
            });
            
            // $("#tes").click(function(){
            //     alert('tes');
            // });


            const arr1 = [1,2,5,7],
                  arr2 = [3,4,8],
                  arrHasil = arr1.concat(arr2);
            function bogoSort(arrHasil) {
                const Array1 = Math.floor(Math.random() * arrHasil.length); 
                const Array2 = Math.floor(Math.random() * arrHasil.length); 
                const a = arrHasil[Array1]; 
                const b = arrHasil[Array2]; 
                arrHasil[Array1] = b; 
                arrHasil[Array2] = a; 
                for (let i = 0; i < arrHasil.length - 1; i++) { 
                    const tes1 = arrHasil[i]; 
                    const tes2 = arrHasil[i + 1]; 
                    if (tes1 > tes2) { 
                        return bogoSort(arrHasil); 
                    }; 
                } 
                return arrHasil;
            } 
            // alert(bogoSort(arrHasil));

            let a = 3, b = 7, hasil = document.getElementById('hasil');
            b = [a, a = b][0];
            hasil.innerHTML += "<p>Hasil Swap: "+a+", "+b+"</p>";

            function test1(){
                var text = 10;
                var i;
                for (i = 0; i < 5; i++) {
                    text += "The number is " + i + "<br>";
                }
                document.getElementById("hasiltest1").innerHTML = text;
            }
            test1();

            /*start: load product*/
            $(".ls-box-sldr-all").slice(0, 10).show();
            $('#loadMore-all').on('click', function(e){
                console.log('áaa');
                e.preventDefault();
                $(".ls-box-sldr-all:hidden").slice(0, 10).slideDown();
                if ($(".ls-box-sldr-all:hidden").length == 0) {
                    // $("#load").fadeOut('slow');
                    $(this).hide();
                }
            });

            $('.tab-pane-lists').each(function(){
                $('.ls-box-sldrs-'+$(this).data('id')).slice(0, 10).show();
            });
            
            function loadMore(id) {
                $('.ls-box-sldrs-'+id+':hidden').slice(0, 10).slideDown();
                if ($('.ls-box-sldrs-'+id+':hidden').length == 0) {
                    $(this).hide();
                }
            }
            /*end:/ load product*/
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