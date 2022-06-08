<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use App\Models\Product;
use Carbon\Carbon;
use Yajra\Datatables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function product(Request $request)
    {
        $products = Product::all();

        return view('manage.produk.index', compact('products'));
    }
}

