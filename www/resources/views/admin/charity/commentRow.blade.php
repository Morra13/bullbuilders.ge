<tr>
    <th scope="row">
        <span class="name mb-0 text-sm text-danger">{{$comment['name']}}</span>
    </th>
    <td>
        {{$comment['email']}}
    </td>
    <td>
        {{$comment['comment']}}
    </td>
    <td>
        {{$comment['created_at']}}
    </td>
    <td>
        <a href="{{route(\App\Http\Controllers\Api\CharityController::ROUTE_DELETE_COMMENT, $comment['id'])}}" class="h3 btn-outline-danger">{{__('admin.delete')}}</a>
    </td>
</tr>
