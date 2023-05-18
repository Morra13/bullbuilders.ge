<?php
/** @var \App\Models\Transaction $transaction */
?>
<tr>
    <th scope="row">
        @if($transaction->instruction_id)
            <div class="media align-items-center">
                <a href="{{ route(\App\Http\Controllers\InstructionController::ROUTE_EDIT, $transaction->instruction_id) }}" class="avatar rounded-circle mr-3">
                    <div class="table-avatar" style="background-image: url('{{asset('storage/' . $transaction->Instruction->main_img)}}');"></div>
                </a>
                <div class="media-body">
                    <a href="{{ route(\App\Http\Controllers\InstructionController::ROUTE_EDIT, $transaction->instruction_id) }}">
                        <span class="name mb-0 text-sm text-success">Quiche with mushrooms</span>
                    </a>
                </div>
            </div>
        @else
            <div class="media align-items-center">
                <div class="table-avatar mr-3"></div>
                <div class="media-body">
                    <span class="name mb-0 text-sm text-danger">Withdraw</span>
                </div>
            </div>
        @endif
    </th>

    <td class="format-date" data-date="{{$transaction->created_at->format('c')}}"></td>

    @if($transaction->type == \App\Models\Transaction::TYPE_DEBIT)
        <td class="budget text-success">
            + ${{number_format($transaction->price, '2', '.', ' ')}} USD
            <br/>
            @if($transaction->commission)
                <small class="text-danger">- {{$transaction->commission_view}}</small>
            @else
                <small class="text-success">commission free</small>
            @endif

        </td>
    @else
        <td class="budget text-danger">
            - ${{number_format($transaction->price, '2', '.', ' ')}} USD
        </td>
    @endif
</tr>
