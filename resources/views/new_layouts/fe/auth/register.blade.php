@extends('layouts.fe.auth.auth')

@section('metadata')
    <title>Veganesia - Register</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/auth/register.css') }}">
@endpush

@section('content')
    <div class="register-page container">
        <div class="logo-oz">
            <a href="{{ route('home') }}">
                <img src="{{ asset('dist/be/icons/logo-vegan.png') }}" alt="" class="logo-vegan-text">
            </a>
            <p style="color: rgba(0, 0, 0, 0.5);" class="text-center mt-3">
                Toko Vegan pertama telengkap di indonesia
            </p>
        </div>
        <div class="grid_layouts sec-register">
            <div>
                <div class="bg-register" style="background-image: url('{{ asset('dist/be/icons/bg-1.png') }}');"></div>
                <div class="m-auto d-block text-center">
                    <h5 class="f-Asap_bold desc-main-text-lg clr-lght-gsh">Yuk! daftar akun Veganesia</h5>
                    <p class="clr-grey-txt">
                        Nikmati keuntungan dengan memiliki akun Veganesia, segera lengkapi data dibawah ini!
                    </p>
                </div>
            </div>
            <div>
                <form action="" class="form-vegan" id="formRegister" autocomplete="off">
                    @csrf
                    <div>
                        <h6 class="clr-grey-txt f-Asap_medium med-small-fnt mb-3">Email</h6>
                        <div class="float-inpt-fld">
                            <input type="email" class="floatfield floating-custom form-control field-main-oz" id="email" name="email" placeholder=" " aria-describedby="email" required>
                            <div class="lbl-float-inpt">
                                <label for="email">Email</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h6 class="clr-grey-txt f-Asap_medium med-small-fnt mb-3">Nomor HP</h6>
                        <div class="float-inpt-fld">
                            <input type="number" class="floatfield floating-custom form-control field-main-oz" id="nohp" name="phone" placeholder=" " aria-describedby="nohp" required>
                            <div class="lbl-float-inpt">
                                <label for="nohp">Nomor HP</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h6 class="clr-grey-txt f-Asap_medium med-small-fnt mb-3">Password</h6>
                        <div class="float-inpt-fld">
                            <input type="password" class="floatfield form-control field-main-oz" id="password" name="password" placeholder=" " aria-describedby="password" autocomplete="new-password" required>
                            <div class="lbl-float-inpt">
                                <label for="password">Password</label>
                            </div>
                            <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                    </div>
                    <div>
                        <div class="main-form-vg custom-checkbox">
                            <input class="form-control" type="checkbox" name="iAgree" id="iAgree">
                            <label for="iAgree" class="custom-control-label">
                                Saya Setuju
                            </label>
                        </div>
                    </div>
                    <div class="mt-4 mb-4">
                        <button class="text-capitalize btn-vegan green-bg-btn" id="registr">
                            daftar sekarang
                        </button>
                    </div>
                    <div class="text-center">
                        <p class="mb-0 text-black mn-small-fnt">Jika sudah punya akun silahkan
                            <span>
                                <a type="button" href="{{route('home')}}" class="clr-green">
                                    &nbsp;Masuk
                                </a>
                            </span>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Start Modal Success Register -->
    <div class="modal-vegan mdl-register" data-backdrop="static" data-keyboard="false">
        <div class="modal fade" id="successregister" tabindex="-1" role="dialog" aria-labelledby="registerLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="bg-register mdl-bg" style="background-image: url('{{ asset('dist/be/icons/maskot-vegan.png') }}');"></div>
                        <div class="m-auto d-block text-center">
                            <h5 class="f-Asap_bold desc-main-text-lg clr-lght-gsh">
                                Hi , Selamat datang
                            </h5>
                            <p class="med-small-fnt clr-grey-txt">
                                Selamat datang di Veganesia tempat jual beli produk sehat, Sempatkan cek email anda untuk verifikasi akun, selamat berbelanja !
                            </p>
                        </div>
                        <a href="{{ route('home') }}" type="button" class="text-capitalize btn-vegan green-bg-btn mdl-btn">
                            yuk mulai
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End:/ Modal Success Register -->
@endsection

@push('scripts')
    <script type="text/javascript">
        // KHUSUS REGISTER
        $(document).ready(function(){
            $('#formRegister').on('submit',function (event) {
                event.preventDefault();
                let formData = new FormData($('#formRegister')[0]);

                $.ajax({
                    url: "{{ route('register') }}",
                    method: 'POST',
                    dataType: "json",
                    data : formData,
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS
                    success: function (response) {
                        if (response.success) {
                            // window.location = '{{ route("home") }}';
                            $('#successregister').modal({
                                backdrop: 'static',
                                keyboard: false
                            });
                        } else {
                            if(response.message){
                                let values = '';

                                $.each(response.message, function (key, value) {
                                    values += value
                                });

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: titleCase(values),
                                    allowOutsideClick: false,
                                }).then(() => window.location.reload());
                            }
                        }
                    },
                    error : function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ups!',
                            text: 'Mohon cek kembali inputan Anda',
                        });
                    }
                })
            });
        });

        function letterCase(str) {
            let splitStr = str.toLowerCase().split(' ');
            for (let i = 0; i < splitStr.length; i++) {
                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
            }

            return splitStr.join(' ');
        }
    </script>
@endpush
