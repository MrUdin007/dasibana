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
        $sosmed =   Sosmed::selectRaw('sosmed.id, sosmed.name as nameSosmed, sosmed.ikon as ikonSosmed, sosmed.slug as urlSosmed')
                    ->where('sosmed.status', 1)
                    ->orderBy('sosmed.created_at', 'DESC')
                    ->get();

        $profil = Profil::select('*')->first();

        return view('public.product', compact(
            'sosmed',
            'profil'
        ));
    }
}
