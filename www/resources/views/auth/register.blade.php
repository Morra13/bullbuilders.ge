@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <div class="header py-7 py-lg-8 d-flex align-items-center" style="background-image: url(../argon/img/theme/profile-cover-2.png); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-8"></span>
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <h1 class="text-white">{{ __('Registration') }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>


    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                        </div>
                        <form role="form" method="POST" action="{{ route(\App\Http\Controllers\DefaultController::ROUTE_REGISTER) }}" id="registration-form">
                            @csrf
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-caps-small"></i></span>
                                    </div>
                                    <input
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Name') }}"
                                        type="text"
                                        name="name"
                                        id="name"
                                        value="{{ old('name') }}"
                                        required
                                    >
                                </div>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Email') }}"
                                        type="email"
                                        name="email"
                                        id="email"
                                        value="{{ old('email') }}"
                                        required>
                                </div>
                                <span class="invalid-feedback d-none" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Password') }}"
                                        type="password"
                                        name="password"
                                        id="password"
                                        required
                                    >
                                </div>
                                <span class="invalid-feedback d-none" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input
                                        class="form-control"
                                        placeholder="{{ __('Confirm Password') }}"
                                        type="password"
                                        name="password_confirmation"
                                        id="password_confirmation"
                                        required
                                    >
                                </div>
                            </div>
                            <div class="row my-4">
                                <div class="col-12">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <input class="custom-control-input" id="customCheckRegister" type="checkbox" required>
                                        <label class="custom-control-label" for="customCheckRegister">
                                            <span class="text-muted">{{ __('I agree with the') }} <a href="#!" data-toggle="modal" data-target="#modal-policy">{{ __('Privacy Policy') }}</a></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-creatory mt-4">{{ __('Create account') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('documentation.policy-modal')
    <script type="text/javascript">
        var email                 = $("#email");
        var password              = $("#password");
        var password_confirmation = $("#password_confirmation");

        email.keyup(function() {
            if(this.value.length > 3) {
                checkEmail();
            }
        });

        email.change(function() {
            if(this.value.length > 3) {
                checkEmail();
            }
        });

        password.keyup(function() {
            checkPassword('password');
        });

        password_confirmation.keyup(function() {
            checkPassword('password_confirmation');
        });

        $('#registration-form').submit(function() {
            checkEmail();
            checkPassword();
            if ($('#registration-form').find('.has-danger').length > 0) {
                return false;
            }
            return true;
        });

        /**
         * Check password
         */
        function checkPassword(type) {
            $.ajax({
                url: "/api/validation/password",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: JSON.stringify(
                    {
                        'password': password.val(),
                        'type': type,
                        'password_confirmation': password_confirmation.val()
                    }
                )
            })
                .done(function( data ) {
                    if (data.result == 'error') {
                        password.addClass('text-danger');
                        password.parent().closest('.form-group').addClass('has-danger');
                        password.parent().parent().find('.invalid-feedback').removeClass('d-none');
                        password.parent().parent().find('.invalid-feedback').html(data.message);
                        password_confirmation.addClass('text-danger');
                        password_confirmation.parent().closest('.form-group').addClass('has-danger');
                        password_confirmation.parent().parent().find('.invalid-feedback').removeClass('d-none');
                        password_confirmation.parent().parent().find('.invalid-feedback').html(data.message);
                    } else {
                        password.removeClass('text-danger');
                        password.parent().closest('.form-group').removeClass('has-danger');
                        password.parent().parent().find('.invalid-feedback').addClass('d-none');
                        password_confirmation.removeClass('text-danger');
                        password_confirmation.parent().closest('.form-group').removeClass('has-danger');
                        password_confirmation.parent().parent().find('.invalid-feedback').addClass('d-none');
                    }
                });
        }

        /**
         * Check email
         */
        function checkEmail() {
            $.ajax({
                url: "/api/validation/email/exist",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: JSON.stringify({ 'email': email.val()})
            })
                .done(function( data ) {
                    if (data.result == 'error') {
                        email.addClass('text-danger');
                        email.parent().closest('.form-group').addClass('has-danger');
                        email.parent().parent().find('.invalid-feedback').removeClass('d-none');
                        email.parent().parent().find('.invalid-feedback').html(data.message);
                    } else {
                        email.removeClass('text-danger');
                        email.parent().closest('.form-group').removeClass('has-danger');
                        email.parent().parent().find('.invalid-feedback').addClass('d-none');
                    }
                });
        }
    </script>
@endsection
