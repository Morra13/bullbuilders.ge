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
    <div class="product_image_area">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="single-prd-item">
                        <img class="img-fluid" src="{{ asset('argon') }}/bullbuilders/images/bg_1.jpg">
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>Faded SkyBlu Denim Jeans</h3>
                        <h2>$149.99</h2>
                        <ul class="list">
                            <li><a class="active" href="#"><span>Category</span> : Household</a></li>
                            <li><a href="#"><span>Availibility</span> : In Stock</a></li>
                        </ul>
                        <p>Mill Oil is an innovative oil filled radiator with the most modern technology. If you are looking for
                            something that can make your interior look awesome, and at the same time give you the pleasant warm feeling
                            during the winter.</p>

                        <div class="card_area d-flex align-items-center">
                            <a class="icon_btn" href="#"><i class="lnr lnr lnr-diamond"></i></a>
                            <a class="icon_btn" href="#"><i class="lnr lnr lnr-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product_image_area">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="single-prd-item">
                        <img class="img-fluid" src="{{ asset('argon') }}/bullbuilders/images/bg_2.jpg">
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>Faded SkyBlu Denim Jeans</h3>
                        <h2>$149.99</h2>
                        <ul class="list">
                            <li><a class="active" href="#"><span>Category</span> : Household</a></li>
                            <li><a href="#"><span>Availibility</span> : In Stock</a></li>
                        </ul>
                        <p>Mill Oil is an innovative oil filled radiator with the most modern technology. If you are looking for
                            something that can make your interior look awesome, and at the same time give you the pleasant warm feeling
                            during the winter.</p>

                        <div class="card_area d-flex align-items-center">
                            <a class="icon_btn" href="#"><i class="lnr lnr lnr-diamond"></i></a>
                            <a class="icon_btn" href="#"><i class="lnr lnr lnr-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product_image_area">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="single-prd-item">
                        <img class="img-fluid" src="{{ asset('argon') }}/bullbuilders/images/bg_3.jpg">
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>Faded SkyBlu Denim Jeans</h3>
                        <h2>$149.99</h2>
                        <ul class="list">
                            <li><a class="active" href="#"><span>Category</span> : Household</a></li>
                            <li><a href="#"><span>Availibility</span> : In Stock</a></li>
                        </ul>
                        <p>Mill Oil is an innovative oil filled radiator with the most modern technology. If you are looking for
                            something that can make your interior look awesome, and at the same time give you the pleasant warm feeling
                            during the winter.</p>

                        <div class="card_area d-flex align-items-center">
                            <a class="icon_btn" href="#"><i class="lnr lnr lnr-diamond"></i></a>
                            <a class="icon_btn" href="#"><i class="lnr lnr lnr-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
