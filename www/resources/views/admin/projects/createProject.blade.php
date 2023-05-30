@extends('layouts.app', ['title' => __('admin.create_project')])

@section('content')
    <div class="header pb-8 pt-5 d-flex align-items-center" style="background-image: url(../argon/img/theme/instagram-1.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-5"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-white">{{__('admin.create_project')}}</h1>
                </div>
            </div>
        </div>
    </div>

    <form method="post" action="{{ route(\App\Http\Controllers\Api\ProjectsController::ROUTE_CREATE_PROJECT) }}" autocomplete="off" enctype="multipart/form-data">
        <div class="container-fluid mt--4">
            <div class="row">
                <?
                $arLang = ['ge', 'ru', 'en'];
                ?>
                @foreach($arLang as $key => $lang)
                    @include('admin.projects.createProjectRow', ['lang' => $lang, 'key' => $key,])
                @endforeach
                <div class="col-xl-3 order-xl-1">
                    <div class="card card-profile shadow"  style="min-height: 700px;">
                        <div class="card-body pt-0 pt-md-4">
                            <input type="file" name="more_img[]" accept=".jpg,.jpeg,.png" multiple>
                        </div>
                    </div>
                </div>
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
