@extends('layouts.fe.fe')

@section('metadata')
    <title>Veganesia - Akun</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('dist/fe/css/content/sidebar_akun.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/fe/css/pages/akun/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendors/css/datepicker.css') }}">
    <style>
        .datepicker {
            z-index: 1600 !important; /* has to be larger than 1050 */
        }
    </style>
@endpush

@section('content')
    <div class="akun-profile">
        <!-- Content Profile -->
        <!-- ============================================================== -->
        <section class="akun-profile-sec container">
            <!-- Sidebar Akun Mobile -->
            <!-- ============================================================== -->
            <div class="mob-sdbr-acc mobl-sdbr-acc">
                <button id="filter-akun" class="btn-vegan green-bg-btn text-capitalize" type="button">
                    <span><i class="fas fa-sliders-h"></i></span>
                    &nbsp;filter
                </button>
            </div>
            <!-- ============================================================== -->
            <!-- End Sidebar Akun Mobile -->

            <div class="grid_layouts gr-akun">
                <div>
                    <!-- Sidebar Akun Desktop -->
                    <!-- ============================================================== -->
                    <div id="desk-sdbr">
                        @include('layouts.fe.sidebar.sidebar-akun')
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Sidebar Akun Desktop -->
                </div>
                <div class="profile-content">
                    <!-- Content -->
                    <!-- ============================================================== -->
                    <div class="menu-tab-notf">
                        <ul class="nav nav-tabs --setting --scrlbrr" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link main-sub-text text-capitalize active" id="editProfile-tab" data-toggle="tab" href="#editProfile" role="tab" aria-controls="editProfile" aria-selected="true">profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link main-sub-text text-capitalize" id="editAlamat-tab" data-toggle="tab" href="#editAlamat" role="tab" aria-controls="editAlamat" aria-selected="false">alamat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link main-sub-text text-capitalize" id="editPassword-tab" data-toggle="tab" href="#editPassword" role="tab" aria-controls="editPassword" aria-selected="false">ganti password</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="editProfile" role="tabpanel" aria-labelledby="editProfile-tab">
                                <div class="grid_layouts gr-sec-profile-tab gr-sec-profile-tab-first">
                                    <div class="items_a1 rounded-circle img-lazy small-lazy user-rvw" data-src="@if(auth('fe')->user()->image != null) {{ asset(env('APP_DOWNLOAD').auth('fe')->user()->image) }} @else {{ asset(auth('fe')->user()->avatar) }} @endif"></div>
                                    <div>
                                        <div class="ct-prf mb-4">
                                            <h6 class="titls f-Asap_medium main-text">Profile</h6>
                                            <div class="form-ct-prf mt-3">
                                                <div class="grid_layouts group-profile">
                                                    <h6>
                                                        Nama
                                                    </h6>
                                                    <h6 class="clr-grey-txt">
                                                        @if(isset(auth('fe')->user()->name))
                                                        {{ auth('fe')->user()->name }}
                                                        @else
                                                        -
                                                        @endif
                                                    </h6>
                                                </div>
                                                <div class="grid_layouts group-profile form-vegan">
                                                    <h6>
                                                        Tanggal Lahir
                                                    </h6>
                                                    <h6 class="clr-grey-txt">
                                                        @if(isset(auth('fe')->user()->dob))
                                                        {{ Carbon\Carbon::parse(auth('fe')->user()->dob)->format('d F Y') }}
                                                        @else
                                                        -
                                                        @endif
                                                    </h6>
                                                </div>
                                                <div class="grid_layouts group-profile">
                                                    <h6>
                                                        Gender
                                                    </h6>
                                                    <h6 class="clr-grey-txt">
                                                        @if(isset(auth('fe')->user()->gender))
                                                        @if(auth('fe')->user()->gender == 1)
                                                        Pria
                                                        @elseif(auth('fe')->user()->gender == 2)
                                                        Wanita
                                                        @endif
                                                        @else
                                                        -
                                                        @endif
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ct-prf">
                                            <h6 class="titls f-Asap_medium main-text">Kontak</h6>
                                            <div class="form-ct-prf mt-3">
                                                <div class="grid_layouts group-profile">
                                                    <h6>
                                                        Email
                                                    </h6>
                                                    <h6 class="clr-grey-txt">
                                                        @if(isset(auth('fe')->user()->email))
                                                        {{ auth('fe')->user()->email }}
                                                        @else
                                                        -
                                                        @endif
                                                    </h6>
                                                </div>
                                                <div class="grid_layouts group-profile">
                                                    <h6>
                                                        No HP
                                                    </h6>
                                                    <h6 class="clr-grey-txt">
                                                        @if(isset(auth('fe')->user()->phone))
                                                        {{ auth('fe')->user()->phone }}
                                                        @else
                                                        -
                                                        @endif
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="items_a1">
                                        <button class="btn-vegan edit-btn text-capitalize" data-toggle="modal" data-target="#Profile" data-backdrop="static" data-keyboard="false">
                                            <span class="icn-pencil">
                                                <img src="{{ asset('dist/fe/icons/pencil.png') }}" alt="pencil">
                                            </span>
                                            edit profile
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="editAlamat" role="tabpanel" aria-labelledby="editAlamat-tab">
                                <article class="mb-4">
                                    <p class="clr-light-gry">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim ullamcorper maecenas montes, arcu sit augue donec in porttitor. Aenean tellus et proin quis</p>
                                </article>
                                @if($customer->provinsi_id == null || $customer->kabupaten_id == null || $customer->kecamatan_id == null)
                                <div>
                                    <button style="width: 145px" class="btn-vegan text-capitalize green-bg-btn" data-toggle="modal" data-target="#modalAlamat" data-backdrop="static" data-keyboard="false">
                                        buat alamat
                                    </button>
                                </div>
                                @else
                                <div class="grid_layouts gr-sec-profile-tab --addrs">
                                    <div class="ct-prf">
                                        <h6 class="titls f-Asap_medium main-text">Alamat</h6>
                                        <div class="form-ct-prf mt-3">
                                            <div class="grid_layouts group-profile">
                                                <h6>
                                                    Nama Penerima
                                                </h6>
                                                <h6 class="clr-grey-txt">
                                                    {{$customer->name}}
                                                </h6>
                                            </div>
                                            <div class="grid_layouts group-profile">
                                                <h6>
                                                    Nomor HP Penerima
                                                </h6>
                                                <h6 class="clr-grey-txt">
                                                    {{$customer->phone}}
                                                </h6>
                                            </div>
                                            <div class="grid_layouts group-profile">
                                                <h6>
                                                    Provinsi
                                                </h6>
                                                <h6 class="clr-grey-txt">
                                                    {{$customer->fetch_destination('province')}}
                                                </h6>
                                            </div>
                                            <div class="grid_layouts group-profile">
                                                <h6>
                                                    Kota / Kabupaten
                                                </h6>
                                                <h6 class="clr-grey-txt">
                                                    {{$customer->fetch_destination('city')}}
                                                </h6>
                                            </div>
                                            <div class="grid_layouts group-profile">
                                                <h6>
                                                    Kecamatan
                                                </h6>
                                                <h6 class="clr-grey-txt">
                                                    {{$customer->fetch_destination('subdistrict_name')}}
                                                </h6>
                                            </div>
                                            <div class="grid_layouts group-profile">
                                                <h6>
                                                    Kode Pos
                                                </h6>
                                                <h6 class="clr-grey-txt">
                                                    {{$customer->post_code}}
                                                </h6>
                                            </div>
                                            <div class="grid_layouts group-profile">
                                                <h6>
                                                    Alamat Lengkap
                                                </h6>
                                                <h6 class="clr-grey-txt">
                                                    {{$customer->address}}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn-vegan edit-btn text-capitalize" data-toggle="modal" data-target="#modalAlamat" data-backdrop="static" data-keyboard="false">
                                            <span class="icn-pencil">
                                                <img src="{{ asset('dist/fe/icons/pencil.png') }}" alt="pencil">
                                            </span>
                                            edit alamat
                                        </button>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="editPassword" role="tabpanel" aria-labelledby="editPassword-tab">
                                <div class="ct-tab-mn">
                                    <article class="mb-4">
                                        <p class="clr-light-gry">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim ullamcorper maecenas montes, arcu sit augue donec in porttitor. Aenean tellus et proin quis</p>
                                    </article>
                                    <form id="formCustomerPassword" action="{{ route('akun.save_setting') }}" class="form-vegan" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="type" id="type" value="profilPassword">
                                        <div class="grid_layouts --change-pws main-form-vg">
                                            <div>
                                                <h6 class="mb-0">Password</h6>
                                            </div>
                                            <div class="float-inpt-fld">
                                                <input type="password" class="floatfield form-control" id="password" name="password" placeholder="Password" aria-describedby="password" autocomplete="new-password" name="password" required>
                                                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            </div>
                                        </div>
                                        <div class="grid_layouts --change-pws main-form-vg">
                                            <div>
                                                <h6 class="mb-0">Password Baru</h6>
                                            </div>
                                            <div class="float-inpt-fld">
                                                <input type="password" class="floatfield form-control field-main-oz" id="passwordbaru" name="passwordbaru" aria-describedby="passwordbaru" placeholder="Password Baru" required>
                                                <span toggle="#passwordbaru" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            </div>
                                        </div>
                                        <div class="grid_layouts --change-pws main-form-vg">
                                            <div>
                                                <h6 class="mb-0">Konfirmasi Password</h6>
                                            </div>
                                            <div class="float-inpt-fld">
                                                <input type="password" class="floatfield form-control field-main-oz" id="confirmpassword" name="confirmpassword" aria-describedby="confirmpassword" placeholder="Konfirmasi Password" required>
                                                <span toggle="#confirmpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            </div>
                                        </div>
                                        <div class="grid_layouts --change-pws main-form-vg" id="match">
                                            <div>
                                                <h6 class="mb-0"></h6>
                                            </div>
                                            <div class="float-inpt-fld">
                                                <div class="alert alert-warning" role="alert" style="margin-bottom: 0px">
                                                    Password tidak sama
                                                </div>
                                            </div>
                                        </div>
                                        <div class="grid_layouts --change-pws">
                                            <div></div>
                                            <div style="width: 145px;">
                                                <button class="text-capitalize btn-vegan green-bg-btn" type="submit" id="save">simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Content -->
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Content Profile -->

        <!-- Start Modal Edit Profile -->
        <div class="modal-vegan mdl-Profile" data-backdrop="static" data-keyboard="false">
            <div class="modal fade" id="Profile" tabindex="-1" role="dialog" aria-labelledby="ProfileLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="text-capitalize mb-0 f-Asap_medium main-sub-text-mid text-left">edit profile</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="formCustomer" action="{{ route('akun.save_setting') }}" class="form-vegan" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="type" id="type" value="nameprofile">
                                <div class="chng-img-usr mb-3">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="image" name="image" accept=".png, .jpg, .jpeg" />
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image: url('@if(auth('fe')->user()->image != null) {{ asset(env('APP_DOWNLOAD').auth('fe')->user()->image) }} @else {{ asset(auth('fe')->user()->avatar) }} @endif');"></div>
                                            <div class="bg-edit"></div>
                                        </div>
                                    </div>
                                    <label id="changeimgs" for="image" class="text-capitalize mt-3 clr-blue">
                                        @if(auth('fe')->user()->image)
                                        ganti foto profile
                                        @else
                                        pilih foto profile
                                        @endif
                                    </label>
                                </div>
                                <div>
                                    <label for="name" class="clr-grey-txt mb-2 f-Asap_medium">Nama</label>
                                    <div class="main-form-vg">
                                        <input type="text" class="form-control" id="name" name="name" aria-describedby="username" value="{{ isset($customer) ? $customer->name : ''}}" placeholder="Nama">
                                    </div>
                                </div>
                                <div>
                                    <label for="birthday" class="clr-grey-txt mb-2 f-Asap_medium">Tanggal Lahir</label>
                                    <div class="input-group main-form-vg">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><div class="--calendar"></div></span>
                                        </div>
                                        <input type="text" id="birthday" name="dob" onkeydown="return false" class="form-control datepicker-vegan" onkeydown="return false" value="{{ isset($customer) ? Carbon\Carbon::parse($customer->dob)->format('m/d/Y') : ''}}">
                                    </div>
                                </div>
                                <div class="gender-mdl">
                                    <label for="gender" class="clr-grey-txt mb-2 f-Asap_medium">Gender</label>
                                    <div class="gender-mdl-sec">
                                        <div class="custom-radio main-form-vg">
                                            <input type="radio" id="pria" name="gender" class="custom-control-input" value="1"
                                                @if(auth('fe')->user()->gender == 1)
                                                checked="true"
                                                @endif>
                                            <label class="custom-control-label" for="pria">
                                                Pria
                                            </label>
                                        </div>
                                        <div class="custom-radio main-form-vg">
                                            <input type="radio" id="Wanita" name="gender" class="custom-control-input" value="2"
                                                @if(auth('fe')->user()->gender == 2)
                                                checked="true"
                                                @endif>
                                            <label class="custom-control-label" for="Wanita">
                                                Wanita
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn-vegan green-bg-btn">simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:/ Modal Edit Profile -->

        <!-- Start Modal Edit Alamat -->
        <div class="modal-vegan mdl-Profile" data-backdrop="static" data-keyboard="false">
            <div class="modal fade" id="modalAlamat" tabindex="-1" role="dialog" aria-labelledby="AlamatLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="text-capitalize mb-0 f-Asap_medium main-sub-text-mid text-left">
                                buat alamat pengiriman
                            </h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="formCustomerAlamat" action="{{ route('akun.save_setting') }}" class="form-vegan" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="type" id="type" value="profilAlamat">
                                <div>
                                    <label for="name_penerima" class="clr-grey-txt mb-2 f-Asap_medium">Nama Penerima <span style="color: red">*</span></label>
                                    <div class="main-form-vg">
                                        <input required type="text" class="form-control" id="name" name="name" aria-describedby="username" value="{{ isset($customer) ? $customer->name : ''}}" placeholder="Nama Penerima">
                                    </div>
                                </div>
                                <div>
                                    <label for="phone_penerima" class="clr-grey-txt mb-2 f-Asap_medium">Nomor HP Penerima <span style="color: red">*</span></label>
                                    <div class="main-form-vg">
                                        <input required type="text" class="form-control" id="phone" name="phone" aria-describedby="username" value="{{ isset($customer) ? $customer->phone : ''}}" placeholder="Nomor HP Penerima">
                                    </div>
                                </div>
                                <div>
                                    <label for="provinsi_penerima" class="clr-grey-txt mb-2 f-Asap_medium">Provinsi <span style="color: red">*</span></label>
                                    <div class="main-form-vg">
                                        <input type="hidden" id="old_provinsi_id" value="{{old('provinsi_id') ?? (isset($customer) ? $customer->fetch_destination('provinsi_id') : '')}}">
                                        <div class="--custom-select">
                                            <select class="text-capitalize select2 destinasi" id="provinsi_id" name="provinsi_id" required>
                                                <option disabled selected class="selected">-- Pilih Provinsi --</option>
                                                @foreach($provinsi as $value)
                                                @if(old('provinsi_id') == $value['province_id'])
                                                <option value="{{$value['province_id']}}" selected>{{$value['province']}}</option>
                                                @elseif(isset($customer) && $customer->fetch_destination('province_id') == $value['province_id'])
                                                <option value="{{$value['province_id']}}" selected>{{$value['province']}}</option>
                                                @else
                                                <option value="{{$value['province_id']}}">
                                                {{$value['province']}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label for="kota_penerima" class="clr-grey-txt mb-2 f-Asap_medium">Kota / Kabupaten <span style="color: red">*</span></label>
                                    <div class="main-form-vg">
                                        <input type="hidden" id="old_kabupaten_id" value="{{old('kabupaten_id') ?? (isset($customer) ? $customer->fetch_destination('city_id') : '')}}">
                                        <div class="--custom-select">
                                            <select class="text-capitalize select2 destinasi" id="kabupaten_id" name="kabupaten_id" required>
                                                <option disabled selected class="selected">-- Pilih Kabupaten --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label for="kecamatan_penerima" class="clr-grey-txt mb-2 f-Asap_medium">Kecamatan <span style="color: red">*</span></label>
                                    <div class="main-form-vg">
                                        <input type="hidden" id="old_kecamatan_id" value="{{old('kecamatan_id') ?? ($customer->destination_code ?? '')}}">
                                        <div class="--custom-select">
                                            <select class="text-capitalize select2" id="kecamatan_id" name="kecamatan_id" required>
                                                <option disabled selected class="selected">-- Pilih Kecamatan --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label for="kode_pos_penerima" class="clr-grey-txt mb-2 f-Asap_medium">Kode POS <span style="color: red">*</span></label>
                                    <div class="main-form-vg">
                                        <input required type="number" class="form-control" id="post_code" name="post_code" aria-describedby="post_code" value="{{ isset($customer) ? $customer->post_code : ''}}" placeholder="Kode POS">
                                    </div>
                                </div>
                                <div>
                                    <label for="address_penerima" class="clr-grey-txt mb-2 f-Asap_medium">Alamat Lengkap <span style="color: red">*</span></label>
                                    <div class="main-form-vg">
                                        <textarea required class="form-control" id="address" name="address" rows="3" placeholder="Ketik Alamat Lengkap">{{ isset($customer) ? $customer->address : ''}}</textarea>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn-vegan green-bg-btn" type="submit">simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:/ Modal Edit Alamat -->
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('dist/vendors/js/datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dist/vendors/js/change_avatar.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dist/vendors/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#Profile').on('shown.bs.modal', function (){
                $('.datepicker-vegan').datepicker({
                    dateFormat: 'd / MM / yyyy',
                    changeMonth: true,
                    changeYear: true,
                    autoclose: true,
                    monthNames: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
                    monthNamesShort: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"]
                }).on('changeDate', function(e){
                    changeDate();
                });
            });

            $('.destinasi').on('change',function(){
                var provinsi_id = $('#provinsi_id').val();
                var kabupaten_id = $('#kabupaten_id').val();
                var kecamatan_id = $('#kecamatan_id').val();
                var old_provinsi_id = $('#old_provinsi_id').val();
                var old_kabupaten_id = $('#old_kabupaten_id').val();
                var old_kecamatan_id = $('#old_kecamatan_id').val();
                var customer_destination_code = $('#customer_id option:selected').data('destination_code');
                var customer_kecamatan_id = $('#customer_id option:selected').data('subdistrict');
                var customer_kabupaten_id = $('#customer_id option:selected').data('city');
                var customer_provinsi_id = $('#customer_id option:selected').data('province');

                var current = $(this).attr('id');
                $.ajax({
                    type: 'POST',
                    url: '{{route("destination")}}',
                    data: {
                        province : provinsi_id,
                        city : kabupaten_id,
                        current : current,
                        _token: "{{csrf_token()}}"
                    },
                    dataType: 'JSON',
                    success: function(data){
                        if (current == "kabupaten_id") {
                            $('#kecamatan_id').find('option').remove();
                            $('#kecamatan_id').append('<option value="0">-- Pilih Kecamatan --</option>');

                            $.each(data,function(k,v){
                                if(customer_destination_code != old_kecamatan_id && customer_destination_code == v.subdistrict_id){
                                    $('#kecamatan_id').append('<option value="'+v.subdistrict_id+'" selected>'+v.subdistrict_name+'</option>');
                                }else if(old_kecamatan_id == v.subdistrict_id){
                                    $('#kecamatan_id').append('<option value="'+v.subdistrict_id+'" selected>'+v.subdistrict_name+'</option>');
                                }else{
                                    $('#kecamatan_id').append('<option value="'+v.subdistrict_id+'">'+v.subdistrict_name+'</option>');
                                }
                            });
                            $('#kecamatan_id').change();
                        }else if (current == "provinsi_id") {
                            $('#kabupaten_id').find('option').remove();
                            $('#kabupaten_id').append('<option value="0">-- Pilih Kabupaten --</option>');
                            $('#kecamatan_id').find('option').remove();
                            $('#kecamatan_id').append('<option value="0">-- Pilih Kecamatan --</option>');

                            $.each(data,function(k,v){
                                if(customer_kabupaten_id != old_kabupaten_id && customer_kabupaten_id == v.city_id){
                                    $('#kabupaten_id').append('<option value="'+v.city_id+'" selected>'+v.city_name+'</option>');
                                }else if(old_kabupaten_id == v.city_id){
                                    $('#kabupaten_id').append('<option value="'+v.city_id+'" selected>'+v.city_name+'</option>');
                                }else{
                                    $('#kabupaten_id').append('<option value="'+v.city_id+'">'+v.city_name+'</option>');
                                }
                            });
                            $('#kabupaten_id').change();
                        }
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            }).change();
        });

        $('#match').hide();
        $(function () {
            $('#passwordbaru, #confirmpassword').on('keyup', function () {
                if ($('#passwordbaru').val() == $('#confirmpassword').val()) {
                    $('#match').fadeOut(500);
                    $('#save').prop('disabled', false);
                } else if ($('#confirmpassword').val() !== '') {
                    $('#match').fadeIn(500);
                    $('#save').prop('disabled', true);
                }
            });
        })
    </script>
@endpush

@section('postWithAjax')
    @if(session('status_password_salah'))
    Swal.fire({
        title: "Warning",
        text: "Password Lama Salah!",
        type: "error",
    });
    @endif
    @if(session('status_password_berbeda'))
    Swal.fire({
        title: "Warning",
        text: "Konfirmasi Password Tidak Sama!",
        type: "error",
    });
    @endif
    postWithAjax("formCustomer","{{ route('akun.save_setting')}}");
    postWithAjax("formCustomerAlamat","{{ route('akun.save_setting')}}");
    postWithAjax("formCustomerPassword","{{ route('akun.save_setting')}}");
@endsection
