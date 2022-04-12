@extends('layouts.fe.fe')

@section('metadata')
    <title>Veganesia - Payment</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/checkout/payment_details.css') }}">
@endpush

@section('content')
    <div class="payment_detail-section">
        <section class="sec-payment_detail">
            <div class="box-payment">
                <div class="head-payment">
                    <div class="sec-thanks-icon">
                        <div class="icons-thanks img-lazy small-lazy" data-src="{{ asset('dist/fe/icons/thanks.png') }}"></div>
                    </div>
                    <p class="text-center mb-0">
                        Silahkan selesaikan pembayaran <span class="clr-warn">sebelum tanggal {{ Carbon\Carbon::parse($penjualan->transaction_date)->format('d F Y H:i') }}</span> untuk menghindari pembatalan transaksi secara otomatis.
                    </p>
                </div>
                <div class="total-payment">
                    <div>
                        <h6 class="main-sub-text f-Asap_medium mb-0">Total Pembayaran</h6>
                    </div>
                    <div class="price-payment">
                        <h6 class="desc-main-text-lg clr-warn f-Asap_medium mb-0">
                            Rp {{ number_format($penjualan->grandtotal,2,",",".")}}
                        </h6>
                    </div>
                </div>
                @if($penjualan->payment_id == 1)
                <div class="transfer-payment --qris-pay">
                    <h6 class="main-sub-text f-Asap_medium mb-20 text-center">
                        Silahkan Scan Qris dibawah ini
                    </h6>
                    <div class="barcode-qris img-lazy small-lazy" data-src="{{ asset('dist/fe/icons/barcode.png') }}"></div>
                    <h6 class="main-sub-text f-Asap_medium mb-0 mt-20 text-center clr-light-gry">
                        Menerima pembayaran
                    </h6>
                </div>
                @elseif($penjualan->payment_id == 2)
                <div class="transfer-payment --manual-pay">
                    <h6 class="main-sub-text f-Asap_medium mb-0">
                        Transfer dapat dilakukan di salah satu rekening tujuan an. Veganesia
                    </h6>
                    <div class="grid_layouts gr-bank-transfer">
                        @foreach($payment_bank as $bank)
                        <div class="grid_layouts icn-bank">
                            @if($bank->title == 'BCA (Bank Central Asia)')
                            <div class="img-bank img-lazy small-lazy --bca" data-src="{{ $bank->icon }}"></div>
                            @elseif($bank->title == 'Mandiri')
                            <div class="img-bank img-lazy small-lazy --mandiri" data-src="{{ $bank->icon }}"></div>
                            @elseif($bank->title == 'BNI (Bank Nasional Indonesia)')
                            <div class="img-bank img-lazy small-lazy --bni" data-src="{{ $bank->icon }}"></div>
                            @elseif($bank->title == 'BRI (Bank Rakyat Indonesia)')
                            <div class="img-bank img-lazy small-lazy --bri" data-src="{{ $bank->icon }}"></div>
                            @endif
                            <div class="desc-bank">
                                <h6 class="text-norek f-Asap_medium">
                                    {{$bank->no_rekening}}
                                </h6>
                                <div class="position-relative">
                                    <button data-target="{{$bank->id}}" class="copyclp-vegan-btn btn-vegan txt-btn clr-blue text-right f-Asap_medium" data-clipboard-text="{{$bank->no_rekening}}" type="button">
                                        salin
                                    </button>
                                    <div class="ct-tggle" id="copyclip-vegan{{$bank->id}}" style="display: none; top: 25px !important;">
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
                </div>
                @endif
                <div class="grid_layouts footer-payment">
                    <button id="RebuyProduct" class="text-capitalize btn-vegan f-Asap_medium green-border-btn">
                        beli lagi
                        <input type="hidden" value="{{$penjualan->total_belanja}}" id="rebuy_totalPrice">
                    </button>
                    <a href="{{route('akun_pesanan.detail', $penjualan->transaction_code)}}" class="text-capitalize btn-vegan f-Asap_medium --transparent-btn">
                        lihat status pembayaran
                    </a>
                </div>
                <div class="d-none">
                <!-- <div> -->
                    @foreach($penjualan->details as $item)
                    @if($item->product->is_variant == true)
                    <div class="list-productss" data-variant="{{$item->product_variant->id}}" data-qty="{{$item->qty}}" data-id="{{$item->product->id}}" data-stock="{{$item->product_variant->stock}}">{{$item->product->name}} - {{$item->product_variant->name}}</div>
                    @else
                    <div class="list-productss" data-variant="0" data-qty="{{$item->qty}}" data-id="{{$item->product->id}}" data-stock="{{$item->product->stock}}">{{$item->product->name}}</div>
                    @endif
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            /********************************/
            /*Rebuy Produk*/
            /********************************/
            $('#RebuyProduct').on('click',function (e) {
                e.preventDefault();
                var id_product   = [];
                var qty_buy_again   = [];
                var id_variant   = [];
                var hasilchck = $('#rebuy_totalPrice').val();

                $.each($('.list-productss'),function(index){
                    id_product[index] = $(this).data('id');
                });

                $.each($('.list-productss'),function(index){
                    qty_buy_again[index] = $(this).data('qty');
                });


                $.each($('.list-productss'),function(index){
                    id_variant[index] = $(this).data('variant');
                });

                $.ajax({
                    url: "{{ route('rebuy') }}",
                    method: 'POST',
                    dataType: "json",
                    data: {
                        id_product: id_product,
                        qty: qty_buy_again,
                        variant: id_variant,
                        prc: hasilchck,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if(response.success == true){
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
                        // else if(response.no_quota){
                        //     Swal.fire({
                        //         type: 'error',
                        //         title: 'Error!',
                        //         text: 'Kuota flash sale telah habis',
                        //     });
                        // }
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
                        //     window.location.reload()
                        // });
                    }
                });
            });

            /********************************/
            /*Global Clipboard Copy*/
            /********************************/
            function setToggle(id) {
                $("#ct-tggle"+id).slideDown();
            }

            function hideToggle(id) {
                setTimeout(function() {
                    $('#ct-tggle'+id).slideUp();
                }, 1200);
            }
            
            var clp = new ClipboardJS('.copyclp');
            clp.on('success', function(e) {
                setToggle($(e.trigger).data('target'));
                hideToggle($(e.trigger).data('target'));
            });
        });
    </script>
@endpush