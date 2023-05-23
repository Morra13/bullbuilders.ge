<?
$obEnum = (new \App\Http\Controllers\Enum\LangController())::getEnum();
?>
@extends('bullbuilders.header', ['title' => __($obEnum::ABOUT)])

@section('content')

    <section class="hero-wrap hero-wrap-2" style="background-image: url({{ asset('argon') }}/bullbuilders/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end">
                <div class="col-md-9 ftco-animate pb-5">
                    <h1 class="mb-0 bread">{{ __($obEnum::ABOUT) }}</h1>
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
                            <span class="subheading">Добро пожаловать в Bull Builders</span>
                            <h2 class="mb-4">Мы создаем и воплощаем в реальность</h2>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
                            <div class="tabulation-2 mt-4">
                                <ul class="nav nav-pills nav-fill d-md-flex d-block">
                                    <li class="nav-item mb-md-0 mb-2">
                                        <a class="nav-link active py-2" data-toggle="tab" href="#home1">Наша миссия</a>
                                    </li>
                                    <li class="nav-item px-lg-2 mb-md-0 mb-2">
                                        <a class="nav-link py-2" data-toggle="tab" href="#home2">Наше видение</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link py-2 mb-md-0 mb-2" data-toggle="tab" href="#home3">Наша ценность</a>
                                    </li>
                                </ul>
                                <div class="tab-content bg-light rounded mt-2">
                                    <div class="tab-pane container p-0 active" id="home1">
                                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                                    </div>
                                    <div class="tab-pane container p-0 fade" id="home2">
                                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                                    </div>
                                    <div class="tab-pane container p-0 fade" id="home3">
                                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
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
                            <span>Лет </span>
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
                            <span>Проектов</span>
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
                            <span>экспертов</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 d-flex">
                        <div class="text d-flex align-items-center">
                            <strong class="number" data-number="1200">0</strong>
                        </div>
                        <div class="text-2">
                            <span>Машин</span>
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
                        <h2 class="mb-4">Шаши сотрудники</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="block-2 ftco-animate">
                        <div class="flipper">
                            <div class="front" style="background-image: url({{asset('argon') }}/bullbuilders/images/team-1.jpg);">
                                <div class="box">
                                    <h2>Ryan Anderson</h2>
                                    <p>Head Engineer</p>
                                </div>
                            </div>
                            <div class="back">
                                <!-- back content -->
                                <blockquote>
                                    <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text &rdquo;</p>
                                </blockquote>
                                <div class="author d-flex">
                                    <div class="image align-self-center">
                                        <img src="{{asset('argon') }}/bullbuilders/images/team-1.jpg" alt="">
                                    </div>
                                    <div class="name align-self-center ml-3">Ryan Anderson <span class="position">Head Engineer</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="block-2 ftco-animate">
                        <div class="flipper">
                            <div class="front" style="background-image: url({{asset('argon') }}/bullbuilders/images/team-2.jpg);">
                                <div class="box">
                                    <h2>Greg Washer</h2>
                                    <p>Head Engineer</p>
                                </div>
                            </div>
                            <div class="back">
                                <!-- back content -->
                                <blockquote>
                                    <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text &rdquo;</p>
                                </blockquote>
                                <div class="author d-flex">
                                    <div class="image align-self-center">
                                        <img src="{{asset('argon') }}/bullbuilders/images/team-2.jpg" alt="">
                                    </div>
                                    <div class="name align-self-center ml-3">Greg Washer<span class="position">Head Engineer</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="block-2 ftco-animate">
                        <div class="flipper">
                            <div class="front" style="background-image: url({{asset('argon') }}/bullbuilders/images/team-3.jpg);">
                                <div class="box">
                                    <h2>Tony Henderson</h2>
                                    <p>Ass. Engineer</p>
                                </div>
                            </div>
                            <div class="back">
                                <!-- back content -->
                                <blockquote>
                                    <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text &rdquo;</p>
                                </blockquote>
                                <div class="author d-flex">
                                    <div class="image align-self-center">
                                        <img src="{{asset('argon') }}/bullbuilders/images/team-3.jpg" alt="">
                                    </div>
                                    <div class="name align-self-center ml-3">Tony Henderson <span class="position">Ass. Engineer</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="block-2 ftco-animate">
                        <div class="flipper">
                            <div class="front" style="background-image: url({{asset('argon') }}/bullbuilders/images/team-4.jpg);">
                                <div class="box">
                                    <h2>Jack Smith</h2>
                                    <p>Architect</p>
                                </div>
                            </div>
                            <div class="back">
                                <!-- back content -->
                                <blockquote>
                                    <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text &rdquo;</p>
                                </blockquote>
                                <div class="author d-flex">
                                    <div class="image align-self-center">
                                        <img src="{{asset('argon') }}/bullbuilders/images/team-4.jpg" alt="">
                                    </div>
                                    <div class="name align-self-center ml-3">Jack Smith <span class="position">Architect</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="block-2 ftco-animate">
                        <div class="flipper">
                            <div class="front" style="background-image: url({{asset('argon') }}/bullbuilders/images/team-5.jpg);">
                                <div class="box">
                                    <h2>Ryan Anderson</h2>
                                    <p>President</p>
                                </div>
                            </div>
                            <div class="back">
                                <!-- back content -->
                                <blockquote>
                                    <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text &rdquo;</p>
                                </blockquote>
                                <div class="author d-flex">
                                    <div class="image align-self-center">
                                        <img src="{{asset('argon') }}/bullbuilders/images/team-5.jpg" alt="">
                                    </div>
                                    <div class="name align-self-center ml-3">Ryan Anderson <span class="position">President</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="block-2 ftco-animate">
                        <div class="flipper">
                            <div class="front" style="background-image: url({{asset('argon') }}/bullbuilders/images/team-6.jpg);">
                                <div class="box">
                                    <h2>Greg Washer</h2>
                                    <p>Chief Executive Officer</p>
                                </div>
                            </div>
                            <div class="back">
                                <!-- back content -->
                                <blockquote>
                                    <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text &rdquo;</p>
                                </blockquote>
                                <div class="author d-flex">
                                    <div class="image align-self-center">
                                        <img src="{{asset('argon') }}/bullbuilders/images/team-6.jpg" alt="">
                                    </div>
                                    <div class="name align-self-center ml-3">Greg Washer<span class="position">Chief Executive Officer</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="block-2 ftco-animate">
                        <div class="flipper">
                            <div class="front" style="background-image: url({{asset('argon') }}/bullbuilders/images/team-7.jpg);">
                                <div class="box">
                                    <h2>Tony Henderson</h2>
                                    <p>Contractor Operation Head</p>
                                </div>
                            </div>
                            <div class="back">
                                <!-- back content -->
                                <blockquote>
                                    <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text &rdquo;</p>
                                </blockquote>
                                <div class="author d-flex">
                                    <div class="image align-self-center">
                                        <img src="{{asset('argon') }}/bullbuilders/images/team-7.jpg" alt="">
                                    </div>
                                    <div class="name align-self-center ml-3">Tony Henderson <span class="position">Contractor Operation Head</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="block-2 ftco-animate">
                        <div class="flipper">
                            <div class="front" style="background-image: url({{asset('argon') }}/bullbuilders/images/team-8.jpg);">
                                <div class="box">
                                    <h2>Jack Smith</h2>
                                    <p>Chief Financial Officer</p>
                                </div>
                            </div>
                            <div class="back">
                                <!-- back content -->
                                <blockquote>
                                    <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text &rdquo;</p>
                                </blockquote>
                                <div class="author d-flex">
                                    <div class="image align-self-center">
                                        <img src="{{ asset('argon') }}/bullbuilders/images/team-8.jpg" alt="">
                                    </div>
                                    <div class="name align-self-center ml-3">Jack Smith <span class="position">Chief Financial Officer</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section testimony-section bg-primary">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                    <span class="subheading">Testimonial</span>
                    <h2 class="mb-4">Happy Clients</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel ftco-owl">
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
                                <div class="text">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img" style="background-image: url(images/person_1.jpg)"></div>
                                        <div class="pl-3">
                                            <p class="name">Roger Scott</p>
                                            <span class="position">Marketing Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
                                <div class="text">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img" style="background-image: url(images/person_2.jpg)"></div>
                                        <div class="pl-3">
                                            <p class="name">Roger Scott</p>
                                            <span class="position">Marketing Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
                                <div class="text">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img" style="background-image: url(images/person_3.jpg)"></div>
                                        <div class="pl-3">
                                            <p class="name">Roger Scott</p>
                                            <span class="position">Marketing Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
                                <div class="text">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img" style="background-image: url(images/person_1.jpg)"></div>
                                        <div class="pl-3">
                                            <p class="name">Roger Scott</p>
                                            <span class="position">Marketing Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
                                <div class="text">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img" style="background-image: url(images/person_2.jpg)"></div>
                                        <div class="pl-3">
                                            <p class="name">Roger Scott</p>
                                            <span class="position">Marketing Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h5 class="font-weight-bold">Home Builder</h5>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                </div>
                <div class="col-md-4">
                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                </div>
            </div>
        </div>
    </section>

@endsection
