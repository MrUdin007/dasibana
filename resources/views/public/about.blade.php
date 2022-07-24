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
            <h3 class="subs-title">tentang dasibana</h3>
        </div>
        <div class="box-ct-section">
            <div class="container section-ct">
                <div class="gr_display about-content">
                    <div class="about-img" style="background-image: url('{{asset('images/pic4.jpg')}}')"></div>
                    <div class="ct-about">
                        <h4 class="text-capitalize text-center main-title">deskripsi perusahaan</h4>
                        <hr style="color: #0b303c !important; border-width: 1.4px;">
                        <p class="text-left mt-4 mb-2">Nama Bisnis : <span>{{$profil->nama_bisnis}}</span></p>
                        <p class="text-left mb-2">Tahun dibangun : <span>{{$profil->tahun}}</span></p>
                        <p class="text-left mb-2">Pemilik : <span>{{$profil->pemilik}}</span></p>
                        <p class="text-left mb-2">Alamat : <span>{{$profil->alamat}}</span></p>
                        <p class="text-left mb-2">{{$profil->deskripsi}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')

@endpush
