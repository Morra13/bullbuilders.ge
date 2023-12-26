@extends('bullbuilders.header', ['title' => __('nav.contact')])

@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url({{asset('argon')}}/bullbuilders/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end">
                <div class="col-md-9 ftco-animate pb-5">
                    <h1 class="mb-0 bread">{{__('nav.contact')}}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="wrapper">
                        <div class="row no-gutters mb-5">
                            <div class="col-md-12">
                                <div class="contact-wrap w-100 p-md-5 p-4">
                                    <h3 class="mb-4">{{__('nav.contact')}}</h3>
                                    <form method="post" action="{{ route(\App\Http\Controllers\Api\MailController::ROUTE_SEND_MAIL) }}" id="contactForm" name="contactForm" class="contactForm">
                                        @csrf
                                        @method('post')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="name">{{__('contact.name')}}</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="name"
                                                        id="name"
                                                        placeholder="{{__('contact.name')}}"
                                                        required
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="email">{{__('contact.email')}}</label>
                                                    <input
                                                        type="email"
                                                        class="form-control"
                                                        name="email"
                                                        id="email"
                                                        placeholder="{{__('contact.email')}}"
                                                        required
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="label" for="theme">{{__('contact.theme')}}</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="theme"
                                                        id="theme"
                                                        placeholder="{{__('contact.theme')}}"
                                                        required
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="label" for="#">{{__('contact.message')}}</label>
                                                    <textarea
                                                        name="message"
                                                        class="form-control"
                                                        id="message"
                                                        cols="30"
                                                        rows="4"
                                                        placeholder="{{__('contact.message')}}"
                                                        required
                                                    ></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="submit" value="{{__('contact.send_message')}}" class="btn btn-primary">
                                                    <div class="submitting"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-map-marker"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>{{__('contact.address')}} : </span> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-phone"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>{{__('contact.phone')}} : </span> <a href="tel://995595292444">+995-595-29-24-44</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-paper-plane"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>{{__('contact.email')}} : </span> <a href="mailto:info@yoursite.com">info@bullbuilders.ge</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-globe"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>{{__('contact.website')}} </span> <a href="{{ Request::root() }}">{{ 'bullbuiilders.ge' }}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
