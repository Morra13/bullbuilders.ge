@extends('layouts.app', ['class' => 'bg-default'])
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
                                        <div style="background-image: url('https://creatory.pro/argon/img/theme/error.png');"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                                <div class="d-flex justify-content-between">
                                </div>
                            </div>
                            <div class="card-body pt-100 mt-0 pt-md-4">
                                <div class="text-center">
                                    <h1 class="pt-4">
                                        404
                                    </h1>
                                    <h3 class="pt-4 text-danger">
                                        Oh, we didn't find such a page
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
