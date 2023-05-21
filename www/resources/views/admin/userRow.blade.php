<?php
/** @var \App\Models\User $user */
?>
<tr>
    <th scope="row">
        <div class="media align-items-center">
            <a href="{{ route(\App\Http\Controllers\AdminCotroller::ROUTE_USER_ROLE_UPDATE, $user->id) }}" class="mr-3">
                <div class="table-avatar" style="background-image: url('{{asset('storage/' . $user->logo)}}');"></div>
            </a>
            <div class="media-body">
                <a href="{{ route(\App\Http\Controllers\AdminCotroller::ROUTE_USER_ROLE_UPDATE, $user->id) }}">
                    <span class="name mb-0 text-sm text-danger">{{$user->name}}</span>
                </a><br/>
            </div>
        </div>
    </th>
    <td>
        <a href="mailto:{{$user->email}}">{{$user->email}}</a>
    </td>
    <td>
        {{$user->role}}
    </td>
    <td class="format-date" data-date="{{$user->created_at->format('c')}}"></td>
    <td class="format-date" data-date="{{$user->updated_at->format('c')}}"></td>
    <td class="budget">
        <a href="{{route(\App\Http\Controllers\InstructionController::ROUTE_ADMIN_LIST)}}?user_id={{$user->id}}" class="h3"></a>
    </td>
</tr>
