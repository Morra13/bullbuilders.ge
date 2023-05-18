<?php
/** @var \App\Models\User $user */
?>
<tr>
    <th scope="row">
        <div class="media align-items-center">
            <a href="{{ route(\App\Http\Controllers\UserController::ROUTE_ADMIN_USER, $user->id) }}" class="mr-3">
                <div class="table-avatar" style="background-image: url('{{asset('storage/' . $user->logo)}}');"></div>
            </a>
            <div class="media-body">
                <a href="{{ route(\App\Http\Controllers\UserController::ROUTE_ADMIN_USER, $user->id) }}">
                    <span class="name mb-0 text-sm text-danger">{{$user->name}}</span>
                </a><br/>
                {{'@' . $user->nick_name}}
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
        @if($user->instruction_count)
            <a href="{{route(\App\Http\Controllers\InstructionController::ROUTE_ADMIN_LIST)}}?user_id={{$user->id}}" class="h3">
                {{$user->instruction_count}}
            </a>
        @else
            {{$user->instruction_count}}
        @endif
    </td>
    <td class="budget">
        {{$user->balance_view}}
    </td>
    <td>
        @if ($user->balance > 0)
            <a class="btn-sm btn-creatory"
               href="{{ route(\App\Http\Controllers\InstructionController::ROUTE_CREATE) }}"
               data-toggle="modal"
               data-target="#modal-form"
               onclick="Withdraw('{{$user->id}}', '{{$user->name}}', '{{$user->balance}}', '{{$user->balance_view}}')"
            >Withdraw</a>
        @endif
    </td>
</tr>
