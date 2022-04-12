@extends('layouts.be.be')

@section('content')
	<div id='mainContent'>
		<!-- Top Menu Breadcrumb -->
		<!-- ============================================================== -->
		<div class="container-fluid">
			<div class="grid_layouts --two-auto">
				<div class="head-lst">
					<h5 class="page-title">
						@if($set == 1)
                        <a href="{{ route('be.app_setting', ['set'=>1]) }}">
                        Set Point Value
                        </a>
                        @elseif($set == 2)
                        <a href="{{ route('be.app_setting', ['set'=>2]) }}">
                        Set Default Point for New Users
                        </a>
                        @endif
                    </h5>
				</div>
				<div class="mn-rght">
					<ol class="breadcrumb">
						<li><a href="javascript:void(0)">App Setting</a></li>
						<li>
                            @if($set == 1)
                            <a href="{{ route('be.app_setting', ['set'=>1]) }}">
                            Set Point Value
                            </a>
                            @elseif($set == 2)
                            <a href="{{ route('be.app_setting', ['set'=>2]) }}">
                            Set Default Point for New Users
                            </a>
                            @endif
                            </a>
                        </li>
						<li class="active">Ubah</li>
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
                            <h3 class="page-title">Ubah</h3>
                        </div>
                    </div>
					<div>
                        <form id="formAppSetting" method="post" action="{{ $api_url.'app_setting/save' }}" data-toggle="validator" class="form-vegan">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ isset($app_setting) ? $app_setting->id : '' }}">
                            <input type="hidden" name="token" value="{{ auth()->user() != null ? auth()->user()->api_token : '' }}">
                            <input type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="control-label" >Name</label>
                                    <input type="text" class="form-control" id="name" name="name" aria-describedby="name" value="{{ $app_setting->name }}" placeholder="Name" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputPassword4">Value</label>
                                    <input type="text" class="form-control" id="value" name="value" placeholder="Value" value="{{ $app_setting->value }}" required>
                                </div>
                            </div>
                            @if ($app_setting->type == 3)
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputPassword4">Target Url</label>
                                    <input type="text" class="form-control" id="target_url" name="target_url" placeholder="Target Url" value="{{ $app_setting->target_url }}">
                                </div>
                            </div>
                            @endif
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Status</label>
                                    <select class="form-control custom-select" id="status" name="status">
                                    @foreach($status as $key => $stt)
                                        <option value="{{ $key }}" {{ isset($app_setting) ? ($app_setting->status  == $key) ? 'selected' : '' : '' }}>{{ $stt }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <a href="{{route('be.app_setting', ['set'=>$set])}}" class="btn btn-danger btn-customize">
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

            var ele_name    = $('#name'),
            ele_value     = $('#value'),
            ele_target_url            = $('#target_url'),
            ele_status            = $('#status'),
            loading         = false,
            data_load = {
                app_setting : '{{ $is_app_setting }}',
            };

            $(document).ready(function () {
                if (!data_load.app_setting) {
                    loadAppSetting();
                }
            });

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
            if (app_setting) {
                loading = false;
                swal.close();
            }
        }

        
        function loadAppSetting() {
            $.ajax({
                url : '{{ $api_url."app_setting/".$app_setting_id }}',
                method : 'post',
                beforeSend: function (xhr) {
                    openLoading();
                },
                success : function (response) {
                    data_load.app_setting = 1;

                    ele_name.val(response.app_setting.name);
                    ele_value.val(response.app_setting.value);
                    ele_target_url.val(response.app_setting.target_url);
                    ele_status.val(response.app_setting.status);
                    closeLoading();
                },
                error : function (xhr) {
                    if (xhr.status == 401) {
                        data_load.app_setting = 1;
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


        submitData('formAppSetting');
    </script>
@endpush