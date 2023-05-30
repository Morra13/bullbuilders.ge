<div class="col-md-4 ftco-animate">
    <a href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_PROJECT, $project['id']) }}">
        <div class="work img d-flex align-items-end" style="background-image: url({{ asset('storage') . '/' . $project['main_img']}});">
            <div class="desc w-100 px-4">
                <div class="text w-100 mb-3">
                    <span>{{ __($project['name']) }}</span>
                    <h3>{{ __($project['manager']) }}</h3>
                    @if($project['status'] == 'completed')
                    <h4 class="btn-outline-success">{{ __('projects.completed') }}</h4>
                    @elseif($project['status'] == 'incomplete')
                        <h4 class="btn-outline-danger">{{ __('projects.incomplete') }}</h4>
                    @endif
                </div>
            </div>
        </div>
    </a>
</div>
