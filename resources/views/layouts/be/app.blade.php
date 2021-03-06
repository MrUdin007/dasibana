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

        @stack('css')
        <link href="{{ asset('dist/be/css/main.css') }}" rel="stylesheet">
        <link href="{{ asset('dist/be/css/custom.css') }}" rel="stylesheet">
        <link href="{{ asset('dist/be/vendor/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('dist/be/vendor/datatables/rowReorder.dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ asset('dist/vendors/css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
        <link href="{{ asset('dist/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
        <link href="{{ asset('dist/be/vendor/datatables/jquery.dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ asset('dist/be/css/floating_input.css') }}" rel="stylesheet">
        <style>
            table .tt-status{
                position: relative;
            }

            table .tt-status::after{
                right: 0.5em;
                content: "\2193";
            }

            table .tt-status::before{
                right: 1em;
                content: "\2191";
            }

            table .tt-status::after, table .tt-status::before{
                position: absolute;
                bottom: 0.9em;
                display: block;
                opacity: 0.3;
            }

            .swal2-popup{
                padding: 30px !important;
                padding-bottom: 40px !important;
            }

            .swal2-popup .swal2-styled{
                padding: 8px 25px !important;
                font-size: 14px !important;
            }

            div, span, p, h1, h2, h3, h4, h5, small, td{
                word-wrap: anywhere;
            }

            ::placeholder {
                color:rgb(133,130,130);
                opacity: 1;
            }
        </style>
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
        <script type="text/javascript" src="{{ asset('dist/vendors/js/bootstrap.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/vendors/js/hide_input.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/be/vendor/js/vendor.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/be/vendor/js/bundle.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/be/vendor/datatables/dataTables.rowReorder.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/be/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/vendors/select2/dist/js/select2.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/be/vendor/ckeditor4/ckeditor.js') }}"></script>

        <script type="text/javascript">
            window.addEventListener('load', function load() {
                const loader = document.getElementById('loader');
                setTimeout(function() {
                    loader.classList.add('fadeOut');
                }, 300);
            });
        </script>
        @stack('scripts')
    </body>
</html>
