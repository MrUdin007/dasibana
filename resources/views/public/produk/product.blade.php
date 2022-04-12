@extends('layouts.fe.fe')

@section('metadata')
    <title>Veganesia - Produk</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/content/sidebar_product.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/content/card_product.css') }}">
@endpush

@section('content')
    <div class="product-section">
        <div class="container">
            <div class="mobile-top-menu">
                <!-- Sidebar Produk Mobile -->
                <!-- ============================================================== -->
                <div class="mob-sdbr-acc mobl-sdbr-acc">
                    <button id="filter-produk" class="btn-vegan green-bg-btn text-capitalize" type="button">
                        <span><i class="fas fa-sliders-h"></i></span>
                        &nbsp;filter
                    </button>
                </div>
                <!-- ============================================================== -->
                <!-- End Sidebar Produk Mobile -->
            </div>
        </div>

        @if(isset(request()->search) || isset(request()->searchProduk))
        <!-- Title Produk -->
        <!-- ============================================================== -->
        <div class="sort-desk container">
            <p class="mb-3 main-sub-text f-Asap_reg">Hasil Pencarian dengan kata kunci
                <span class="f-Asap_medium">
                    @if(isset(request()->search))
                    "{{ request()->search }} (<span class="constantformatnumber" data-content="{{count($products)}}">{{count($products)}}</span>)"
                    @elseif(isset(request()->searchProduk))
                    "{{ request()->searchProduk }} (<span class="constantformatnumber" data-content="{{count($products)}}">{{count($products)}}</span>)"
                    @endif
                </span>
            </p>
        </div>
        <!-- ============================================================== -->
        <!-- End Title Produk -->
        @endif

        <!-- Content Produk -->
        <!-- ============================================================== -->
        <section class="container">
            @if($sale)
            <div class="weeklypromosection">
                <h6 class="mb-0 f-Asap_medium desc-main-text-lg">weekly promo</h6>
            </div>
            @endif
            @if($newproduct)
            <div class="is_newsection">
                <h6 class="mb-0 f-Asap_medium desc-main-text-lg">produk terbaru</h6>
            </div>
            @endif

            @if($product_related)
            <div class="is_newsection">
                <h6 class="mb-0 f-Asap_medium desc-main-text-lg" style="background: #16a387;">produk terkait</h6>
            </div>
            @endif

            <div class="grid_layouts prdct-sec">
                <div>
                    <!-- Sidebar Desktop -->
                    <!-- ============================================================== -->
                    <div id="desk-sdbr">
                        @include('layouts.fe.sidebar.sidebar-product',['slug'=>''],compact('category_list'))
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Sidebar Desktop -->
                </div>
                <div class="ct-produk-section">
                    <!-- Sort Desktop -->
                    <!-- ============================================================== -->
                    <div class="sort-desk">
                        <div class="grid_layouts ct-sort-desk" style="margin-bottom: 20px;">
                            <div>
                                <form action="" class="form-vegan">
                                    <div class="sorts-list">
                                        <div class="custom-checkbox form-check-inline">
                                            <input value="0" class="sedangdiskon" @if(in_array('sedangdiskon',$param)) selected @endif type="checkbox" name="sedangdiskon" id="sedangdiskon">
                                            <label for="sedangdiskon">
                                                sedang diskon
                                            </label>
                                        </div>
                                        <div class="custom-checkbox form-check-inline">
                                            <input class="produkfav" @if(in_array('produkfav',$param)) selected @endif type="checkbox" name="produkfav" id="produkfav" value="1">
                                            <label for="produkfav">
                                                produk favorit
                                            </label>
                                        </div>
                                        <div class="custom-checkbox form-check-inline">
                                            <input class="tanpabawang" @if(in_array('tanpabawang',$param)) selected @endif type="checkbox" name="tanpabawang" id="tanpabawang" value="false">
                                            <label for="tanpabawang">
                                                tanpa bawang
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="grid_layouts sort-gr sort-prdct sort-pt">
                                <div class="list-srt">
                                    <p class="mb-0 clr-grey-txt">Urutkan berdasarkan &nbsp;:</p>
                                </div>
                                <div class="list-srt">
                                    <div class="form-vegan">
                                        <div class="main-form-vg input-sorts">
                                            <div class="--custom-select sort-black">
                                                <select style="width: 135px;" class="resizeselect clr-light-gry text-capitalize f-Asap_light" id="sortproduct" name="sortproduct">
                                                    <option class="list-sortmns @if(in_array('terbaru',$param)) active_sort selected @endif sortProduct" href="javascript:void(0)" onclick="sort_product(this, 'terbaru')">
                                                        Terbaru
                                                    </option>
                                                    <option class="list-sortmns @if(in_array('terlama',$param)) active_sort selected @endif sortProduct" href="javascript:void(0)" onclick="sort_product(this, 'terlama')">
                                                        Terlama
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Sort Desktop -->

                    <div id="productContainer">
                        @include('public.produk.data_search',['products'=>$products, 'param'=>$param])
                    </div>
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Content Produk -->
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            /********************************/
            /*Active Class Menu Category Header*/
            /********************************/
            var slugheader = $('.header-ctgr.active').data('slug');
            $(".sidebar_category_list[data-slug='"+slugheader+"']").addClass('active');
            var slugsidebar = $('.sidebar_category_list.active').data('slug');
            $(".header-ctgr[data-slug='"+slugsidebar+"']").addClass('active');

            var slugheader_sub = $('.header-ctgr-sub.active').data('slug');
            $(".sidebar-ctgr-sub[data-slug='"+slugheader_sub+"']").addClass('active');
            $(".sidebar-ctgr-sub[data-slug='"+slugheader_sub+"']").parent().parent().addClass('show');
            $(".sidebar-ctgr-sub[data-slug='"+slugheader_sub+"']").parent().parent().parent().find('.arrow-sidebar-products').attr('aria-expanded', true);
            $(".sidebar-ctgr-sub[data-slug='"+slugheader_sub+"']").parent().parent().parent().siblings().find('.arrow-sidebar-products').attr('aria-expanded', false);
            var slugsidebar_sub = $('.sidebar-ctgr-sub.active').data('slug');
            $(".header-ctgr-sub[data-slug='"+slugsidebar_sub+"']").addClass('active');

            /********************************/
            /*Start: Filter & Sort Product*/
            /********************************/
            var category_ele = '';
            var sortby = '';
            var tanpabawang_ele = '';
            var sedangdiskon_ele = '';
            var produkfav_ele = '';
            var url_string     = window.location.href;
            var url            = new URL(url_string);
            var kategori_param = url.searchParams.get("kategori");
            var tanpabawang     = url.searchParams.get("tanpabawang");
            var sedangdiskon     = url.searchParams.get("sedangdiskon");
            var produkfav     = url.searchParams.get("produkfav");

            function lazyLoad() {
                var $q = function(q, res){
                    if (document.querySelectorAll) {
                        res = document.querySelectorAll(q);
                    } else {
                        var d=document,
                        a=d.styleSheets[0] || d.createStyleSheet();
                        a.addRule(q,'f:b');
                        for(var l=d.all,b=0,c=[],f=l.length;b<f;b++)
                            l[b].currentStyle.f && c.push(l[b]);

                        a.removeRule(0);
                        res = c;
                    }
                    return res;
                },
                addEventListener = function(evt, fn){
                    window.addEventListener
                        ? this.addEventListener(evt, fn, false)
                        : (window.attachEvent)
                            ? this.attachEvent('on' + evt, fn)
                            : this['on' + evt] = fn;
                },
                _has = function(obj, key) {
                    return Object.prototype.hasOwnProperty.call(obj, key);
                };
                function loadImage (el, fn) {
                    var img = new Image(),
                    src = el.getAttribute('data-src'),
                    embed = el.getAttribute('data-embed');
                    img.onload = function() {
                        if (!! el.parent){
                            el.parent.replaceChild(img, el)
                        }
                        else {
                            if (el.tagName == 'IMG') {
                                el.src = src;
                            } else {
                                $(el).css("background-image", "url("+src+")");
                            }
                            $(el).addClass('loaded');
                        }
                        if (embed) {
                            $(el).children(0).show();
                        }

                        fn? fn() : null;
                    }
                    if (src) {
                        img.src = src;
                    }
                }

                function elementInViewport(el) {
                    var rect = el.getBoundingClientRect();

                    return (
                        rect.top    >= 0
                    && rect.left   >= 0
                    && rect.top <= (window.innerHeight || document.documentElement.clientHeight)
                    )
                }

                var images = new Array(),
                query = $q('.img-lazy'),
                processScroll = function(){
                    for (var i = 0; i < images.length; i++) {
                        if (elementInViewport(images[i])) {
                            loadImage(images[i], function () {
                                images.splice(i, i);
                            });
                        }
                    };
                };

                // Array.prototype.slice.call is not callable under our lovely IE8
                for (var i = 0; i < query.length; i++) {
                    images.push(query[i]);
                };
                processScroll();
                addEventListener('scroll',processScroll);
            }

            function filterKategori() {
                $.ajax({
                    url: "{{ $filter_url }}",
                    method: 'GET',
                    dataType: "json",
                    data: {
                        kategori: category_ele,
                        sortby: sortby,
                        tanpabawang: tanpabawang_ele,
                        sedangdiskon: sedangdiskon_ele,
                        produkfav: produkfav_ele
                    },
                    success: function (response) {
                        console.log(response);
                        var temp_param = $.param({
                            kategori : response.kategori,
                            sortby : response.sortby,
                            tanpabawang: response.tanpabawang,
                            sedangdiskon: response.sedangdiskon,
                            produkfav: response.produkfav
                        });
                        window.history.pushState(
                            {
                                "html":response.html,
                                "total":response.total
                            },
                            "",
                            "{{ $filter_url }}?"+temp_param
                        );
                        $('.weeklypromosection').hide();
                        $('#productContainer').empty();
                        $('#productContainer').append(history.state.html);
                        lazyLoad();
                    }
                });
            }

            if (kategori_param) {
                $('.sidebar_category_list[data-slug="'+kategori_param+'"]').addClass('active');
                category_ele = kategori_param;
            }
            if (tanpabawang) {
                $('.tanpabawang[value="'+tanpabawang+'"]').prop('checked',true);
                tanpabawang_ele = $('.tanpabawang:checked').val();
            }
            if (sedangdiskon) {
                $('.sedangdiskon[value="'+sedangdiskon+'"]').prop('checked',true);
                sedangdiskon_ele = $('.sedangdiskon:checked').val();
            }
            if (produkfav) {
                $('.produkfav[value="'+produkfav+'"]').prop('checked',true);
                produkfav_ele = $('.produkfav:checked').val();
            }

            $(document).on('click','.sidebar_category_list_all',function(e){
                //utk menu header
                $(".header-ctgr").removeClass('active');
            });

            $(document).on('click','.sidebar_category_list',function(e){
                category_ele = $(this).data('slug');
                $(this).addClass('active');

                //utk menu sidebar siblings
                $(this).parent().siblings().find('.sidebar_category_list').removeClass('active');
                $(this).parent().siblings().find('.sidebar_category_list_parent').removeClass('active');
                $(this).parent().siblings().find('.sidebar_category_list_child').removeClass('active');

                //utk menu header
                $(".header-ctgr[data-slug='"+category_ele+"']").addClass('active');
                $(".header-ctgr[data-slug='"+category_ele+"']").parent().siblings().find('.header-ctgr').removeClass('active');
                $(".header-ctgr-sub").removeClass('active');

                //utk filternya
                filterKategori();
            });

            $(document).on('click','.sidebar_category_list_parent',function(e){
                category_ele = $(this).data('slug');
                $(this).addClass('active');

                //utk menu sidebar siblings
                $(this).parent().parent().siblings().find('.sidebar_category_list_parent').removeClass('active');
                $('.sidebar_category_list').removeClass('active');
                $(this).parent().parent().siblings().find('.parent-'+category_ele+'').removeClass('active');

                //utk arrow menu sidebar
                $(this).parent().find('.arrow-sidebar-products').attr('aria-expanded', true);
                $(this).parent().parent().find('#side_'+category_ele+'').addClass('show');

                //utk arrow menu sidebar siblings
                $(this).parent().parent().siblings().find('.arrow-sidebar-products').attr('aria-expanded', false);
                $(this).parent().parent().siblings().find('.multiple-menus').removeClass('show');

                //utk menu header
                $(".header-ctgr-sub[data-slug='"+category_ele+"']").addClass('active');
                $(".header-ctgr-sub[data-slug='"+category_ele+"']").parent().siblings().find('.header-ctgr-sub').removeClass('active');
                $(".header-ctgr").removeClass('active');

                //utk filternya
                filterKategori();
            });

            $(document).on('click','.sidebar_category_list_child',function(e){
                category_ele = $(this).parent().parent().parent().find('.sidebar_category_list_parent').data('slug');
                child_ele = $(this).data('child');
                $(this).addClass('active');

                //utk menu sidebar siblings
                $(this).parent().siblings().find('.sidebar_category_list_child').removeClass('active');
                $(this).parent().parent().parent().siblings().find('.sidebar_category_list_parent').removeClass('active');
                $(this).parent().parent().parent().siblings().find('.sidebar_category_list_child').removeClass('active');
                $(this).parent().parent().parent().siblings().find('.sidebar_category_list').removeClass('active');
                $(this).parent().parent().parent().find('.child-'+child_ele+'').addClass('active');

                //utk menu header
                $(".header-ctgr-sub[data-slug='"+category_ele+"']").addClass('active');
                $(".header-ctgr-sub[data-slug='"+category_ele+"']").parent().siblings().find('.header-ctgr-sub').removeClass('active');
                $(".header-ctgr").removeClass('active');

                //utk filternya
                filterKategori();
            });

            $(document).on('change','.tanpabawang',function(e){
                tanpabawang_ele = $('.tanpabawang:checked').val();
                filterKategori();
            });

            $(document).on('change','.sedangdiskon',function(e){
                sedangdiskon_ele = $('.sedangdiskon:checked').val();
                filterKategori();
            });

            $(document).on('change','.produkfav',function(e){
                produkfav_ele = $('.produkfav:checked').val();
                filterKategori();
            });

            $(document).on('click','.sortProduct',function(e){
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
            });

            function sort_product(e, type) {
                $(this).addClass('active');
                $('#sortproduct').addClass('active');
                sortby = type;
                filterKategori();
            };

            window.onpopstate = function(e){
                console.log(e);
                if(e.state){
                    $('#productContainer').empty();
                    $('#productContainer').append(e.state.html);
                    lazyLoad();
                } else {
                    window.location.reload();
                }
            };
            /********************************/
            /*End:/ Filter & Sort Product*/
            /********************************/
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

            $(document).on('click','.add-to-cart',function(e){
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




@extends('layouts.fe.fe')       -----> dari content, manggil template yang mau dipakai
@yield('content')               -----> dari template, mau manggil content yang dipakai (buat ngebaca section)
@include('layouts.fe.header')   -----> ngambil satu halaman full
@section('metadata')            -----> inisialisasi/init section
@push('stylesheets')            -----> inisialisasi assets (js & css)
@stack('scripts')               -----> manggil assets (js & css) di templatenya
