<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- ****** faviconit.com favicons ****** -->
        <link rel="apple-touch-icon" sizes="57x57" href="{{asset('favicon/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{asset('favicon/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{asset('favicon/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{asset('favicon/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{asset('favicon/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{asset('favicon/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{asset('favicon/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{asset('favicon/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('favicon/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">
        <link rel="manifest" href="{{asset('favicon/manifest.json')}}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{asset('favicon/ms-icon-144x144.png')}}">
        <meta name="theme-color" content="#ffffff">
        <!-- ****** faviconit.com favicons ****** -->

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Veganesia - Login Admin</title>
        <link href="{{ asset('dist/be/css/template.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/content/floating_input.css') }}">
        @stack('css')
    </head>
    <body>
        <div id="app" class="auth-reg-vegan">
            <div class="gr-vegan">
                <div class="cover-vegan">
                    <div class="logo-vegan"></div>
                    <div class="cvr-ct">
                        <div class="sec-cover-vegan"></div>
                        <p class="descs">Tempat belanja makanan sehat dan barang vegan dengan harga terbaik</p>
                    </div>
                </div>
                <div class="forms-vegan">
                    <div class="cover-vegan">
                        <div class="logo-vegan"></div>
                        <div class="cvr-ct">
                            <p class="descs">Tempat belanja makanan sehat dan barang vegan dengan harga terbaik</p>
                        </div>
                    </div>
                    <div class="sec-forms-vegan">
                        <div class="form-section-vegan">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="{{ asset('dist/be/js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/vendors/js/hide_input.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
        @stack('script')
    </body>
</html>