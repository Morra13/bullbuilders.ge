<?php
/** @var \App\Models\Instruction $instruction */
?>
<tr>
    <th scope="row">
        <div class="media align-items-center">
            @if ($instruction->User)
                <a href="{{ route(\App\Http\Controllers\UserController::ROUTE_ADMIN_USER, $instruction->user_id) }}" class="avatar rounded-circle mr-3">
                    <div class="table-avatar" style="background-image: url('{{asset('storage/' . $instruction->User->logo)}}');"></div>
                </a>
                <div class="media-body">
                    <a href="{{ route(\App\Http\Controllers\UserController::ROUTE_ADMIN_USER, $instruction->user_id) }}">
                        <span class="name mb-0 text-sm text-danger">{{ $instruction->User->name }}</span>
                    </a>
                </div>
            @endif
        </div>
    </th>
    <th scope="row">
        <div class="media align-items-center">
            <a href="{{ route(\App\Http\Controllers\InstructionController::ROUTE_EDIT, $instruction->id) }}" class="avatar rounded-circle mr-3">
                <div class="table-avatar" style="background-image: url('{{ empty($instruction->main_img) ? asset('storage') . '/uploads/defaultUploadImg.png' : asset('storage/' . $instruction->main_img) }}');"></div>
            </a>
            <div class="media-body">
                <a href="{{ route(\App\Http\Controllers\InstructionController::ROUTE_EDIT, $instruction->id) }}">
                    <span class="name mb-0 text-sm text-primary">{{ $instruction->name }}</span>
                </a>
            </div>
        </div>
    </th>
    <td class="format-date" data-date="{{$instruction->created_at->format('c')}}"></td>
    <td class="budget">
        {{ $instruction->price_view }}
    </td>
    <td class="budget">
        {{ $instruction->sold_view }}
    </td>
    <td>
        <span class="badge badge-dot mr-4">
        @if($instruction->status == 'archive')
                <i class="bg-danger"></i>
            @else
                <i class="bg-success"></i>
            @endif
            <span class="status">{{ $instruction->status }}</span>
        </span>
    </td>
</tr>
