<tr>
    <th scope="row">
        <div class="media align-items-center">
            <a href="{{ route(\App\Http\Controllers\PartnersController::ROUTE_PARTNER_UPDATE, $partner['id']) }}" class="mr-3">
                <div class="table-avatar" style="background-image: url('{{asset('storage/' . $staff['photo'])}}');"></div>
            </a>
            <div class="media-body">
                <a href="{{ route(\App\Http\Controllers\PartnersController::ROUTE_PARTNER_UPDATE, $partner['id']) }}">
                    <span class="name mb-0 text-sm text-danger">{{$partner['name']}}</span>
                </a><br/>
            </div>
        </div>
    </th>
    <td>
        <span>{{ $partner['title'] }}</span>
    </td>
    <td>
        {{$partner['description']}}
    </td>
    <td>
        <a href="{{route(\App\Http\Controllers\Api\StaffController::ROUTE_STAFF_DELETE, $partner['id'])}}" class="h3 btn-outline-danger">{{__('admin.delete')}}</a>
    </td>
</tr>
