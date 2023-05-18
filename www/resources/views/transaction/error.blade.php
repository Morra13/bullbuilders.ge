@extends('layouts.app', ['class' => 'bg-default'])
<?php
/** @var \App\Models\User $user */
/** @var \App\Models\Instruction $instruction */
?>

@section('content')
    <div class="header pb-1 pt-1 d-flex align-items-center" style="background-image: url(../../argon/img/theme/profile-cover-2.png); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-8"></span>
        <div class="container">
            <div class="header-body text-center mt-9 mb-3">
                <div class="row justify-content-center">
                    <div class="col-xl-8 mb-5 mb-xl-0">
                        <div class="card card-profile shadow">
                            <div class="row justify-content-center">
                                <div class="col-lg-3 order-lg-2">
                                    <div class="card-profile-image">
                                        <div style="background-image: url('https://creatory.pro/argon/img/theme/paypal.png');"></div>
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
                                        {{$instruction->name}}<span class="font-weight-light"></span>
                                    </h3>
                                    <div>
                                        <i class="ni education_hat mr-2"></i>Instruction
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0 mt-0 pt-md-4">
                                <div class="text-center">
                                    <img src="https://creatory.pro/argon/img/theme/error.png" alt="" style="width: 100%; max-width: 200px;">
                                    <h2 class="pt-4 text-danger">
                                        Something went wrong, the payment failed
                                    </h2>
                                    <hr class="my-4" />
                                    <p class="text-center">
                                        <a href="{{ route(\App\Http\Controllers\InstructionController::ROUTE_PAYMENT, [$instruction->User->nick_name, $instruction->id]) }}"class="btn btn-creatory">Try again</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
