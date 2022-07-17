@extends('layouts.be.app')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Data Sosmed</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('sosmed.index')}}">Sosmed</a></li>
                <li class="breadcrumb-item active">
                    Data Sosmed
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h4 class="card-title">Data Sosmed</h4>
                        </div>
                    </div>
                    @if(session('status'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        <h3 class="text-success"><i class="fa fa-check-circle"></i> Success</h3> {{ session('status') }}
                    </div>
                    @endif

                    <div class="tab-content" id="myTabContent">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><b>Nama Sosmed</b><span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <p class="form-control-static">{{ $sosmed->name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><b>Ikon Sosmed</b><span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <div id="ikonsosmed">{{ $sosmed->ikon }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
        });
    </script>
@endpush
