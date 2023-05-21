<?php
/** @var \App\Models\User $user */
?>
@extends('layouts.app', ['title' => $user->name])

@section('content')
    @include('user.partials.header', [
        'title' => $user->name,
        'description' => ' ',
        'class' => 'col-lg-7'
    ])

    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-xl-6 order-xl-1 mb-5 mb-xl-0">
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
                            <form method="post" action="{{ route(\App\Http\Controllers\Api\UserController::ROUTE_ROLE) }}">
                                @csrf
                                @method('post')
                                <input hidden name="user_id" value="{{ $user->id }}">
                                @if($user->role == 'creator')
                                    <input hidden name="role" value="admin">
                                    <button  type="submit" class="btn btn-sm btn-danger mr-4" >{{ __('Make Admin') }}</button>
                                @elseif($user->role == 'admin')
                                    <input hidden name="role" value="creator">
                                    <button  type="submit" class="btn btn-sm btn-info mr-4" >{{ __('Make Creator') }}</button>
                                @endif
                            </form>
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
                                {{ $user->name }}<span class="font-weight-light"></span>
                            </h3>
                            <div class="h5 font-weight-300">
                                {{ $user->email }}
                            </div>
                            <div class="h4 font-weight-900">
                                [ {{ $user->role }} ]
                            </div>
                            <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>{{ $user->position }}
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i>{{ $user->work }}
                            </div>
                            <hr class="my-4" />
                            <p style="text-align: justify">
                                {!! $user->welcome_text_view !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
