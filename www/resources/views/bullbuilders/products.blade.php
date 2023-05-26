@extends('bullbuilders.header', ['title' => __('nav.products')])

@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url({{asset('argon')}}/bullbuilders/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end">
                <div class="col-md-9 ftco-animate pb-5">
                    <h1 class="mb-0 bread">{{__('nav.products')}}</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row d-flex no-gutters">
                <div class="col-md-6 d-flex">
                    <div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-end" style="background-image:url({{ asset('argon') }}/bullbuilders/images/about.jpg);">
                    </div>
                </div>
                <div class="col-md-6 pl-md-5">
                    <div class="row justify-content-start py-5">
                        <div class="col-md-12 heading-section ftco-animate pl-md-4 py-md-4">
                            <span class="subheading"> {{ __('Название продукта') }}</span>
                            <h2 class="mb-4">{{ __('Цена') }}</h2>
                            <h5 class="ion-ios-checkmark-circle">{{ __(' Ну тут какой то текст про этот продукт') }}</h5>
                            <div class="tab-content bg-light rounded mt-2">
                                <div class="tab-pane container p-0 active" id="home1">
                                    <span class="ion-ios-information-circle">{{ __(' Описание продукта') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex no-gutters">
                <div class="col-md-6 d-flex">
                    <div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-end" style="background-image:url({{ asset('argon') }}/bullbuilders/images/about.jpg);">
                    </div>
                </div>
                <div class="col-md-6 pl-md-5">
                    <div class="row justify-content-start py-5">
                        <div class="col-md-12 heading-section ftco-animate pl-md-4 py-md-4">
                            <span class="subheading"> {{ __('Название продукта') }}</span>
                            <h2 class="mb-4">{{ __('Цена') }}</h2>
                            <h5 class="ion-ios-checkmark-circle">{{ __(' Ну тут какой то текст про этот продукт') }}</h5>
                            <div class="tab-content bg-light rounded mt-2">
                                <div class="tab-pane container p-0 active" id="home1">
                                    <span class="ion-ios-information-circle">{{ __(' Описание продукта') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
