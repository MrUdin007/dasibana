@extends('layouts.fe.auth.auth')

@section('metadata')
    <title>Veganesia - Reset Password</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/auth/reset_password.css') }}">
@endpush

@section('content')
    <div class="resetpw-page container">
        <div class="logo-oz">
            <a href="{{ route('home') }}">
                <img src="{{ asset('dist/be/icons/logo-vegan.png') }}" alt="" class="logo-vegan-text">
            </a>
        </div>
        <div class="sec-resetpw">
            <div class="mt-2 mb-2">
                <h5 class="desc-main-text-lg f-Asap_bold text-capitalize">
                    reset password
                </h5>
                <p class="med-small-fnt clr-grey-txt">
                    Masukkan email anda untuk melakukan reset password
                </p>
            </div>
            <form action="" class="form-vegan" id="formResetPW" autocomplete="off">
                @csrf
                <div>
                    <h6 class="clr-grey-txt f-Asap_medium med-small-fnt mb-3">Password Lama</h6>
                    <div class="float-inpt-fld">
                        <input type="password" class="floatfield form-control field-main-oz" id="passwordold" name="passwordold" placeholder=" " aria-describedby="passwordold" autocomplete="new-passwordold">
                        <div class="lbl-float-inpt">
                            <label for="passwordold">Passwordold</label>
                        </div>
                        <span toggle="#passwordold" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                </div>
                <div>
                    <h6 class="clr-grey-txt f-Asap_medium med-small-fnt mb-3">Password Baru</h6>
                    <div class="float-inpt-fld">
                        <input type="password" class="floatfield form-control field-main-oz" id="passwordbaru" name="passwordbaru" placeholder=" " aria-describedby="passwordbaru" autocomplete="new-passwordbaru">
                        <div class="lbl-float-inpt">
                            <label for="passwordbaru">Passwordbaru</label>
                        </div>
                        <span toggle="#passwordbaru" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                </div>
                <div class="mt-4 mb-4">
                    <button type="button" class="text-capitalize btn-vegan green-bg-btn" data-dismiss="modal" data-toggle="modal" data-target="#resetpassword" data-backdrop="static" data-keyboard="false">
                        reset password
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Start Modal Reset Password -->
    <div class="modal-vegan mdl-rstpw" data-backdrop="static" data-keyboard="false">
        <div class="modal fade" id="resetpassword" tabindex="-1" role="dialog" aria-labelledby="registerLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="bg-register mdl-bg" style="background-image: url('{{ asset('dist/be/icons/maskot-vegan.png') }}');"></div>
                        <div class="m-auto d-block text-center">
                            <h5 class="f-Asap_bold desc-main-text-lg clr-lght-gsh">
                                Reset Password
                            </h5>
                            <p class="med-small-fnt clr-grey-txt">
                                Silahkan cek email anda untuk mendapatkan link reset password
                            </p>
                        </div>
                        <a href="#" type="button" class="text-capitalize btn-vegan green-bg-btn mdl-btn">
                            ok
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End:/ Modal Reset Password -->
@endsection

@push('scripts')
    <script type="text/javascript">
        // KHUSUS RESET PASSWORD
        $(document).ready(function(){
            
        });
    </script>
@endpush