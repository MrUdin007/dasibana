@extends('layouts.be.app')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <ol class="breadcrumb">
                <li>
                    <h3 style="font-size: 16px !important;">
                        <a href="{{ route('produk.index')}}">Produk</a>
                    </h3>
                </li>
                <li class="active">
                    <h3 style="font-size: 16px !important;">
                        {{ ($produk) ? 'Edit' : 'Add' }} Data Produk
                    </h3>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('status'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        <h3 class="text-danger">
                            Gagal
                        </h3>
                        {{ session('status') }}
                    </div>
                    @endif
                    <form id="formproduk" class="form m-t-20" action="{{ ($produk) ? route('produk.edit',$produk->id) : route('produk.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="control-label">Nama<span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="text" name="name" id="name" class="form-control" value="{{ (old('name') ? old('name') : ((isset($produk)) ? $produk->name : '')) }}" placeholder="Masukkan Nama" required data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Foto Produk<span class="text-danger">*</span><small> <b style="font-size: 11px !important;">(Maksimal File Yang Diunggah : 1.024KB)</b></small></label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="foto" id="foto" value="{{ (old('foto') ? old('foto') : ((isset($produk)) ? $produk->foto : '')) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Link Shopee<span class="text-danger">*</span><small> <b style="font-size: 11px !important;">(Contoh : www.google.com)</b></small></label>
                            <div class="controls">
                                <input type="text" name="link_shopee" id="link_shopee" class="form-control" value="{{ (old('link_shopee') ? old('link_shopee') : ((isset($produk)) ? $produk->link_shopee : '')) }}" placeholder="Masukkan Link Shopee" required data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Link Tokopedia<span class="text-danger">*</span><small> <b style="font-size: 11px !important;">(Contoh : www.google.com)</b></small></label>
                            <div class="controls">
                                <input type="text" name="link_tokopedia" id="link_tokopedia" class="form-control" value="{{ (old('link_tokopedia') ? old('link_tokopedia') : ((isset($produk)) ? $produk->link_tokopedia : '')) }}" placeholder="Masukkan Link Tokopedia" required data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Kategori Produk<span class="text-danger">*</span></label>
                            <div class="controls">
                                <select class="form-select form-control" name="id_kategori">
                                    <option selected>Pilih Kategori Produk</option>
                                    @foreach($kategoriProduk as $kategori)
                                    <option value="{{$kategori->id}}" id="{{$kategori->id}}">{{$kategori->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="status_test" id="status_test" value="{{ (old('status') ? old('status') : ((isset($produk)) ? $produk->status : '0')) }}">
                                <label class="form-check-label" for="status">
                                    Aktif
                                </label>
                            </div>
                        </div>
                        <div class="text-xs-right">
                            <hr>
                            <button type="submit" class="btn btn-info">Submit</button>
                            <a href="{{route('produk.index')}}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#formproduk").submit( function(e) {
                var messageLength = CKEDITOR.instances['post_content'].getData().replace(/<[^>]*>/gi, '').length;
                if( !messageLength ) {
                    alert( 'Please fill Content' );
                    e.preventDefault();
                    $("form").find('[type=submit]').removeAttr("disabled");
                }

            });
        });

        $('.datetimepicker').datetimepicker({
            format:'YYYY-MM-DD HH:mm:ss',
            });

        $('.dp').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        $(function() {
            CKEDITOR.replace('post_content');
        });
    </script>
@endpush
