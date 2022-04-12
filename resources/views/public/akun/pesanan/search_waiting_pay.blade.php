@if(count($orders->where('transaction_status', 1)->where('payment_status', 1)) > 0)
<!-- Start Ada Pesanan -->
@foreach($orders->where('transaction_status', 1)->where('payment_status', 1) as $order_waiting)
<div class="pt-list-order">
    <div class="grid_layouts head-pt-list-order">
        <div class="bx-head-mns code-order">
            <h5 class="nocode main-sub-text f-Asap_medium">
                {{$order_waiting->transaction_code}}
            </h5>
            <h6 class="clr-light-gry text-capitalize mb-0">
                {{ Carbon\Carbon::parse($order_waiting->created_at)->format('d F Y') }}
            </h6>
        </div>
        <div class="bx-head-mns stts-order">
            <h6 class="clr-light-gry small-fnt text-capitalize">status pesanan :</h6>
            <div class="stts-listjhdd">
                <div class="status-order --waiting">
                    <h6 class="small-fnt text-capitalize mb-0 stts-order-text">{{$order_waiting->p_status}}</h6>
                </div>
            </div>
        </div>
        <div class="bx-head-mns ttl-order">
            <h6 class="clr-light-gry small-fnt text-capitalize">total pembayaran :</h6>
            <h5 style="color: #FA591D;" class="mb-0 f-Asap_medium desc-main-text">
                Rp. {{ number_format($order_waiting->grandtotal ,2,",",".")}}
            </h5>
        </div>
    </div>
    <div class="body-pt-list-order">
        <div class="accordion" id="waitaccordionProduct">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <button class="btn-vegan txt-btn" type="button" data-toggle="collapse" data-target="#listsproducts_{{$order_waiting->id}}" aria-expanded="true" aria-controls="listsproducts_{{$order_waiting->id}}">
                        Daftar Belanja (<span id="total_all" class="constantformatnumberCN" data-content="{{count($order_waiting->details)}}">{{count($order_waiting->details)}}</span>)
                        <span class="icn-arrow" style="background-image: url('{{ asset('dist/fe/icons/arrow-grey.png') }}')"></span>
                    </button>
                </div>
                <div id="listsproducts_{{$order_waiting->id}}" class="collapse show" aria-labelledby="headinglistsproducts_{{$order_waiting->id}}" data-parent="#waitaccordionProduct">
                    <div class="grid_layouts card-body">
                        @if($search == true)
                            @if($order_waiting->transaction_status == 1 && $order_waiting->payment_status == 1)
                            <div class="grid_layouts gr-cart-prdct">
                            @else
                            <div class="grid_layouts gr-cart-prdct list-products-all-{{$order_waiting->id}}" data-qty="{{$order_waiting->qty}}" data-product="{{$order_waiting->product_id}}">
                            @endif
                                <div class="cover-img img-lazy small-lazy" data-src="{{ env('APP_DOWNLOAD') . $order_waiting->media }}"></div>
                                <div class="desc">
                                    <h6 class="prd-title truncate-texts mb-1">
                                        {{ $order_waiting->name }}
                                    </h6>
                                    <h6 class="prd-price clr-light-gry truncate-texts mb-0">
                                        Rp.{{ number_format($order_waiting->price ,2,",",".")}} &nbsp;&nbsp; x{{ $order_waiting->qty}}
                                    </h6>
                                </div>
                            </div>
                        @else
                            @foreach($order_waiting->details as $item)
                            <div class="grid_layouts gr-cart-prdct">
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
    
    <div class="grid_layouts footer-pt-list-order waiting-mode">
        <div class="pay-shopping">
            <a href="{{ route('akun_pesanan_bayar.detail', $order_waiting->transaction_code) }}" class="text-center btn-vegan text-capitalize orange-btn f-Asap_medium">
                bayar belanjaan
            </a>
        </div>
        <div>
            <h6 class="clr-light-gry small-fnt text-capitalize mb-0">bayar sebelum : </h6>
        </div>
        <div class="ft-date-order">
            <div class="icn-bell img-lazy small-lazy" data-src="{{ asset('dist/fe/icons/bell.png') }}"></div>
            <h6 class="clr-lght-gsh mb-0">
                {{ Carbon\Carbon::parse($order_waiting->transaction_date)->format('d F Y H:i') }}
            </h6>
        </div>
        <div class="rincian-view-btns">
            <a href="{{route('akun_pesanan.detail', $order_waiting->transaction_code)}}" class="view-rincian btn-vegan txt-btn text-capitalize">
                lihat rincian pesanan
                <span class="icn-arrow" style="background-image: url('{{ asset('dist/fe/icons/arrow-grey.png') }}')"></span>
            </a>
        </div>
    </div>
</div>
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