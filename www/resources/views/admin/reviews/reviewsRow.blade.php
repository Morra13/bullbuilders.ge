<tr>
    <th scope="row">
        <div class="media align-items-center">
            <a href="{{ route(\App\Http\Controllers\ReviewsController::ROUTE_REVIEWS_UPDATE, $review['id']) }}" class="mr-3">
                <div class="table-avatar" style="background-image: url('{{asset('storage/' . $review['photo'])}}');"></div>
            </a>
            <div class="media-body">
                <a href="{{ route(\App\Http\Controllers\ReviewsController::ROUTE_REVIEWS_UPDATE, $review['id']) }}">
                    <span class="name mb-0 text-sm text-danger">{{$review['name']}}</span>
                </a><br/>
            </div>
        </div>
    </th>
    <td>
        <span>{{ $review['surname'] }}</span>
    </td>
    <td>
        {{$review['position']}}
    </td>
    <td>
        <span> {{ $review['comment'] }} </span>
    </td>
    <td>
        <a href="{{route(\App\Http\Controllers\Api\ReviewsController::ROUTE_REVIEWS_DELETE, $review['id'])}}" class="h3 btn-outline-danger">{{__('admin.delete')}}</a>
    </td>
</tr>
