@extends('layouts.be.app')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Data Produk</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('produk.index')}}">Produk</a></li>
                <li class="breadcrumb-item active">
                    Data Produk
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
                            <h4 class="card-title">Data Produk</h4>
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
                                    <label class="control-label"><b>Nama produk</b><span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <p class="form-control-static">{{ $produk->name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><b>Foto produk</b><span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <div id="ikonproduk">{{ $produk->foto }}</div>
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
