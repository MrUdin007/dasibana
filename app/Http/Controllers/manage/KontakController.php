<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class KontakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Profile = DB::select("select * from profil");
            return Datatables::of($Profile)
                    ->addIndexColumn()
                    ->addColumn('action', function($url){
                        $slug= asset($url->slug);
                        return '<a href="'.$slug.'" class="edit btn btn-primary btn-sm">View</a>';
                    })
                    ->rawColumns(['action'])->make(true);
        }
        return view('manage.kontak.index');
    }

    public function add(Request $request)
    {
        return view('manage.kontak.form');
    }

    public function edit(Request $request)
    {
        return view('manage.kontak.form');
    }
}
