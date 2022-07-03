<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\KategoriProduk;
use Carbon\Carbon;
use DB;
use Mail;
use Hash;

class ProductCateghoryController extends Controller
{
    public function index(Request $req)
    {
        $kategori_produk    =   KategoriProduk::selectRaw('kategori_produk.id, kategori_produk.name as kategoriName')
                                ->where('kategori_produk.status', 1)
                                ->orderBy('kategori_produk.created_at', 'DESC')
                                ->get();

        return view('public.categhory.index', compact(
            'kategori_produk'
        ));
    }

    // public function detail(Request $req)
    // {
    //     $kategori_produk    =   KategoriProduk::selectRaw('kategori_produk.id, kategori_produk.name as kategoriName')
    //                             ->where('kategori_produk.status', 1)
    //                             ->orderBy('kategori_produk.created_at', 'DESC')
    //                             ->get();

    //     return view('public.categhory.detail', compact(
    //         'detail_kategori'
    //     ));
    // }
}
