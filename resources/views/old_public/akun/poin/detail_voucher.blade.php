@extends('layouts.fe.fe')

@section('metadata')
    <title>Veganesia - Voucher {{$vouchers->kode}}</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/akun/poin/detail_voucher.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/fe/css/content/sidebar_akun.css') }}">
@endpush

@section('content')
    <div class="detailvoucher">
        <!-- Content Profile -->
        <!-- ============================================================== -->
        <section class="sec-detailvoucher container">
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
                    <div class="box-detailvoucher">
                        <div class="border-bottom-large menu-poin">
                            <a href="{{route('akun_point')}}" class="ksjak main-sub-text f-Asap_medium text-capitalize mb-0 clr-lght-gsh">
                                <span class="arrow-icns"></span>
                                detail voucher
                            </a>
                        </div>
                        
                        <!-- Start Body Voucher Detail -->
                        <div class="menu-poin">
                            <div class="grid_layouts gr-detailvchs">
                                <div class="detail-mns">
                                    <div class="img-crd-point img-lazy big-lazy" data-src="{{ asset($cover) }}"></div>
                                    <h5 class="mb-0 clr-grey-txt desc-main-text f-Asap_medium">{{$vouchers->title}}</h5>
                                    <div class="tabmenu-detail-voucher navs-vegan">
                                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active text-uppercase" id="deskripsi-tab" data-toggle="tab" href="#deskripsi" role="tab" aria-controls="deskripsi" aria-selected="true">
                                                    deskripsi
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-uppercase" id="sandk-tab" data-toggle="tab" href="#sandk" role="tab" aria-controls="sandk" aria-selected="false">
                                                    syarat dan ketentuan
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="deskripsi" role="tabpanel" aria-labelledby="deskripsi-tab">
                                                <article>
                                                    <p class="mb-0">
                                                        @if(isset($vouchers->keterangan))
                                                        {!! strip_tags($vouchers->keterangan) !!}
                                                        @else
                                                        -
                                                        @endif
                                                    </p>
                                                </article>
                                            </div>
                                            <div class="tab-pane fade" id="sandk" role="tabpanel" aria-labelledby="sandk-tab">
                                                <article>
                                                    <p class="mb-0">
                                                        @if(isset($vouchers->ketentuan))
                                                        {!! strip_tags($vouchers->ketentuan) !!}
                                                        @else
                                                        -
                                                        @endif
                                                    </p>
                                                </article>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-promo-info">
                                    <div class="ls-detail-promo-info">
                                        <h6 class="mb-0 text-uppercase desc-main-text text-center" style="color: #333333;">info promo</h6>
                                    </div>
                                    <div class="ls-detail-promo-info grid_layouts text-center">
                                        <div>
                                            <h6 class="text-capitalize f-Asap_medium">
                                                masa berlaku
                                            </h6>
                                            <small style="color: rgba(51, 51, 51, 0.6);">
                                                {{ Carbon\Carbon::parse($vouchers->end_date)->format('d F Y') }}
                                            </small>
                                        </div>
                                        <div class="rightkshaha">
                                            <h6 class="text-capitalize f-Asap_medium">
                                                minimal transaksi
                                            </h6>
                                            <small class="text-capitalize" style="color: rgba(51, 51, 51, 0.6);">
                                                @if($vouchers->min_pembelanjaan > 0)
                                                {{ $vouchers->min_pembelanjaan }}
                                                @else
                                                tanpa minimal transaksi
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                    <div class="ls-detail-promo-info grid_layouts">
                                        <div>
                                            <h5 class="mb-0 text-capitalize f-Asap_medium main-sub-text">
                                                jumlah poin : <span style="color: #1FBC9D;">{{ $vouchers->poin_required }} Poin</span>
                                            </h5>
                                        </div>
                                        <div>
                                            @if(auth('fe')->check()) 
                                                @if($vouchers->poin_required != 0)
                                                @if( auth('fe')->user()->point > $vouchers->poin_required)
                                                <button class="btnMdlhasenoughpoint btn-vegan green-bg-btn text-capitalize f-Asap_medium" data-idvoucher="{{$vouchers->id}}">
                                                @else
                                                <button class="btn-vegan green-bg-btn text-capitalize f-Asap_medium" data-target="#notenoughpoint" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                                @endif
                                                    tukar poin
                                                </button>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ls-detail-promo-info grid_layouts">
                                        <div>
                                            <h6 class="mb-0 text-capitalize" style="color: rgba(51, 51, 51, 0.6);">bagikan</h6>
                                        </div>
                                        <div class="dsdhs">
                                            <div class="position-relative shares-smd share-btn" id="share-oz01" data-url="{{ route('akun_detail_voucher', $vouchers->kode) }}" data-title="{{ $vouchers->title }}" data-desc="{{ $vouchers->title }}">
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
                                                    <a id="copyclp101" class="copyclp position-relative" data-clipboard-text="{{ route('akun_detail_voucher', $vouchers->kode) }}" type="button">
                                                        <i class="fas fa-link"></i>
                                                    </a>
                                                </div>
                                                <div class="ct-tggle ct-tggle1" id="ct-tggle101" style="display: none">
                                                    <div class="position-relative">
                                                        <small class="small-fnt">Copied</small>
                                                        <div class="mn-arrw"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Body Voucher Detail -->
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Content -->
                </div>

                <!-- Start Modal Switch Poin If Has Enough Point -->
                <div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
                    <div class="modal fade modalpoints" id="hasenoughpoint" tabindex="-1" role="dialog" aria-labelledby="hasenoughpointLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="cover-point-mdl img-lazy small-lazy" data-src="{{ asset('dist/fe/icons/got_poin.png') }}"></div>
                                    <article>
                                        <p class="mb-0 clr-light-gry text-center m-auto d-block" style="width: calc(100% - 40px);">
                                            Selamat anda berhasil menukarkan point, segera gunakan kupon anda sebelum habis masa tenggang
                                        </p>
                                    </article>
                                    <a href="{{ route('akun_mykupon') }}" style="width: 100px; margin: auto;" class="mt-4 f-Asap_medium text-uppercase btn-vegan green-bg-btn">
                                        ok
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:/ Modal Switch Poin If Has Enough Point -->

                <!-- Start Modal If Has Not Enough Point -->
                <div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
                    <div class="modal fade modalpoints" id="notenoughpoint" tabindex="-1" role="dialog" aria-labelledby="notenoughpointLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header pb-0" style="border: unset">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="cover-point-mdl img-lazy small-lazy" data-src="{{ asset('dist/fe/icons/got_poin.png') }}"></div>
                                    <article>
                                        <p class="mb-0 clr-light-gry text-center m-auto d-block" style="width: calc(100% - 40px);">
                                            Maaf Jumlah Point anda belum mencukupi untuk menukarkan dengan kupon ini 
                                        </p>
                                    </article>
                                    <button style="width: 100px; margin: auto;" data-dismiss="modal" class="mt-4 f-Asap_medium text-uppercase btn-vegan green-bg-btn">ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:/ Modal If Has Not Enough Point -->
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Content Profile -->
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            // POIN-REVIEW-REWARD (Tiap produk yg direview)
            // (bisa tukar poin selama masih memiliki poin yang cukup utk ditukar, setelahnya baru bisa dipakai vouchernya dipakai d laman checkout --> berlaku utk yg ada poin required nya)
            // (tidak perlu tukar poin dan tetap bisa dipakai voucher di laman checkout --> berlaku utk yg poinnya 0 atau tanpa batasan)
            // setelah tukar poin pada voucher yang dipilih, maka user sudah bisa pakai voucher tersebut
            $('.btnMdlhasenoughpoint').on('click',function(e){
                e.preventDefault();
                var id_voucher = $(this).data('idvoucher');

                $.ajax({
                    url: "{{ route('voucher.tukarpoin') }}",
                    method: 'POST',
                    dataType: "json",
                    data: {
                        id_voucher: id_voucher,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        console.log(data);
                        if(data.success == true){
                            $('#hasenoughpoint').modal({
                                backdrop: 'static', 
                                keyboard: false
                            });
                        }
                        else{
                            Swal.fire({
                                type: 'error',
                                title: 'Maaf!',
                                text: 'Voucher sudah tidak berlaku',
                                allowOutsideClick: false
                            }).then(function() {
                                window.location.reload(true);
                            });
                        }
                    },
                    error : function (data) {
                        Swal.fire({
                            title: "Ups!",
                            text: "Mohon cek kembali inputan Anda",
                            type: "error",
                            allowOutsideClick: false
                        });
                    }
                });
            });
            
            /*Start: Global Clipboard Copy*/
            function setToggle1(message) {
                $("#ct-tggle101").slideDown();
            }

            function hideToggle1() {
                setTimeout(function() {
                    $('#ct-tggle101').slideUp();
                }, 1200);
            }

            var clp1 = new ClipboardJS('#copyclp101');
            clp1.on('success', function(e) {
                setToggle1();
                hideToggle1();
            });
            /*End:/ Global Clipboard Copy*/
        });
    </script>
@endpush