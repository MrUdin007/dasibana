@extends('layouts.fe.auth.auth')

@section('metadata')
    <title>Veganesia - Forgot Password</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/auth/forgot_password.css') }}">
@endpush

@section('content')
    <div class="forgotpw-page container">
        <div class="logo-oz">
            <a href="{{ route('home') }}">
                <img src="{{ asset('dist/be/icons/logo-vegan.png') }}" alt="" class="logo-vegan-text">
            </a>
        </div>
        <div class="sec-forgotpw">
            <div class="mt-2 mb-2">
                <h5 class="desc-main-text-lg f-Asap_bold text-capitalize">
                    lupa password
                </h5>
                <p class="med-small-fnt clr-grey-txt">
                    Masukkan email anda untuk melakukan reset password
                </p>
            </div>
            <form action="{{ env('APP_DOWNLOAD') . 'api/forgot_password' }}" method="POST" class="form-vegan" id="formForgotPW" autocomplete="off">
                @csrf
                <div>
                    <h6 class="clr-grey-txt f-Asap_medium med-small-fnt mb-3">Email</h6>
                    <div class="float-inpt-fld">
                        <input type="email" class="floatfield form-control field-main-oz" id="email" name="email" placeholder=" " aria-describedby="email">
                        <div class="lbl-float-inpt">
                            <label for="email">Email</label>
                        </div>
                    </div>
                </div>
                <div class="mt-4 mb-4">
                    <button type="submit" class="text-capitalize btn-vegan green-bg-btn">
                        kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        // KHUSUS FORGOT PASSWORD
        $(document).ready(function(){
            $(document).on('submit', '#formForgotPW', function (e) {
                e.preventDefault();

                let form = $('#formForgotPW'),
                    url  = form.attr('action'),
                    data = new FormData(form[0]);

                $.ajax({
                    url: url,
                    method: 'post',
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    data: data,
                    beforeSend: function () {
                        Swal.fire({
                            title: "Mohon Menunggu",
                            text: "System sedang memproses permintaan Anda",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                        });
                    },
                    success:  (response) => {
                        console.log('suk');
                        if (response.success) {
                            Swal.fire({
                                title: "Sukses",
                                text: response.data + 'Anda akan dialihkan ke halaman utama Veganesia',
                                type: "success",
                                showConfirmButton: true,
                                allowOutsideClick: true,
                            }).then((result) => window.location = '/')
                        } else {
                            Swal.fire({
                                title: "Gagal",
                                text: response.data,
                                type: "error",
                                showConfirmButton: true,
                                allowOutsideClick: true,
                            });
                        }
                    },
                    error: (response) => console.log('we')
                });
            });
        });
    </script>
@endpush
