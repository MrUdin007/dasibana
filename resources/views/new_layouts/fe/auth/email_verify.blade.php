<!DOCTYPE html>
<html lang="en">
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
        <title>Veganesia - Email Verify</title>
        <!-- Custom CSS -->
        <style>
            @font-face {
                font-family: Asap_reg;
                src: url("{{ asset('dist/fe/fonts/asap/Asap-Regular.ttf') }}") format('truetype');
                font-style: normal;
                font-display: swap;
            }
            @font-face {
                font-family: Asap_medium;
                src: url("{{ asset('dist/fe/fonts/asap/Asap-Medium.ttf') }}") format('truetype');
                font-style: normal;
                font-display: swap;
            }
            @font-face {
                font-family: Asap_bold;
                src: url("{{ asset('dist/fe/fonts/asap/Asap-Bold.ttf') }}") format('truetype');
                font-style: normal;
                font-display: swap;
            }
            @font-face {
                font-family: pattaya_medium;
                src: url("{{ asset('dist/be/fonts/pattaya/Pattaya-Regular.ttf') }}") format('truetype');
                font-style: normal;
                font-display: swap;
            }
            /***** start: boostrap******/
            html {
                box-sizing: border-box;
                font-family: sans-serif;
                line-height: 1.15;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
                -ms-overflow-style: scrollbar;
                -webkit-tap-highlight-color: transparent;
            }
            html {
                font-family: sans-serif;
                line-height: 1.15;
                -webkit-text-size-adjust: 100%;
            }
            *, ::after, ::before {
                box-sizing: inherit;
            }
            body, h1, h2, h3, h4, h5, h6, p, a, b, div, .form-control, small{
                font-family: "Asap_reg", sans-serif !important;
                letter-spacing: .02em;
            }
            body {
                margin: 0;
                font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;
                font-size: 1rem;
                font-weight: 400;
                line-height: 1.5;
                color: #212529;
                background-color: #fff;
            }
            a {
                text-decoration: none;
                background-color: transparent;
                -webkit-text-decoration-skip: objects;
            }
            .text-center {
                text-align: center !important;
            }
            .h1, h1 {
                font-size: 2.5rem;
            }
            .h3, h3 {
                font-size: 1.75rem;
            }
            h1, h2, h3, h4, h5, h6 {
                margin-top: 0;
                margin-bottom: .5rem;
            }
            .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
                margin-bottom: .5rem;
                font-family: "Asap_reg", sans-serif !important;
                font-weight: 500;
                line-height: 1.1;
                color: inherit;
            }
            p {
                margin-top: 0;
                margin-bottom: 1rem;
            }
            b, strong {
                font-weight: bolder;
            }

            [type="reset"], [type="submit"], button, html [type="button"] {
                -webkit-appearance: button;
            }
            button, select {
                text-transform: none;
            }
            button, input {
                overflow: visible;
            }
            button, input, optgroup, select, textarea {
                margin: 0;
                font-family: inherit;
                font-size: inherit;
                line-height: inherit;
            }
            [role="button"], a, area, button, input, label, select, summary, textarea {
                -ms-touch-action: manipulation;
                touch-action: manipulation;
            }
            dl, ol, ul {
                margin-top: 0;
                margin-bottom: 1rem;
            }
            /***** end: boostrap******/
            a{
                color: #1FBC9D;
            }
            p {
                font-size: 16px;
            }
            /***** start: custom mail manage page******/
            .bg-vegan{
                background-color: #1FBC9D;
                width: 1199px;
                height: 120px;
                padding-top: 50px;
                margin: auto;
            }
            #mail .vegan-logo{
                font-size: 36px;
                color: #1FBC9D;
                text-transform: capitalize;
                font-family: "pattaya_medium", sans-serif !important;
            }
            #mail{
                box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
                margin: auto;
                width: 768px;
                position: relative;
                z-index: 1;
                height: calc(100vh - 110px);
                background-color: white;
            }

            #mail .box-mail{
                padding: 20px 30px;
            }

            #mail .head{
                margin-bottom: 3rem;
                margin-top: 1rem;
            }

            #mail .head .left{
                text-align: left;
            }

            #mail .head .right{
                text-align: right;
                margin: auto;
                padding-top: 20px;
            }

            #mail .content h1{
                font-size: 30px;
                line-height: 1.5;
                color: #565656;
            }

            #mail button{
                cursor: pointer;
                background: #ffffff;
                padding: 10px 40px;
                border: 1px solid #1FBC9D;
                border-radius: 40px;
            }

            #mail button a{
                font-weight: 600;
            }

            #mail button:hover{
                background: #1FBC9D;
            }

            #mail button:hover a{
                color: #ffffff;
            }

            #mail button .btn-blue:hover{
                background: #1FBC9D
            }

            #mail .content .welcomstext{
                text-align: left;
                font-family: "Asap_medium", sans-serif !important;
                font-size: 28px;
                margin-bottom: 15px;
            }

            #mail .content hr{
                width: 30%;
                height: 2px;
                background: #eee;
                border-radius: 20px;
                border-color: #eee;
            }

            #mail .btn_.start{
                padding: 0 15px;
                border-left: 1px solid #1FBC9D;
            }

            #mail .btn_:hover, #mail .btn_.start:hover{
                color: #000000;
                border-color: #000000;
                opacity: .5;
                text-decoration: none;
            }

            .grid_layouts {
                display: grid;
                align-items: center;
            }
            footer{
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
            }
            footer .footer small {
                color: rgba(0, 0, 0, 0.4);
            }
            footer .footer .gr-autoo {
                grid-template-columns: repeat(2, minmax(1px, auto));
                grid-gap: 10px;
                padding: 15px 0;
            }
            .f-asap-bold{
                font-family: "Asap_bold", sans-serif !important;
            }
            .artc-txt{
                text-align: left;
                color: rgba(0, 0, 0, 0.6);
                font-size: 15px;
            }
            .btn-vegan {
                width: 220px;
                font-size: 16px;
                margin: 40px auto;
                letter-spacing: 0.04em;
                background-color: transparent;
                padding: 10px 16px;
                transition: all 0.3s ease-in-out;
                border: 1px solid transparent;
                border-radius: 8px;
                line-height: 24px;
                text-transform: capitalize;
                display: block;
            }
                .btn-vegan:hover, .btn-vegan:active, .btn-vegan:focus {
                opacity: 0.8 !important;
            }
            .btn-vegan.green-bg-btn {
                background-color: #1FBC9D;
                color: #ffffff;
                text-align: center !important;
                border: 1px solid #1FBC9D !important;
            }
            footer .footer .gr-autoo div {
                padding: 0 20px;
            }
            footer .footer .gr-autoo div:first-child {
                text-align: right;
                padding-right: 30px;
                border-right: 1px solid rgba(0, 0, 0, 0.4);
            }
            footer .footer .gr-autoo div:last-child {
                text-align: left;
            }

            @media screen and (max-width: 1199px){
                .bg-vegan{
                    width: 100%;
                }
            }

            @media screen and (max-width: 767px) {
                #mail h1{
                    font-size: 35px;
                }

                #mail{
                    width: 100%;
                    padding: 10px !important;
                }
            }

            @media screen and (max-width: 575px) {
                #mail .head {
                    padding: 0;
                    margin: 1rem auto 4rem;
                }

                #mail .head .left, #mail .head .right{
                    text-align: center;
                    padding: 0;
                }
            }

            @media (max-width: 424px) {
                #mail .head{
                    margin: .5rem auto 3rem;
                }
                #mail .vegan-logo{
                    font-size: 30px;
                }
                .btn-vegan {
                    font-size: 13px;
                    width: 150px;
                    padding: 6px 16px;
                }
                footer .footer .gr-autoo {
                    grid-template-columns: minmax(1px, auto);
                    grid-gap: 0;
                }
                footer .footer .gr-autoo small {
                    text-align: center !important;
                    display: block;
                }
            }
            /***** end:/ custom mail manage page******/
        </style>
    </head>
    <body>
        <div class="bg-vegan">
            <div id="mail" class="text-center">
                <div class="box-mail">
                    <div class="head">
                        <h6 class="vegan-logo">veganesia</h6>
                    </div>
                    <div class="content">
                        <h4 class="welcomstext">
                            Hai, Sahabat Vegan
                        <p class="artc-txt">
                            Yuk verifikasi akun kamu , untuk mastiin kamu  masukin email yang tepat (valid) , silahkan klik tombol di bawah ini
                        </p>
                        <a href="{{ route('email_verification', ['token' => $email_token]) }}" class="btn-vegan green-bg-btn">
                            aktifkan sekarang
                        </a>
                        <p class="artc-txt">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut at bibendum id vulputate nunc, sed. Bibendum proin fermentum in purus id vel nullam. Aliquam vel habitasse.
                        </p>
                        <div class="greetings" style="margin-top: 50px">
                            <p class="artc-txt" style="text-transform: capitalize; margin-bottom: 5px;">terima kasih,</p>
                            <p class="artc-txt f-asap-bold" style="text-transform: capitalize">veganesia</p>
                        </div>
                    </div>
                </div>
                <footer>
                    <div class="footer">
                        <div class="grid_layouts gr-autoo">
                            <div>
                                <small class="f-Asap_reg mn-small-fnt">© Veganesia - 2021</small>
                            </div>
                            <div>
                                <small class="f-Asap_reg mn-small-fnt">Developed by Oninyon</small>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
