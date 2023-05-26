<footer class="footer">
    <div class="container-fluid px-lg-5">
        <div class="row">
            <div class="col-md-9 py-5">
                <div class="row">
                    <div class="col-md-4 mb-md-0 mb-4">
                        <a class="navbar-brand pt-0" href="{{ route(\App\Http\Controllers\PublicController::ROUTE_INDEX) }}">
                            <img src="{{ asset('argon') }}/img/brand/logo_1.png" class="navbar-brand-img" alt="...">
                            <a class="navbar-brand center" href="{{ route(\App\Http\Controllers\PublicController::ROUTE_INDEX) }}">Bull<span class="footer-heading"><i>builders.</i></span>
                            </a>
                        </a>
                        <ul class="ftco-footer-social p-0">
                            <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><span class="ion-logo-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><span class="ion-logo-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><span class="ion-logo-instagram"></span></a></li>
                        </ul>
                    </div>
                    <div class="col-md-8">
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-lg-10">
                                <div class="row">
                                    <div class="col-md-6 mb-md-0 mb-6">
                                        <h2 class="footer-heading">{{ __('footer.about_bull') }}</h2>
                                    </div>
                                    <div class="col-md-6 mb-md-0 mb-6">
                                        <a href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_ABOUT) }}" class="nav-link btn-outline-dark">{{ __('footer.about') }}<span class="footer-heading"></span></a>
                                        <a href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_PARTNERS) }}" class="nav-link btn-outline-dark">{{ __('footer.partners') }}<span class="footer-heading"></span></a>
                                        <a href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_PROJECTS) }}" class="nav-link btn-outline-dark">{{ __('footer.projects') }}<span class="footer-heading"></span></a>
                                        <a href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_PRODUCTS) }}" class="nav-link btn-outline-dark">{{ __('footer.products') }}<span class="footer-heading"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-md-5">
                    <div class="col-md-12">
                        <p class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            {{ __('footer.see_you') . ' ' }}<i class="ion-ios-heart" aria-hidden="true"></i> <a href="{{ Request::root()}}" target="_blank">Bullbuilders.ge</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 py-md-5 py-4 aside-stretch-right pl-lg-5">
                <h2 class="footer-heading">{{__('nav.contact')}}</h2>
                <form action="#" class="contact-form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="{{__('contact.name')}}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="{{__('contact.email')}}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="{{__('contact.theame')}}">
                    </div>
                    <div class="form-group">
                        <textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="{{__('contact.message')}}"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control submit px-3">{{__('contact.send_message')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</footer>
