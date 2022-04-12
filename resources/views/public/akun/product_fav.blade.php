@extends('layouts.fe.fe')

@section('metadata')
    <title>Veganesia - Produk Favorit</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('dist/fe/css/content/sidebar_akun.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/fe/css/pages/akun/product_fav.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/content/card_product.css') }}">
@endpush

@section('content')
    <div class="akun-productFav">
        <!-- Content Product Favorit -->
        <!-- ============================================================== -->
        <section class="akun-productFav-sec container">
            <!-- Sidebar Akun Mobile -->
            <!-- ============================================================== -->
            <div class="mob-sdbr-acc mobl-sdbr-acc">
                <button id="filter-akun" class="btn-vegan green-bg-btn text-capitalize" type="button">
                    <span><i class="fas fa-sliders-h"></i></span> 
                    &nbsp;filter
                </button>
            </div>
            <!-- ============================================================== -->
            <!-- End Sidebar Akun Mobile -->

            <div class="grid_layouts gr-akun">
                <div>
                    <!-- Sidebar Akun Desktop -->
                    <!-- ============================================================== -->
                    <div id="desk-sdbr">
                        @include('layouts.fe.sidebar.sidebar-akun')
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Sidebar Akun Desktop -->
                </div>
                <div class="productFav-content">
                    <!-- Content -->
                    <!-- ============================================================== -->
                    <div class="head-card">
                        <h6 class="title-head-card f-Asap_medium text-capitalize main-sub-text mb-0">barang favorit</h6>
                    </div>
                    <div class="content-card">
                        @if(count($products) > 0)
                        <!-- Start Content Fav Product -->
                        <div class="sbcrd-ls-ct-akun">
                            <div class="grid_layouts prdct-gr">
                                @foreach($products as $product)
                                    @include('public.produk.card_product', ['produk'=>$product,'not_slide'=>true])
                                @endforeach
                            </div>
                        </div>
                        <!-- End Content Fav Product -->
                        <!-- Pagination -->
                        <!-- ============================================================== -->
                        {{ $products->links('layouts.fe.pagination') }}
                        <!-- ============================================================== -->
                        <!-- End Pagination -->
                        @else
                        <!-- Start: If there is no post -->
                        <div class="no-post-list">
                            <div>
                                <img src="{{ asset('dist/fe/icons/no-post.png') }}" alt="no post">
                            </div>
                            <div>
                                <p class="text-center f-Asap_medium">
                                    Tidak ada postingan
                                </p>
                            </div>
                        </div>
                        <!-- End:/ If there is no post -->
                        @endif
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Content -->
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Content Product Favorit -->
    </div>
@endsection

@push('scripts')
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