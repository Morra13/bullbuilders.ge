<div class="col-md-4 ftco-animate">
    <a href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_PROJECT, $project['id']) }}">
        <div class="work img d-flex align-items-end" style="background-image: url({{ asset('storage') . '/' . $project['main_img']}});">
            <div class="desc w-100 px-4">
                <div class="text w-100 mb-3">
                    <div>{{ __($project['name']) }}</div>
                </div>
            </div>
        </div>
    </a>
</div>
