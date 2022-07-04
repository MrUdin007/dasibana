<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Admin = DB::select('select * from admins');
            return Datatables::of($Admin)
                    ->addIndexColumn()
                    ->addColumn('action', function($url){
                        $slug= asset($url->slug);
                        return '<a href="'.$slug.'" class="edit btn btn-primary btn-sm">View</a>';
                    })
                    ->rawColumns(['action'])->make(true);
        }
        return view('manage.admin.index');
    }

    public function add(Request $request)
    {
        return view('manage.admin.form');
    }

    public function edit(Request $request)
    {
        return view('manage.admin.form');
    }
}
