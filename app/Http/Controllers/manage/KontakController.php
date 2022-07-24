<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Profil; //mendefinisikan table profile yang sudah terdapat di models
use Carbon\Carbon;
use DataTables;
use Mail;
use Hash;


class KontakController extends Controller
{
    public function __construct() //
    {
        $this->middleware('auth'); //hanya bisa diakses kalau user telah login
    }

    public function index(Request $request) //hanya manggil index.blade yang isinya ada datatable sama view modal
    {
        return view('manage.kontak.index');
    }

    public function getData(Request $req) //ambil data dari database dan di set di datatable
    {
        $columns = array(
            0 => "profil.id",
            1 => "profil.nama_bisnis",
            2 => "profil.pemilik",
            3 => "profil.deskripsi",
        );

        $columns_alias = array(
            0 => "profil.id",
            1 => "profil.nama_bisnis",
            2 => "profil.pemilik",
            3 => "profil.deskripsi",
        );

        $limit = $req->length; //banyak data pagination
        $start = $req->start; //menunjukan jumlah data pada tiap pagination
        $order = $columns[$req->order[0]['column']]; //menyingkronisasikan data pada datatable berdasarkan coloum database
        $dir   = $req->order[0]['dir']; //menyingkronisasikan data pada datatable berdasarkan directory database pada saat pindah halaman datatable
        $search = $req->search['value']; //mengambil data yg diinput pada search field

        $kontak = Profil::select($columns_alias); //manggil datatable dari database berdasarkan column_alies
        $kontak->where('profil.deleted_at', null);
        $kontak->orderBy('profil.created_at', 'DESC');

        $total_data = $kontak->count();
        $filtered_data = $kontak->count();
        $kontak->orderBy($order,$dir); //

        if ($search) {
            $kontak->Where('profil.nama_bisnis','LIKE',"%{$search}%");
            $kontak->orWhere('profil.pemilik','LIKE',"%{$search}%");
            $filtered_data = $kontak->count();
        }
        $data = array();
        foreach ($kontak->get() as $key => $val) // pengulangan untuk manggil tiap data kontak dari database
        {
            $action = '<div class="button-group">';
            $action .='
                <a href="javascript:void(0)" title="view" class="btn btn-sm btn-rounded btn-outline-info" onclick="openKontak('.$val->id.')">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-eye"></i>
                    </span>
                </a>
            ';

            $action .='
                <a href="'.route('kontak.edit',$val->id).'" title="edit"  class="btn btn-sm btn-rounded btn-outline-success">
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

    public function form($id=null) //menampilkan data kontak berdasarkan tombol edit yang ditekan
    {

        $kontak = Profil::find($id);

        return view('manage.kontak.form', [
            'kontak' => $kontak
        ]);
    }
    public function view(Request $req)
    {
        $kontak = Profil::find($req->id);
        if ($req->ajax()) {
            return response()->json([
                'success'         => true,
                'alamat'          => $kontak->alamat,
                'tahun'           => $kontak->tahun,
                'nama_bisnis'     => $kontak->nama_bisnis,
                'pemilik'         => $kontak->pemilik,
                'deskripsi'       => $kontak->deskripsi,
            ]);
        }

        return 'html';
    }
    public function save(Request $req, $id=null) //menyimpan data kedalam database dari halaman edit atau add
    {
        if($id){
            $validator = Validator::make($req->all(), [
                'alamat'        => 'required|string|max:500',
                'tahun'         => 'required|string|max:4',
                'nama_bisnis'   => 'required|string|max:255',
                'pemilik'       => 'required|string|max:255',
                'deskripsi'     => 'required|string|max:500',
            ]);

            if ($validator->fails()) {
                $req->session()->flash('status', 'Data gagal diubah!');
                return redirect()->route('kontak.edit', $id);
            }

            $kontak = Profil::find($id);
        }else{
            $validator = Validator::make($req->all(), [
                'alamat'        => 'required|string|max:500',
                'tahun'         => 'required|string|max:4',
                'nama_bisnis'   => 'required|string|max:255',
                'pemilik'       => 'required|string|max:255',
                'deskripsi'     => 'required|string|max:500',
            ]);

            if ($validator->fails()) {
                $req->session()->flash('status', 'Data baru gagal dimasukkan!');
                return redirect()->route('kontak.add', $id);
            }
            $kontak = new Profil;
            $same_slug = Profil::where('slug','like',Str::slug($req->nama_bisnis).'%')->count();
            if ($same_slug > 0) {
                $slug = Str::slug($req->nama_bisnis.' '.$same_slug);
            } else {
                $slug = Str::slug($req->nama_bisnis);
            }
            $kontak->slug = $slug;
        }

        // Save data
        $kontak->alamat          = $req->alamat;
        $kontak->tahun           = $req->tahun;
        $kontak->nama_bisnis     = $req->nama_bisnis;
        $kontak->pemilik         = $req->pemilik;
        $kontak->deskripsi       = $req->deskripsi;

        if(!$id) {
            $kontak->created_at = Carbon::now()->format('Y-m-d');
            $kontak->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        }

        $kontak->save();
        $req->session()->flash('status', 'Data berhasil dimasukkan!');
        return redirect()->route('kontak.index');
    }

    public function delete(Request $req, $id) //menghapus data dari database berdasarkan id tombol delete yg ditekan
    {

        $kontak = Profil::find($id);
        $kontak->deleted_at  = Carbon::now()->format('Y-m-d');
        $kontak->save();

        $req->session()->flash('status', 'Data berhasil dihapus!');
        return redirect()->route('kontak.index');
    }
    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $kontak = DB::select('select * from kontak');
    //         return Datatables::of($kontak)
    //                 ->addIndexColumn()
    //                 ->addColumn('tahun', function($pic){
    //                     $url= asset($pic->tahun);
    //                     return '<img src="'.$url.'" alt="'.$url.'">';
    //                 })
    //                 ->addColumn('action', function($url){
    //                     $slug= asset($url->slug);
    //                     return '<a href="'.$slug.'" class="edit btn btn-primary btn-sm">View</a>';
    //                 })
    //                 ->rawColumns(['action','tahun'])->make(true);
    //     }
    //     return view('manage.kontak.index');
    // }
}
