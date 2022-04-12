@extends('layouts.fe.auth.auth')

@section('metadata')
    <title>Veganesia - </title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/auth/direct.css') }}">
@endpush

@section('content')
    <div class="direct-page container">
        <div class="logo-oz">
            <a href="{{ route('home') }}">
                <img src="{{ asset('dist/be/icons/logo-vegan.png') }}" alt="" class="logo-vegan-text">
            </a>
        </div>
        <div class="sec-direct">
            <div class="mt-2 mb-2">
                <h5 class="desc-main-text-lg text-center f-Asap_bold text-capitalize" style="margin-bottom: 30px;">
                    @if ($success)
                    selamat <br> Akun anda telah berhasil di verifikasi!
                    @else
                    maaf <br> Akun anda gagal di verifikasi!
                    @endif
                </h5>
                <p class="med-small-fnt clr-grey-txt text-center">
                    @if ($success)
                    Silahkan belanja melalui website veganesia atau download aplikasi veganesia
                    @else
                    Silahkan hubungi Customer Service kami
                    @endif
                </p>
                <div class="logooo">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">

    </script>
@endpush
