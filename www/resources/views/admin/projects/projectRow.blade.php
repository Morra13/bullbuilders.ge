<tr>
    <th scope="row">
        <div class="media align-items-center">
            <a href="{{ route(\App\Http\Controllers\ProjectsController::ROUTE_PROJECT_UPDATE, $project['id']) }}" class="mr-3">
                <div class="table-avatar" style="background-image: url('{{asset('storage/' . $project['main_img'])}}');"></div>
            </a>
            <div class="media-body">
                <a href="{{ route(\App\Http\Controllers\ProjectsController::ROUTE_PROJECT_UPDATE, $project['id']) }}">
                    <span class="name mb-0 text-sm text-danger">{{$project['name']}}</span>
                </a><br/>
            </div>
        </div>
    </th>
    <td>
        @if($project['status'] == 'completed')
            <span class="btn-success">{{ __('admin.'. $project['status'])  }}</span>
        @else
            <span class="btn-danger">{{ __('admin.'. $project['status'])  }}</span>
        @endif
    </td>
    <td>
        {{$project['manager_phone']}}
    </td>
    <td>
        <span> {{ $project['description'] }} </span>
    </td>
    <td>
        <span>{{ $project['date_begin'] }}</span>
    </td>
    <td>
        <span>{{$project['date_end']}}</span>
    </td>
    <td>
        <a href="{{ route(\App\Http\Controllers\ProjectsController::ROUTE_PROJECT_UPDATE_IMG, $project['id']) }}" class="mr-3">
            <span> {{ __('admin.more_img') }} </span>
        </a>
    </td>
    <td>
        <a href="{{route(\App\Http\Controllers\Api\ProjectsController::ROUTE_PROJECT_DELETE, $project['id'])}}" class="h3 btn-outline-danger">{{__('admin.delete')}}</a>
    </td>
</tr>
