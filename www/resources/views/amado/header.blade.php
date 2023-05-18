<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title  -->
    <title>{{ $title ?? config('app.name', 'Argon Dashboard') }}</title>`

    <!-- Favicon  -->
    <link type="image/png" sizes="16x16" rel="icon" href="{{ asset('argon') }}/img/favicon/r16.png">
    <link type="image/png" sizes="32x32" rel="icon" href={{ asset('argon') }}/img/favicon/r32.png">
    <link type="image/png" sizes="96x96" rel="icon" href="{{ asset('argon') }}/img/favicon/r96.png">
    <link type="image/png" sizes="120x120" rel="icon" href="{{ asset('argon') }}/img/favicon/r120.png">

    <!-- CSS -->
    <link type="text/css" href="{{ asset('argon') }}/amado/css/core-style.css" rel="stylesheet">
    <link type="text/css" href="{{ asset('argon') }}/amado/css/style.css" rel="stylesheet">

</head>
<body>
    <div class="main-content-wrapper d-flex clearfix">
        @include('amado.sidebar')
        @yield('content')
    </div>
        @include('amado.footer')


    <script src="{{ asset('argon') }}/amado/js/jquery/jquery-2.2.4.min.js"></script>
    <script src="{{ asset('argon') }}/amado/js/popper.min.js"></script>
    <script src="{{ asset('argon') }}/amado/js/bootstrap.min.js"></script>
    <script src="{{ asset('argon') }}/amado/js/plugins.js"></script>
    <script src="{{ asset('argon') }}/amado/js/active.js"></script>

</body>

</html>
