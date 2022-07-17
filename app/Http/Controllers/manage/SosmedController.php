<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Sosmed;
use Carbon\Carbon;
use DataTables;
use Mail;
use Hash;


class SosmedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('manage.sosmed.index');
    }

    public function getData(Request $req)
    {
        $columns = array(
            0 => "sosmed.id",
            1 => "sosmed.name",
            2 => "sosmed.ikon",
            3 => "sosmed.status",
        );

        $columns_alias = array(
            0 => "sosmed.id",
            1 => "sosmed.name",
            2 => "sosmed.ikon",
            3 => "sosmed.status",
        );

        $limit = $req->length; //banyak data pagination
        $start = $req->start; //menunjukan jumlah data pada tiap pagination
        $order = $columns[$req->order[0]['column']]; //menyingkronisasikan data pada datatable berdasarkan coloum database
        $dir   = $req->order[0]['dir']; //menyingkronisasikan data pada datatable berdasarkan directory database pada saat pindah halaman datatable
        $search = $req->search['value']; //mengambil data yg diinput pada search field

        $sosmed = Sosmed::select($columns_alias); //manggil datatable dari database berdasarkan column_alies
        $sosmed->where('sosmed.deleted_at', null);
        $sosmed->orderBy('sosmed.created_at', 'DESC');

        $total_data = $sosmed->count();
        $filtered_data = $sosmed->count();
        $sosmed->orderBy($order,$dir); //

        if ($search) {
            $sosmed->where('sosmed.name','LIKE',"%{$search}%");
            $filtered_data = $sosmed->count();
        }
        $data = array();
        foreach ($sosmed->get() as $key => $val) // pengulangan untuk manggil tiap data sosmed dari database
        {
            $action = '<div class="button-group">';
            $action .='
                <a href="javascript:void(0)" title="view" class="btn btn-sm btn-rounded btn-outline-info" onclick="openSosmed('.$val->id.')">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-eye"></i>
                    </span>
                </a>
            ';

            $action .='
                <a href="'.route('sosmed.edit',$val->id).'" title="edit"  class="btn btn-sm btn-rounded btn-outline-success">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-pencil-alt"></i>
                    </span>
                </a>
            ';

            $action .='
                <a href="javascript:void(0)" title="delete" class="btn btn-sm btn-rounded btn-outline-danger" onclick="deleteSosmed(\'delete-form-'.$val->id.'\')">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-trash"></i>
                    </span>
                </a>
                <form id="delete-form-'.$val->id.'" action="'.route('sosmed.delete',$val->id).'" method="POST" style="display: none;">'.csrf_field().'</form>
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

        $sosmed = Sosmed::find($id);

        return view('manage.sosmed.form', [
            'sosmed' => $sosmed
        ]);
    }

    public function view(Request $req)
    {
        $sosmed = Sosmed::find($req->id);
        if ($req->ajax()) {
            return response()->json([
                'success'       => true,
                'name'          => $sosmed->name,
            ]);
        }

        return 'html';
    }
    public function save(Request $req, $id=null)
    {
        if($id){
            $validator = Validator::make($req->all(), [
                'name' => 'required|string|max:255|unique:sosmed,name',
                'ikon'     => 'required|string|max:255|unique:sosmed,ikon,'.$id,
                'status'     => 'required|string|unique:sosmed,status,'.$id,
            ]);

            if ($validator->fails()) {
                $req->session()->flash('status', 'Data gagal diubah!');
                return redirect()->route('sosmed.edit', $id);
            }

            $sosmed = Sosmed::find($id);
        }else{
            $validator = Validator::make($req->all(), [
                'name' => 'required|string|max:255|unique:sosmed,name',
                'ikon'     => 'required|string|max:255|unique:sosmed,ikon,'.$id,
                'status'     => 'required|string|unique:sosmed,status,'.$id,
            ]);

            if ($validator->fails()) {
                $req->session()->flash('status', 'Data baru gagal dimasukkan!');
                return redirect()->route('sosmed.add', $id);
            }
            $sosmed = new Sosmed;
            $same_slug = Sosmed::where('slug','like',Str::slug($req->name).'%')->count();
            if ($same_slug > 0) {
                $slug = Str::slug($req->name.' '.$same_slug);
            } else {
                $slug = Str::slug($req->name);
            }
            $sosmed->slug = $slug;
        }

        // Save data
        $sosmed->name       = $req->name;
        $sosmed->ikon       = $req->ikon;
        $sosmed->status     = $req->status;

        if(!$id) {
            $sosmed->created_at = Carbon::now()->format('Y-m-d');
            $sosmed->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        }

        $sosmed->save();
        $req->session()->flash('status', 'Data berhasil dimasukkan!');
        return redirect()->route('sosmed.index');
    }

    public function delete(Request $req, $id)
    {

        $sosmed = Sosmed::find($id);
        $sosmed->deleted_at  = Carbon::now()->format('Y-m-d');
        $sosmed->save();

        $req->session()->flash('status', 'Data berhasil dihapus!');
        return redirect()->route('sosmed.index');
    }
    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $Sosmed = DB::select('select * from sosmed');
    //         return Datatables::of($Sosmed)
    //                 ->addIndexColumn()
    //                 ->addColumn('ikon', function($pic){
    //                     $url= asset($pic->ikon);
    //                     return '<img src="'.$url.'" alt="'.$url.'">';
    //                 })
    //                 ->addColumn('action', function($url){
    //                     $slug= asset($url->slug);
    //                     return '<a href="'.$slug.'" class="edit btn btn-primary btn-sm">View</a>';
    //                 })
    //                 ->rawColumns(['action','ikon'])->make(true);
    //     }
    //     return view('manage.sosmed.index');
    // }
}
