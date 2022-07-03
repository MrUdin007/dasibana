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

class ProductController extends Controller
{
    public function index(Request $req)
    {
        $products     =   Produk::selectRaw('produk.id, produk.foto as fotoProduk, produk.link_shopee, produk.link_tokopedia')
                        ->where('produk.status', 1)
                        ->orderBy('produk.created_at', 'DESC')
                        ->get();

        $kategori_produk    =  KategoriProduk::selectRaw('kategori_produk.id, kategori_produk.name as kategoriName')
                                ->where('kategori_produk.status', 1)
                                ->orderBy('kategori_produk.created_at', 'DESC')
                                ->get();

        return view('public.product', compact(
            'products',
            'kategori_produk'
        ));
    }
}
