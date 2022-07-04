<?php
    use App\Models\KategoriProduk;
?>

<div class="header-dasibana">
    <nav class="navbar navbar-expand-md fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{asset('images/dasibana.png')}}" alt="">
                </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse menu-header" id="navbarCollapse">
                <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item {{ (Route::is('home')) ? 'active' : '' }}">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">beranda</a>
                    </li>
                    <?php
                        $kategori_produk    =   KategoriProduk::selectRaw('kategori_produk.id, kategori_produk.name as kategoriName, kategori_produk.slug as urlKategori')
                                                ->where('kategori_produk.status', 1)
                                                ->orderBy('kategori_produk.created_at', 'DESC')
                                                ->get();
                    ?>
                    @if(count($kategori_produk) > 0)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ (Route::is('product_categhory')) ? 'active' : '' }}" href="{{ route('product_categhory') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            kategori produk
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($kategori_produk as $produkKategori)
                            <li>
                                <a id={{$produkKategori->id}} class="dropdown-item" href="{{ route('detail_categhory', [$produkKategori->urlKategori]) }}">
                                    {{$produkKategori->kategoriName}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                    <li class="nav-item {{ (Route::is('product')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('product') }}">produk</a>
                    </li>
                    <li class="nav-item {{ (Route::is('about')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('about') }}">tentang kami</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
