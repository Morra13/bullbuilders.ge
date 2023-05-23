<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span>  {{__( 'nav.menu' )}}
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav mr-auto">
                @if($page == 'main')
                    <li class="nav-item active">
                    @else
                    <li class="nav-item">
                @endif
                    <a class="nav-link" href="{{ route(\App\Http\Controllers\PublicController::ROUTE_INDEX) }}"> {{__( 'nav.main' )}} </a>
                </li>
                @if($page == 'about')
                    <li class="nav-item active">
                    @else
                    <li class="nav-item">
                @endif
                    <a class="nav-link" href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_ABOUT) }}"> {{__( 'nav.about' )}} </a>
                </li>
                @if($page == 'partners')
                    <li class="nav-item active">
                    @else
                    <li class="nav-item">
                @endif
                    <a class="nav-link" href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_PARTNERS) }}"> {{__( 'nav.partners' )}} </a>
                </li>
                @if($page == 'products')
                    <li class="nav-item active">
                    @else
                    <li class="nav-item">
                @endif
                    <a class="nav-link" href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_PRODUCTS) }}"> {{__( 'nav.products' )}} </a>
                </li>
                @if($page == 'projects')
                    <li class="nav-item active">
                    @else
                    <li class="nav-item">
                @endif
                    <a class="nav-link" href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_PROJECTS) }}"> {{__( 'nav.projects' )}} </a>
                </li>
                @if($page == 'contact')
                    <li class="nav-item active">
                    @else
                    <li class="nav-item">
                @endif
                    <a class="nav-link" href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_CONTACT) }}"> {{__( 'nav.contact' )}} </a>
                </li>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route(\App\Http\Controllers\PublicController::ROUTE_CHANGE_LANG , 'ge') }}">
                                <span class="flag-icon flag-icon-ge"></span> Geo
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route(\App\Http\Controllers\PublicController::ROUTE_CHANGE_LANG , 'ru') }}">
                                <span class="flag-icon flag-icon-ru"></span> Ru
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route(\App\Http\Controllers\PublicController::ROUTE_CHANGE_LANG , 'en') }}">
                                <span class="flag-icon flag-icon-us"></span> Eng
                            </a>
                        </li>
                    </ul>
            </ul>
        </div>
    </div>
</nav>
