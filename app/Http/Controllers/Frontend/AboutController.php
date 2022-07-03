<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Profil;
use Carbon\Carbon;
use DB;
use Mail;
use Hash;

class AboutController extends Controller
{
    public function index(Request $req)
    {
        $profil = Profil::select('*')->first();

        return view('public.about', compact(
            'profil'
        ));
    }
}
