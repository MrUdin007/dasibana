<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Produk;
use App\Models\KategoriProduk;
use Carbon\Carbon;
use DataTables;
use Mail;
use Hash;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('manage.produk.index');
    }

    public function getData(Request $req)
    {
        $columns = array(
            0 => "produk.id",
            1 => "produk.name",
            2 => "produk.status",
            3 => "produk.foto",
        );

        $columns_alias = array(
            0 => "produk.id",
            1 => "produk.name",
            2 => "produk.status",
            3 => "produk.foto",
        );

        $limit = $req->length; //banyak data pagination
        $start = $req->start; //menunjukan jumlah data pada tiap pagination
        $order = $columns[$req->order[0]['column']]; //menyingkronisasikan data pada datatable berdasarkan coloum database
        $dir   = $req->order[0]['dir']; //menyingkronisasikan data pada datatable berdasarkan directory database pada saat pindah halaman datatable
        $search = $req->search['value']; //mengambil data yg diinput pada search field

        $produk = Produk::select($columns_alias); //manggil datatable dari database berdasarkan column_alies
        $produk->where('produk.deleted_at', null);
        $produk->orderBy('produk.created_at', 'DESC');

        $total_data = $produk->count();
        $filtered_data = $produk->count();
        $produk->orderBy($order,$dir); //

        if ($search) {
            $produk->where('produk.name','LIKE',"%{$search}%");
            $filtered_data = $produk->count();
        }
        $data = array();
        foreach ($produk->get() as $key => $val) // pengulangan untuk manggil tiap data produk dari database
        {
            $action = '<div class="button-group">';
            $action .='
                <a href="javascript:void(0)" title="view" class="btn btn-sm btn-rounded btn-outline-info" onclick="openproduk('.$val->id.')">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-eye"></i>
                    </span>
                </a>
            ';

            $action .='
                <a href="'.route('produk.edit',$val->id).'" title="edit"  class="btn btn-sm btn-rounded btn-outline-success">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-pencil-alt"></i>
                    </span>
                </a>
            ';

            $action .='
                <a href="javascript:void(0)" title="delete" class="btn btn-sm btn-rounded btn-outline-danger" onclick="deleteproduk(\'delete-form-'.$val->id.'\')">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-trash"></i>
                    </span>
                </a>
                <form id="delete-form-'.$val->id.'" action="'.route('produk.delete',$val->id).'" method="POST" style="display: none;">'.csrf_field().'</form>
            ';
            $action .= '</div>';

            $url= asset($val->foto);
            $image = '<img src="'.$url.'" alt="'.$val->name.'">';

            if($val->status === 1){
                $status = '<span class="badge bg-success dasibana-badge">Aktif</span>';
            }
            else{
                $status = '<span class="badge bg-secondary dasibana-badge">Tidak Aktif</span>';
            }

            $data[$key] = $val->toArray();
            $data[$key]['no'] = $key+$start+1;
            $data[$key]['foto'] = $image;
            $data[$key]['status'] = $status;
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

        $produk = Produk::find($id);
        $kategoriProduk = KategoriProduk::where('kategori_produk.status', 1)
                        ->where('kategori_produk.deleted_at', null)
                        ->orderBy('kategori_produk.created_at', 'DESC')
                        ->get();

        return view('manage.produk.form', [
            'produk'            => $produk,
            'kategoriProduk'    => $kategoriProduk
        ]);
    }

    public function view(Request $req)
    {
        $produk = Produk::find($req->id);
        $url= asset($produk->foto);
        $image = '<img src="'.$url.'" alt="'.$url.'" style="width: 60px;">';

        if ($req->ajax()) {
            return response()->json([
                'success'       => true,
                'name'          => $produk->name,
                'foto'          => $image,
            ]);
        }

        return 'html';
    }

    public function save(Request $req, $id=null)
    {
        if($id){
            if($req->name != null && $req->foto != null && $req->id_kategori != null && $req->link_shopee != null && $req->link_tokopedia != null){
                $validator = Validator::make($req->all(), [
                    'name'              => 'required|string|max:255',
                    'foto'              => 'required|image|max:1024|mimes:jpg,jpeg,png',
                    'id_kategori'       => 'required|integer|max:11',
                    'link_shopee'       => 'required|string',
                    'link_tokopedia'    => 'required|string',
                ]);

                if ($validator->fails()) {
                    $req->session()->flash('status', 'Data gagal diubah!');
                    return redirect()->route('produk.edit', $id);
                }
            }

            $produk = Produk::find($id);
        }else{
            $validator = Validator::make($req->all(), [
                'name'              => 'required|string|max:255',
                'foto'              => 'required|image|max:1024|mimes:jpg,jpeg,png',
                'id_kategori'       => 'required|integer|max:11',
                'link_shopee'       => 'required|string',
                'link_tokopedia'    => 'required|string',
            ]);

            if ($validator->fails()) {
                $req->session()->flash('status', 'Data baru gagal dimasukkan!');
                return redirect()->route('produk.add', $id);
            }
            $produk         = new Produk;
            $same_slug      = Produk::where('slug','like',Str::slug($req->name).'%')->count();
            if ($same_slug > 0) {
                $slug = Str::slug($req->name.' '.$same_slug);
            } else {
                $slug = Str::slug($req->name);
            }
            $produk->slug = $slug;
        }

        // directory image
        $dir = 'images/foto-produk/';
        if(!file_exists($dir)){
            mkdir($dir);
        }

        // Save data
        if($req->hasFile('foto')){
            $image     = $req->file('foto');
            $file_name = Carbon::now()->toDateString().'-'.uniqid().'.'. $image->getClientOriginalExtension();
            if($id) {
                if(file_exists($produk->foto)){
                    unlink($produk->foto);
                }
            }
            $image->move($dir, $file_name);
            $produk->foto = $dir.$file_name;
        }

        ///utk set k database   = ambil value dari form
        $produk->name           = $req->name;
        $produk->link_shopee    = $req->link_shopee;
        $produk->link_tokopedia = $req->link_tokopedia;
        $produk->id_kategori    = $req->id_kategori;
        $produk->status         = $req->status == 'on' ? 1 : 0;

        if(!$id) {
            $produk->created_at = Carbon::now()->format('Y-m-d');
            $produk->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        }

        $produk->save();
        $req->session()->flash('status', 'Data berhasil dimasukkan!');
        return redirect()->route('produk.index');
    }

    public function delete(Request $req, $id)
    {

        $produk = Produk::find($id);
        $produk->deleted_at  = Carbon::now()->format('Y-m-d');
        $produk->save();

        $req->session()->flash('status', 'Data berhasil dihapus!');
        return redirect()->route('produk.index');
    }
}
