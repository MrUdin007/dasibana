@extends('layouts.be.app')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Data Admin</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Admin</a></li>
                <li class="breadcrumb-item active">
                    @if($admin)
                    <a href="{{ route('admin.edit',$admin->id) }}">Edit Data Admin</a>
                    @else
                    <a href="{{ route('admin.add') }}">Tambah Data Admin</a>
                    @endif
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
                    <h4 class="card-title">{{ ($admin) ? 'Edit' : 'Add' }} Data Admin</h4>
                    @if(session('status'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        <h3 class="text-success"><i class="fa fa-check-circle"></i> Success</h3> {{ session('status') }}
                    </div>
                    @endif
                    <form id="formAdmin" class="form m-t-20" action="{{ ($admin) ? route('admin.edit',$admin->id) : route('admin.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="control-label">Nama Admin<span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="text" name="nameadmin" id="nameadmin" class="form-control" value="{{ (old('name') ? old('name') : ((isset($admin)) ? $admin->name : '')) }}" placeholder="Masukkan Nama" required data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Username<span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="text" name="usernameadmin" id="usernameadmin" class="form-control" value="{{ (old('username') ? old('username') : ((isset($admin)) ? $admin->username : '')) }}" placeholder="Masukkan Username" required data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email Admin<span class="text-danger">*</span></label>
                            <div class="tags-default">
                                <input type="text" name="emailadmin" id="emailadmin" value="{{ (old('email') ? old('email') : ((isset($admin)) ? $admin->email : '')) }}" placeholder="Masukkan Email"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Password Admin<span class="text-danger">*</span></label>
                            <div class="tags-default">
                                <input type="password" name="passwordadmin" id="passwordadmin" value="{{ (old('password') ? old('password') : ((isset($admin)) ? $admin->password : '')) }}" placeholder="Masukkan Password"/>
                            </div>
                        </div>

                        <div class="text-xs-right">
                            <hr>
                            <button type="submit" class="btn btn-info">Submit</button>
                            <a href="{{route('admin.index')}}"><button type="button" class="btn btn-inverse">Cancel</button></a>
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
            $("#formAdmin").submit( function(e) {
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
