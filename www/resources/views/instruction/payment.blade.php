@extends('layouts.app', ['class' => 'bg-default'])
<?php
    /** @var \App\Models\User $user */
    /** @var \App\Models\Instruction $instruction */
?>

@section('content')
    <div class="header pb-8 pt-5 d-flex align-items-center" style="background-image: url(../../argon/img/theme/profile-cover-2.png); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <div style="background-image: url('{{asset('storage/' . $user->logo)}}');"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                        </div>
                    </div>
                    <div class="card-body pt-0 mt-6 pt-md-4">
                        <div class="text-center">
                            <h3>
                                {{$user->name}}<span class="font-weight-light"></span>
                            </h3>
                            @if ($user->position)
                                <div>
                                    <i class="ni education_hat mr-2"></i>{{$user->position}}, {{$user->work}}
                                </div>
                            @endif
                            <hr class="my-4" />
                            <p style="text-align: justify">
                                {!! $user->welcome_text_view !!}
                            </p>
                        </div>
                    </div>
                    <div class="card-body pt-0 mt-0 pt-md-4">
                        <div class="text-center">
                            <h2>
                                {{$instruction->name}}<span class="font-weight-light"></span>
                            </h2>
                            @if ($instruction->main_img)
                            <div class="card-profile-pdf-image pt-2">
                                <img src="{{ asset('storage/' . $instruction->main_img)}}" class="rounded">
                            </div>
                            @endif
                            <h2 class="pt-4">
                                {{$instruction->price_view}}
                            </h2>
                            <hr class="my-4" />
                            <p style="text-align: justify">
                                {{$instruction->short_description}}
                            </p>
                            <p class="text-danger" id="form-error">
                            </p>
                        </div>
                        <div class="text-center row" id="form-container">
                            <div class="col-sm-12 col-md-8 mb-3 form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input
                                        type="email"
                                        name="email"
                                        id="input-email"
                                        class="form-control"
                                        placeholder="{{ __('Enter your email address to receive instructions') }}"
                                        value=""
                                        required
                                    >
                                    <input
                                        name="instruction_id"
                                        id="instruction_id"
                                        type="hidden"
                                        value="{{ $instruction->id }}"
                                    >
                                    <input
                                        name="transaction_id"
                                        id="transaction_id"
                                        type="hidden"
                                        value=""
                                    >
                                </div>
                                <div class="invalid-feedback d-none">
                                    {{ $errors->first('email') }}
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 mb-3">
                                <button type="button" class="btn btn-creatory w-100" id="buy-now">{{ __('BUY NOW') }}</button>
                            </div>
                        </div>
                        <div class="text-center pt-4 d-none" id="paypal-container">
                            @include('instruction.paypal')
                        </div>
                        <div class="text-center pt-4 d-none" id="loader">
                            <div class="spinner-border text-danger" role="status" style="width: 3rem; height: 3rem;">
                                <span class="sr-only-b">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
