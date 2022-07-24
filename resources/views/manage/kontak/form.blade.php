@extends('layouts.be.app')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <ol class="breadcrumb">
                <li>
                    <h3 style="font-size: 16px !important;">
                        <a href="{{ route('kontak.index')}}">Kontak</a>
                    </h3>
                </li>
                <li class="active">
                    <h3 style="font-size: 16px !important;">
                        {{ ($kontak) ? 'Edit' : 'Add' }} Data Kontak
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
                    <form id="formkontak" class="form m-t-20" action="{{ ($kontak) ? route('kontak.edit',$kontak->id) : route('kontak.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="control-label">Nama Bisnis<span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="text" name="nama_bisnis" id="nama_bisnis" class="form-control" value="{{ isset($kontak)) ? $kontak->nama_bisnis : '' }}" placeholder="Masukkan Nama Bisnis" required data-validation-required-message="Kolom ini tidak boleh kosong">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Pemilik<span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="text" name="pemilik" id="pemilik" class="form-control" value="{{ isset($kontak)) ? $kontak->pemilik : '' }}" placeholder="Masukkan Nama Pemilik" required data-validation-required-message="Kolom ini tidak boleh kosong">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Tahun<span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="number" name="tahun" id="tahun" class="form-control" value="{{ isset($kontak)) ? $kontak->tahun : '' }}" placeholder="Masukkan Tahun" required data-validation-required-message="Kolom ini tidak boleh kosong">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Alamat<span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="text" name="alamat" id="alamat" class="form-control" value="{{ isset($kontak)) ? $kontak->alamat : '' }}" placeholder="Masukkan Deskripsi" required data-validation-required-message="Kolom ini tidak boleh kosong">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Deskripsi<span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="text" name="deskripsi" id="deskripsi" class="form-control" value="{{ isset($kontak)) ? $kontak->deskripsi : '' }}" placeholder="Masukkan Deskripsi" required data-validation-required-message="Kolom ini tidak boleh kosong">
                            </div>
                        </div>
                        <div class="text-xs-right">
                            <hr>
                            <button type="submit" class="btn btn-info">Submit</button>
                            <a href="{{route('kontak.index')}}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
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
            $("#formKontak").submit( function(e) {
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
