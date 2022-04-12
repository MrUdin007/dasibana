@if(count($orders->where('transaction_status', 3)->where('payment_status', 2)) > 0)
<!-- Start Ada Pesanan -->
@foreach($orders->where('transaction_status', 3)->where('payment_status', 2) as $order_send)
<div class="pt-list-order">
    <div class="grid_layouts head-pt-list-order">
        <div class="bx-head-mns code-order">
            <h5 class="nocode main-sub-text f-Asap_medium">
                {{$order_send->transaction_code}}
            </h5>
            <h6 class="clr-light-gry text-capitalize mb-0">
                {{ Carbon\Carbon::parse($order_send->created_at)->format('d F Y') }}
            </h6>
        </div>
        <div class="bx-head-mns stts-order">
            <h6 class="clr-light-gry small-fnt text-capitalize">status pesanan :</h6>
            <div class="stts-listjhdd --trsgc">
                {{--Dikirim--}}
                <div class="status-order --sent">
                    <h6 class="small-fnt text-capitalize mb-0 stts-order-text">{{$order_send->p_status}}</h6>
                </div>
                <div class="tracking-section">
                    <button class="btn-vegan txt-btn text-capitalize f-Asap_medium small-fnt" data-toggle="modal" data-target="#detStts-send-{{$order_send->id}}" data-backdrop="static" data-keyboard="false">lacak pesanan</h6>
                </div>
            </div>
        </div>
        <div class="bx-head-mns ttl-order">
            <h6 class="clr-light-gry small-fnt text-capitalize">total pembayaran :</h6>
            <h5 style="color: #FA591D;" class="mb-0 f-Asap_medium desc-main-text">
                Rp. {{ number_format($order_send->grandtotal ,2,",",".")}}
            </h5>
        </div>
    </div>
    <div class="body-pt-list-order">
        <div class="accordion" id="accordionProduct">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <button class="btn-vegan txt-btn" type="button" data-toggle="collapse" data-target="#listsproducts_{{$order_send->id}}" aria-expanded="true" aria-controls="listsproducts_{{$order_send->id}}">
                        Daftar Belanja (<span id="total_all" class="constantformatnumberCN" data-content="{{count($order_send->details)}}">{{count($order_send->details)}}</span>)
                        <span class="icn-arrow" style="background-image: url('{{ asset('dist/fe/icons/arrow-grey.png') }}')"></span>
                    </button>
                </div>
                <div id="listsproducts_{{$order_send->id}}" class="collapse show" aria-labelledby="headinglistsproducts_{{$order_send->id}}" data-parent="#accordionProduct">
                    <div class="grid_layouts card-body">
                        @if($search == true)
                            @if($order_send->transaction_status == 1 && $order_send->payment_status == 1)
                            <div class="grid_layouts gr-cart-prdct">
                            @else
                            <div class="grid_layouts gr-cart-prdct list-products-all-{{$order_send->id}}" data-qty="{{$order_send->qty}}" data-product="{{$order_send->product_id}}">
                            @endif
                                <div class="cover-img img-lazy small-lazy" data-src="{{ env('APP_DOWNLOAD') . $order_send->media }}"></div>
                                <div class="desc">
                                    <h6 class="prd-title truncate-texts mb-1">
                                        {{ $order_send->name }}
                                    </h6>
                                    <h6 class="prd-price clr-light-gry truncate-texts mb-0">
                                        Rp.{{ number_format($order_send->price ,2,",",".")}} &nbsp;&nbsp; x{{ $order_send->qty}}
                                    </h6>
                                </div>
                            </div>
                        @else
                            @foreach($order_send->details as $item)
                            <div class="grid_layouts gr-cart-prdct list-products-sent-{{$order_send->id}}" data-qty="{{$item->qty}}" data-product="{{$item->product_id}}">
                                <div class="cover-img img-lazy small-lazy" data-src="{{ $item->item->cover_image }}"></div>
                                <div class="desc">
                                    <h6 class="prd-title truncate-texts mb-1">
                                        @if($item->product->is_variant == true)
                                        {{ $item->item->name }} - {{ $item->product_variant->name }}
                                        @else
                                        {{ $item->item->name }}
                                        @endif
                                    </h6>
                                    <h6 class="prd-price clr-light-gry truncate-texts mb-0">
                                        Rp.{{ number_format($item->price ,2,",",".")}} &nbsp;&nbsp; x{{ $item->qty}}
                                    </h6>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid_layouts footer-pt-list-order send-mode">
        <div class="pay-shopping">
            <button class="text-center btn-vegan text-capitalize orange-btn f-Asap_medium receivedProductMain" data-id="{{$order_send->id}}" data-code="{{$order_send->transaction_code}}">
                terima barang
            </button>
        </div>
        <div class="ft-date-order">
            <div class="icn-bell img-lazy small-lazy loaded" data-src="{{ asset('dist/fe/icons/bell.png') }}"></div>
            <h6 class="clr-light-gry mb-0 text-capitalize f-Asap_italic">
                mohon konfirmasi jika barang sudah diterima
            </h6>
        </div>
        <div class="rincian-view-btns">
            <a href="{{route('akun_pesanan.detail', $order_send->transaction_code)}}" class="view-rincian btn-vegan txt-btn text-capitalize">
                lihat rincian pesanan
                <span class="icn-arrow" style="background-image: url('{{ asset('dist/fe/icons/arrow-grey.png') }}')"></span>
            </a>
        </div>
    </div>
</div>

<!-- Start Modal Lacak Order -->
<div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
    <div class="modal fade" id="detStts-send-{{$order_send->id}}" tabindex="-1" role="dialog" aria-labelledby="detStts-send-{{$order_send->id}}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize text-left desc-main-text f-Asap_medium" id="detStts-send-{{$order_send->id}}Label">
                        status pengiriman
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div class="mdl-stts">
                        <div class="grid_layouts gr-head-mnsdhshs mdl-padd">
                            <div class="lhsajsha">
                                <div>
                                    <h5 class="mb-0 small-fnt clr-light-gry">
                                        ID Pesanan
                                    </h5>
                                </div>
                                <div class="mn-right sub-mn-right">
                                    <h5 class="text-uppercase mb-0 f-Asap_medium">
                                        {{ $order_send->transaction_code}}
                                    </h5>
                                </div>
                            </div>
                            <div class="lhsajsha">
                                <div>
                                    <h5 class="mb-0 text-capitalize small-fnt clr-light-gry">
                                        tanggal pesanan
                                    </h5>
                                </div>
                                <div class="mn-right sub-mn-right">
                                    <h5 class="mb-0 f-Asap_medium">
                                        {{ Carbon\Carbon::parse($order_send->created_at)->format('d F Y') }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="mdl-padd order-detl">
                            <div class="grid_layouts gr-krss mb-3">
                                <div class="kurir-descs">
                                    @if ($order_send->shipping_code == 'jnt')
                                    <div class="icn-kurirs --jnt"></div>
                                    @elseif ($order_send->shipping_code == 'jne')
                                    <div class="icn-kurirs --jne"></div>
                                    @elseif ($order_send->shipping_code == 'pos')
                                    <div class="icn-kurirs --pos"></div>
                                    @elseif ($order_send->shipping_code == 'sicepat')
                                    <div class="icn-kurirs --sicepat"></div>
                                    @endif
                                    <h6 class="mb-0 text-capitalize clr-gry">
                                        Reguler 2-3 Hari
                                    </h6>
                                </div>
                                <div class="rg-sect">
                                    @if(($order_send->no_resi) != null)
                                    <h5 class="mb-0 text-capitalize main-sub-text f-Asap_medium">
                                        {{$order_send->no_resi}} &nbsp;
                                        <span class="position-relative">
                                            <a data-target="noresimodal" class="copyclp position-relative btn-ouzen txt-btn clr-blue main-sub-text-mid" data-clipboard-text="{{$order_send->no_resi}}" type="button">
                                                salin
                                            </a>
                                            <div class="ct-tggle ct-tggletp" id="ct-tgglenoresimodal" style="display: none;">
                                                <div class="position-relative">
                                                    <small class="small-fnt">Copied</small>
                                                    <div class="mn-arrw"></div>
                                                </div>
                                            </div>
                                        </span>
                                    </h5>
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="mdl-padd lst-mn-stts">
                            <div class="stts-order">
                                <ul>
                                    {{--@if($waybill != '')
                                        @foreach($waybill as $w)
                                        <li class="mnu-stts">
                                            <div>
                                                <h6 class="mid-main-sub-text lnk-stts">{{$w->manifest_date}}</h6>
                                                <h6 class="mid-main-sub-text lnk-stts">{{$w->manifest_time}}</h6>
                                            </div>
                                            <div class="chcks">
                                                <div class="chck-icn"></div>
                                            </div>
                                            <div>
                                                <h6 class="mid-main-sub-text  text-capitalize">{{ $w->manifest_description}} - {{ $w->city_name}}</h6>
                                            </div>
                                        </li>
                                        @endforeach
                                    @endif--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End:/ Modal Lacak Order -->
@endforeach
<!-- End:/ Ada Pesanan -->
@else
<!-- Start Tidak Ada Pesanan -->
<div class="card-no-post-list">
    <div class="no-post-list">
        <div class="img-no-post img-lazy small-lazy" data-src="{{ asset('dist/fe/icons/no-cart.png') }}"></div>
        <div class="desc-no-post">
            <h6 class="text-capitalize f-Asap_medium main-sub-text">belum ada belanjaan</h6>
            <p class="clr-light-gry">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Diam pretium adipiscing eleifend lectus. Et orci ornare habitant.
            </p>
            <a href="{{ route('produk') }}" class="btn-vegan text-capitalize text-center btn-shopping">mulai belanja</a>
        </div>
    </div>
</div>
<!-- End:/ Tidak Ada Pesanan -->
@endif

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            /********************************/
            /*Rebuy Produk*/
            /********************************/
            $('.rebuymainorder_sent').on('click',function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var id_product   = [];
                var qty_buy_again   = [];
                var hasilchck = $(this).data('price');
                $.each($('.list-products-sent-'+id+''),function(index){
                    id_product[index] = $(this).data('product');
                });

                $.each($('.list-products-sent-'+id+''),function(index){
                    qty_buy_again[index] = $(this).data('qty');
                });

                $.ajax({
                    url: "{{ route('checkout') }}",
                    method: 'POST',
                    dataType: "json",
                    data: {
                        id_product: id_product,
                        qty: qty_buy_again,
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
                        }).then(function() {
                            window.location.reload()
                        });
                    }
                });
            });
        });
    </script>
@endpush