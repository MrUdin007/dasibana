@extends('layouts.be.be')

@section('content')
    <div id='mainContent'>
        <!-- Top Menu Breadcrumb -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="grid_layouts --two-auto">
                <div class="head-lst">
                    <h5 class="page-title">Product Size Chart
                    </h5>
                </div>
                <div class="mn-rght">
                    <ol class="breadcrumb">
                        <li><a href="">Home</a></li>
                        <li><a href="{{ route('be.product_size_chart') }}">Product Size Chart</a></li>
                        <li class="active">{{isset($chart) ? "Ubah" : "Tambah"}}</li>
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
							<h3 class="page-title">{{isset($chart) ? "Ubah" : "Tambah"}}</h3>
						</div>
					</div>
                    <div>
                        <form id="formChart" method="post" action="{{ $api_url.'product/chart/save' }}" data-toggle="validator" class="form-vegan">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ isset($chart) ? $chart->id : '' }}">
                            <input type="hidden" name="token" value="{{ auth()->user() != null ? auth()->user()->api_token : '' }}">
                            <input type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Product</label>
                                    <select class="form-control custom-select" id="product_id" name="product_id">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ isset($chart) ? ($chart->product_id  == $product->id) ? 'selected' : '' : '' }}>{{ $product->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="control-label" >Gambar</label>
                                    <input type="file" id="image" name="image" class="form-control" aria-label="Sizing example input" aria-describedby="username" @if(!(isset($chart))) required @endif>
                                    <small class="form-text">Rekomendasi ukuran 930x450 pixel dan size 2MB</small>
                                    @if(isset($chart))
                                    <small class="form-text">Kosongkan apabila gambar tidak diganti</small>
                                    @endif
                                    </div>
                            </div>
                            
                            <a href="{{route('be.product_size_chart')}}" class="btn btn-warning">
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

        var ele_image    = $('#image'),
        ele_product_id   = $('#product_id'),
        loading         = false,
        data_load = {
            chart : '{{ $is_chart }}',
        };

        $(document).ready(function () {
            if (!data_load.chart) {
                loadChart();
            }
        });

        CKEDITOR.replace('caption');

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
            if (chart) {
                loading = false;
                swal.close();
            }
        }

        
        function loadChart() {
            $.ajax({
                url : '{{ $api_url."product/chart/".$chart_id }}',
                method : 'post',
                beforeSend: function (xhr) {
                    openLoading();
                },
                success : function (response) {
                    data_load.chart = 1;


                    $.each(response.product_id, function (i,v) {
                        ele_product_id.append($('<option>', {
                            value: v.id,
                            text: v.name
                        }));
                    });

                    ele_image.val(response.chart.image);
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


        submitData('formChart');
    </script>
@endpush