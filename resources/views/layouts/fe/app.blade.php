<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- CSRF Token -->
        @stack('title')

        <!-- ****** faviconit.com favicons ****** -->
        <link rel="apple-touch-icon" sizes="57x57" href="{{asset('images/favicons/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{asset('images/favicons/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{asset('images/favicons/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/favicons/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{asset('images/favicons/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{asset('images/favicons/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{asset('images/favicons/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{asset('images/favicons/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicons/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('images/favicons/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicons/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{asset('images/favicons/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicons/favicon-16x16.png')}}">
        <link rel="manifest" href="{{asset('images/favicons/manifest.json')}}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{asset('images/favicons/ms-icon-144x144.png')}}">
        <meta name="theme-color" content="#ffffff">
        <!-- ****** faviconit.com favicons ****** -->

        <link href="{{asset('dist/fe/css/bootstrap.min.css')}}" rel="stylesheet" crossorigin="anonymous">
        <link href="{{asset('dist/fe/css/main.css')}}" rel="stylesheet" crossorigin="anonymous">
        @stack('css')
    </head>
    <body>
        <!-- @App Content -->
        <!-- =================================================== -->
        <div>
            <!-- Start: Header -->
            <!-- ============================================================== -->
            @include('layouts.fe.header')
            <!-- ============================================================== -->
            <!-- End:/ Header -->

            <!-- #Main ============================ -->
            <div class="dasibana-content">
                <!-- ### $App Screen Content ### -->
                <div class="dasibana-page">
                    @yield('content')
                </div>

                <!-- Start: Footer -->
                <!-- ============================================================== -->
                @include('layouts.fe.footer')
                <!-- ============================================================== -->
                <!-- End:/ Footer -->
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <!-- JavaScript Bundle with Popper -->
        <script src="{{asset('dist/fe/js/bootstrap.bundle.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{asset('dist/fe/js/jquery.min.js')}}" crossorigin="anonymous"></script>
        @stack('scripts')
    </body>
</html>
