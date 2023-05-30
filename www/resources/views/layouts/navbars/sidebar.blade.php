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
                        <span>{{ __('admin.profile') }}</span>
                    </a>
                    <a href="{{ route(\App\Http\Controllers\UserController::ROUTE_PASSWORD) }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('admin.change_password') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route(\App\Http\Controllers\DefaultController::ROUTE_LOGOUT) }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('admin.logout') }}</span>
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
                            <img src="{{ asset('argon') }}/img/brand/logo_1.png">
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

            @if(auth()->user()->isAdmin())
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\AdminCotroller::ROUTE_ADMIN ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\AdminCotroller::ROUTE_ADMIN) }}">
                            <i class="ni ni-circle-08 {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\AdminCotroller::ROUTE_ADMIN ? 'text-danger' : 'text-primary' }}"></i> {{ __('admin.admin') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\StaffController::ROUTE_CREATE_STAFF ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\StaffController::ROUTE_CREATE_STAFF) }}">
                            <i class="ni ni-fat-add {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\StaffController::ROUTE_CREATE_STAFF ? 'text-danger' : 'text-primary' }}"></i> {{ __('admin.create_staff') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\StaffController::ROUTE_STAFF ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\StaffController::ROUTE_STAFF) }}">
                            <i class="ni ni-badge {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\StaffController::ROUTE_STAFF ? 'text-danger' : 'text-primary' }}"></i> {{ __('admin.staff') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ReviewsController::ROUTE_CREATE_REVIEWS ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\ReviewsController::ROUTE_CREATE_REVIEWS) }}">
                            <i class="ni ni-fat-add {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ReviewsController::ROUTE_CREATE_REVIEWS ? 'text-danger' : 'text-primary' }}"></i> {{ __('admin.create_review') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ReviewsController::ROUTE_REVIEWS ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\ReviewsController::ROUTE_REVIEWS) }}">
                            <i class="ni ni-like-2 {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ReviewsController::ROUTE_REVIEWS ? 'text-danger' : 'text-primary' }}"></i> {{ __('admin.reviews') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ProjectsController::ROUTE_CREATE_PROJECT ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\ProjectsController::ROUTE_CREATE_PROJECT) }}">
                            <i class="ni ni-fat-add {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ProjectsController::ROUTE_CREATE_PROJECT ? 'text-danger' : 'text-primary' }}"></i> {{ __('admin.create_project') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ProjectsController::ROUTE_PROJECT ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\ProjectsController::ROUTE_PROJECT) }}">
                            <i class="ni ni-shop {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\ProjectsController::ROUTE_PROJECT ? 'text-danger' : 'text-primary' }}"></i> {{ __('admin.projects') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\PartnersController::ROUTE_CREATE_PARTNER ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\PartnersController::ROUTE_CREATE_PARTNER) }}">
                            <i class="ni ni-fat-add {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\PartnersController::ROUTE_CREATE_PARTNER ? 'text-danger' : 'text-primary' }}"></i> {{ __('admin.create_partner') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\PartnersController::ROUTE_PARTNERS ? 'text-danger' : '' }}" href="{{ route(\App\Http\Controllers\PartnersController::ROUTE_PARTNERS) }}">
                            <i class="ni ni-shop {{ Route::getCurrentRoute()->getName() == \App\Http\Controllers\PartnersController::ROUTE_PARTNERS ? 'text-danger' : 'text-primary' }}"></i> {{ __('admin.partners') }}
                        </a>
                    </li>
                </ul>
            @endif
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route(\App\Http\Controllers\PublicController::ROUTE_CHANGE_LANG , 'ge') }}">
                        <span class="flag-icon flag-icon-ge"></span> Geo
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route(\App\Http\Controllers\PublicController::ROUTE_CHANGE_LANG , 'ru') }}">
                        <span class="flag-icon flag-icon-ru"></span> Ru
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route(\App\Http\Controllers\PublicController::ROUTE_CHANGE_LANG , 'en') }}">
                        <span class="flag-icon flag-icon-us"></span> Eng
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
