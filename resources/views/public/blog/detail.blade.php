@extends('layouts.fe.fe')

@section('metadata')
    <title>Veganesia - Blog - {{$artikel_detail->title}}</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/blog/detail.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/vendor/slick_slider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/blog/sidebar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/content/card_product.css') }}">
@endpush

@section('content')
    <div class="blogdetail-section container">
        <!-- Blog Detail Header -->
        <!-- ============================================================== -->
        <section class="ct-blog-header">
            <div class="grid_layouts gr-blog-detail">
                <div class="ls-menucategory">
                    <ul>
                        @foreach($category as $menucategory)
                        <li>
                            <a href="{{ route('blog.category', [$menucategory->slug]) }}" class="main-sub-text text-capitalize">
                                {{$menucategory->name}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <form class="form-vegan" autocomplete="off" id="searchblogdetailForm" action="" method="get">
                        <div class="input-group search-inputs">
                            <input id="searchblogdetailData" name="searchblog" type="text" class="form-control --search" placeholder="Cari Artikel" aria-label="" aria-describedby="search" value="{{ isset(request()->searchblog) ? request()->searchblog : '' }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text --nobg" id="searchblogdetail">
                                    <button class="search-icn" type="button"></button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Blog Detail Header -->

        <!-- Blog Detail Content -->
        <!-- ============================================================== -->
        <section class="ct-blog-detail">
            @if(count($product_related) > 0)
            <div class="grid_layouts gr-blog-detail">
            @else
            <div class="no-grids">
            @endif
                <div class="detail-ct-sec">
                    <!-- Breadcrumb -->
                    <!-- ============================================================== -->
                    <div class="sec-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('blog')}}">Vegan News</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{$artikel_detail->title}}
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Breadcrumb -->

                    <h4 class="mb-3 f-Asap_medium title-blog">
                        {{$artikel_detail->title}}
                    </h4>
                    <div class="ctg-sec">
                        <a href="{{ route('blog.category', [$artikel_detail->urlcategory]) }}" class="f-Asap_light sml-tct clr-light-gry truncate-texts">
                            {{$artikel_detail->category}}
                        </a>
                    </div>
                    <div class="grid_layouts gr-middle-blg">
                        <div class="date-blg rhegr">
                            <small class="small-fnt">
                                {{ Carbon\Carbon::parse($artikel_detail->created_at)->format('d F Y') }}
                            </small>
                            @if($artikel_detail->hits > 0)
                            <small class="sml-tct viewers-pts small-fnt" style="color: rgba(0, 0, 0, 0.4);">
                                <div class="viewers-icn --blck"></div>
                                <span class="constantformatnumber" data-content="{{$artikel_detail->hits}}">{{$artikel_detail->hits}}</span>
                            </small>
                            @endif
                        </div>
                        <div class="position-relative shares-smd share-btn" id="share-oz{{ $artikel_detail->id }}" data-url="{{ route('blog.detail', [$artikel_detail->urlcategory, $artikel_detail->urlblog]) }}" data-title="{{ $artikel_detail->post_title }}" data-desc="{{ $artikel_detail->post_title }}">
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
                                <a data-target="{{ $artikel_detail->id }}-top" class="copyclp copyclp-vegan-btn position-relative" data-clipboard-text="{{ route('blog.detail', [$artikel_detail->urlcategory, $artikel_detail->urlblog]) }}" type="button">
                                    <i class="fas fa-link"></i>
                                </a>
                            </div>
                            <div class="ct-tggle ct-tggle-top" id="copyclip-vegan{{ $artikel_detail->id }}-top" style="display: none">
                                <div class="position-relative">
                                    <small class="small-fnt">Copied</small>
                                    <div class="mn-arrw"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-art">
                        <div class="cover-blg img-lazy images-slider big-lazy" data-src="{{ asset($artikel_detail->image_cover) }}"></div>
                        <article>
                            <p>{!! $artikel_detail->contentblog !!}</p>
                        </article>
                        <div class="sosmed">
                            <h6 class="mb-0 f-Asap_medium">
                                Share
                                <span style="padding-left: 20px;">
                                    <div class="position-relative shares-smd share-btn" id="share-oz{{ $artikel_detail->id }}" data-url="{{ route('blog.detail', [$artikel_detail->urlcategory, $artikel_detail->urlblog]) }}" data-title="{{ $artikel_detail->post_title }}" data-desc="{{ $artikel_detail->post_title }}">
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
                                            <a data-target="{{ $artikel_detail->id }}-bottom" class="copyclp-vegan-btn copyclp position-relative" data-clipboard-text="{{ route('blog.detail', [$artikel_detail->urlcategory, $artikel_detail->urlblog]) }}" type="button">
                                                <i class="fas fa-link"></i>
                                            </a>
                                        </div>
                                        <div class="ct-tggle ct-tggle2" id="copyclip-vegan{{ $artikel_detail->id }}-bottom" style="display: none">
                                            <div class="position-relative">
                                                <small class="small-fnt">Copied</small>
                                                <div class="mn-arrw"></div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            </h6>
                        </div>
                        <div class="tags">
                            <ul>
                                @foreach($blog_tags as $tags)
                                <li>
                                    <h6>
                                        {{$tags->name}}
                                    </h6>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @if(count($product_related) > 0)
                <div class="sidebar-blog">
                    <div class="top-menu">
                        <h6 class="f-Asap_medium text-capitalize">produk terkait</h6>
                    </div>
                    <div class="bottom-menu">
                        <div class="grid_layouts gr-prdetails">
                            @foreach($product_related->take(2) as $products_related)
                            <div class="box-sldr">
                                @include('public.produk.card_product', ['produk'=>$products_related])
                            </div>
                            @endforeach
                        </div>
                        @if(count($product_related) > 2)
                        <div class="view-details">
                            <a href="{{ route('produk.blog', [$tagblog, 'blog'=>'true']) }}">
                                lihat produk lainnya ({{count($product_related)-2}})
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Blog Detail Content -->

        @if(count($blogrecommendation) > 0)
        <!-- Recommendation Blog -->
        <!-- ============================================================== -->
        <section class="recommendation-blog container">
            <div class="head-ct-slider pt-0">
                <div class="head-ttle">
                    <h3 class="mb-0 text-uppercase">
                        baca juga lainnya
                    </h3>
                </div>
            </div>
            <div class="sldr-gr-artkles">
                <div class="main-recommendation-slider slider-lazy big-lazy">
                    <div class="recommendation-slider slider-temp --slider-main">
                        @foreach($blogrecommendation as $blogsrecommendation)
                        <div class="gr-artkl">
                            <div class="card-artikel">
                                <a href="{{ route('blog.detail', [$blogsrecommendation->urlcategory, $blogsrecommendation->urlblog]) }}" class="imgs-artikel">
                                    <div class="image-cvr img-lazy images-slider small-lazy" data-src="{{ asset($blogsrecommendation->image_cover) }}"></div>
                                </a>
                                <div class="desc-artikel">
                                    <div>
                                        <a href="{{ route('blog.detail', [$blogsrecommendation->urlcategory, $blogsrecommendation->urlblog]) }}" class="main-sub-text mb-2 text-left text-black truncate-texts f-Asap_reg --three">
                                            {{$blogsrecommendation->title}}
                                        </a>
                                    </div>
                                    <div class="ctg-sec">
                                        <a href="{{ route('blog.category', [$blogsrecommendation->urlcategory]) }}" class="f-Asap_light sml-tct clr-light-gry truncate-texts">
                                            {{$blogsrecommendation->category}}
                                        </a>
                                    </div>
                                    <div class="--date rhegr">
                                        <small class="clr-light-gry truncate-texts text-left f-Asap_medium small-fnt">
                                            {{ Carbon\Carbon::parse($blogsrecommendation->post_time)->format('d M Y') }}
                                        </small>
                                        @if($artikel_detail->hits > 0)
                                        <small class="sml-tct viewers-pts small-fnt" style="color: rgba(0, 0, 0, 0.4);">
                                            <div class="viewers-icn --blck"></div>
                                            <span class="constantformatnumber" data-content="{{$artikel_detail->hits}}">{{$artikel_detail->hits}}</span>
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
        </section>
        <!-- ============================================================== -->
        <!-- End Recommendation Blog -->
        @endif
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('dist/vendors/slick-slider/slick/slick.js')}}"></script>
    <script type="text/javascript" src="{{ asset('dist/fe/js/pages/blog_detail.js') }}"></script>
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