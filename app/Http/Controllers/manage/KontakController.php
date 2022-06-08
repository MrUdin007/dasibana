<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class KontakController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Kontak = DB::select('select * from kontak');
            return Datatables::of($Kontak)
                    ->addIndexColumn()
                    ->addColumn('action', function($url){
                        $slug= asset($url->slug);
                        return '<a href="'.$slug.'" class="edit btn btn-primary btn-sm">View</a>';
                    })
                    ->rawColumns(['action'])->make(true);
        }
        return view('manage.kontak.index');
    }
}
