@extends('layouts.fe.fe')

@section('metadata')
    <title>Veganesia - Promo</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/promo/main.css') }}">
@endpush

@section('content')
    <div class="promo-section">
        <!-- Content Profile -->
        <!-- ============================================================== -->
        <section class="sec-promo container">
            <!-- Content -->
            <!-- ============================================================== -->
            <div class="box-promo">
                <div class="grid_layouts gr-promo">
                    <div>
                        <h5 class="text-uppercase f-Asap_medium mb-0" style="color: rgba(0, 0, 0, 0.8);">promo hari ini</h5>
                    </div>
                    <div>
                        <form class="form-vegan" autocomplete="off" id="formSearch" action="" method="get">
                            <div class="input-group search-inputs">
                                <input id="promosearchpage" name="searchpromo" type="text" class="form-control --search" placeholder="Cari Promo" aria-label="" aria-describedby="search" value="{{ isset(request()->searchpromo) ? request()->searchpromo : '' }}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text --nobg" id="searchpromo">
                                        <button class="search-icn" type="button"></button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Start Content Promo -->
                <div class="menu-promo">
                    @if(count($vouchers) > 0)
                    <!-- Start: If there is voucher -->
                    <div class="grid_layouts --ls-ct-promo">
                        @foreach($vouchers as $voucher)
                        <div class="crd-ct-promo">
                            <a href="{{ route('promo.detail', $voucher->kode) }}">
                                <div class="img-crd-point img-lazy images-slider small-lazy" data-src="{{ asset($voucher->image) }}"></div>
                            </a>
                            <div class="bttm-ct-pon-crd">
                                <div class="pad-hgh">
                                    <h5 class="mb-0 main-sub-text f-Asap_medium">
                                        {{ $voucher->keterangan }}
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
                                <div class="grid_layouts gr-twolhsa desc-point pad-hgh pt-3">
                                    <div>
                                        <h5 class="mb-0 text-capitalize f-Asap_medium main-sub-text">
                                            kode promo : <span style="color: #1FBC9D;">{{ $voucher->kode }}</span>
                                        </h5>
                                    </div>
                                    <div class="howtogetpoint">
                                        <a href="{{ route('promo.detail', $voucher->kode) }}" class="mb-0 f-Asap_medium main-sub-text" style="color: #2F80ED;">S&K</a>
                                    </div>
                                </div>
                                <div class="btn-swtch position-relative">
                                    <button data-target="{{$voucher->id}}" class="copyclp-vegan-btn btn-vegan green-bg-btn text-capitalize f-Asap_medium main-sub-text" data-clipboard-text="{{$voucher->kode}}" type="button">
                                        salin kode
                                    </button>
                                    <div class="ct-tggle tggl-lgrhfsbfjs" id="copyclip-vegan{{$voucher->id}}" style="display: none">
                                        <div class="position-relative">
                                            <small class="small-fnt">Copied</small>
                                            <div class="mn-arrw"></div>
                                        </div>
                                    </div>
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
                            <h6 class="text-capitalize f-Asap_medium main-sub-text">maaf! tidak ada promo tersedia</h6>
                        </div>
                    </div>
                    <!-- End:/ Tidak Ada Voucher -->
                    @endif
                </div>
                <!-- End Content Promo -->
            </div>
            <!-- ============================================================== -->
            <!-- End Content -->
        </section>
        <!-- ============================================================== -->
        <!-- End Content Profile -->
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            /********************************/
            /*Detail Blog Clipboard Copy*/
            /********************************/
            function setToggle(id) {
                $(".ct-tggle-top").slideDown();
            }

            function hideToggle(id) {
                setTimeout(function() {
                    $('.ct-tggle-top').slideUp();
                }, 1200);
            }
            
            var clp = new ClipboardJS('.btn-copyclp-top');
            clp.on('success', function(e) {
                setToggle($(e.trigger).data('target'));
                hideToggle($(e.trigger).data('target'));
            });
        });
    </script>
@endpush