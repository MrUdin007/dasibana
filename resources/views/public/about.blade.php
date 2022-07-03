@extends('layouts.fe.app')

@push('title')
    <title>Tentang Dasibana</title>
@endpush

@push('css')
    <link rel="stylesheet" href="{{asset('dist/fe/css/about.css')}}"/>
@endpush

@section('content')
    <section class="about-dasibana">
        <div class="banner-about" style="background-image: url('{{asset('images/pic3.jpg')}}')">
            <div class="bg-overlay-banner"></div>
            <h3>tentang dasibana</h3>
        </div>
        <div class="container section-ct">
            <div class="gr_display about-content">
                <div class="about-img" style="background-image: url('{{asset('images/pic4.jpg')}}')"></div>
                <div>
                    <h4 class="text-capitalize text-center mb-3">deskripsi perusahaan</h4>
                    <p class="text-center">{{$profil->deskripsi}}</p>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')

@endpush
