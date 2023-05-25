<div class="col-md-4 ftco-animate">
    <a href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_PROJECT, $project['id']) }}">
        <div class="work img d-flex align-items-end" style="background-image: url({{ asset('argon') }}/bullbuilders/images/work-1.jpg);">
            <div class="desc w-100 px-4">
                <div class="text w-100 mb-3">
                    <span>{{ __($project['name']) }}</span>
                    <h3>{{ __($project['manager']) }}</h3>
                </div>
            </div>
        </div>
    </a>
</div>
