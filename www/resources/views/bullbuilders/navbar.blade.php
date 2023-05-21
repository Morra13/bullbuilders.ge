<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span> {{$obEnum::MENU}}
        </button>
{{--        <form action="#" class="searchform order-lg-last">--}}
{{--            <div class="form-group d-flex">--}}
{{--                <input type="text" class="form-control pl-3" placeholder="Search">--}}
{{--                <button type="submit" placeholder="" class="form-control search"><span class="fa fa-search"></span></button>--}}
{{--            </div>--}}
{{--        </form>--}}
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav mr-auto">
                @if($page == 'main')
                    <li class="nav-item active">
                    @else
                    <li class="nav-item">
                @endif
                    <a class="nav-link" href="{{ route(\App\Http\Controllers\PublicController::ROUTE_INDEX) }}">{{$obEnum::MAIN}}</a>
                </li>
                @if($page == 'about')
                    <li class="nav-item active">
                    @else
                    <li class="nav-item">
                @endif
                    <a class="nav-link" href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_ABOUT) }}">{{$obEnum::ABOUT}}</a>
                </li>
                @if($page == 'partners')
                    <li class="nav-item active">
                    @else
                    <li class="nav-item">
                @endif
                    <a class="nav-link" href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_PARTNERS) }}">{{$obEnum::PARTNERS}}</a>
                </li>
                @if($page == 'products')
                    <li class="nav-item active">
                    @else
                    <li class="nav-item">
                @endif
                    <a class="nav-link" href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_PRODUCTS) }}">{{$obEnum::PRODUCTS}}</a>
                </li>
                @if($page == 'projects')
                    <li class="nav-item active">
                    @else
                    <li class="nav-item">
                @endif
                    <a class="nav-link" href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_PROJECTS) }}">{{$obEnum::PROJECTS}}</a>
                </li>
                @if($page == 'contact')
                    <li class="nav-item active">
                    @else
                    <li class="nav-item">
                @endif
                    <a class="nav-link" href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_CONTACT) }}">{{$obEnum::CONTACT}}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
