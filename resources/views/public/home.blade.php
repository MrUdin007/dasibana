@extends('layouts.fe.app')

@push('title')
    <title>Dasibana</title>
@endpush

@push('css')
    <link rel="stylesheet" href="{{asset('dist/fe/css/home.css')}}"/>
@endpush

@section('content')
    <section class="home-dasibana">
        <div class="banner-dasibana" style="background-image: url('{{asset('images/banner.jpg')}}')">
            <div class="container">
                <div class="dasibana-icon-name">
                    <h1>
                        dasibana
                    </h1>
                </div>
            </div>
        </div>

        <div class="produk-unggulan section-ct">
            <div class="container">
                <h1 class="main-title">produk unggulan</h1>
                <div class="gr_display gr-prodc">
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset('images/product1.jpg')}}')"></div>
                    </div>
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset('images/product5.jpg')}}')"></div>
                    </div>
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset('images/product8.jpg')}}')"></div>
                    </div>
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset('images/product1.jpg')}}')"></div>
                    </div>
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset('images/product1.jpg')}}')"></div>
                    </div>
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset('images/product5.jpg')}}')"></div>
                    </div>
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset('images/product8.jpg')}}')"></div>
                    </div>
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset('images/product1.jpg')}}')"></div>
                    </div>
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset('images/product8.jpg')}}')"></div>
                    </div>
                    <div class="produk-item">
                        <div class="pic-produk" style="background-image: url('{{asset('images/product1.jpg')}}')"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

        });
    </script>
@endpush
