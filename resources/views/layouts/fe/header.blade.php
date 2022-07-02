<?php
    use App\Models\KategoriProduk;
?>

<div class="header-dasibana">
    <nav class="navbar navbar-expand-md fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/')}}">
                    <img src="{{asset('images/dasibana.png')}}" alt="">
                </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse menu-header" id="navbarCollapse">
                <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <!-- <a class="nav-link {{ (Route::is('home')) ? 'active' : '' }}" aria-current="page" href="#">beranda</a> -->
                        <a class="nav-link active" aria-current="page" href="#">beranda</a>
                    </li>
                    <?php
                        $kategori_produk    =   KategoriProduk::selectRaw('kategori_produk.id, kategori_produk.name as kategoriName, kategori_produk.slug as urlProduk')
                                                ->where('kategori_produk.status', 1)
                                                ->orderBy('kategori_produk.created_at', 'DESC')
                                                ->get();
                    ?>
                    @if(count($kategori_produk) > 0)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            produk
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($kategori_produk as $produkKategori)
                            <li>
                                <a id={{$produkKategori->id}} class="dropdown-item" href={{$produkKategori->urlProduk}}>
                                    {{$produkKategori->kategoriName}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="#">tentang kami</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
