@extends('layouts.app', ['title' => __('admin.update_charity_img')])

@section('content')
    <style>
        #img_container {
            position:relative;
            display:inline-block;
            text-align:center;
        }
        .button {
            position:absolute;
            top: 5px;
            right:5px;
            width:30px;
            height:30px;
        }
    </style>

    <div class="header pb-8 pt-5 d-flex align-items-center" style="background-image: url(../argon/img/theme/instagram-1.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-5"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-white">{{__('admin.update_charity_img')}}</h1>
                </div>
            </div>
        </div>
    </div>
    <form method="post" action="{{ route(\App\Http\Controllers\Api\CharityController::ROUTE_UPDATE_CHARITY_IMG, $id) }}" autocomplete="off" enctype="multipart/form-data">
        <div class="container-fluid mt--4">
            <div class="row">
                <div class="col-xl-6 order-xl-1">
                    <div class="card card-profile shadow"  style="min-height: 700px;">
                        @csrf
                        @method('post')
                        <div class="card-body pt-0 pt-md-4">
                            <div class="col-xl-12 order-xl-1 center">
                                <div class="card card-profile shadow"  style="min-height: 700px;">
                                    <div class="card-body pt-0 pt-md-4">
                                        <div class="row align-items-center">
                                            <div class="col-12 card-profile-pdf-image pl-0">
                                                @foreach($arCharityImg as $img)
                                                    <div id="img_container">
                                                        <img class="img-responsive" width="150" height="150" src="{{ asset('storage') .'/'.  $img['img'] }}"/>
                                                        <a href="{{ route(\App\Http\Controllers\Api\CharityController::ROUTE_DELETE_CHARITY_IMG , $img['id'])}}" class="button btn-danger"><i class="fas fa-times"></i></a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 order-xl-1">
                    <div class="card card-profile shadow"  style="min-height: 700px;">
                        <div class="card-body pt-0 pt-md-4">
                            <div class="col-xl-12 order-xl-1 center">
                                <div class="card card-profile shadow"  style="min-height: 700px;">
                                    <div class="card-body pt-0 pt-md-4">
                                        <label class="form-control-label" for="input-link">{{ __('admin.add_more_img') }}</label>
                                        <input type="file" name="more_img[]" accept=".jpg,.jpeg,.png" multiple>
                                    </div>
                                    <div class="col-xl-12 order-xl-4">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-creatory mt-4">{{ __('admin.add') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footers.auth')
        </div>
    </form>
@endsection
