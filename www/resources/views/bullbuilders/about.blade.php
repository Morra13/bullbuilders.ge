@extends('bullbuilders.header', ['title' => __('about.about')])

@section('content')

    <section class="hero-wrap hero-wrap-2" style="background-image: url({{ asset('argon') }}/bullbuilders/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end">
                <div class="col-md-9 ftco-animate pb-5">
                    <h1 class="mb-0 bread">{{__( 'about.about' )}}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row d-flex no-gutters">
                <div class="col-md-6 d-flex">
                    <div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-end" style="background-image:url({{ asset('argon') }}/bullbuilders/images/about.jpg);">
                        <a href="https://www.youtube.com/watch?v=yDPdE7S6gtA" class="icon-video popup-vimeo d-flex justify-content-center align-items-center">
                            <span class="icon-play"></span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 pl-md-5">
                    <div class="row justify-content-start py-5">
                        <div class="col-md-12 heading-section ftco-animate pl-md-4 py-md-4">
                            <span class="subheading"> {{ __('about.welcome') }}</span>
                            <h2 class="mb-4">{{ __('about.h1') }}</h2>
                            <p>{{ __('about.h1text') }}</p>
                            <div class="tabulation-2 mt-4">
                                <ul class="nav nav-pills nav-fill d-md-flex d-block">
                                    <li class="nav-item mb-md-0 mb-2">
                                        <a class="nav-link active py-2" data-toggle="tab" href="#home1">{{ __('about.mission') }}</a>
                                    </li>
                                    <li class="nav-item px-lg-2 mb-md-0 mb-2">
                                        <a class="nav-link py-2" data-toggle="tab" href="#home2">{{ __('about.vision') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link py-2 mb-md-0 mb-2" data-toggle="tab" href="#home3">{{ __('about.value') }}</a>
                                    </li>
                                </ul>
                                <div class="tab-content bg-light rounded mt-2">
                                    <div class="tab-pane container p-0 active" id="home1">
                                        <p>{{ __('about.missionText') }}</p>
                                    </div>
                                    <div class="tab-pane container p-0 fade" id="home2">
                                        <p>{{ __('about.visionText') }}</p>
                                    </div>
                                    <div class="tab-pane container p-0 fade" id="home3">
                                        <p>{{ __('about.valueText') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-counter" id="section-counter">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 d-flex">
                        <div class="text d-flex align-items-center">
                            <strong class="number" data-number="50">0</strong>
                        </div>
                        <div class="text-2">
                            <span>{{ __('about.years') }} </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                    <a href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_PROJECTS) }}">

                    <div class="block-18 d-flex">
                        <div class="text d-flex align-items-center">
                            <strong class="number" data-number="999">0</strong>
                        </div>
                        <div class="text-2">
                            <span>{{ __('about.projects') }}</span>
                        </div>
                    </div>
                    </a>

                </div>
                <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 d-flex">
                        <div class="text d-flex align-items-center">
                            <strong class="number" data-number="378">0</strong>
                        </div>
                        <div class="text-2">
                            <span>{{ __('about.experts') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 d-flex">
                        <div class="text d-flex align-items-center">
                            <strong class="number" data-number="1200">0</strong>
                        </div>
                        <div class="text-2">
                            <span>{{ __('about.machines') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section">
        <div class="container-fluid px-md-5">

            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
{{--                        <span class="subheading">Testimonial</span>--}}
                        <h2 class="mb-4">{{ __('about.staff') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($arStaff as $staff)
                    @include('bullbuilders.userRow', ['staff' => $staff])
                @endforeach
            </div>
        </div>
    </section>


    <section class="ftco-section testimony-section bg-primary">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                    <h2 class="mb-4">{{ __('about.сustomer_reviews') }}</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel ftco-owl">
                        @foreach($arReviews as $review)
                            @include('bullbuilders.reviewsRow', ['review' => $review])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h5 class="font-weight-bold">Bull Builders</h5>
                    <p>{{ __('about.p1') }}</p>
                    <p>{{ __('about.p2') }}</p>
                </div>
                <div class="col-md-4">
                    <p>{{ __('about.p3') }}</p>
                </div>
            </div>
        </div>
    </section>

@endsection
