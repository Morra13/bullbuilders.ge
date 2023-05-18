<?
$obEnum = (new \App\Http\Controllers\Enum\LangController())::getLang();
?>

<!--  Всплывающее меню для пойска  -->
{{--<div class="search-wrapper section-padding-100">--}}
{{--    <div class="search-close">--}}
{{--        <i class="fa fa-close" aria-hidden="true"></i>--}}
{{--    </div>--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <div class="search-content">--}}
{{--                    <form action="#" method="get">--}}
{{--                        <input type="search" name="search" id="search" placeholder="Type your keyword...">--}}
{{--                        <button type="submit"><img src="{{ asset('argon') }}/amado/img/core-img/search.png" alt=""></button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="mobile-nav">
    <!-- Navbar Brand -->
    <div class="amado-navbar-brand">
        <a href="{{ route(\App\Http\Controllers\PublicController::ROUTE_INDEX) }}"><img src="{{ asset('argon') }}/amado/img/core-img/logo.png" alt=""></a>
    </div>
    <!-- Navbar Toggler -->
    <div class="amado-navbar-toggler">
        <span></span><span></span><span></span>
    </div>
</div>

<!-- Header Area Start -->
<header class="header-area clearfix">
    <!-- Close Icon -->
    <div class="nav-close">
        <i class="fa fa-close" aria-hidden="true"></i>
    </div>
    <!-- Logo -->
    <div class="logo">
        <a href="{{ route(\App\Http\Controllers\PublicController::ROUTE_INDEX) }}"><img src="{{ asset('argon') }}/amado/img/core-img/logo.png" alt=""></a>
    </div>
    <!-- Amado Nav -->
    <nav class="amado-nav">
        <ul>
            <li class="active"><a href="{{ route(\App\Http\Controllers\PublicController::ROUTE_INDEX) }}">{{$obEnum::MAIN}}</a></li>
            <li><a href="{{ route(\App\Http\Controllers\AmadoController::ROUTE_PRODUCT) }}">{{$obEnum::PRODUCTS}}</a></li>
            <li><a href="{{ route(\App\Http\Controllers\AmadoController::ROUTE_ABOUT) }}">{{$obEnum::ABOUT}}</a></li>
        </ul>
    </nav>
    <!-- Button Group -->
    <div class="amado-btn-group mt-30 mb-100">
        <a href="#" class="btn amado-btn mb-15">%Discount%</a>
        <a href="#" class="btn amado-btn active">New this week</a>
    </div>
    <!-- Cart Menu -->
    <div class="cart-fav-search mb-100">
        <a href="{{ route(\App\Http\Controllers\AmadoController::ROUTE_BASKET) }}" class="cart-nav"><img src="{{ asset('argon') }}/amado/img/core-img/cart.png" alt=""> {{$obEnum::BASKET}} <span>(0)</span></a>
{{--        <a href="#" class="fav-nav"><img src="{{ asset('argon') }}/amado/img/core-img/favorites.png" alt=""> Favourite</a>--}}
{{--        <a href="#" class="search-nav"><img src="{{ asset('argon') }}/amado/img/core-img/search.png" alt=""> Search</a>--}}
    </div>
    <!-- Social Button -->
{{--    <div class="social-info d-flex justify-content-between">--}}
{{--        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>--}}
{{--        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>--}}
{{--        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>--}}
{{--        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>--}}
{{--    </div>--}}
</header>
