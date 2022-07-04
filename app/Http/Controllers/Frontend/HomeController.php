<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\KategoriProduk;
use App\Models\Produk;
use App\Models\Profil;
use Carbon\Carbon;
use DB;
use Mail;
use Hash;

class HomeController extends Controller
{
    public function index(Request $req)
    {
        $produk_terbaru     =   Produk::selectRaw('produk.id, produk.foto as fotoProduk, produk.link_shopee, produk.link_tokopedia')
                                ->where('produk.status', 1)
                                ->orderBy('produk.created_at', 'DESC')
                                ->take(12)
                                ->get();

        $kategori_produk    =  KategoriProduk::selectRaw('kategori_produk.id, kategori_produk.name as kategoriName, kategori_produk.slug')
                                ->where('kategori_produk.status', 1)
                                ->orderBy('kategori_produk.created_at', 'DESC')
                                ->get();

        $profil = Profil::select('*')->first();

        return view('public.home', compact(
            'produk_terbaru',
            'kategori_produk',
            'profil'
        ));
    }
}

