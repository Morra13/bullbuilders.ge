{{-- TODO Меню слева --}}
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
{{-- TODO Меню сверху --}}
{{--<nav class="navbar navbar-vertical fixed-left navbar-light bg-white" id="sidenav-main">--}}
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand pt-0" href="/">
            <img src="{{ asset('argon') }}/img/brand/logo_1.png" class="navbar-brand-img" alt="...">
        </a>
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <div class="header-avatar" style="background-image: url('{{asset('storage/' . auth()->user()->logo)}}');"></div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <a href="{{ route(\App\Http\Controllers\UserController::ROUTE_EDIT) }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route(\App\Http\Controllers\DefaultController::ROUTE_LOGOUT) }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="/">
                            <img src="{{ asset('argon') }}/img/brand/logo_4.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
{{--            <ul class="navbar-nav">--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\PublicController::ROUTE_BOX ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\PublicController::ROUTE_BOX) }}">--}}
{{--                        <i class="ni ni-app {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\PublicController::ROUTE_BOX ? 'text-danger' : 'text-primary' }}"></i> {{ __('მთავარი გვერდი') }}--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\OrderController::ROUTE_ORDERS ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\OrderController::ROUTE_ORDERS) }}">--}}
{{--                        <i class="ni ni-cart {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\OrderController::ROUTE_ORDERS ? 'text-danger' : 'text-primary' }}"></i> {{ __('გაყიდვების ნახვა') }}--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ProductController::ROUTE_DEBTORS ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\ProductController::ROUTE_DEBTORS) }}">--}}
{{--                        <i class="ni ni-fat-delete {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ProductController::ROUTE_DEBTORS ? 'text-danger' : 'text-primary' }}"></i> {{ __('ნისიების ნახვა') }}--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ReturnGoodsController::ROUTE_RETURN ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\ReturnGoodsController::ROUTE_RETURN) }}">--}}
{{--                        <i class="ni ni-curved-next {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ReturnGoodsController::ROUTE_RETURN ? 'text-danger' : 'text-primary' }}"></i> {{ __('პროდუქციის დაბრუნება') }}--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
            @if(auth()->user()->isAdmin())
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\AdminCotroller::ROUTE_ADMIN ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\AdminCotroller::ROUTE_ADMIN) }}">
                            <i class="ni ni-archive-2 {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\AdminCotroller::ROUTE_ADMIN ? 'text-danger' : 'text-primary' }}"></i> {{ __(' Пользователи ') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ProductController::ROUTE_ENTRANCE ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\ProductController::ROUTE_ENTRANCE) }}">
                            <i class="ni ni-fat-add {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ProductController::ROUTE_ENTRANCE ? 'text-danger' : 'text-primary' }}"></i> {{ __('პროდუქტის მიღება') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ProductController::ROUTE_ENTRANCE_CHECK ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\ProductController::ROUTE_ENTRANCE_CHECK) }}">
                            <i class="ni ni-glasses-2 {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ProductController::ROUTE_ENTRANCE_CHECK ? 'text-danger' : 'text-primary' }}"></i> {{ __('მიღებული პროდუქტების ნახვა') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\OffsController::ROUTE_OFFS ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\OffsController::ROUTE_OFFS) }}">
                            <i class="ni ni-fat-delete {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\OffsController::ROUTE_OFFS ? 'text-danger' : 'text-primary' }}"></i> {{ __('პროდუქტის ჩამოწერა') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\OffsController::ROUTE_OFFS_CHECK ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\OffsController::ROUTE_OFFS_CHECK) }}">
                            <i class="ni ni-scissors {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\OffsController::ROUTE_OFFS_CHECK ? 'text-danger' : 'text-primary' }}"></i> {{ __('ჩამოწერილი პროდუქტების ნახვა') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ReturnGoodsController::ROUTE_RETURN_CHECK ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\ReturnGoodsController::ROUTE_RETURN_CHECK) }}">
                            <i class="ni ni-curved-next {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ReturnGoodsController::ROUTE_RETURN_CHECK ? 'text-danger' : 'text-primary' }}"></i> {{ __('დაბრუნებული პროდუქტების ნახვა') }}
                        </a>
                    </li>
                </ul>
                <hr class="my-3">
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ProductController::ROUTE_CREATE ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\ProductController::ROUTE_CREATE) }}">
                            <i class="ni ni-fat-add {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ProductController::ROUTE_CREATE ? 'text-danger' : 'text-primary' }}"></i> {{ __('ახალი პროდუქტის შექმნა') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ProductController::ROUTE_CREATE_TYPE ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\ProductController::ROUTE_CREATE_TYPE) }}">
                            <i class="ni ni-fat-remove {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ProductController::ROUTE_CREATE_TYPE ? 'text-danger' : 'text-primary' }}"></i> {{ __('ახალი კატეგორიის შექმნა ') }}
                        </a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</nav>
