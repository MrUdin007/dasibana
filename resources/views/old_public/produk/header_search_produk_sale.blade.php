@foreach($datas->take(3) as $product_sale)
<a class="item-search-list" href="{{ route('produk.detail', [$product_sale->urlcategory, $product_sale->urlproduct]) }}">
    <div class="display_grid grid-global-search --gr-prdct">
        <div class="search-img-container">
            <div class="search-img img-lazy loaded" style="background-image: url('{{ $product_sale->cover_image }}')"></div>
        </div>
        <div>
            @if($product_sale->is_disc)
            <h6 class="truncate-texts">
            @else
            <h6 class="truncate-texts --two">
            @endif
                {{$product_sale->productname}}
            </h6>
            <h6 class="price">
                {{$product_sale->final_price}}
            </h6>
            @if($product_sale->discount_type == 2)
            @if($product_sale->is_disc)
            <div class="dsc-prc">
                <div>
                    <small class="truncate-texts f-Asap_reg">
                        Rp.{{ number_format($product_sale->price,2,",",".")}}
                    </small>
                </div>
                <div class="disc-lbl">
                    {{ $product_sale->disc_value }}
                </div>
            </div>
            @endif
            @endif
        </div>
    </div>
</a>
@endforeach
@if(count($datas) > 3)
<div class="view-all">
    <a class="text-capitalize" href="{{ route('produk') }}">lihat semua produk sale</a>
</div>
@endif