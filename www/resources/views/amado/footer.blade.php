<?
$obEnum = (new \App\Http\Controllers\Enum\LangController())::getEnum();
?>
{{--<section class="newsletter-area section-padding-100-0">--}}
{{--    <div class="container">--}}
{{--        <div class="row align-items-center">--}}
{{--            <!-- Newsletter Text -->--}}
{{--            <div class="col-12 col-lg-6 col-xl-7">--}}
{{--                <div class="newsletter-text mb-100">--}}
{{--                    <h2>Subscribe for a <span>25% Discount</span></h2>--}}
{{--                    <p>Nulla ac convallis lorem, eget euismod nisl. Donec in libero sit amet mi vulputate consectetur. Donec auctor interdum purus, ac finibus massa bibendum nec.</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- Newsletter Form -->--}}
{{--            <div class="col-12 col-lg-6 col-xl-5">--}}
{{--                <div class="newsletter-form mb-100">--}}
{{--                    <form action="#" method="post">--}}
{{--                        <input type="email" name="email" class="nl-email" placeholder="Your E-mail">--}}
{{--                        <input type="submit" value="Subscribe">--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
<footer class="footer_area clearfix">
    <div class="container">
        <div class="row align-items-center">
            <!-- Single Widget Area -->
            <div class="col-12 col-lg-4">
                <div class="single_widget_area">
                    <!-- Logo -->
                    <div class="footer-logo mr-50">
                        <a href="{{ route(\App\Http\Controllers\PublicController::ROUTE_INDEX) }}"><img src="{{ asset('argon') }}/amado/img/core-img/logo2.png" alt=""></a>
                    </div>
                    <!-- Copywrite Text -->
                    <p class="copywrite">
                        <script>document.write(new Date().getFullYear());</script> <i class="fa fa-heart-o" aria-hidden="true"></i><a href="https://smf.com.ge" target="_blank">SMF</a>
                    </p>
                </div>
            </div>
            <!-- Single Widget Area -->
            <div class="col-12 col-lg-8">
                <div class="single_widget_area">
                    <!-- Footer Menu -->
                    <div class="footer_menu">
                        <nav class="navbar navbar-expand-lg justify-content-end">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                            <div class="collapse navbar-collapse" id="footerNavContent">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{ route(\App\Http\Controllers\PublicController::ROUTE_INDEX) }}">{{$obEnum::MAIN}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route(\App\Http\Controllers\AmadoController::ROUTE_PRODUCT) }}">{{$obEnum::PRODUCTS}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route(\App\Http\Controllers\AmadoController::ROUTE_ABOUT) }}">{{$obEnum::ABOUT}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route(\App\Http\Controllers\AmadoController::ROUTE_BASKET) }}">{{$obEnum::BASKET}}</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
