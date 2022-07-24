<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use Carbon\Carbon;
use DataTables;
use Mail;
use Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('manage.admin.index');
    }

    public function getData(Request $req)
    {
        $columns = array(
            0 => "admins.id",
            1 => "admins.name",
            2 => "admins.username",
            3 => "admins.email",
        );

        $columns_alias = array(
            0 => "admins.id",
            1 => "admins.name",
            2 => "admins.username",
            3 => "admins.email",
        );

        $limit = $req->length;
        $start = $req->start;
        $order = $columns[$req->order[0]['column']];
        $dir   = $req->order[0]['dir'];
        $search = $req->search['value'];

        $admin = Admin::select($columns_alias);
        $admin->orderBy('admins.created_at', 'DESC');

        $total_data = $admin->count();
        $filtered_data = $admin->count();
        $admin->orderBy($order,$dir);

        if ($search) {
            $admin->where('admins.name','LIKE',"%{$search}%");
            $admin->orWhere('admins.username','LIKE',"%{$search}%");
            $admin->orWhere('admins.email','LIKE',"%{$search}%");
            $filtered_data = $admin->count();
        }
        $data = array();
        foreach ($admin->get() as $key => $val)
        {
            $action = '<div class="button-group">';
            $action .='
                <a href="javascript:void(0)" title="view" class="btn btn-sm btn-rounded btn-outline-info" onclick="openAdmin('.$val->id.')">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-eye"></i>
                    </span>
                </a>
            ';

            $action .='
                <a href="'.route('admin.edit',$val->id).'" title="edit"  class="btn btn-sm btn-rounded btn-outline-success">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-pencil-alt"></i>
                    </span>
                </a>
            ';
            $action .= '</div>';

            $data[$key] = $val->toArray();
            $data[$key]['no'] = $key+$start+1;
            $data[$key]['action'] = $action;
        }

        return response()->json([
            'order'             => $order,
            'draw'              => $req->draw,
            'recordsTotal'      => $total_data,
            'recordsFiltered'   => $filtered_data,
            'data'              => $data,
        ]);
    }

    public function form($id=null)
    {

        $admin = Admin::find($id);

        return view('manage.admin.form', [
            'admin' => $admin
        ]);
    }

    public function view(Request $req)
    {
        $admin = Admin::find($req->id);
        if ($req->ajax()) {
            return response()->json([
                'success'       => true,
                'name'          => $admin->name,
                'username'      => $admin->username,
                'email'         => $admin->email,
            ]);
        }

        return 'html';
    }

    public function save(Request $req, $id=null)
    {
        if($id){
            $validator = Validator::make($req->all(), [
                'username' => 'required|string|max:255|unique:admins,username',
                'email'     => 'required|string|unique:admins,email,'.$id,
            ]);

            if ($validator->fails()) {
                $req->session()->flash('status', 'Data gagal diubah!');
                return redirect()->route('admin.edit', $id);
            }

            $admin = Admin::find($id);
        }else{
            $admin = new Admin;
            $same_slug = Admin::where('slug','like',Str::slug($req->name).'%')->count();
            if ($same_slug > 0) {
                $slug = Str::slug($req->name.' '.$same_slug);
            } else {
                $slug = Str::slug($req->name);
            }
            $admin->slug = $slug;
        }

        // Save data
        $admin->name       = $req->name;
        $admin->username   = $req->username;
        $admin->email      = $req->email;
        $admin->password   = bcrypt(sha1($req->password));
        if(!$id) {
            $admin->created_at = Carbon::now()->format('Y-m-d');
            $admin->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        }

        $admin->save();
        $req->session()->flash('status', 'Data berhasil dimasukkan!');
        return redirect()->route('admin.index');
    }
}
