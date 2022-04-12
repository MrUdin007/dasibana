@if(count($orders->where('transaction_status', 1)->where('payment_status', 2)) > 0)
<!-- Start Ada Pesanan -->
@foreach($orders->where('transaction_status', 1)->where('payment_status', 2) as $order_new)
<div class="pt-list-order">
    <div class="grid_layouts head-pt-list-order">
        <div class="bx-head-mns code-order">
            <h5 class="nocode main-sub-text f-Asap_medium">
                {{$order_new->transaction_code}}
            </h5>
            <h6 class="clr-light-gry text-capitalize mb-0">
                {{ Carbon\Carbon::parse($order_new->created_at)->format('d F Y') }}
            </h6>
        </div>
        <div class="bx-head-mns stts-order">
            <h6 class="clr-light-gry small-fnt text-capitalize">status pesanan :</h6>
            <div class="stts-listjhdd">
                {{--sudah dibayar--}}
                <div class="status-order --new-order">
                    <h6 class="small-fnt text-capitalize mb-0 stts-order-text">{{$order_new->p_status}}</h6>
                </div>
            </div>
        </div>
        <div class="bx-head-mns ttl-order">
            <h6 class="clr-light-gry small-fnt text-capitalize">total pembayaran :</h6>
            <h5 style="color: #FA591D;" class="mb-0 f-Asap_medium desc-main-text">
                Rp. {{ number_format($order_new->grandtotal ,2,",",".")}}
            </h5>
        </div>
    </div>
    <div class="body-pt-list-order">
        <div class="accordion" id="accordionProduct">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <button class="btn-vegan txt-btn" type="button" data-toggle="collapse" data-target="#listsproducts_{{$order_new->id}}" aria-expanded="true" aria-controls="listsproducts_{{$order_new->id}}">
                        Daftar Belanja (<span id="total_all" class="constantformatnumberCN" data-content="{{count($order_new->details)}}">{{count($order_new->details)}}</span>)
                        <span class="icn-arrow" style="background-image: url('{{ asset('dist/fe/icons/arrow-grey.png') }}')"></span>
                    </button>
                </div>
                <div id="listsproducts_{{$order_new->id}}" class="collapse show" aria-labelledby="headinglistsproducts_{{$order_new->id}}" data-parent="#accordionProduct">
                    <div class="grid_layouts card-body">
                        @if($search == true)
                            @if($order_new->transaction_status == 1 && $order_new->payment_status == 1)
                            <div class="grid_layouts gr-cart-prdct">
                            @else
                            <div class="grid_layouts gr-cart-prdct list-products-all-{{$order_new->id}}" data-qty="{{$order_new->qty}}" data-product="{{$order_new->product_id}}">
                            @endif
                                <div class="cover-img img-lazy small-lazy" data-src="{{ env('APP_DOWNLOAD') . $order_new->media }}"></div>
                                <div class="desc">
                                    <h6 class="prd-title truncate-texts mb-1">
                                        {{ $order_new->name }}
                                    </h6>
                                    <h6 class="prd-price clr-light-gry truncate-texts mb-0">
                                        Rp.{{ number_format($order_new->price ,2,",",".")}} &nbsp;&nbsp; x{{ $order_new->qty}}
                                    </h6>
                                </div>
                            </div>
                        @else
                            @foreach($order_new->details as $item)
                            <div class="grid_layouts gr-cart-prdct list-products-new-{{$order_new->id}}" data-qty="{{$item->qty}}" data-product="{{$item->product_id}}">
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
    
    <div class="grid_layouts footer-pt-list-order">
        <div class="rincian-view-btns">
            <a href="{{route('akun_pesanan.detail', $order_new->transaction_code)}}" class="view-rincian btn-vegan txt-btn text-capitalize">
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

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            /********************************/
            /*Rebuy Produk*/
            /********************************/
            $('.rebuymainorder_new').on('click',function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var id_product   = [];
                var qty_buy_again   = [];
                var hasilchck = $(this).data('price');
                $.each($('.list-products-new-'+id+''),function(index){
                    id_product[index] = $(this).data('product');
                });

                $.each($('.list-products-new-'+id+''),function(index){
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