@extends('layouts.app', ['title' => __('admin.create_product')])

@section('content')
    <div class="header pb-8 pt-5 d-flex align-items-center" style="background-image: url(../argon/img/theme/instagram-2.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-5"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-white">{{__('admin.create_product')}}</h1>
                </div>
            </div>
        </div>
    </div>

    <form method="post" action="{{ route(\App\Http\Controllers\Api\ProductsController::ROUTE_CREATE_PRODUCT) }}" autocomplete="off" enctype="multipart/form-data">
        <div class="container-fluid mt--4">
            <div class="row">
                <?
                $arLang = ['ge', 'ru', 'en'];
                ?>
                @foreach($arLang as $key => $lang)
                    @include('admin.products.createProductRow', ['lang' => $lang, 'key' => $key,])
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
