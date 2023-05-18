<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Argon Dashboard') }}</title>
        <!-- Favicon -->
        <link type="image/png" sizes="16x16" rel="icon" href="{{ asset('argon') }}/img/favicon/r16.png">
        <link type="image/png" sizes="32x32" rel="icon" href={{ asset('argon') }}/img/favicon/r32.png">
        <link type="image/png" sizes="96x96" rel="icon" href="{{ asset('argon') }}/img/favicon/r96.png">
        <link type="image/png" sizes="120x120" rel="icon" href="{{ asset('argon') }}/img/favicon/r120.png">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Extra details for Live View on GitHub Pages -->

        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v={{time()}}" rel="stylesheet">

        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
        <script src="https://unpkg.com/imask"></script>
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            @if (!isset($no_sidebar))
                <form id="logout-form" action="{{ route(\App\Http\Controllers\DefaultController::ROUTE_LOGOUT) }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @include('layouts.navbars.sidebar')
            @endif
        @endauth

        <div class="main-content">
            @if (!isset($no_sidebar))
                @include('layouts.navbars.navbar')
            @endif
            @yield('content')
        </div>

        @guest()
            @if (!isset($no_sidebar))
                @include('layouts.footers.guest')
            @endif
        @endguest

        @stack('js')

        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>

        <script type="text/javascript">

            function copyToClipboard(text) {
                var inputc = document.body.appendChild(document.createElement("input"));
                inputc.value = text;
                inputc.select();
                document.execCommand('copy');
                inputc.parentNode.removeChild(inputc);
            }

            $(function () {
                $('.format-date').each(function () {
                    var d = new Date(this.getAttribute('data-date'));
                    $(this).html(d.toLocaleString());
                })
            })
        </script>

{{--        <script type="text/javascript">--}}
{{--            document.addEventListener('DOMContentLoaded', () => {--}}
{{--                const inputElement = document.getElementById('price',)--}}
{{--                const maskOptions = {--}}
{{--                    mask: Number,--}}
{{--                }--}}
{{--                IMask(inputElement, maskOptions);--}}
{{--            })--}}
{{--        </script>--}}

{{--        <script type="text/javascript">--}}
{{--            document.addEventListener('DOMContentLoaded', () => {--}}
{{--                const inputElement = document.getElementById('taken')--}}
{{--                const maskOptions = {--}}
{{--                    mask: Number,--}}
{{--                }--}}
{{--                IMask(inputElement, maskOptions);--}}
{{--            })--}}
{{--        </script>--}}

{{--        <script type="text/javascript">--}}
{{--            document.addEventListener('DOMContentLoaded', () => {--}}
{{--                const inputElement = document.getElementById('qty')--}}
{{--                const maskOptions = {--}}
{{--                    mask: Number,--}}
{{--                }--}}
{{--                IMask(inputElement, maskOptions);--}}
{{--            })--}}
{{--        </script>--}}
    </body>
</html>
