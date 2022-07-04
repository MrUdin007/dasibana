<?php
    use App\Models\KategoriProduk;
    use App\Models\Sosmed;
?>

<div class="footer-dasibana">
    <div class="container">
        <div class="top-footer section-ct">
            <div class="gr_display gr-footer">
                <div class="menu-footer">
                    <h4 class="title-footer">kategori produk</h4>
                    <div class="gr_display gr-footer-kategori">
                        <?php
                            $kategori_produk    =   KategoriProduk::selectRaw('kategori_produk.id, kategori_produk.name as kategoriName, kategori_produk.slug as urlKategori')
                                                    ->where('kategori_produk.status', 1)
                                                    ->orderBy('kategori_produk.created_at', 'DESC')
                                                    ->take(10)
                                                    ->get();
                        ?>
                        @if(count($kategori_produk) > 0)
                        @foreach($kategori_produk as $produkKategori)
                        <div class="ls-kategori-ft">
                            <a id={{$produkKategori->id}} href="{{ route('detail_categhory', [$produkKategori->urlKategori]) }}">
                                {{$produkKategori->kategoriName}}
                            </a>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="ft-sosmed">
                    <h4 class="title-footer">ikuti kami</h4>
                    <div class="menu-sosmed gr_display mb-3">
                        <?php
                            $sosmed    =   Sosmed::selectRaw('sosmed.id, sosmed.name as nameSosmed, sosmed.ikon as ikonSosmed, sosmed.slug as urlSosmed')
                                            ->where('sosmed.status', 1)
                                            ->orderBy('sosmed.created_at', 'DESC')
                                            ->get();
                        ?>
                        @if(count($sosmed) > 0)
                        @foreach($sosmed as $sosmeds)
                        <a href={{$sosmeds->urlSosmed}} target="_blank" id={{$sosmeds->id}}>
                            <div class="footer-icn-smd @if($sosmeds->nameSosmed == 'dasibanaTokopedia') --tokped @endif"style="background-image: url('{{asset($sosmeds->ikonSosmed)}}')"></div>
                        </a>
                        @endforeach
                        @endif
                    </div>
                    <a href="{{ route('about') }}">
                        tentang kami
                    </a>
                </div>
                <div class="logo-footer">
                    <div class="footer-icn-smd-lg" style="background-image: url('{{asset('images/icon.png')}}')"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer">
        <p class="mb-0">© Dasibana.com - 2022</p>
    </div>
</div>
