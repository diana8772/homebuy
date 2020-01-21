<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/app.css') }}">
        <style>
            html, body {
                background: url("public/image/7.png");
                background-size: cover;
                font-family: 'Microsoft JhengHei', sans-serif;
                font-weight: 100;
                font-weight:bold;
                margin: 0;
                width: 100%;
                height: 100px;
            }.links > a {
                font-size: 16px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <div class="content">
                <div class="title m-b-md">
                    台中房屋
                </div>
            </div>
        </div>
    </body>
</html>
