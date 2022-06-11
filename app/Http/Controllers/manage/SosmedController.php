<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class SosmedController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Sosmed = DB::select('select * from sosmed');
            return Datatables::of($Sosmed)
                    ->addIndexColumn()
                    ->addColumn('icon', function($pic){
                        $url= asset($pic->icon);
                        return '<img src="'.$url.'" alt="'.$url.'">';
                    })
                    ->addColumn('action', function($url){
                        $slug= asset($url->slug);
                        return '<a href="'.$slug.'" class="edit btn btn-primary btn-sm">View</a>';
                    })
                    ->rawColumns(['action','icon'])->make(true);
        }
        return view('manage.sosmed.index');
    }
}
