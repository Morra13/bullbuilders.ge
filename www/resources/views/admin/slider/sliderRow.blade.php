<tr>
    <th scope="row">
        <div class="media align-items-center">
            <a href="{{ route(\App\Http\Controllers\SliderController::ROUTE_UPDATE_SLIDER, $slider['id']) }}" class="mr-3">
                <div class="table-avatar" style="background-image: url('{{asset('storage/' . $slider['main_img'])}}');"></div>
            </a>
            <div class="media-body">
                <a href="{{ route(\App\Http\Controllers\SliderController::ROUTE_UPDATE_SLIDER, $slider['id']) }}">
                    <span class="name mb-0 text-sm text-danger">{{$slider['id']}}</span>
                </a><br/>
            </div>
        </div>
    </th>
    <td>
        <span>{{ $slider['subtitle_' . (session()->get('lang') ?? 'ge')] }}</span>
    </td>
    <td>
        {{$slider['title_' . (session()->get('lang')  ?? 'ge')]}}
    </td>
    <td>
        <a href="{{route(\App\Http\Controllers\Api\SliderController::ROUTE_DELETE_SLIDER, $slider['id'])}}" class="h3 btn-outline-danger">{{__('admin.delete')}}</a>
    </td>
</tr>
