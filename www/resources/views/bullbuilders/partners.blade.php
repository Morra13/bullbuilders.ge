@extends('bullbuilders.header', ['title' => __('nav.partners')])

@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url({{asset('argon')}}/bullbuilders/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end">
                <div class="col-md-9 ftco-animate pb-5">
                    <h1 class="mb-0 bread">{{__('nav.partners')}}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            @if(!empty($arPartners))
                @foreach($arPartners as $partner)
                    <div class="row d-flex no-gutters">
                        <div class="col-md-6 d-flex">
                            <div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-end" style="background-image:url({{ asset('storage') . '/' . $partner['main_img'] }});">
                            </div>
                        </div>
                        <div class="col-md-6 pl-md-5">
                            <div class="row justify-content-start py-5">
                                <div class="col-md-12 heading-section ftco-animate pl-md-4 py-md-4">
                                    <span class="subheading"> {{ $partner['name'] }}</span>
                                    <h2 class="mb-4">{{ $partner['title'] }}</h2>
                                    <div class="tab-content bg-light rounded mt-2">
                                        <div class="tab-pane container p-0 active" id="home1">
                                            <p>{{ $partner['description'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                @endforeach
            @endif
        </div>
    </section>

@endsection
