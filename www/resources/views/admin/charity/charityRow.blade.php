<tr>
    <th scope="row">
        <div class="media align-items-center">
            <a href="{{ route(\App\Http\Controllers\CharityController::ROUTE_UPDATE_CHARITY, $charity['id']) }}" class="mr-3">
                <div class="table-avatar" style="background-image: url('{{asset('storage/' . $charity['main_img'])}}');"></div>
            </a>
            <div class="media-body">
                <a href="{{ route(\App\Http\Controllers\CharityController::ROUTE_UPDATE_CHARITY, $charity['id']) }}">
                    <span class="name mb-0 text-sm text-danger">{{$charity['name']}}</span>
                </a><br/>
            </div>
        </div>
    </th>
    <td>
        {{$charity['manager']}}
    </td>
    <td>
        {{$charity['manager_phone']}}
    </td>
    <td>
        {{$charity['date']}}
    </td>
    <td>
        <a href="{{ route(\App\Http\Controllers\CharityController::ROUTE_COMMENT, $charity['id']) }}" class="mr-3">
            <span> {{ __('admin.comment') }} </span>
        </a>
    </td>
    <td>
        <a href="{{ route(\App\Http\Controllers\CharityController::ROUTE_UPDATE_CHARITY_IMG, $charity['id']) }}" class="mr-3">
            <span> {{ __('admin.more_img') }} </span>
        </a>
    </td>
    <td>
        <a href="{{route(\App\Http\Controllers\Api\CharityController::ROUTE_DELETE_CHARITY, $charity['id'])}}" class="h3 btn-outline-danger">{{__('admin.delete')}}</a>
    </td>
</tr>
