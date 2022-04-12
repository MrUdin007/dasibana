<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- ****** faviconit.com favicons ****** -->
        <link rel="apple-touch-icon" sizes="57x57" href="{{asset('favicon/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{asset('favicon/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{asset('favicon/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{asset('favicon/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{asset('favicon/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{asset('favicon/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{asset('favicon/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{asset('favicon/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('favicon/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">
        <link rel="manifest" href="{{asset('favicon/manifest.json')}}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{asset('favicon/ms-icon-144x144.png')}}">
        <meta name="theme-color" content="#ffffff">
        <!-- ****** faviconit.com favicons ****** -->

        <!-- Start: custom metadata -->
        @yield('metadata')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Start: custom metadata -->

        <!-- Start: custom stylesheets -->
        <link rel="stylesheet" type="text/css" href="{{ asset('dist/vendors/css/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/main.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('dist/vendors/css/select2.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/content/number.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/content/floating_input.css') }}">
        @stack('stylesheets')
        <!-- Start: custom stylesheets -->

        <!-- Start of midtrans script -->
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-iG7875hEQ2PfEE1T"></script>
        <!-- End of midtrans script -->
        @stack('topscripts')
    </head>
    <body>
        <div class="backdrop-blur-vegan" style="display: none"></div>
        <!-- Menu header -->
        <!-- ============================================================== -->
        <header class="header-vegan">
            @include('layouts.fe.header')
        </header>
        <!-- ============================================================== -->
        <!-- End menu header -->

        <!-- Menu content -->
        <!-- ============================================================== -->
        <div class="body-content-vegan">
            @yield('content')
        </div>
        <!-- ============================================================== -->
        <!-- End menu content -->

        <!-- Show Hide Cart Content -->
        <!-- ============================================================== -->
        {{$app->make('cart')}}
        <!-- ============================================================== -->
        <!-- End Show Hide Cart Content -->

        <!-- Show Hide Notification Content -->
        <!-- ============================================================== -->
        @include('layouts.fe.notif')
        <!-- ============================================================== -->
        <!-- End Show Hide Notification Content -->

        <!-- Sidebar Produk Mobile -->
        <!-- ============================================================== -->
        <div class="collapse showsidebar" id="showSidebarProduk" style="display: none"></div>
        <!-- ============================================================== -->
        <!-- End Sidebar Produk Mobile -->

        <!-- Sidebar Akun Mobile -->
        <!-- ============================================================== -->
        <div class="collapse showsidebar" id="showSidebarAkun" style="display: none"></div>
        <!-- ============================================================== -->
        <!-- End Sidebar Akun Mobile -->

        <!-- Sidebar Artikel Mobile -->
        <!-- ============================================================== -->
        <div class="collapse showsidebar" id="showSidebarArtikel" style="display: none"></div>
        <!-- ============================================================== -->
        <!-- End Sidebar Artikel Mobile -->

        <!-- Modal Empty Stock -->
        <!-- ============================================================== -->
        <div class="stock-empty-product">
            <div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
                <div class="modal fade" id="emptyStock" tabindex="-1" role="dialog" aria-labelledby="emptyStockLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header pb-0" style="border: unset;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body pt-0">
                                <div class="cover-empty-stock" style="background-image: url('{{ asset('dist/fe/icons/no-stock.png') }}')"></div>
                                <div class="msgsfs">
                                    <h6 class="desc-main-text f-Asap_medium text-center">Maaf, stok habis</h6>
                                    <p class="clr-light-gry text-center">
                                        Produk ini sedang tidak tersedia, Apakah anda inggin di beritahu apabila barang sudah tersedia ?
                                    </p>
                                </div>
                                <div class="grid_layouts gr-btndjhsdjhsds jsakhds">
                                    <button class="clr-light-gry btn-vegan text-capitalize f-Asap_medium --transparent-btn" data-dismiss="modal">
                                        abaikan
                                    </button>
                                    <button class="btn-vegan text-capitalize f-Asap_medium green-bg-btn sendmenotif" id="sendmenotif">
                                        beritahu saya
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Modal Empty Stock -->

        <!-- Start Modal Add To Cart -->
        @include('layouts.fe.add_to_cart')
        <!-- End:/ Modal Add To Cart -->

        <!-- Seo Content -->
        <!-- ============================================================== -->
        <div class="seo-content-vegan">
            @yield('seoContent')
        </div>
        <!-- ============================================================== -->
        <!-- End Seo Content -->

        <!-- Menu footer -->
        <!-- ============================================================== -->
        <footer class="footer-ouz position-relative" id="footer-sec">
            @include('layouts.fe.footer')
        </footer>
        <!-- ============================================================== -->
        <!-- End menu footer -->

        <!-- Form Logout -->
        <!-- ============================================================== -->
        <form id="formLogout" action="{{ route('logout') }}" method="post">
            @csrf
        </form>
        <!-- ============================================================== -->
        <!-- End Form Logout -->

        <div id="globalMask" style="display: none;"></div>
        <div id="cartMask" style="display: none;"></div>

        <script type="text/javascript">
            var cust_id = 0;
            <?php if(auth('fe')->check()):?>
                <?php 
                    $cust_id = auth('fe')->user()->id;
                ?>
                cust_id = <?php echo $cust_id ?>;
            <?php endif ?>
        </script>

        <script type="text/javascript" src="{{ asset('dist/vendors/js/bootstrap.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/fe/js/main.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/vendors/js/hide_input.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/vendors/clipboard.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/vendors/js/select2.js')}}"></script>
        <script type="text/javascript" src="{{ asset('dist/vendors/js/number.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                /********************************/
                /*Responsive Menu Burger Header*/
                /********************************/
                if (window.matchMedia('(max-width: 767px)').matches) {
                    var mxHght = $(window).height();
                    var hgtHeaderMob = $('#hgt-headermob').height();
                    var submxHght = $('#mxHght').height();
                    var totalHeight = mxHght-(hgtHeaderMob+submxHght+10);
                    console.log(totalHeight);
                    $('#mxHght').css({
                        'max-height': totalHeight,
                        'overflow-y': 'auto'
                    });
                }

                /********************************/
                /*Clone Sidebar Produk For Mobile View*/
                /********************************/
                if (window.matchMedia('(max-width: 991px)').matches) {
                    $(".sidebar-prdct-vegan").prependTo("#showSidebarProduk").html();
                    
                    var filterProduk = $('#filter-produk');
                    var closeProduk = $('#cls-produk');
                    $(filterProduk).click(function() {
                        $('.backdrop-blur-vegan').show();
                        $('#showSidebarProduk').toggle("slide");
                        $('body').css('overflow-y', 'hidden');
                    });
                    $(closeProduk).click(function() {
                        $('.backdrop-blur-vegan').hide();
                        $('#showSidebarProduk').toggle("hide");
                        $('body').css('overflow-y', 'auto');
                    });
                }

                $(document).ready(function() {
                    $(".form-vegan").validate();
                });

                var timer_global_search;
                var q_global_search   = "{{ request()->search }}";
                var q_suggest_search   = "{{ request()->suggestsearch }}";
                var global_search_ele = $('#globalSearch');
                var global_search_suggest_ele = $('#globalSearchResult .global-search-suggest');
                var global_search_article_ele = $('#globalSearchResult .global-search-article');
                var global_search_produk_ele = $('#globalSearchResult .global-search-produk');
                var global_search_produk_sale_ele = $('#globalSearchResult .global-search-produk-sale');
                var global_search_voucher_ele = $('#globalSearchResult .global-search-voucher');

                var timer_header_brand_search;
                // var header_brands = $('.header-brand-list');
                var url_string     = window.location.href;
                var url            = new URL(url_string);
                // var rate_param     = url.searchParams.get("rate");
                // var brand_param    = url.searchParams.getAll("brand[]");
                // var kategori_param = url.searchParams.get("kategori");

                function focusglobalSearch() {
                    clearTimeout(timer_global_search);
                    timer_global_search = setTimeout(function(){
                        if (q_suggest_search) {
                            $('#globalSearchResult').show();
                            $.ajax({
                                url: "{{ route('global.suggestsearch') }}",
                                method: 'POST',
                                dataType: "json",
                                data: {
                                    _token : "{{ csrf_token() }}",
                                    q : q_suggest_search
                                },
                                success: function (response) {
                                    if (response.suggest) {
                                        console.log('tes search suggest');
                                        global_search_suggest_ele.find('.global-search-list').empty();
                                        global_search_suggest_ele.show();
                                        global_search_suggest_ele.addClass('active-search');
                                        global_search_suggest_ele.find('.global-search-list').append(response.suggest);
                                    }
                                }
                            });
                        } else {
                            $('#globalSearchResult').hide();
                        }
                    },200);
                }

                function globalSearch() {
                    q_global_search = global_search_ele.val().toLowerCase();
                    clearTimeout(timer_global_search);
                    timer_global_search = setTimeout(function(){
                        if (q_global_search) {
                            $('#globalSearchResult').show();
                            $.ajax({
                                url: "{{ route('global.search') }}",
                                method: 'POST',
                                dataType: "json",
                                data: {
                                    _token : "{{ csrf_token() }}",
                                    q : q_global_search
                                },
                                success: function (response) {
                                    if (response.products) {
                                        console.log('search products');
                                        global_search_produk_ele.find('.global-search-list').empty();
                                        global_search_produk_ele.show();
                                        global_search_produk_ele.addClass('active-search');
                                        global_search_produk_ele.find('.global-search-list').append(response.products);
                                    } else {
                                        global_search_produk_ele.hide();
                                    }

                                    if (response.productSale) {
                                        console.log('search productSale');
                                        global_search_produk_sale_ele.find('.global-search-list').empty();
                                        global_search_produk_sale_ele.show();
                                        global_search_produk_sale_ele.addClass('active-search');
                                        global_search_produk_sale_ele.find('.global-search-list').append(response.productSale);
                                    } else {
                                        global_search_produk_sale_ele.hide();
                                    }

                                    if (response.news) {
                                        console.log('search news');
                                        global_search_article_ele.find('.global-search-list').empty();
                                        global_search_article_ele.show();
                                        global_search_article_ele.addClass('active-search');
                                        global_search_article_ele.find('.global-search-list').append(response.news);
                                    } else {
                                        global_search_article_ele.hide();
                                    }

                                    if (response.promo) {
                                        console.log('search promo');
                                        global_search_voucher_ele.find('.global-search-list').empty();
                                        global_search_voucher_ele.show();
                                        global_search_voucher_ele.addClass('active-search');
                                        global_search_voucher_ele.find('.global-search-list').append(response.promo);
                                    } else {
                                        global_search_voucher_ele.hide();
                                    }
                                },
                                error : function (response) {
                                    console.log('gagal search');
                                }
                            });
                        } else {
                            $('#globalSearchResult').hide();
                        }
                    },500);
                }

                $(document)
                    .on('focus','#globalSearch',function(){
                        $('#globalMask').show();
                        focusglobalSearch();
                    })
                    .on('click','#globalSearch',function(){
                        $('#globalMask').show();
                        if (q_global_search) {
                            $('#globalSearchResult').show();
                        }
                    })
                    .on('submit','#formGlobalSearch',function(e){
                        // e.preventDefault();
                        globalSearch();
                    })
                    .on('keyup','#globalSearch',function(){
                        globalSearch();
                    })
                    .on('click','#globalMask',function(){
                        $('#globalMask').hide();
                        $('#globalSearchResult').hide();
                    });

                // setting search input select2
                // $(".select2").select2({
                //     minimumResultsForSearch: Infinity
                // });
                
                // input number field section
                $('.input-number').each(function () {
                    $(this).number();
                });

                //like product floating
                $(document).on('click','.product_like_checkbox',function(e){
                    e.preventDefault();
                    var id = $(this).data('id');
                    var val = $('#likes_'+id+'').prop("checked");
                    if(!$('#likes_'+id+'').is(':checked')){
                        $('#likes_'+id+'').prop("checked", true);
                    }
                    else{
                        $('#likes_'+id+'').prop("checked", false);
                    }
                    $.ajax({
                        url: "{{ route('product.like') }}",
                        method: 'POST',
                        dataType: "json",
                        data: {
                            id: id,
                            val: val,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            if(response.success == 'login'){
                                $('#login').modal();
                            }else if(response.love == 'unchecked'){
                                $('#likes_'+id+'').prop('checked',false);
                            }else if(response.love == 'checked'){
                                $('#likes_'+id+'').prop('checked',true);
                            }
                        },
                        error : function (xhr) {
                        }
                    })
                });
                
                // LAZY LOAD JANGAN DIHAPUS ATAU DIPINDAHKAN
                !function(window){
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
                            rect.top      >= 0
                            && rect.left  >= 0
                            && rect.top   <= (window.innerHeight || document.documentElement.clientHeight)
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
                }(this);
            });
        </script>
        <script type="text/javascript" src="{{ asset('dist/vendors/jquery.validate.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                function postWithAjax(form_id,redirect = null) {
                    // Post With AJAX
                    $('#'+form_id).on('submit',function (event) {
                        event.preventDefault();
                        let form = $(this);
                        let url  = form.attr('action');
                        let formData = new FormData(form[0]);
                        // Remove
                        form.find('.invalid-feedback').remove();
                        form.find('.form-control').removeClass('is-invalid');

                        $.ajax({
                            url : url,
                            method: 'POST',
                            dataType: "json",
                            data : formData,
                            contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                            processData: false, // NEEDED, DON'T OMIT THIS
                            beforeSend: function () {
                                Swal.fire({
                                    title: "Mohon Menunggu",
                                    text: "System sedang memproses permintaan Anda",
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                });
                            },
                            success: function (response) {
                                console.log('ya berhasil');
                                form.data('submitted', false);
                                if(response.midtrans){
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
                                                {{--window.location = '{{ route("akun_pesanan") }}';--}}
                                            },
                                            onPending: function(result){
                                                console.log('pending');
                                                console.log(result);
                                                Swal.close();
                                                {{--window.location = '{{ route("akun_pesanan") }}';--}}
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
                                else{
                                    Swal.fire({
                                        title: response.msg_title,
                                        text: response.msg_desc,
                                        type: response.msg_type,
                                        allowOutsideClick: false
                                    }).then(function() {
                                    // }).then((result) => {
                                        // window.location.reload(true);
                                        // if(result.value === true && response.msg_type != 'error' && redirect) {
                                        if(response.msg_type != 'error' && redirect) {
                                            if(response.redirect){
                                                window.location = response.redirect;
                                            }else if(response.login){
                                                $('#login').modal();
                                            }
                                            else {
                                                window.location = redirect;
                                            }
                                        }
                                        else if(response.variant_kosong == true){
                                            $('#productkosong_'+response.product_variant.id+'').html('Maaf, jumlah stok yang tersisa adalah '+response.product_variant.stock+'')
                                        }
                                        else if(response.stok_kosong == true){
                                            $('#productkosong_'+response.product_kosong.id+'').html('Maaf, jumlah stok yang tersisa adalah '+response.product_kosong.stock+'')
                                        }
                                        else{
                                            $('#'+form_id).valid();
                                        }
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
                                    title: "Ups!",
                                    text: "Mohon cek kembali inputan Anda",
                                    type: "error",
                                    allowOutsideClick: false
                                });
                                // .then(function() {
                                //     window.location.reload()
                                // });
                            }
                        })
                    });
                }
                @yield('postWithAjax')
            });
        </script>
        @stack('scripts')
    </body>
</html>