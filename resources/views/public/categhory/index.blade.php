@extends('layouts.fe.app')

@push('title')
<title>Kategori Produk Dasibana</title>
@endpush

@push('css')
    <link rel="stylesheet" href="{{asset('dist/fe/css/categhory.css')}}"/>
@endpush

@section('content')
    <section class="categhory-dasibana">
        <div class="banner-categhory" style="background-image: url('{{asset('images/pic1.jpg')}}')">
            <div class="bg-overlay-banner"></div>
            <h3 class="subs-title">kategori produk</h3>
        </div>
        <div class="box-ct-section">
            <div class="container section-ct">
                <div class="gr_display categhory-content">
                    @if(count($kategori_produk) > 0)
                    @foreach($kategori_produk as $kategori)
                    <div class="categhory-lists">
                        <div class="parallax-slides"></div>
                        <div class="ct-cat">
                            <a href="{{ route('detail_categhory', [$kategori->urlKategori]) }}">{{$kategori->kategoriName}}</a>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')

@endpush
