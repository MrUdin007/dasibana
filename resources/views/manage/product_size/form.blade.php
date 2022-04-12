@extends('layouts.be.be')

@section('content')
    <div id='mainContent'>
        <!-- Top Menu Breadcrumb -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="grid_layouts --two-auto">
                <div class="head-lst">
                    <h5 class="page-title">Product Size
                    </h5>
                </div>
                <div class="mn-rght">
                    <ol class="breadcrumb">
                        <li><a href="">Home</a></li>
                        <li><a href="{{ route('be.product_size') }}">Product Size</a></li>
                        <li class="active">{{isset($size) ? "Ubah" : "Tambah"}}</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Forms -->
        <!-- ============================================================== -->
        <div class="row gap-20 pos-r">
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                    <div class="grid_layouts --two-auto">
						<div class="head-lst">
							<h3 class="page-title">{{isset($size) ? "Ubah" : "Tambah"}}</h3>
						</div>
					</div>
                    <div>
                        <form id="formSize" method="post" action="{{ $api_url.'product/size/save' }}" data-toggle="validator" class="form-vegan">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ isset($size) ? $size->id : '' }}">
                            <input type="hidden" name="token" value="{{ auth()->user() != null ? auth()->user()->api_token : '' }}">
                            <input type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Product</label>
                                    <select class="form-control custom-select" id="product_id" name="product_id" @if(isset($size)) disabled @endif>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ isset($size) ? ($size->product_id  == $product->id) ? 'selected' : '' : '' }}>{{ $product->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputPassword4">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" aria-describedby="name" value="{{ (old('name') ? old('name') : ((isset($size)) ? $size->name : '')) }}" placeholder="Contoh: S/M/L">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputPassword4">Stock</label>
                                    <input type="number" onkeypress="return isNumberKey(event)" class="form-control" id="stock" name="stock" aria-describedby="stock" value="{{ (old('stock') ? old('stock') : ((isset($size)) ? $size->stock : '')) }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Status</label>
                                    <select class="form-control custom-select" id="status" name="status">
                                    @foreach($status as $key => $stt)
                                        <option value="{{ $key }}" {{ isset($size) ? ($size->status  == $key) ? 'selected' : '' : '' }}>{{ $stt }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <a href="{{route('be.product_size')}}" class="btn btn-warning">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary" id="save">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">

        var ele_status = $('#status'),
        ele_product_id = $('#product_id'),
        ele_name       = $('#name'),
        ele_stock      = $('#stock'),
        loading        = false,
        data_load = {
            size : '{{ $is_size }}',
        };

        $(document).ready(function () {
            if (!data_load.size) {
                loadSize();
            }
        });

        CKEDITOR.replace('caption');

        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        function openLoading() {
            if (!loading) {
                loading = true;
                swal({
                    title: "Mohon Menunggu",
                    text: "Data Anda sedang diproses",
                    showConfirmButton: false,
                });
            }
        }

        function closeLoading() {
            if (size) {
                loading = false;
                swal.close();
            }
        }

        
        function loadSize() {
            $.ajax({
                url : '{{ $api_url."product/size/".$size_id }}',
                method : 'post',
                beforeSend: function (xhr) {
                    openLoading();
                },
                success : function (response) {
                    data_load.chart = 1;


                    $.each(response.status, function (i,v) {
                        ele_status.append($('<option>', {
                            value: v.id,
                            text: v
                        }));
                    });

                    ele_name.val(response.chart.name);
                    ele_stock.val(response.chart.stock);
                    ele_status.val(response.chart.status);
                    ele_product_id.val(response.chart.product_id);
                    closeLoading();
                },
                error : function (xhr) {
                    if (xhr.status == 401) {
                        data_load.chart = 1;
                        swal({
                            type: "error",
                            title: "Your login status in invalid!",
                            text: "Please do login again.",
                        }, function (isConfirm) {
                            $('#formLogout').submit();
                        });
                    }
                }
            });
        }


        submitData('formSize');
    </script>
@endpush