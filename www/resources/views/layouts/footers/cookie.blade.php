{{--<style>--}}
{{--    #cb-cookie-banner--}}
{{--    {--}}
{{--        position: fixed;--}}
{{--        bottom: 0;--}}
{{--        left: 0;--}}
{{--        width: 100%;--}}
{{--        z-index: 999;--}}
{{--        border-radius: 0;--}}
{{--        display: none--}}
{{--    }--}}
{{--</style>--}}
{{--<div id="cb-cookie-banner" class="alert alert-dark text-center mb-0" role="alert">--}}
{{--    🍪 This website uses cookies to ensure you get the best experience on our website.--}}
{{--    <a href="{{route(\App\Http\Controllers\PublicController::ROUTE_COOKIE)}}" target="blank">Learn more</a>--}}
{{--    <button type="button" class="btn btn-primary btn-sm ms-3" onclick="window.cb_hideCookieBanner()">--}}
{{--        I agree--}}
{{--    </button>--}}
{{--</div>--}}
{{--<script>--}}
{{--    function showCookieBanner(){--}}
{{--        let cookieBanner = document.getElementById("cb-cookie-banner");--}}
{{--        cookieBanner.style.display = "block";--}}
{{--    }--}}

{{--    function hideCookieBanner(){--}}
{{--        localStorage.setItem("cb_isCookieAccepted", "yes");--}}
{{--        let cookieBanner = document.getElementById("cb-cookie-banner");--}}
{{--        cookieBanner.style.display = "none";--}}
{{--    }--}}

{{--    function initializeCookieBanner(){--}}
{{--        let isCookieAccepted = localStorage.getItem("cb_isCookieAccepted");--}}
{{--        if(isCookieAccepted === null)--}}
{{--        {--}}
{{--            localStorage.setItem("cb_isCookieAccepted", "no");--}}
{{--            showCookieBanner();--}}
{{--        }--}}
{{--        if(isCookieAccepted === "no"){--}}
{{--            showCookieBanner();--}}
{{--        }--}}
{{--    }--}}

{{--    window.onload = initializeCookieBanner();--}}
{{--    window.cb_hideCookieBanner = hideCookieBanner;--}}
{{--</script>--}}
