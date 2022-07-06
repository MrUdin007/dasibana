<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
        $admin->where('admins.deleted_at', null);

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
                <a href="javascript:void(0)" title="view" class="btn btn-sm btn-rounded btn-info" onclick="openAdmin('.$val->id.')">
                    <i class="fa fa-eye"></i>
                </a>
            ';

            $action .='
                <a href="'.route('admin.edit',$val->id).'" title="edit"  class="btn btn-sm btn-rounded btn-warning">
                    <i class="fa fa-edit"></i>
                </a>
            ';

            $action .='
                <a href="javascript:void(0)" title="delete" class="btn btn-sm btn-rounded btn-danger" onclick="deleteAdmin(\'delete-form-'.$val->id.'\')">
                    <i class="fa fa-trash"></i>
                </a>
                <form id="delete-form-'.$val->id.'" action="'.route('admin.delete',$val->id).'" method="POST" style="display: none;">'.csrf_field().'</form>
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
                'created_at'    => $admin->created_at,
                'username'      => $admin->username,
                'email'         => $admin->email,
            ]);
        }

        return 'html';
    }

    public function save(Request $req, $id=null)
    {
        if($id){
            $admin = Admin::find($id);
        }else{
            $admin = new Admin;
            $same_slug = Admin::where('slug','like',str_slug($req->id).'%')->count();
            if ($same_slug > 0) {
                $slug = str_slug($req->id.' '.$same_slug);
            } else {
                $slug = str_slug($req->id);
            }
            $admin->slug = $slug;
        }

        // Save data
        $admin->name       = $req->name;
        $admin->username   = $req->username;
        $admin->email      = $req->email;
        $admin->password   = $req->password;
        if(!$id) {
            $admin->created_at = Carbon::now()->format('Y-m-d');
            $admin->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        }
        $admin->save();

        if($id) {
            $req->session()->flash('status', 'Edit Record Success!');
            return redirect()->route('admin.edit', $id);
        }else{
            $req->session()->flash('status', 'Add Record Success!');
            return redirect()->route('admin.add');
        }
    }

    public function delete(Request $req, $id)
    {

        $admin = Admin::find($id);
        $admin->deleted_at  = Carbon::now()->format('Y-m-d');
        $admin->save();

        $req->session()->flash('status', 'Delete Success!');
        return redirect()->route('admin.index');
    }
}
