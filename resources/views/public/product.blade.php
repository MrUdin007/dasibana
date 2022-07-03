@extends('layouts.fe.app')

@push('title')
<title>Produk Dasibana</title>
@endpush

@push('css')
    <link rel="stylesheet" href="{{asset('dist/fe/css/product.css')}}"/>
@endpush

@section('content')
    <section class="product-dasibana">
        <div class="banner-product" style="background-image: url('{{asset('images/pic2.jpg')}}')">
            <div class="bg-overlay-banner"></div>
            <h3>semua produk</h3>
        </div>
        <div class="container section-ct">
            <div class="gr_display gr-prodc">
                @if(count($products) > 0)
                @foreach($products as $product)
                <div class="produk-item">
                    <div class="pic-produk" style="background-image: url('{{asset($product->fotoProduk)}}')">
                        <div class="bottom-hidden-btn">
                            <div class="gr_display gr-btn-prdc">
                                <a class="pc-btn-prdct --shopee" target="_blank" href={{$product->link_shopee}} style="background-image: url('{{asset('images/icons/shopee.png')}}')"></a>
                                <a class="pc-btn-prdct --tokped" target="_blank" href={{$product->link_tokopedia}} style="background-image: url('{{asset('images/icons/tokopedia.png')}}')"></a>
                            </div>
                            <div class="overlay-btns-prd"></div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection


@push('scripts')

@endpush
