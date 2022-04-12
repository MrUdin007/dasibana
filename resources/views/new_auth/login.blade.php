@extends('layouts.be.app')

@push('css')
    <link href="{{ asset('dist/be/css/login.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="login-sec">
        <div class="card-login">
            <h3 class="title">login form</h3>
            <form id="formLogin" class="form-vegan" action="{{ $api_url . 'login' }}">
                <div class="form-group">
                    <h6 class="clr-white m-0 mb-10 med-small-fnt text-capitalize">email address</h6>
                    <div class="float-inpt-fld">
                        <input id="email" type="email" class="floatfield form-control field-main-oz" name="email" placeholder=" " value="" required autocomplete="email" aria-describedby="email" autofocus>
                        <div class="lbl-float-inpt">
                            <label for="email">Email Address</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <h6 class="clr-white m-0 mb-10 med-small-fnt text-capitalize">password</h6>
                    <div class="float-inpt-fld">
                        <input id="password" type="password" class="floatfield form-control field-main-oz" name="password" placeholder=" " aria-describedby="password" autocomplete="current-password" required>
                        <div class="lbl-float-inpt">
                            <label for="password">Password</label>
                        </div>
                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="mt-40">
                        <button type="submit" class="submit-btn">
                            login
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
<script>
    $(document).on('submit', '#formLogin', function (e) {
        e.preventDefault();
        var form = $('#formLogin'),
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
            success: function (response) {
                if (response.success) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('login.callback') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "api_token": response.token
                        },
                        success: function (response) {
                            let timerInterval
                            Swal.fire({
                                title: 'Sukses',
                                html: 'Login Berhasil',
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                timer: 1000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    timerInterval = setInterval(() => {
                                        const content = Swal.getHtmlContainer()
                                        if (content) {
                                            const b = content.querySelector('b')
                                            if (b) {
                                                b.textContent = Swal.getTimerLeft()
                                            }
                                        }
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    console.log('I was closed by the timer');
                                    window.location = response.url;
                                }
                            });
                            // Swal.fire({
                            //     title: "Sukses",
                            //     text: "Login Berhasil",
                            //     showConfirmButton: false,
                            //     allowOutsideClick: false,
                            // }).then((result) => {
                            //     console.log(result);
                            //     console.log(response);
                            //     window.location = response.url
                            // });
                        },
                        error: function (error) { console.log(error); }
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Login Gagal',
                        text: 'Username atau Password salah',
                        allowOutsideClick: false
                    }).then(() => window.location.reload());
                }
            },
            error: function (error) { console.log(error); }
        });
    });

</script>
@endpush
