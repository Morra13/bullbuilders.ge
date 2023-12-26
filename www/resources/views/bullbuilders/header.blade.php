<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Argon Dashboard') }}</title>

        <link type="image/png" sizes="16x16" rel="icon" href="{{ asset('argon') }}/img/favicon/r16.png">
        <link type="image/png" sizes="32x32" rel="icon" href={{ asset('argon') }}/img/favicon/r32.png">
        <link type="image/png" sizes="96x96" rel="icon" href="{{ asset('argon') }}/img/favicon/r96.png">
        <link type="image/png" sizes="120x120" rel="icon" href="{{ asset('argon') }}/img/favicon/r120.png">

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="{{ asset('argon') }}/bullbuilders/css/animate.css">

        <link rel="stylesheet" href="{{ asset('argon') }}/bullbuilders/css/owl.carousel.min.css">
        <link rel="stylesheet" href="{{ asset('argon') }}/bullbuilders/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="{{ asset('argon') }}/bullbuilders/css/magnific-popup.css">

        <link rel="stylesheet" href="{{ asset('argon') }}/bullbuilders/css/ionicons.min.css">

        <link rel="stylesheet" href="{{ asset('argon') }}/bullbuilders/css/flaticon.css">
        <link rel="stylesheet" href="{{ asset('argon') }}/bullbuilders/css/icomoon.css">
        <link rel="stylesheet" href="{{ asset('argon') }}/bullbuilders/css/style.css">
        <link rel="stylesheet" href="{{ asset('argon') }}/bullbuilders/css/flag.css">
        <link rel="stylesheet" href="{{ asset('argon') }}/bullbuilders/css/myStyle.css?{{time()}}">
    </head>
<body>

<div class="container pt-5">
    <div class="row justify-content-between">
        <div class="col">
            <a class="navbar-brand pt-0" href="{{ route(\App\Http\Controllers\PublicController::ROUTE_INDEX) }}">
                <img src="{{ asset('argon') }}/img/brand/logo_1.png" class="navbar-brand-img" alt="...">
            </a>
        </div>
        <div class="center">
            <a class="navbar-brand center" href="{{ route(\App\Http\Controllers\PublicController::ROUTE_INDEX) }}">Bull<span><i>builders.</i></span>
            </a>
        </div>
        <div class="col d-flex justify-content-end">
            <div class="social-media">
                <p class="mb-0 d-flex">
                    <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
                    <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
                    <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
                    <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
                </p>
            </div>
        </div>
    </div>
</div>
@include('bullbuilders.navbar')

@yield('content')

@include('bullbuilders.footer')

<script src="{{ asset('argon') }}/bullbuilders/js/jquery.min.js"></script>
<script src="{{ asset('argon') }}/bullbuilders/js/jquery-migrate-3.0.1.min.js"></script>
<script src="{{ asset('argon') }}/bullbuilders/js/popper.min.js"></script>
<script src="{{ asset('argon') }}/bullbuilders/js/bootstrap.min.js"></script>
<script src="{{ asset('argon') }}/bullbuilders/js/jquery.easing.1.3.js"></script>
<script src="{{ asset('argon') }}/bullbuilders/js/jquery.waypoints.min.js"></script>
<script src="{{ asset('argon') }}/bullbuilders/js/jquery.stellar.min.js"></script>
<script src="{{ asset('argon') }}/bullbuilders/js/jquery.animateNumber.min.js"></script>
<script src="{{ asset('argon') }}/bullbuilders/js/owl.carousel.min.js"></script>
<script src="{{ asset('argon') }}/bullbuilders/js/jquery.magnific-popup.min.js"></script>
<script src="{{ asset('argon') }}/bullbuilders/js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="{{ asset('argon') }}/bullbuilders/js/google-map.js"></script>
<script src="{{ asset('argon') }}/bullbuilders/js/main.js"></script>

</body>
</html>

