@foreach($datas->take(3) as $product)
<a class="item-search-list" href="{{ route('produk.detail', [$product->urlcategory, $product->urlproduct]) }}">
    <div class="display_grid grid-global-search --gr-prdct">
        <div class="search-img-container">
            <div class="search-img img-lazy loaded" style="background-image: url('{{ $product->cover_image }}')"></div>
        </div>
        <div>
            @if($product->is_disc)
            <h6 class="truncate-texts">
            @else
            <h6 class="truncate-texts --two">
            @endif
                {{$product->productname}}
            </h6>
            <h6 class="price">
                {{$product->final_price}}
                @if($product->is_new == true)
                <span class="is_new_prdct">
                    new
                </span>
                @endif
            </h6>
        </div>
    </div>
</a>
@endforeach
@if(count($datas) > 3)
<div class="view-all">
    <a class="text-capitalize" href="{{ route('produk') }}">lihat semua produk</a>
</div>
@endif