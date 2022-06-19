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
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicons/apple-touch-icon.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicons/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicons/favicon-16x16.png')}}">
        <link rel="manifest" href="{{asset('images/favicons/site.webmanifest')}}">
        <!-- ****** faviconit.com favicons ****** -->

        @stack('css')
        <link href="{{ asset('dist/be/css/main.css') }}" rel="stylesheet">
        <link href="{{ asset('dist/be/vendor/css/style.css') }}" rel="stylesheet">
        <!-- <link href="{{ asset('dist/vendors/css/bootstrap.css') }}" rel="stylesheet"> -->
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
        <!-- <script type="text/javascript" src="{{ asset('dist/be/js/app.js') }}"></script> -->
        <!-- <script type="text/javascript" src="{{ asset('dist/be/vendor/jquery/dist/jquery.min.js') }}"></script> -->
        <script type="text/javascript" src="{{ asset('dist/be/vendor/js/vendor.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/be/vendor/js/bundle.js') }}"></script>

        <script type="text/javascript">
            window.addEventListener('load', function load() {
                const loader = document.getElementById('loader');
                setTimeout(function() {
                    loader.classList.add('fadeOut');
                }, 300);
            });
            $(document).ready(function () {
                $('#dropdownVeganesia').click(function(){
                    $('#menudropdownheader').toggle();
                });

                $("#tesmodal").click(function(){
                    $("#exampleModal").modal('show');
                });

                $('.logout-veg').click(function () {
                    $('#formLogout').submit();
                });

            });

        </script>
        @stack('scripts')
    </body>
</html>
