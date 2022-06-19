@extends('layouts.fe.fe')

@section('metadata')
    <title>Veganesia - Pesanan Saya</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/akun/pesanan/pesanan.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/fe/css/content/sidebar_akun.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendors/css/datepicker.css') }}">
@endpush

@section('content')
    <div class="akun-order">
        <!-- Content Profile -->
        <!-- ============================================================== -->
        <section class="sec-akun-order container">
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
                <div class="order-content">
                    <!-- Content -->
                    <!-- ============================================================== -->
                    <div class="top-menu-order">
                        <div class="menu-list-order">
                            <ul class="nav dv-scrbamn dv-scrbamn-rdr --scrlbrr" id="myTabOrder" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active tab-type" data-type="all" id="all-tab" data-toggle="tab" href="#all" role="tab" 
                                        aria-controls="all" aria-selected="true">
                                        semua (<span id="total_all" class="constantformatnumberCN" data-content="{{$total_all}}">{{$total_all}}</span>)
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link tab-type" data-type="waitingpay" id="waitingpay-tab" data-toggle="tab" href="#waitingpay" role="tab" 
                                        aria-controls="waitingpay" aria-selected="false">
                                        menunggu pembayaran (<span id="total_waiting" class="constantformatnumberCN" data-content="{{$total_waiting}}">{{$total_waiting}}</span>)
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link tab-type" data-type="newOrder" id="newOrder-tab" data-toggle="tab" href="#newOrder" role="tab" 
                                        aria-controls="newOrder" aria-selected="false">
                                        sudah dibayar (<span id="total_new_order" class="constantformatnumberCN" data-content="{{$total_new_order}}">{{$total_new_order}}</span>)
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link tab-type" data-type="processPay" id="processPay-tab" data-toggle="tab" href="#processPay" role="tab" 
                                        aria-controls="processPay" aria-selected="false">
                                        diproses (<span id="total_process" class="constantformatnumberCN" data-content="{{$total_process}}">{{$total_process}}</span>)
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link tab-type" data-type="sent" id="sent-tab" data-toggle="tab" href="#sent" role="tab" 
                                        aria-controls="sent" aria-selected="false">
                                        dikirim (<span id="total_sent" class="constantformatnumberCN" data-content="{{$total_sent}}">{{$total_sent}}</span>)
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link tab-type" data-type="done" id="done-tab" data-toggle="tab" href="#done" role="tab" 
                                        aria-controls="done" aria-selected="false">
                                        selesai (<span id="total_done" class="constantformatnumberCN" data-content="{{$total_done}}">{{$total_done}}</span>)
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link tab-type" data-type="cancel" id="cancel-tab" data-toggle="tab" href="#cancel" role="tab" 
                                        aria-controls="cancel" aria-selected="false">
                                        dibatalkan (<span id="total_cancel" class="constantformatnumberCN" data-content="{{$total_cancel}}">{{$total_cancel}}</span>)
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="menu-search-order">
                            <form class="form-vegan" autocomplete="off" id="formSearchOrder" action="" method="get">
                                <div class="input-group search-inputs">
                                    <input id="search_order" name="searchOrderPage" type="text" class="form-control --search" placeholder="Cari berdasarkan ID Pesanan atau Nama Produk dalam semua pesanan" aria-label="" aria-describedby="search" @if(isset(request()->searchOrderPage)) value="{{request()->searchOrderPage}}" @endif>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="searchOrder">
                                            <button class="search-icn" type="button"></button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="body-menu-order">
                        <div class="lists-order-vegan">
                            <div class="tab-content" id="myTabOrderContent">
                                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                    @include('public.akun.pesanan.search_all')
                                </div>
                                <div class="tab-pane fade" id="waitingpay" role="tabpanel" aria-labelledby="waitingpay-tab">
                                    @include('public.akun.pesanan.search_waiting_pay')
                                </div>
                                <div class="tab-pane fade" id="newOrder" role="tabpanel" aria-labelledby="newOrder-tab">
                                    @include('public.akun.pesanan.search_new_order')
                                </div>
                                <div class="tab-pane fade" id="processPay" role="tabpanel" aria-labelledby="processPay-tab">
                                    @include('public.akun.pesanan.search_proses')
                                </div>
                                <div class="tab-pane fade" id="sent" role="tabpanel" aria-labelledby="sent-tab">
                                    @include('public.akun.pesanan.search_kirim')
                                </div>
                                <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">
                                    @include('public.akun.pesanan.search_selesai')
                                </div>
                                <div class="tab-pane fade" id="cancel" role="tabpanel" aria-labelledby="cancel-tab">
                                    @include('public.akun.pesanan.search_cancel')
                                </div>
                            </div>
                        </div>

                        <!-- Start Modal Terima Barang -->
                        <div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
                            <div class="modal fade" id="terimabarangMain" tabindex="-1" role="dialog" aria-labelledby="terimabarangMainLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header pb-0" style="border: unset;">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body pt-0">
                                            <div class="cover-review" style="background-image: url('{{ asset('dist/fe/icons/beri_review.png') }}')"></div>
                                            <p class="clr-light-gry text-center" style="width: calc(100% - 50px); margin: 30px auto;">
                                                Terimakasih sudah berbelanja di Veganesia, yuk review produknya agar kamu bisa dapatkan tambahan <span style="color: #EE4D2D;">100 poin</span>
                                            </p>
                                            <div class="grid_layouts gr-btndjhsdjhsds">
                                                <button id="doneTransactionsMain" class="clr-light-gry btn-vegan text-capitalize f-Asap_medium --transparent-btn">
                                                    selesai
                                                </button>
                                                <button class="btn-vegan text-capitalize f-Asap_medium green-bg-btn" id="givereviewmain">
                                                    beri review
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End:/ Modal Terima Barang -->

                        <!-- Start Modal Beri Review -->
                        <div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
                            <div class="modal fade" id="givereviewproductsmain" tabindex="-1" role="dialog" aria-labelledby="givereviewproductsmainLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form id="reviewprodukformMain" action="" class="form-vegan" enctype="multipart/form-data">
                                            <div class="modal-header" id="headerheightreviewMain">
                                                <h5 class="modal-title text-capitalize text-left desc-main-text f-Asap_medium" id="rebuyLabelMain"></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <div class="mdl-give-review">
                                                    <div class="warning-orders --mdl-wrnngs">
                                                        <p class="mb-0">
                                                            Yuk ka ,tambahkan foto biar dapat point tambahan dari veganesia
                                                        </p>
                                                    </div>
                                                    <div class="menu-barang-review --scrlbrr" id="bodyheightreviewMain"></div>
                                                </div>
                                            </div>
                                            <div class="modal-footer" id="footerheightreviewMain">
                                                <button id="add-reviewprodukformMain" role="button" class="btn-vegan green-bg-btn text-capitalize" type="submit" style="width: 145px;" data-form="reviewprodukformMain">
                                                    kirim
                                                </button>
                                            </div>
                                        </form>     
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End:/ Modal Beri Review -->

                        <!-- Start Modal Review Berhasil Ditambahkan -->
                        <div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
                            <div class="modal fade" id="reviewSuccessMain" tabindex="-1" role="dialog" aria-labelledby="reviewSuccessMainLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="cover-review" style="background-image: url('{{ asset('dist/fe/icons/got_poin.png') }}'); background-size: cover;"></div>
                                            <p class="clr-light-gry text-center" style="width: calc(100% - 50px); margin: 10px auto 30px;">
                                                Terimakasih ya sudah memberikan review belanjaannya, Selamat kamu mendapatkan <span style="color: #EE4D2D;">100 poin</span>
                                            </p>
                                            <div class="mt-3 mb-3">
                                                <button class="btn-vegan text-capitalize f-Asap_medium green-bg-btn m-auto" style="width: 145px" id="doneAddReviewMain">
                                                    selesai
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End:/ Modal Review Berhasil Ditambahkan -->
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Content -->
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Content Profile -->
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            /********************************/
            /*Review Produk*/
            /********************************/
            $('.receivedProductMain').on('click',function (e) {
                e.preventDefault();
                $('#terimabarangMain').modal('show');
                var data_id = $(this).data('id');
                var data_code = $(this).data('code');
                $('#doneTransactionsMain').attr({
                    'data-code' : data_code,
                    'data-id' : data_id
                });
                $('#givereviewmain').attr({
                    'data-code' : data_code,
                    'data-id' : data_id
                });
            });

            $('#doneTransactionsMain').on('click',function (e) {
                e.preventDefault();
                var id_order = $(this).data('id');

                $.ajax({
                    url: "{{ route('akun_pesanan.done') }}",
                    method: 'POST',
                    dataType: "json",
                    data : {
                        _token: "{{ csrf_token() }}",
                        id: id_order
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#terimabarangMain').hide();
                            Swal.fire({
                                type: 'success',
                                title: 'Terima kasih telah setia berbelanja di Veganesia!',
                                text: 'Anda akan tetap dialihkan ke halaman detail pesanan anda.',
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
                        });
                    }
                })
            });

            $('#givereviewproductsmain').on('shown.bs.modal', function(e) {
                var mxHght = $(window).height();
                var headerheight = $('#headerheightreviewMain').height();
                var footerheight = $('#footerheightreviewMain').height();
                var bodyheightreview = headerheight + footerheight;
                var count_height_bodies = mxHght - (bodyheightreview + 230);
                $('#bodyheightreviewMain').css({
                    'overflow-x' : 'scroll',
                    'max-height' : count_height_bodies
                });
            });

            $('#givereviewmain').on('click',function (e) {
                e.preventDefault();
                $(this).closest('.modal').hide();
                var data_id = $(this).data('id');
                var data_code = $(this).data('code');
                $('#add-reviewprodukformMain').attr({
                    'data-id' : data_id,
                    'data-code' : data_code
                });

                $.ajax({
                    url: "{{ route('akun_pesanan.get_product') }}",
                    method: 'POST',
                    dataType: "json",
                    data: {
                        id_transaction: data_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        console.log(data);
                        var html  = '';
                        var response = data.product;
                        $('#rebuyLabelMain').text('beri review ('+data.total_product+')');
                        $.each(response, function(i,v){
                            html += '<input class="id_transaksi_review_main" type="hidden" id="id_transaksi_review_main" name="id_transaksi_review_main" value="'+v.transaction_id+'">'
                            html += '<div class="lists-barang-review --scrlbrr">'
                                html += '<div class="grid_layouts gr-product-lisstss">'
                                    html += '<div class="cover-prdcts" style="background-image:url('+v.media+')"></div>'
                                    html += '<div>'
                                        html += '<h6 class="f-Asap_medium mb-0">'+v.name+''
                                            html += '<input class="id_produk_review_main" type="hidden" id="id_produk_review_main" name="id_produk_review_main" value="'+v.id_product+'">'
                                        html += '</h6>'
                                    html += '</div>'
                                html += '</div>'

                                html += '<div class="input-gallery-products">'
                                    html += '<div>'
                                        html += '<input id="imagereviewsmain" class="input-imagereviewsmain" name="imagereviewsmain" type="file" multiple value="">'
                                    html += '</div>'
                                    html += '<div class="comment-sectionss">'
                                        html += '<div class="main-form-vg mb-0">'
                                            html += '<textarea class="ulasanproduk_main" value="" class="form-control" id="ulasanproduk_main" name="ulasanproduk_main" rows="3" placeholder="Berikan ulasanmu tentang produk ini"></textarea>'
                                        html += '</div>'
                                    html += '</div>'
                                html += '</div>'
                            html += '</div>';
                        });
                        $('#bodyheightreviewMain').html(html);
                        $('#givereviewproductsmain').modal('show');
                    }
                });
            });

            $(document).on('click','#add-reviewprodukformMain', function (e) {
                e.preventDefault();
                var commentmain = [];
                var productmain = [];
                var ordermain   = [];
                var imagereviews   = [];
                var data = new FormData();
                var data_id = $(this).data('id');
                var data_code = $(this).data('code');
                $('#doneAddReviewMain').attr({
                    'data-id' : data_id,
                    'data-code' : data_code
                });

                $(".ulasanproduk_main").each(function(index) {
                    commentmain[index] = $(this).val();
                });

                $(".id_produk_review_main").each(function(index) {
                    productmain[index] = $(this).val();
                });

                $(".id_transaksi_review_main").each(function(index) {
                    ordermain[index] = $(this).val();
                });

                $(".input-imagereviewsmain").each(function(index) {
                    var files = [];
                    files = $(this)[0].files;

                    $.each(files, function(key, v) {
                        data.append("imagereviews["+index+"][]", files[key]);
                    });
                });

                data.append("comment", commentmain);
                data.append("product", productmain);
                data.append("order", ordermain);

                $.ajaxSetup({
                    headers: { "X-CSRF-Token" : $("meta[name=csrf-token]").attr("content") }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{ route('akun_pesanan.review.save') }}",
                    data: data,
                    dataType: "json",
                    processData : false,
                    contentType : false,
                    beforeSend: function () {
                        Swal.fire({
                            title: "Mohon Menunggu",
                            text: "System sedang memproses permintaan Anda",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                        });
                    },
                    success: function (response) {
                        if(response.success == true){
                            Swal.close();
                            $('#add-reviewprodukformMain').closest(".modal").modal('hide');
                            $('#reviewSuccessMain').modal({
                                backdrop: 'static', 
                                keyboard: false
                            });
                        }
                        else{
                            Swal.fire({
                                title: "Maaf!",
                                text: "Mohon beri input penilaian anda pada masing-masing produk",
                                type: "error",
                                allowOutsideClick: false,
                            });
                        }
                    },
                    error: function (data) {
                        var res = data.responseJSON;
                        Swal.fire({
                            title: "Ups!",
                            text: "Mohon cek kembali inputan Anda",
                            type: "error",
                        });
                    }
                });
            });

            $('#doneAddReviewMain').on('click',function (e) {
                e.preventDefault();
                var id_order = $(this).data('id');

                $.ajax({
                    url: "{{ route('akun_pesanan.done') }}",
                    method: 'POST',
                    dataType: "json",
                    data : {
                        _token: "{{ csrf_token() }}",
                        id: id_order,
                        is_review: true,
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#reviewSuccessMain').modal('hide');
                            Swal.fire({
                                type: 'success',
                                title: 'Terima kasih telah setia berbelanja di Veganesia!',
                                text: 'Anda akan tetap dialihkan ke halaman detail pesanan anda.',
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
                        });
                    }
                })
            });
        });
    </script>
@endpush