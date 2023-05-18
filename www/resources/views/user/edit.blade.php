@extends('layouts.app', ['title' => __('User Profile')])
@section('content')
    @include('user.partials.header', [
        'title' => __('Hello') . ', '. auth()->user()->name,
        'description' => __('Здарова.'),
        'class' => 'col-lg-7'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-1 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <form id="target" action="{{ route(\App\Http\Controllers\Api\UserController::ROUTE_AVATAR) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <label for="chooseFile">
                                        <div style="background-image: url('{{asset('storage/' . auth()->user()->logo)}}');"></div>
                                    </label>
                                    <input
                                        id="chooseFile"
                                        name="file"
                                        type="file"
                                        class="d-none"
                                        onchange="this.form.submit()"
                                        accept=".jpg,.jpeg,.png"
                                    />
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                                                        <a href="#" class="btn btn-sm btn-info mr-4">{{ __( auth()->user()->role) }}</a>
{{--                                                        <a href="#" class="btn btn-sm btn-default float-right">{{ __('Message') }}</a>--}}
                        </div>
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>
                                {{ auth()->user()->name }}<span class="font-weight-light"></span>
                            </h3>
                            <hr class="my-4" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-2">
                <div class="card bg-secondary shadow">
                    <div class="card-body">
                        <form method="POST" action="{{ route(\App\Http\Controllers\Api\UserController::ROUTE_UPDATE) }}" autocomplete="off" enctype="multipart/form-data" id="update-form">
                            @csrf
                            @method('post')

                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input
                                        type="text"
                                        name="name"
                                        id="input-name"
                                        class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Name') }}"
                                        value="{{ old('name', auth()->user()->name) }}" required
                                    >

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <label class="form-control-label" for="email">{{ __('Email') }}</label>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <input
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Email') }}"
                                            type="email"
                                            name="email"
                                            id="email"
                                            value="{{ old('email', auth()->user()->email) }}"
                                            required>
                                    </div>
                                    <span class="invalid-feedback d-none" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                </div>
                            </div>

                            <div class="pl-lg-4">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-creatory mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                            <input hidden name="user_id" id="user_id" value="{{ (int) auth()->user()->getAuthIdentifier() }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
@endsection
