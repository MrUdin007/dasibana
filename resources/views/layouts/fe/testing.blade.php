<!DOCTYPE html>
<html>
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

        @stack('css')
        <link href="{{ asset('dist/vendors/css/bootstrap.css') }}" rel="stylesheet">
    </head>
    <body class="app">
        <div id='loader'>
            <div class="spinner"></div>
        </div>

        <!-- @App Content -->
        <!-- =================================================== -->
        <div>
            <!-- Start: Sidebar -->
            <!-- ============================================================== -->
            @include('layouts.be.sidebar')
            <!-- ============================================================== -->
            <!-- End:/ Sidebar -->

            <!-- #Main ============================ -->
            <div class="page-container">
                <!-- Start: Header -->
                <!-- ============================================================== -->
                @include('layouts.be.header')
                <!-- ============================================================== -->
                <!-- End:/ Header -->

                <!-- ### $App Screen Content ### -->
                <main class='main-content bgc-grey-100'>
                    @yield('content')
                </main>

                <!-- Start: Footer -->
                <!-- ============================================================== -->
                @include('layouts.be.footer')
                <!-- ============================================================== -->
                <!-- End:/ Footer -->
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script type="text/javascript" src="{{ asset('dist/be/vendor/jquery/dist/jquery.min.js') }}"></script>
        @stack('scripts')
    </body>
</html>
