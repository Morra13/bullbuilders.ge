<tr>
    <th scope="row">
        <div class="media align-items-center">
            <a href="{{ route(\App\Http\Controllers\StaffController::ROUTE_STAFF_UPDATE, $staff['id']) }}" class="mr-3">
                <div class="table-avatar" style="background-image: url('{{asset('storage/' . $staff['photo'])}}');"></div>
            </a>
            <div class="media-body">
                <a href="{{ route(\App\Http\Controllers\StaffController::ROUTE_STAFF_UPDATE, $staff['id']) }}">
                    <span class="name mb-0 text-sm text-danger">{{$staff['name']}}</span>
                </a><br/>
            </div>
        </div>
    </th>
    <td>
        <span>{{ $staff['surname'] }}</span>
    </td>
    <td>
        {{$staff['position']}}
    </td>
    <td>
        <span> {{ $staff['comment'] }} </span>
    </td>
    <td>
        <a href="{{route(\App\Http\Controllers\Api\StaffController::ROUTE_STAFF_DELETE, $staff['id'])}}" class="h3 btn-outline-danger">{{__('admin.delete')}}</a>
    </td>
</tr>
