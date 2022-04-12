@extends('layouts.be.be')

@section('content')
    <div id='mainContent'>
        <!-- Top Menu Breadcrumb -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="grid_layouts --two-auto">
                <div class="head-lst">
                    <h5 class="page-title">Slider
                    </h5>
                </div>
                <div class="mn-rght">
                    <ol class="breadcrumb">
                        <li><a href="">Home</a></li>
                        <li><a href="{{ route('be.slider') }}">Slider</a></li>
                        <li class="active">{{isset($slider) ? "Ubah" : "Tambah"}} Slider</li>
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
                            <h3 class="page-title">{{isset($slider) ? "Ubah" : "Tambah"}} Slider</h3>
                        </div>
                    </div>
                    <div>
                        <form id="formSlider" method="post" action="{{ $api_url.'slider/save' }}" data-toggle="validator" class="form-vegan">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ isset($slider) ? $slider->id : '' }}">
                            <input type="hidden" name="token" value="{{ auth()->user() != null ? auth()->user()->api_token : '' }}">
                            <input type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="control-label" >Gambar</label>
                                    <input type="file" id="image" name="image" class="form-control" aria-label="Sizing example input" aria-describedby="username" @if(!(isset($slider))) required @endif>
                                    <small class="form-text">Rekomendasi ukuran 930x450 pixel dan size 2MB</small>
                                    @if(isset($slider))
                                    <small class="form-text">Kosongkan apabila gambar tidak diganti</small>
                                    @endif
                                    </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputPassword4">Caption</label>
                                    <textarea class="form-control" id="caption" name="caption" placeholder="Caption">{{ (old('caption') ? old('caption') : ((isset($slider)) ? $slider->caption : '')) }}</textarea> 
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputPassword4">Target URL</label>
                                    <input type="text" class="form-control" id="target_url" name="target_url" aria-describedby="name" value="{{ (old('target_url') ? old('target_url') : ((isset($slider)) ? $slider->target_url : '')) }}" placeholder="Contoh: https://www.google.com/">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Status</label>
                                    <select class="form-control custom-select" id="status" name="status">
                                    @foreach($status as $key => $stt)
                                        <option value="{{ $key }}" {{ isset($slider) ? ($slider->status  == $key) ? 'selected' : '' : '' }}>{{ $stt }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <a href="{{route('be.slider')}}" class="btn btn-danger btn-customize">
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
        ele_target_url   = $('#target_url'),
        ele_status       = $('#status'),
        ele_caption      = $('#caption'),
        loading         = false,
        data_load = {
            slider : '{{ $is_slider }}',
        };

        $(document).ready(function () {
            if (!data_load.slider) {
                loadSlider();
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
            if (slider) {
                loading = false;
                swal.close();
            }
        }

        
        function loadSlider() {
            $.ajax({
                url : '{{ $api_url."slider/".$slider_id }}',
                method : 'post',
                beforeSend: function (xhr) {
                    openLoading();
                },
                success : function (response) {
                    data_load.slider = 1;

                    ele_image.val(response.slider.image);
                    ele_target_url.val(response.slider.target_url);
                    ele_status.val(response.slider.status);
                    ele_caption.val(response.slider.caption);
                    closeLoading();
                },
                error : function (xhr) {
                    if (xhr.status == 401) {
                        data_load.slider = 1;
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


        submitData('formSlider');
    </script>
@endpush