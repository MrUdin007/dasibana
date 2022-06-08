<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $ProdukKategori = DB::select('select * from produkkategori');
            return Datatables::of($ProdukKategori)
                    ->addIndexColumn()
                    ->addColumn('status', function($status){
                        if($status->status === 1){
                            $pills = '<div class="tt-status"><span class="badge badge-pill badge-success">Active</span></div>';
                        }
                        else{
                            $pills = '<div class="tt-status"><span class="badge badge-pill badge-secondary">Inactive</span></div>';
                        }
                        return $pills;
                    })
                    ->addColumn('action', function($url){
                        $slug= asset($url->slug);
                        return '<a href="'.$slug.'" class="edit btn btn-primary btn-sm">View</a>';
                    })
                    ->rawColumns(['action'])->make(true);
        }
        return view('manage.produkkategori.index');
    }
}
