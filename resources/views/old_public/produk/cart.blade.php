<div id="cartbox" class="cart-vegan d-none">
    <div class="sec-cart">
        <div id="top-product-cart">
            <div class="grid_layouts top-cart">
                <div>
                    <h6 class="title-cart f-Asap_medium text-capitalize">
                        <span id="icnCart" class="icon-cart"></span>
                        keranjang belanja (<span class="constantformatnumberCN" data-content="{{count($carts)}}">{{count($carts)}}</span>)
                    </h6>
                </div>
                <div>
                    <button id="closeCart" class="icon-cart icn-cart-scr"></button>
                </div>
            </div>
        </div>
        <div id="ls-product-cart" class="ls-product-cart --scrlbrr">
            <div class="middle-cart">
                @if(count(auth('fe')->user()->cart) > 0)
                @foreach($carts as $cart)
                <div class="brdr-crt-lst">
                    @if($cart->product->is_variant == true)
                    <div class="grid_layouts gr-cart-prdct" @if($cart->product_variant->stock == 0) style="opacity: .7;" @endif>
                    @else
                    <div class="grid_layouts gr-cart-prdct" @if($cart->product->stock == 0) style="opacity: .7;" @endif>
                    @endif

                        <div class="cart_item_a cover-img icon-cart img-slider img-lazy" data-src="{{ asset($cart->product->cover_image) }}"></div>
                        <div class="cart_item_b">
                            <div class="desc">
                                <h6 class="prd-title med-small-fnt f-Asap_medium truncate-texts mb-1">
                                    {{ $cart->product->name }}
                                </h6>
                                @if($cart->product->is_variant == true) 
                                <input class="listsprice" id="cart-{{$cart->id}}" data-qty="{{ $cart->qty }}" value="{{ $cart->product->only_final_price }}" type="hidden" data-idvarian="{{ $cart->product_variant->id }}" data-product="{{$cart->product->id}}" data-id="{{ $cart->id }}">
                                <input class="listHarga" id="price_{{ $cart->product->id }}" data-qty="{{ $cart->qty }}" value="{{ $cart->product->only_final_price }}" type="hidden" data-idvarian="{{ $cart->product_variant->id }}" data-product="{{$cart->product->id}}" data-id="{{ $cart->id }}">
                                @else
                                <input class="listsprice" id="cart-{{$cart->id}}" data-qty="{{ $cart->qty }}" value="{{ $cart->product->only_final_price }}" type="hidden" data-idvarian="0" data-product="{{$cart->product->id}}" data-id="{{ $cart->id }}">
                                <input class="listHarga" id="price_{{ $cart->product->id }}" data-qty="{{ $cart->qty }}" value="{{ $cart->product->only_final_price }}" type="hidden" data-idvarian="0" data-product="{{$cart->product->id}}" data-id="{{ $cart->id }}">
                                @endif
                                <h6 class="prd-price med-small-fnt truncate-texts mb-1">
                                    {{ $cart->product->final_price }}
                                </h6>
                                @if($cart->product->is_variant == true) 
                                <small class="clr-light-gry small-fnt">Ukuran <span class="f-Asap_bold clr-blck">{{ $cart->product_variant->name }}</span></small>
                                @endif
                            </div>
                            <div class="form-vegan input-number-cart-vegan">
                                @if($cart->product->is_variant == true)
                                <input class="input-number form-control qty_input float_product_qtys_cart" data-stocks="{{ $cart->product_variant->stock }}" data-variant="{{ $cart->product_variant->id }}" data-id="{{ $cart->id }}" data-product="{{ $cart->product->id }}" type="number" name="qty" value="{{ $cart->qty }}" step="1" min="1" data-min="1" max="{{ $cart->product_variant->stock }}" data-max="{{ $cart->product_variant->stock }}">
                                @else
                                <input class="input-number form-control qty_input float_product_qtys_cart" data-stocks="{{ $cart->product->stock }}" data-variant="0" data-id="{{ $cart->id }}" data-product="{{ $cart->product->id }}" type="number" name="qty" value="{{ $cart->qty }}" step="1" min="1" data-min="1" max="{{ $cart->product->stock }}" data-max="{{ $cart->product->stock }}">
                                @endif
                            </div>
                        </div>
                        <div class="cart_item_c">
                            <button id="deleteCart" class="deleteCart icon-cart icon-del" data-id="{{$cart->id}}"></button>
                        </div>
                    </div>
                    <div class="mt-2">
                        @if($cart->product->is_variant == true)
                        <small id="not_enough_stock_{{ $cart->product_variant->id }}" style="color: red;" class="mb-0 small-fnt"></small>
                        @else
                        <small id="not_enough_stock_{{ $cart->product->id }}" style="color: red;" class="mb-0 small-fnt"></small>
                        @endif
                    </div>
                </div>
                @endforeach
                @else
                <!-- Start Tidak Ada Cart -->
                <div class="no-post-list">
                        <div class="img-no-post img-lazy small-lazy" data-src="{{ asset('dist/fe/icons/keranjang.png') }}"></div>
                        <div class="desc-no-post">
                            <h6 class="text-capitalize f-Asap_medium main-sub-text">maaf! belum ada belanjaan</h6>
                        </div>
                    </div>
                    <!-- End:/ Tidak Ada Cart -->
                @endif
            </div>
        </div>
        <div id="bottom-product-cart">
            <div class="grid_layouts bottom-cart">
                <div class="totalCart">
                    <small class="text-capitalize clr-light-gry small-fnt">total belanja</small>
                    <h6 class="totalCount" id="totalCount"></h6>
                </div>
                <div class="btn-chk">
                    @if(count(auth('fe')->user()->cart) > 0)
                    <input type="hidden" id="totalPrice">
                    <button id="checkoutCart" class="btn-vegan orange-btn text-capitalize">checkout</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.qty_input').prev().addClass('number-minus-main');
            $('.qty_input').next().addClass('number-plus-main');

            $('.float_product_qtys_cart').prev().addClass('number-minus-cart');
            $('.float_product_qtys_cart').next().addClass('number-plus-cart');
            $('.float_product_qtys_cart').prev().addClass('number-minus-cartMain');
            $('.float_product_qtys_cart').next().addClass('number-plus-cartMain');

            $('.modal_qtys_addtocart').prev().addClass('number-minus-modlAddcart');
            $('.modal_qtys_addtocart').next().addClass('number-plus-modlAddcart');
            $('.modal_qtys_addtocart').prev().addClass('number-minus-cart');
            $('.modal_qtys_addtocart').next().addClass('number-plus-cart');
            $('.modal_qtys_addtocart').prev().addClass('number-minus-cartMain');
            $('.modal_qtys_addtocart').next().addClass('number-plus-cartMain');

            $('#float_product_qtys').prev().addClass('number-minus-detail');
            $('#float_product_qtys').next().addClass('number-plus-detail');
            $('#float_product_qtys').prev().addClass('number-minus-cartMain');
            $('#float_product_qtys').next().addClass('number-plus-cartMain');

            /********************************/
            /*CART LIST*/
            /********************************/
            if($('#totalPrice').val() == 0){
                var jumlah = parseInt($('#price_'+$(this).data('product')+'').val());
                $('#totalPrice').val(jumlah);
                $('#total_belanja').val(jumlah);
                console.log('total1');
            }
        });
    </script>
@endpush