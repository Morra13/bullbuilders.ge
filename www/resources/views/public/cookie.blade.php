@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <div class="header pb-1 pt-1 d-flex align-items-center" style="background-image: url(../argon/img/theme/profile-cover-2.png); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-8"></span>
        <div class="container">
            <div class="header-body text-center mt-7 mb-7">
                <div class="row">
                    <div class="col-xl-12 order-xl-1">
                        <div class="card bg-secondary shadow">
                            <div class="card-body">
                                <h6 class="heading-small text-muted mb-4">Generic Cookie Policy Template</h6>
                                <div class="pl-lg-4">
                                    <p class="text-justify">Please read this cookie policy (<a href="{{route(\App\Http\Controllers\PublicController::ROUTE_COOKIE)}}">“cookie policy”</a>, <a href="{{route(\App\Http\Controllers\PublicController::ROUTE_POLICY)}}">“policy”</a>) carefully before using Creatory.pro website
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="heading-small text-muted mb-4">What are cookies?</h6>
                                <div class="pl-lg-4">
                                    <p class="text-justify">Cookies are simple text files that are stored on your computer or mobile device by a website’s server. Each cookie is unique to your web browser. It will contain some anonymous information such as a unique identifier, website’s domain name, and some digits and numbers.
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="heading-small text-muted mb-4">What types of cookies do we use?</h6>
                                <div class="pl-lg-4">
                                    <p class="text-justify"><b>Necessary cookies</b></p>
                                    <p class="text-justify">Necessary cookies allow us to offer you the best possible experience when accessing and navigating through our website and using its features. For example, these cookies let us recognize that you have created an account and have logged into that account
                                    <p class="text-justify"><b>Functionality cookies</b></p>
                                    <p class="text-justify">Functionality cookies let us operate the site in accordance with the choices you make. For example, we will recognize your username and remember how you customized the site during future visits.
                                    <p class="text-justify"><b>Analytical cookies</b></p>
                                    <p class="text-justify">These cookies enable us and third-party services to collect aggregated data for statistical purposes on how our visitors use the website. These cookies do not contain personal information such as names and email addresses and are used to help us improve your user experience of the website.
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="heading-small text-muted mb-4">How to delete cookies?</h6>
                                <div class="pl-lg-4">
                                    <p class="text-justify">If you want to restrict or block the cookies that are set by our website, you can do so through your browser setting. Alternatively, you can visit <a href="https://www.internetcookies.com/"> www.internetcookies.com </a>, which contains comprehensive information on how to do this on a wide variety of browsers and devices. You will find general information about cookies and details on how to delete cookies from your device.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>

    <div class="container mt--10 pb-5"></div>
@endsection
