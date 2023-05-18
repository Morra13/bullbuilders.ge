@include('layouts.footers.cookie')

<div class="row align-items-center justify-content-xl-between">
    <div class="col-xl-6">
        <div class="copyright text-center text-xl-left text-muted">
            &copy; {{ now()->year }} S.M.F
        </div>
    </div>
{{--    <div class="col-xl-6">--}}
{{--        <ul class="nav nav-footer justify-content-center justify-content-xl-end">--}}
{{--            <li class="nav-item">--}}
{{--                <a href="{{route(\App\Http\Controllers\PublicController::ROUTE_POLICY)}}" class="nav-link">Privacy Policy</a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a href="{{route(\App\Http\Controllers\PublicController::ROUTE_HOW_IT_WORK)}}" class="nav-link">About Us</a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </div>--}}
</div>
