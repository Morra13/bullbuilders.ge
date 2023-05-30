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

    <div class="site-section">
        @if(!empty($arPartners))
            @foreach($arPartners as $key => $partner)
                <div class="block__73694 mb-2" id="services-section">
                    <div class="container">
                        <div class="row d-flex no-gutters align-items-stretch">
                            @if($key % 2 == 0 || $key === 0)
                                <div class="img col-12 col-lg-6 block__73422" style="background-image: url({{ asset('storage') . '/' . $partner['main_img']}})" data-aos="fade-right" data-aos-delay="">
                                </div>
                            @else
                                <div class="img col-12 col-lg-6 block__73422 order-lg-2" style="background-image: url({{ asset('storage') . '/' . $partner['main_img']}})" data-aos="fade-left" data-aos-delay="">
                                </div>
                            @endif
                            <div class="col-lg-5 ml-auto p-lg-5 mt-4 mt-lg-0" data-aos="fade-left" data-aos-delay="">
                                <h2 class="mb-3 text-black">{{ $partner['name'] }}</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus id dignissimos nemo minus perspiciatis ullam itaque voluptas iure vero, nesciunt unde odit aspernatur distinctio, maiores facere officiis. Cum, esse, iusto?</p>
                                <p>Minus perspiciatis ullam itaque voluptas iure vero, nesciunt unde odit aspernatur distinctio, maiores facere officiis. Cum, esse, iusto?</p>
                                <ul class="ul-check primary list-unstyled mt-5">
                                    <li>Lorem ipsum dolor.</li>
                                    <li>Quod, amet. Provident.</li>
                                    <li>Quo, adipisci, quis.</li>
                                    <li>Cumque perspiciatis, blanditiis?</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

@endsection
