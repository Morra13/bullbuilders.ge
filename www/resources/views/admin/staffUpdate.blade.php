@extends('layouts.app', ['title' => __('admin.staff_update')])

@section('content')
    <div class="header pb-8 pt-5 d-flex align-items-center" style="background-image: url(../argon/img/theme/instagram-1.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-5"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-white">{{__('admin.staff_update')}}</h1>
                </div>
            </div>
        </div>
    </div>
    <form method="post" action="{{ route(\App\Http\Controllers\Api\AdminController::ROUTE_CREATE_STAFF) }}" autocomplete="off" enctype="multipart/form-data">
        <div class="container-fluid mt--4">
            <div class="row">
                @foreach($arStaff as $lang => $staff)
                    @include(
                                'admin.updateStaffRow', [
                                     'lang'     => $lang,
                                     'staff'    => $staff,
                                ]
                            )
                @endforeach
                <div class="col-xl-12 order-xl-4">
                    <div class="text-center">
                        <button type="submit" class="btn btn-creatory mt-4">{{ __('admin.create') }}</button>
                    </div>
                </div>
            </div>
            @include('layouts.footers.auth')
        </div>
    </form>
@endsection
