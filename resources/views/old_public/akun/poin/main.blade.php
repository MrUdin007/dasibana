@extends('layouts.fe.fe')

@section('metadata')
    <title>Veganesia - Poin Saya</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/akun/poin/main.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/fe/css/content/sidebar_akun.css') }}">
@endpush

@section('content')
    <div class="akun-poin">
        <!-- Content Profile -->
        <!-- ============================================================== -->
        <section class="sec-akun-poin container">
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
                    <div class="box-akun-poin">
                        <div class="border-bottom-large menu-poin">
                            <div class="grid_layouts gr-topmnhds">
                                <div>
                                    <h6 style="color: #1FBC9D;" class="ksjak main-sub-text f-Asap_medium text-capitalize mb-0 clr-lght-gsh">
                                        veganesia poin
                                    </h6>
                                </div>
                                <div class="howtogetpoint">
                                    <button style="color: #2F80ED;" class="f-Asap_medium ksjak text-capitalize btn-vegan txt-btn" data-toggle="modal" data-target="#howtGetPoints" data-backdrop="static" data-keyboard="false">
                                        cara mendapatkan poin
                                        <span class="arrow-icns"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Start Header Poin Cover -->
                        <div class="border-bottom-large menu-poin">
                            <div data-src="{{ asset('dist/fe/icons/poin.png') }}" class="cover-poin-main img-lazy big-lazy">
                                <h5 class="pointexts f-Asap_medium desc-main-text text-center" style="color: #E24667;">{{auth('fe')->user()->point}} <span class="f-Asap_medium" style="color: #000000;">Poin</span></h5>
                            </div>
                        </div>
                        <!-- End Header Poin Cover -->
                        
                        <!-- Start Main Poin  -->
                        <div class="menu-poin">
                            <h5 class="f-Asap_medium text-capitalize desc-main-text">tukarkan poinmu</h5>
                            <p class="clr-light-gry mb-0">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim ullamcorper maecenas montes, arcu sit augue donec in porttitor. Aenean tellus et proin quis
                            </p>
                            <div class="pt-poin-menu">
                                @if(count($vouchers) > 0)
                                <!-- Start: If there is voucher -->
                                <div class="grid_layouts --ls-ct-poin">
                                    @foreach($vouchers as $voucher)
                                    <div class="crd-ct-poin">
                                        <a href="{{ route('akun_detail_voucher', $voucher->kode) }}">
                                            <div class="img-crd-point img-lazy big-lazy" data-src="{{ asset($voucher->image) }}"></div>
                                        </a>
                                        <div class="bttm-ct-pon-crd">
                                            <div class="pad-hgh">
                                                <h5 class="mb-0 main-sub-text f-Asap_medium">
                                                    {{ $voucher->title }}
                                                </h5>
                                            </div>
                                            <div class="grid_layouts gr-twolhsa masaberlaku pad-hgh">
                                                <div>
                                                    <h6 class="text-capitalize f-Asap_medium">
                                                        masa berlaku
                                                    </h6>
                                                    <small style="color: rgba(51, 51, 51, 0.6);">
                                                        {{ Carbon\Carbon::parse($voucher->end_date)->format('d F Y') }}
                                                    </small>
                                                </div>
                                                <div class="rightkshaha">
                                                    <h6 class="text-capitalize f-Asap_medium">
                                                        minimal transaksi
                                                    </h6>
                                                    <small class="text-capitalize" style="color: rgba(51, 51, 51, 0.6);">
                                                        @if($voucher->min_pembelanjaan > 0)
                                                        {{ $voucher->min_pembelanjaan }}
                                                        @else
                                                        tanpa minimal transaksi
                                                        @endif
                                                    </small>
                                                </div>
                                                <div class="circle-trnsp --tr-left"></div>
                                                <div class="circle-trnsp --tr-right"></div>
                                            </div>
                                            <div class="grid_layouts desc-point pad-hgh pt-3">
                                                <div class="lists-pointss">
                                                    <h5 class="mb-0 text-capitalize f-Asap_medium main-sub-text">
                                                        jumlah poin : <span style="color: #1FBC9D;">{{ $voucher->poin_required }} Poin</span>
                                                    </h5>
                                                </div>
                                                <div class="howtogetpoint lists-pointss">
                                                    <a href="{{ route('akun_detail_voucher', $voucher->kode) }}" class="mb-0 f-Asap_medium main-sub-text" style="color: #2F80ED;">S&K</a>
                                                </div>
                                            </div>
                                            <div class="btn-swtch">
                                                @if(auth('fe')->check())
                                                    @if($voucher->poin_required != 0)
                                                        @if( auth('fe')->user()->point > $voucher->poin_required)
                                                        <button class="btnMdlhasenoughpoint btn-vegan green-bg-btn text-capitalize f-Asap_medium main-sub-text" data-idvoucher="{{$voucher->id}}">
                                                        @else
                                                        <button class="btn-vegan green-bg-btn text-capitalize f-Asap_medium main-sub-text" data-target="#notenoughpoint" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                                        @endif    
                                                            tukarkan poin
                                                        </button>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- End:/ If there is voucher -->
                                
                                <!-- Pagination -->
                                <!-- ============================================================== -->
                                {{ $vouchers->links('layouts.fe.pagination')}}
                                <!-- ============================================================== -->
                                <!-- End Pagination -->
                                @else
                                
                                <!-- Start Tidak Ada Voucher -->
                                <div class="no-post-list">
                                    <div class="img-no-post img-lazy small-lazy" data-src="{{ asset('dist/fe/icons/no_promo.png') }}"></div>
                                    <div class="desc-no-post">
                                        <h6 class="text-capitalize f-Asap_medium main-sub-text">maaf! tidak ada voucher tersedia</h6>
                                    </div>
                                </div>
                                <!-- End:/ Tidak Ada Voucher -->
                                @endif
                            </div>
                        </div>
                        <!-- End Main Poin  -->
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Content -->
                </div>

                <!-- Start Modal How To Get Point -->
                <div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
                    <div class="modal fade modalpoints" id="howtGetPoints" tabindex="-1" role="dialog" aria-labelledby="howtGetPointsLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-capitalize text-left desc-main-text f-Asap_medium" id="uploadbuktibayarLabel">
                                        cara mendapatkan poin
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="cover-point-mdl img-lazy small-lazy" data-src="{{ asset('dist/fe/icons/how-to-get-poin.png') }}"></div>
                                    <article>
                                        <p class="mb-0">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim ullamcorper maecenas montes, arcu sit augue donec in porttitor. Aenean tellus et proin quis. 
                                            Elementum malesuada diam pellentesque id dui vulputate massa sit facilisis. Enim, adipiscing nisi odio egestas.
                                        </p>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:/ Modal How To Get Point -->

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
                                    <div class="cover-point-mdl img-lazy small-lazy" data-src="{{ asset('dist/fe/icons/got_poin.png') }}" style="padding-top: 70%;"></div>
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
        });
    </script>
@endpush