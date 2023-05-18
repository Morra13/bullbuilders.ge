<?php
/** @var \App\Models\Instruction $instruction */
?>
<tr>
    <th scope="row">
        <div class="media align-items-center">
            <a href="{{ route(\App\Http\Controllers\InstructionController::ROUTE_EDIT, $instruction->id ) }}" class="avatar rounded-circle mr-3">
                <div class="table-avatar" style="background-image: url('{{ empty($instruction->main_img) ? asset('storage') . '/uploads/defaultUploadImg.png' : asset('storage/' . $instruction->main_img) }}');"></div>
            </a>
            <div class="media-body">
                <a href="{{ route(\App\Http\Controllers\InstructionController::ROUTE_EDIT, $instruction->id ) }}">
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
    <td class="text-right">
        <div class="media align-items-right">
            <a href="{{ route(\App\Http\Controllers\InstructionController::ROUTE_EDIT, $instruction->id ) }}" class="text-default">
                <i class="ni ni-settings-gear-65 pr-3" style="font-size: 20px"></i>
            </a>

            @if($instruction->status == \App\Models\Instruction::STATUS_SALE)
                <a
                    href="#"
                    class="text-info"
                    onclick="copyToClipboard('{{$instruction->instruction_link}}')"
                    data-toggle="modal"
                    data-target="#modal-notification"
                >
                    <i class="ni ni-ungroup" style="font-size: 20px"></i>
                </a>
            @endif

        </div>
    </td>
</tr>

