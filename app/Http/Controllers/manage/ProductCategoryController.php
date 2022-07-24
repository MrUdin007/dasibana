<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\KategoriProduk;
use Carbon\Carbon;
use DataTables;
use Mail;
use Hash;


class ProductCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('manage.produkkategori.index');
    }

    public function getData(Request $req)
    {
        $columns = array(
            0 => "kategori_produk.id",
            1 => "kategori_produk.name",
            2 => "kategori_produk.status",
        );

        $columns_alias = array(
            0 => "kategori_produk.id",
            1 => "kategori_produk.name",
            2 => "kategori_produk.status",
        );

        $limit = $req->length; //banyak data pagination
        $start = $req->start; //menunjukan jumlah data pada tiap pagination
        $order = $columns[$req->order[0]['column']]; //menyingkronisasikan data pada datatable berdasarkan coloum database
        $dir   = $req->order[0]['dir']; //menyingkronisasikan data pada datatable berdasarkan directory database pada saat pindah halaman datatable
        $search = $req->search['value']; //mengambil data yg diinput pada search field

        $produkkategori = KategoriProduk::select($columns_alias); //manggil datatable dari database berdasarkan column_alies
        $produkkategori->where('kategori_produk.deleted_at', null);
        $produkkategori->orderBy('kategori_produk.created_at', 'DESC');

        $total_data = $produkkategori->count();
        $filtered_data = $produkkategori->count();
        $produkkategori->orderBy($order,$dir); //

        if ($search) {
            $produkkategori->where('kategori_produk.name','LIKE',"%{$search}%");
            $filtered_data = $produkkategori->count();
        }
        $data = array();
        foreach ($produkkategori->get() as $key => $val) // pengulangan untuk manggil tiap data produkkategori dari database
        {
            $action = '<div class="button-group">';
            $action .='
                <a href="javascript:void(0)" title="view" class="btn btn-sm btn-rounded btn-outline-info" onclick="openProdukkategori('.$val->id.')">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-eye"></i>
                    </span>
                </a>
            ';

            $action .='
                <a href="'.route('produkkategori.edit',$val->id).'" title="edit"  class="btn btn-sm btn-rounded btn-outline-success">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-pencil-alt"></i>
                    </span>
                </a>
            ';

            $action .='
                <a href="javascript:void(0)" title="delete" class="btn btn-sm btn-rounded btn-outline-danger" onclick="deleteProdukkategori(\'delete-form-'.$val->id.'\')">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-trash"></i>
                    </span>
                </a>
                <form id="delete-form-'.$val->id.'" action="'.route('produkkategori.delete',$val->id).'" method="POST" style="display: none;">'.csrf_field().'</form>
            ';
            $action .= '</div>';

            $url= asset($val->ikon);
            $image = '<img src="'.$url.'" alt="'.$val->name.'">';

            if($val->status === 1){
                $status = '<span class="badge bg-success dasibana-badge">Aktif</span>';
            }
            else{
                $status = '<span class="badge bg-secondary dasibana-badge">Tidak Aktif</span>';
            }

            $data[$key] = $val->toArray();
            $data[$key]['no'] = $key+$start+1;
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

        $produkkategori = KategoriProduk::find($id);

        return view('manage.produkkategori.form', [
            'produkkategori' => $produkkategori
        ]);
    }

    public function view(Request $req)
    {
        $produkkategori = KategoriProduk::find($req->id);
        if ($req->ajax()) {
            return response()->json([
                'success'       => true,
                'name'          => $produkkategori->name,
            ]);
        }

        return 'html';
    }

    public function save(Request $req, $id=null)
    {
        if($id){
            $validator = Validator::make($req->all(), [
                'name'      => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                $req->session()->flash('status', 'Data gagal diubah! Maksimal File Yang Diunggah : 1.024KB');
                return redirect()->route('produkkategori.edit', $id);
            }

            $produkkategori = KategoriProduk::find($id);
        }else{
            $validator = Validator::make($req->all(), [
                'name'      => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                $req->session()->flash('status', 'Data baru gagal dimasukkan! Maksimal File Yang Diunggah : 1.024KB');
                return redirect()->route('produkkategori.add', $id);
            }
            $produkkategori = new KategoriProduk;
            $same_slug = KategoriProduk::where('slug','like',Str::slug($req->name).'%')->count();
            if ($same_slug > 0) {
                $slug = Str::slug($req->name.' '.$same_slug);
            } else {
                $slug = Str::slug($req->name);
            }
            $produkkategori->slug = $slug;
        }

        // Save data
        $produkkategori->name       = $req->name;
        $produkkategori->status     = $req->status == 'on' ? 1 : 0;

        if(!$id) {
            $produkkategori->created_at = Carbon::now()->format('Y-m-d');
            $produkkategori->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        }

        $produkkategori->save();
        $req->session()->flash('status', 'Data berhasil dimasukkan!');
        return redirect()->route('produkkategori.index');
    }

    public function delete(Request $req, $id)
    {

        $produkkategori = KategoriProduk::find($id);
        $produkkategori->deleted_at  = Carbon::now()->format('Y-m-d');
        $produkkategori->save();

        $req->session()->flash('status', 'Data berhasil dihapus!');
        return redirect()->route('produkkategori.index');
    }
}
