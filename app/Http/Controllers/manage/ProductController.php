<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use App\Models\Product;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Product = DB::select('select * from produk');
            return Datatables::of($Product)
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
                    ->addColumn('foto', function($pic){
                        $url= asset($pic->foto);
                        return '<img src="'.$url.'" alt="'.$url.'">';
                    })
                    ->addColumn('action', function($url){
                        $slug= asset($url->id);
                        return '<a href="'.$slug.'" class="edit btn btn-primary btn-sm">View</a>';
                    })
                    ->rawColumns(['foto','action'])->make(true);
        }
        return view('manage.produk.index');
    }
}
