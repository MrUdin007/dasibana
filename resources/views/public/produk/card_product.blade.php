<div class="ct-card-prdct">
    <div class="img-prod">
        <a href="{{ route('produk.detail', [$produk->urlcategory, $produk->urlproduct]) }}" class="card-slider">
            {{--@if(!isset($not_slide))
            <div class="img-slider img-lazy small-lazy">
                <img data-lazy="{{ $produk->cover_image }}">
            @else--}}
            <div class="img-slider img-lazy small-lazy" data-src="{{ $produk->cover_image }}">
            {{--@endif--}}
                @if($produk->is_new == true)
                <div class="ribbon">
                    new
                </div>
                @endif
            </div>
        </a>
        <div class="fav-prod">
            <input type="checkbox" name="likes_{{ $produk->id }}" id="likes_{{ $produk->id }}" @if($produk->is_like_by_user) checked @endif>
            @if(auth('fe')->check())
            <label class="love-icn product_like_checkbox" for="likes_{{ $produk->id }}" data-id="{{ $produk->id }}"></label>
            @else
            <label class="love-icn" type="button" data-toggle="modal" data-target="#login" data-backdrop="static" data-keyboard="false"></label>
            @endif
        </div>
    </div>
    <div class="desc-prdct">
        <form method="post" data-toggle="validator" class="form-vegan">
            @csrf
            <input type="hidden" value="1" name="qty" id="qty">
            <div class="lnk-crd-prdct">
                <a href="{{ route('produk.detail', [$produk->urlcategory, $produk->urlproduct]) }}">
                    <div class="mb-2 tp-desc-prd">
                        <h3 class="ttl-prd truncate-texts --two f-Asap_reg">
                            {{$produk->productname}}
                        </h3>
                    </div>
                    <div class="prc_shaj">
                        <h4 class="price-prd truncate-texts f-Asap_reg flashSale">
                            {{ $produk->final_price }}
                            -
                            
                        </h4>
                        @if($produk->is_disc)
                        <div class="mb-2">
                            <div class="dsc-prc">
                                <div class="ls-dsc-prc mb-1 mr-1">
                                    <small class="truncate-texts f-Asap_reg">
                                        Rp.{{ number_format($produk->price,2,",",".")}}
                                    </small>
                                </div>
                                <div class="ls-dsc-prc">
                                    <div class="disc-lbl">
                                        {{ $produk->disc_value }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </a>
            </div>
            @if(auth('fe')->check())
            @if($produk->is_variant == 1)
            <button class="btn-vegan btn-buy add-to-cart-variant" data-id="{{$produk->id}}">
                beli
            </button>
            @else
            <button class="btn-vegan btn-buy add-to-cart" data-id="{{$produk->id}}" data-stockcart="" data-stock="{{$produk->stock}}">
                beli
            </button>
            @endif
            @else
            <button class="btn-vegan btn-buy" type="button" data-toggle="modal" data-target="#login" data-backdrop="static" data-keyboard="false">
                beli
            </button>
            @endif
        </div>
    </form>
</div>