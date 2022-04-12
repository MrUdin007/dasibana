<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
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

        <!-- Start: custom metadata -->
        @yield('metadata')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Start: custom metadata -->

        <!-- Start: custom stylesheets -->
        <link rel="stylesheet" type="text/css" href="{{ asset('dist/vendors/css/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/template.css') }}">
        @stack('stylesheets')
        <!-- Start: custom stylesheets -->
    </head>
    <body id="body-main">
        <!-- Menu header -->
        <!-- ============================================================== -->
        <header class="header-vegan fixed-top" id="header-main">
            @include('layouts.fe.template.header')
        </header>
        <!-- ============================================================== -->
        <!-- End menu header -->

        <!-- Menu content -->
        <!-- ============================================================== -->
        <div class="body-content-vegan" id="content-mainvegan">
            <div class="container">
                @yield('content')
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End menu content -->

        <!-- Menu footer -->
        <!-- ============================================================== -->
        <footer class="footer-vg" id="footer-main">
            @include('layouts.fe.template.footer')
        </footer>
        <!-- ============================================================== -->
        <!-- End menu footer -->

        <script type="text/javascript">
            var cust_id = 0;
            <?php if(auth('fe')->check()):?>
                <?php 
                    $cust_id = auth('fe')->user()->id;
                ?>
                cust_id = <?php echo $cust_id ?>;
            <?php endif ?>
        </script>

        <script type="text/javascript" src="{{ asset('dist/vendors/js/bootstrap.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                var mxHght = $(window).height();
                var height_header = $('#header-main').height();
                var height_footer = $('#footer-main').height();
                $('#body-main').css('height', mxHght);
                var ct = height_header+height_footer+75;
                $('#content-mainvegan').css({
                    'margin-top': height_header+20,
                    'min-height' : mxHght-ct,
                });

                // LAZY LOAD JANGAN DIHAPUS ATAU DIPINDAHKAN
                !function(window){
                    var $q = function(q, res){
                        if (document.querySelectorAll) {
                            res = document.querySelectorAll(q);
                        } else {
                            var d=document,
                            a=d.styleSheets[0] || d.createStyleSheet();
                            a.addRule(q,'f:b');
                            for(var l=d.all,b=0,c=[],f=l.length;b<f;b++)
                                l[b].currentStyle.f && c.push(l[b]);

                            a.removeRule(0);
                            res = c;
                        }
                        return res;
                    },
                    addEventListener = function(evt, fn){
                        window.addEventListener
                            ? this.addEventListener(evt, fn, false)
                            : (window.attachEvent)
                                ? this.attachEvent('on' + evt, fn)
                                : this['on' + evt] = fn;
                    },
                    _has = function(obj, key) {
                        return Object.prototype.hasOwnProperty.call(obj, key);
                    };

                    function loadImage (el, fn) {
                        var img = new Image(),
                        src = el.getAttribute('data-src'),
                        embed = el.getAttribute('data-embed');
                        img.onload = function() {
                            if (!! el.parent){
                                el.parent.replaceChild(img, el)
                            }
                            else {
                                if (el.tagName == 'IMG') {
                                    el.src = src;
                                } else {
                                    $(el).css("background-image", "url("+src+")");
                                }
                                $(el).addClass('loaded');
                            }
                            if (embed) {
                                $(el).children(0).show();
                            }

                            fn? fn() : null;
                        }
                        if (src) {
                            img.src = src;
                        }
                    }

                    function elementInViewport(el) {
                        var rect = el.getBoundingClientRect();

                        return (
                            rect.top      >= 0
                            && rect.left  >= 0
                            && rect.top   <= (window.innerHeight || document.documentElement.clientHeight)
                        )
                    }

                    var images = new Array(),
                    query = $q('.img-lazy'),
                    processScroll = function(){
                        for (var i = 0; i < images.length; i++) {
                            if (elementInViewport(images[i])) {
                                loadImage(images[i], function () {
                                    images.splice(i, i);
                                });
                            }
                        };
                    };
                    // Array.prototype.slice.call is not callable under our lovely IE8
                    for (var i = 0; i < query.length; i++) {
                        images.push(query[i]);
                    };

                    processScroll();
                    addEventListener('scroll',processScroll);
                }(this);
            });
        </script>
        @stack('scripts')
    </body>
</html>