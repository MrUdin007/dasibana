<?php
    use App\Models\Cart;
    use App\Models\Notifications;
 ?>

@if(!route('product') && !route('kontak_us'))
<div class="desktop-header">
    <div class="header-vegan fixed-top" id="hgt-header">
        <div class="top-header --lg-desk-view">
            <div class="main-top-mn-head">
                <div class="gr-tp-hd container">
                    <div class="l_tHeader">
                        <a href="#" data-toggle="modal" data-target="#downloadapp" data-backdrop="static" data-keyboard="false">
                            Download <span class="f-Asap_bold">Veganesia Mobile App</span>
                        </a>
                    </div>
                    <div class="r_tHeader">
                        <div>
                            <a href="{{ route('blog') }}">vegan news</a>
                        </div>
                        <div>
                            <a href="{{ route('promo') }}">promo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-header mob-top-header" id="hgt-headermob">
            <div class="middle-top-mn-head">
                <div class="midd-sec-hd" id="ct-headr">
                    <div class="gr-bt-hd container">
                        <div class="grid_layouts --header-gr gr-pt">
                            <div class="gr-a">
                                <div class="navbar-light">
                                    <button id="navbar-togglers" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarPln" aria-controls="navbarPln" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                </div>
                                <div class="sec-logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('dist/be/icons/veganesia.png') }}" alt="" class="logo-vegan" id="lg-z">
                                        <img src="{{ asset('dist/be/icons/logo-vegan.png') }}" alt="" class="logo-vegan-text" id="lg-txt">
                                    </a>
                                </div>
                            </div>
                            <div class="gr-b">
                                <form class="form-vegan" autocomplete="off" id="formGlobalSearch" action="{{ route('produk') }}" method="get">
                                    <div class="input-group search-inputs">
                                        <input id="globalSearch" name="search" type="text" class="form-control --search" placeholder="Mau cari apa kak?" aria-label="" aria-describedby="search" @if(isset(request()->search)) value="{{request()->search}}" @endif>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="search">
                                                <button class="search-icn" type="button"></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div id="globalSearchResult" class="--scrlbrr animate slideIn">
                                        <div class="grid_layouts box-search-public">
                                            <div class="ls-globalSearchResult global-search-produk" style="display: none;">
                                                <div class="top-global-search-list">
                                                    <h6 class="f-Asap_medium main-sub-text text-capitalize mb-1">
                                                        produk
                                                    </h6>
                                                </div>
                                                <div class="global-search-list"></div>
                                            </div>
                                            <div class="ls-globalSearchResult global-search-produk-sale" style="display: none;">
                                                <div class="top-global-search-list">
                                                    <h6 class="f-Asap_medium main-sub-text text-capitalize mb-1">
                                                        sale
                                                    </h6>
                                                </div>
                                                <div class="global-search-list"></div>
                                            </div>
                                            <div class="ls-globalSearchResult global-search-article" style="display: none;">
                                                <div class="top-global-search-list">
                                                    <h6 class="f-Asap_medium main-sub-text text-capitalize mb-1">
                                                        vegan news
                                                    </h6>
                                                </div>
                                                <div class="global-search-list"></div>
                                            </div>
                                            <div class="ls-globalSearchResult global-search-voucher" style="display: none;">
                                                <div class="top-global-search-list">
                                                    <h6 class="f-Asap_medium main-sub-text text-capitalize mb-1">
                                                        voucher
                                                    </h6>
                                                </div>
                                                <div class="global-search-list"></div>
                                            </div>
                                        </div>
                                        <!-- <div>
                                            <div class="ls-globalSearchResult global-search-suggest" style="display: none;">
                                                <div class="global-search-list"></div>
                                            </div>
                                        </div> -->
                                    </div>
                                </form>
                            </div>
                            <!-- start: Element check status login -->
                            <div class="notif-ouz grid_layouts @if(auth('fe')->check()) --notif-ouz-loggedin gr-c @else --notif-ouz @endif">
                            <!-- End:/ Element check status login -->
                                <div class="img-notf">
                                    <button id="cartBtn" class="img-lnk --carticn" style="background-image: url('{{ asset('dist/fe/icons/cart.png') }}')">
                                        @if(auth('fe')->check())
                                        @if(count(auth('fe')->user()->cart) > 0)
                                        <small class="text-badge f-Asap_reg constantformatnumberCN" data-content="{{ count(auth('fe')->user()->cart) }}">
                                            {{ count(auth('fe')->user()->cart) }}
                                        </small>
                                        @endif
                                        @endif
                                    </button>
                                </div>
                                @if(!auth('fe')->check())
                                    <div>
                                        <button class="btn-vegan txt-btn btn-lggg" data-toggle="modal" data-target="#login" data-backdrop="static" data-keyboard="false">
                                            <small>Masuk</small>
                                        </button>
                                    </div>
                                    <div>
                                        <a class="btn-vegan green-bg-btn btn-lggg" href="{{ url('register') }}">
                                            <small>Daftar</small>
                                        </a>
                                    </div>
                                @else
                                    <div class="img-notf">
                                        <button id="notifBtn" class="img-lnk --notificn" style="background-image: url('{{ asset('dist/fe/icons/notif.png') }}')">
                                            <?php
                                                if(auth('fe')->user() != null){
                                                    $notifications = Notifications::where('customer_id',auth('fe')->user()->id)->orderBy('created_at', 'desc')->get();
                                                    $notification_total = Notifications::where('customer_id',auth('fe')->user()->id)->where('read_at', null)->get();
                                                }else{
                                                    $notifications = [];
                                                }
                                            ?>
                                            @if(count($notifications) > 0 && count($notification_total) != 0)
                                            <small class="text-badge f-Asap_reg constantformatnumberCN" data-content="{{count($notification_total)}}">
                                                {{count($notification_total)}}
                                            </small>
                                            @endif
                                        </button>
                                    </div>
                                    <div class="bt-profil">
                                        <div class="dropdown">
                                            <a type="button" class="text-left main-sub-text clr-grey-txt header-acc-prf --lg-desk-view drpmnu-oz f-Asap_reg dropdown-toggle text-capitalize" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="pic-users rounded-circle images-slider img-lazy" data-src="@if(auth('fe')->user()->image != null) {{ asset(env('APP_DOWNLOAD').auth('fe')->user()->image) }} @else {{ asset(auth('fe')->user()->avatar) }} @endif"></span>
                                                <span class="truncate-texts text-left f-Asap_medium" id="setnamauser"></span>
                                            </a>
                                            <a type="button" class="--mob-profile drpmnu-oz f-Asap_reg dropdown-toggle text-capitalize main-sub-text" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <div class="pic-users rounded-circle images-slider img-lazy" data-src="@if(auth('fe')->user()->image != null) {{ asset(env('APP_DOWNLOAD').auth('fe')->user()->image) }} @else {{ asset(auth('fe')->user()->avatar) }} @endif"></div>
                                            </a>
                                            <div id="profilheadermenu" class="dropdown-menu profileDropdown lg-pt-prfl" aria-labelledby="profileDropdown">
                                                <div id="headProf" class="--scrlbrr sidebar-set-all siderbar-setouz sidebar-set-vegan-ac">
                                                    <div class="head-sdr">
                                                        <!-- start: Element jika data sudah lengkap -->
                                                        <div class="profile-sc">
                                                            <div class="">
                                                                <a href="{{ route('akun.profile') }}" class="text-capitalize --acc f-Asap_reg">
                                                                    <div class="rounded-circle images-slider img-lazy" data-src="@if(auth('fe')->user()->image != null) {{ asset(env('APP_DOWNLOAD').auth('fe')->user()->image) }} @else {{ asset(auth('fe')->user()->avatar) }} @endif"></div>
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a href="{{ route('akun.profile') }}" class="text-left text-capitalize main-sub-text --acc f-Asap_reg">
                                                                    <span id="namauser" data-nama="{{ auth('fe')->user()->name }}" class="text-left truncate-texts">
                                                                    @if(auth('fe')->user()->name)
                                                                    {{ auth('fe')->user()->name }}
                                                                    @else
                                                                    Akun Saya
                                                                    @endif
                                                                    </span>
                                                                </a>
                                                            </div>
                                                            @if(auth('fe')->user()->point > 0)
                                                            <div class="pil-stts">
                                                                <a href="{{ route('akun_point') }}" class="lnk-pnt text-capitalize">
                                                                    Point <span class="constantformatnumber" data-content="{{ auth('fe')->user()->point }}">{{ auth('fe')->user()->point }}</span>
                                                                </a>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <!-- end:/ Element jika data sudah lengkap -->
                                                    </div>
                                                    <div class="list-menu-sd">
                                                        <ul class="ls-sd-acc-lnk">
                                                            <li class="lst-mn-sd {{ (Route::is('akun.profile')) ? 'active' : '' }}">
                                                                <a class="lnk-mn text-capitalize sd-acc-lnk" href="{{ route('akun.profile') }}">
                                                                    akun saya
                                                                </a>
                                                            </li>
                                                            <li class="lst-mn-sd {{ (Route::is('akun_mykupon') || Route::is('akun_detail_mykupon')) ? 'active' : '' }}">
                                                                <a class="lnk-mn text-capitalize sd-acc-lnk" href="{{ route('akun_mykupon') }}">
                                                                    Kupon Saya @if(count(auth('fe')->user()->kupon) > 0) (<span class="constantformatnumber" data-content="{{count(auth('fe')->user()->kupon)}}">{{count(auth('fe')->user()->kupon)}}</span>) @endif
                                                                </a>
                                                            </li>
                                                            <li class="lst-mn-sd {{ (Route::is('akun_fav')) ? 'active' : '' }}">
                                                                <a class="lnk-mn text-capitalize ssd-acc-lnk" href="{{ route('akun_fav') }}">
                                                                    barang favorit
                                                                </a>
                                                            </li>
                                                            <li class="lst-mn-sd  {{ (Route::is('akun_pesanan') || Route::is('akun_pesanan.*') || Route::is('akun_pesanan_bayar.*')) ? 'active' : '' }}">
                                                                <a class="lnk-mn text-capitalize ssd-acc-lnk" href="{{ route('akun_pesanan') }}">
                                                                    pesanan saya
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="bttm-sdr">
                                                        <a href="javascript:void(0)" class="text-capitalize" onclick="$('#formLogout').submit();">
                                                            log out
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <nav class="navbar navbar-expand-md header container">
                <div class="collapse navbar-collapse --scrlbrr" id="navbarPln">
                    {{$app->make('main_header')}}
                </div>
            </nav>
        </div>
    </div>

    @if(!auth('fe')->check())
    <!-- Start Modal Login -->
    <div class="modal-vegan mdl-login" data-backdrop="static" data-keyboard="false">
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content mdl-login-head">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('layouts.fe.auth.login')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End:/ Modal Login -->
    @endif
</div>
@endif

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            /********************************/
            /*Change responsive for content vegan*/
            /********************************/
            var mxHghts = $(window).height();
            var hgtHeaders = $('#hgt-header').height();
            var hgtHeaderMob = $('#hgt-headermob').height();
            var height_footer = $('#footer-sec').height();
            var hg_headFoot = hgtHeaders+height_footer;
            var height_body_content_vegan = mxHghts - hg_headFoot;
            if (window.matchMedia('(max-width: 767px)').matches) {
                $('.body-content-vegan').css('margin-top', hgtHeaderMob);
                $('#profilheadermenu').css('margin-top', hgtHeaders+25);
            }
            else if (window.matchMedia('(min-width: 768px)').matches) {
                $('.body-content-vegan').css('margin-top', hgtHeaders);
                $('#profilheadermenu').css('margin-top', hgtHeaders-57);
            }
            if (window.matchMedia('(max-width: 452px)').matches) {
                $('#profilheadermenu').css('margin-top', hgtHeaders+12);
            }
            $('.body-content-vegan').css('min-height', height_body_content_vegan);

            /********************************/
            /*LOGIN*/
            /********************************/
            $('#formLogin').on('submit',function (event) {
                event.preventDefault();
                let formData = new FormData($('#formLogin')[0]);

                $.ajax({
                    url: "{{ route('login') }}",
                    method: 'POST',
                    dataType: "json",
                    data : formData,
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS
                    beforeSend: function () {
                        Swal.fire({
                            title: "Mohon Menunggu",
                            text: "Data Anda sedang diproses",
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                    },
                    success: function (response) {
                        console.log(response.success);
                        if (response.success) {
                            // window.location = '{{ route("home") }}';
                            window.location = window.location.href;
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Ups!',
                                text: 'Akun tidak ditemukan',
                            });
                        }
                    },
                    error : function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ups!',
                            text: 'Mohon cek kembali inputan Anda',
                        });
                    }
                })
            });

            /********************************/
            /*CART LIST*/
            /********************************/
            function hitungTotal() {
                var total = 0;
                var average = 0;
                $('.listsprice').each(function () {
                    var prices = $(this).val();
                    var qty = $(this).data('qty');
                    var counttotal = parseInt(prices*qty);
                    if (!isNaN(this.value) && this.value.length != 0) {
                        total += counttotal;
                    }
                });

                if (!isNaN(total) && total != 0) {
                    var txtboxes = $('.listsprice').length;
                    average = parseInt(total) / txtboxes;
                }

                var reverse = total.toString().split('').reverse().join(''),
                    ribuan  = reverse.match(/\d{1,3}/g);
                    ribuan  = ribuan.join('.').split('').reverse().join('');

                $('#totalCount').text('Rp '+ribuan+',00');
                $('#totalPrice').val(total);
            }
            hitungTotal();

            $('#checkoutCart').click(function(){
                var id_carts   = [];
                var id_products   = [];
                var id_variants   = [];
                var hasilchck = $('#totalPrice').val();
                $.each($('.listHarga'),function(index){
                    id_carts[index] = $(this).data('id');
                });
                $.each($('.listHarga'),function(index){
                    id_products[index] = $(this).data('product');
                });
                $.each($('.listHarga'),function(index){
                    id_variants[index] = $(this).data('idvarian');
                });
                $.ajax({
                    url: "{{ route('checkout') }}",
                    method: 'POST',
                    dataType: "json",
                    data: {
                        id_carts: id_carts,
                        prc: hasilchck,
                        id_products: id_products,
                        id_variants: id_variants,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if(response.no_stock == true){
                            Swal.fire({
                                type: 'error',
                                title: 'Error!',
                                text: 'Stock produk yang dipilih telah habis, mohon menghapus produk yang tidak tersedia',
                            });
                        }else if(response.add_qty){
                            Swal.fire({
                                type: 'error',
                                title: 'Error!',
                                text: 'Mohon masukkan jumlah produk!',
                            });
                        }else if(response.not_enough_stock){
                            Swal.fire({
                                type: 'error',
                                title: 'Maaf!',
                                text: 'Stok Produk Tidak Tersedia!',
                            }).then(function() {
                                if(response.product.is_variant == true){
                                    $('#not_enough_stock_'+response.cart.id+'').html('Maaf, jumlah stok yang tersisa adalah '+response.cart.stock+'')
                                }
                                else{
                                    $('#not_enough_stock_'+response.product.id+'').html('Maaf, jumlah stok yang tersisa adalah '+response.product.stock+'')
                                }
                            });
                        }else if(response.success == true){
                            console.log(response);
                            Swal.fire({
                                type: 'success',
                                title: 'Terimakasih',
                                text: 'Anda akan diarahkan ke halaman checkout',
                                allowOutsideClick: false
                            }).then(function() {
                                window.location = response.redirect;
                            });
                            // window.location = '{{ route("checkout.index") }}';
                        }
                        else{
                            Swal.fire({
                                type: 'error',
                                title: 'Error!',
                                text: 'Mohon cek kembali inputan Anda',
                                allowOutsideClick: false
                            });
                        }
                    },
                    error : function (xhr) {
                        Swal.fire({
                            title: "Ups!",
                            text: "Mohon cek kembali inputan Anda",
                            type: "error",
                            allowOutsideClick: false
                        });
                        // .then(function() {
                        //     window.location.reload();
                        // });
                    }
                });
            });

            $(".number-plus").bind('keyup mouseup change', function () {
                if($(this).hasClass('number-plus-main')){
                    var max = $(this).prev().data('max');
                    var qtys= +$(this).prev().val() + 1 > max ? max : +$(this).prev().val() + 1;
                    var products_id= $(this).prev().data('product');
                    var variant_id = $(this).prev().data('variant');
                    var cart_id = $(this).prev().data('id');

                    if($(this).prev().val() > max){
                        $(this).prev().val(max);
                    }
                    else{
                        $.ajax({
                            url: "{{ route('cart.update') }}",
                            method: 'POST',
                            dataType: "json",
                            data: {
                                product_id: products_id,
                                variants_id: variant_id,
                                qty: qtys,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                if(response.success ){
                                    console.log('berhasil nambah update');
                                    var harga = response.total_price_product;
                                    var reverse = harga.toString().split('').reverse().join(''),
                                        ribuan  = reverse.match(/\d{1,3}/g);
                                        ribuan  = ribuan.join('.').split('').reverse().join('')

                                    $('#price_'+response.product.id+'').val(harga);

                                    var price = parseInt($('#totalPrice').val()) + (response.total_price_product - response.total_price_product_lama);
                                    var harga_total = price;
                                    var reverse_total = harga_total.toString().split('').reverse().join(''),
                                        ribuan_total  = reverse_total.match(/\d{1,3}/g);
                                        ribuan_total  = ribuan_total.join('.').split('').reverse().join('');

                                    $('#totalPrice').val(price);
                                    $('#totalCount').html('Rp '+ribuan_total+',00');
                                }
                            },
                            error : function (xhr) {
                                Swal.fire({
                                    title: "Ups!",
                                    text: "Mohon Maaf, gagal mengganti",
                                    type: "error",
                                    allowOutsideClick: false
                                });
                            }
                        })
                    }
                }
            });

            $(".number-minus").bind('keyup mouseup change', function () {
                if($(this).hasClass('number-minus-main')){
                    var min = $(this).next().data('min');
                    var cart_id = $(this).next().data('id')
                    var qtys = +$(this).next().val() - 1 < min ? min : +$(this).next().val() - 1;
                    var products_id = $(this).next().data('product');
                    var variant_id = $(this).next().data('variant');

                    if($(this).next().val() < min){
                        $(this).next().val(min);
                    }
                    else{
                        $.ajax({
                            url: "{{ route('cart.update') }}",
                            method: 'POST',
                            dataType: "json",
                            data: {
                                product_id: products_id,
                                variants_id: variant_id,
                                qty: qtys,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                if(response.success ){
                                    var harga = response.total_price_product;
                                    var reverse = harga.toString().split('').reverse().join(''),
                                        ribuan  = reverse.match(/\d{1,3}/g);
                                        ribuan  = ribuan.join('.').split('').reverse().join('')

                                    $('#price_'+response.product.id+'').val(harga);

                                    var price = parseInt($('#totalPrice').val()) + (response.total_price_product - response.total_price_product_lama);
                                    var harga_total = price;
                                    var reverse_total = harga_total.toString().split('').reverse().join(''),
                                        ribuan_total  = reverse_total.match(/\d{1,3}/g);
                                        ribuan_total  = ribuan_total.join('.').split('').reverse().join('');

                                    $('#totalPrice').val(price);
                                    $('#totalCount').html('Rp '+ribuan_total+',00');
                                }
                            },
                            error : function (xhr) {
                                Swal.fire({
                                    title: "Ups!",
                                    text: "Mohon Maaf, gagal mengganti",
                                    type: "error",
                                    allowOutsideClick: false
                                });
                            }
                        })
                    }
                }
            });

            $(".qty_input").on('keyup change',function(){
                var qtys = $(this).val();
                var products_id = $(this).data('product');
                var max = $(this).data('max');
                var min = $(this).data('min');
                var cart_id = $(this).data('id');
                var variant_id = $(this).data('variant');

                if($(this).val() > max){
                    $(this).val(max);
                }
                else if($(this).val() < min){
                    $(this).val(min);
                }
                else{
                    $.ajax({
                        url: "{{ route('cart.update') }}",
                        method: 'POST',
                        dataType: "json",
                        data: {
                            product_id: products_id,
                            variants_id: variant_id,
                            qty: qtys,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            if(response.success ){
                                console.log('berhasil ganti update');
                            }
                        },
                        error : function (xhr) {
                            Swal.fire({
                                title: "Ups!",
                                text: "Mohon Maaf, gagal mengganti",
                                type: "error",
                                allowOutsideClick: false
                            });
                        }
                    })
                }
            });
        });
    </script>
@endpush
