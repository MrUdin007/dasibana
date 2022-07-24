@extends('layouts.be.app')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <ol class="breadcrumb">
                <li>
                    <h3 style="font-size: 16px !important;">
                        <a href="{{ route('sosmed.index')}}">Sosmed</a>
                    </h3>
                </li>
                <li class="active">
                    <h3 style="font-size: 16px !important;">
                        {{ ($sosmed) ? 'Edit' : 'Add' }} Data Sosmed
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
                    <form id="formsosmed" class="form m-t-20" action="{{ ($sosmed) ? route('sosmed.edit',$sosmed->id) : route('sosmed.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="control-label">Nama<span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="text" name="name" id="name" class="form-control" value="{{ isset($sosmed) ? $sosmed->name : '' }}" placeholder="Masukkan Nama" required data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Icon<span class="text-danger">*</span><small> <b style="font-size: 11px !important;">(Maksimal File Yang Diunggah : 1.024KB)</b></small></label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="ikon" id="ikon" value="{{ isset($sosmed) ? $sosmed->ikon : '' }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="status" id="status"
                                @if(isset($sosmed) && $sosmed->status == 1)
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
                            <a href="{{route('sosmed.index')}}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
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
            $("#formSosmed").submit( function(e) {
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
