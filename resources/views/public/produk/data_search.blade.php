@if(count($products) > 0)
<div class="grid_layouts prdct-gr">
    @foreach($products as $p)
        @include('public.produk.card_product',['produk'=>$p,'not_slide'=>true])
    @endforeach
</div>
@else
<!-- Start Tidak Ada Produk -->
<div class="no-post-list">
    <div class="img-no-post img-lazy small-lazy" data-src="{{ asset('dist/fe/icons/produk-empty.png') }}" style="height: 300px;"></div>
    <div class="desc-no-post">
        <h6 class="text-capitalize f-Asap_medium main-sub-text">Mohon maaf, produk yang Anda cari tidak ditemukan.</h6>
    </div>
</div>
<!-- End:/ Tidak Ada Produk -->
@endif

<!-- Pagination -->
<!-- ============================================================== -->
{{ $products->appends($param)->links('layouts.fe.pagination') }}
<!-- ============================================================== -->
<!-- End Pagination -->