@foreach($datas->take(3) as $promo)
<a class="item-search-list" href="{{ route('promo.detail', [$promo->kode]) }}">
    <div class="display_grid grid-global-search --gr-prdct">
        <div class="search-img-container">
            <div class="search-img img-lazy loaded" style="background-image: url('{{ $promo->image }}')"></div>
        </div>
        <div>
            <h6 class="truncate-texts --two">
                {{$promo->title}}
            </h6>
            <h6 class="price text-capitalize truncate-texts">
                poin : {{$promo->poin_required}}
            </h6>
        </div>
    </div>
</a>
@endforeach
@if(count($datas) > 3)
<div class="view-all">
    <a class="text-capitalize" href="{{ route('promo') }}">lihat semua promo</a>
</div>
@endif
