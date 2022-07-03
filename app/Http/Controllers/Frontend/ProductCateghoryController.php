<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\KategoriProduk;
use App\Models\Produk;
use Carbon\Carbon;
use DB;
use Mail;
use Hash;

class ProductCateghoryController extends Controller
{
    public function index(Request $req)
    {
        $kategori_produk    =   KategoriProduk::selectRaw('kategori_produk.id, kategori_produk.name as kategoriName, kategori_produk.slug as urlKategori')
                                ->where('kategori_produk.status', 1)
                                ->orderBy('kategori_produk.created_at', 'DESC')
                                ->get();

        return view('public.categhory.index', compact(
            'kategori_produk'
        ));
    }

    public function detail(Request $req)
    {
        if($req->slug){
            $kategori_produk    =   KategoriProduk::selectRaw('kategori_produk.name')
                                    ->first();

            $products = KategoriProduk::selectRaw('kategori_produk.name, produk.name as produkName, produk.foto, produk.link_shopee, produk.link_tokopedia')
                        ->leftJoin('produk','produk.id_kategori','=','kategori_produk.id')
                        ->where('kategori_produk.slug', $req->slug)
                        ->where('kategori_produk.status', 1)
                        ->where('produk.status', 1)
                        ->orderBy('produk.created_at', 'DESC')
                        ->get();
        }

        return view('public.categhory.detail', compact(
            'kategori_produk',
            'products'
        ));
    }
}
