@extends('layouts.be.app')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <ol class="breadcrumb">
                <li>
                    <h3 style="font-size: 16px !important;">
                        <a href="{{ route('produkkategori.index')}}">Produk Kategori</a>
                    </h3>
                </li>
                <li class="active">
                    <h3 style="font-size: 16px !important;">
                        {{ ($produkkategori) ? 'Edit' : 'Add' }} Data Produk Kategori
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
                    <form id="formprodukkategori" class="form m-t-20" action="{{ ($produkkategori) ? route('produkkategori.edit',$produkkategori->id) : route('produkkategori.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="control-label">Nama<span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="text" name="name" id="name" class="form-control" value="{{ isset($produkkategori)) ? $produkkategori->name : '' }}" placeholder="Masukkan Nama" required data-validation-required-message="Kolom ini tidak boleh kosong">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="status" id="status"
                                @if(isset($produkkategori) && $produkkategori->status == 1)
                                    checked
                                @endif
                                >
                                <label class="form-check-label" for="status">
                                    Aktif
                                </label>
                            </div>
                        </div>
                        <div class="text-xs-right">
                            <hr>
                            <button type="submit" class="btn btn-info">Submit</button>
                            <a href="{{route('produkkategori.index')}}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
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
            $("#formProdukkategori").submit( function(e) {
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
