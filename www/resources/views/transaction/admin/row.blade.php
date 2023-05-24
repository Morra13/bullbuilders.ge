<?php
/** @var \App\Models\Transaction $transaction */
?>
<tr>
    <th scope="row">
        <div class="media align-items-center">
            <a href="{--><!--{ route(\App\Http\Controllers\UserController::ROUTE_ADMIN_USER, $transaction->author_id) }}" class="avatar rounded-circle mr-3">
                <div class="table-avatar" style="background-image: url('{{asset('storage/' . $transaction->Author->logo)}}');"></div>
            </a>
            <div class="media-body">
                <a href="{{ route(\App\Http\Controllers\UserController::ROUTE_ADMIN_USER,  $transaction->author_id) }}">
                    <span class="name mb-0 text-sm text-danger">{{$transaction->Author->name}}</span>
                    <br/>
                    <small>{{$transaction->Author->email}}</small>
                </a>
            </div>
        </div>
    </th>
    <th scope="row">
        <div class="media align-items-center">
            @if ($transaction->User)
                <a href="{{ route(\App\Http\Controllers\UserController::ROUTE_ADMIN_USER, $transaction->user_id) }}" class="avatar rounded-circle mr-3">
                    <div class="table-avatar" style="background-image: url('{{asset('storage/' . $transaction->User->logo)}}');"></div>
                </a>
                <div class="media-body">
                    <a href="{{ route(\App\Http\Controllers\UserController::ROUTE_ADMIN_USER,  $transaction->user_id) }}">
                        @if ($transaction->User->name)
                            <span class="name mb-0 text-sm text-danger">{{$transaction->User->name}}</span>
                            <br/>
                        @endif
                        <small>{{$transaction->User->email}}</small>
                    </a>
                </div>
            @else
                unknown
            @endif
        </div>
    </th>
    <th scope="row">
        <div class="media align-items-center">
            @if ($transaction->instruction_id)
                <a href="{{ route(\App\Http\Controllers\InstructionController::ROUTE_EDIT, $transaction->instruction_id) }}" class="avatar rounded-circle mr-3">
                    <div class="table-avatar" style="background-image: url('{{asset('storage/' . $transaction->Instruction->main_img)}}');"></div>
                </a>
                <div class="media-body">
                    <a href="{{ route(\App\Http\Controllers\InstructionController::ROUTE_EDIT, $transaction->instruction_id) }}">
                        <span class="name mb-0 text-sm text-primary">{{$transaction->Instruction->name}}</span>
                    </a>
                </div>
            @else
                <div class="table-avatar mr-3"></div>
                <div class="media-body">
                    <span class="name mb-0 text-sm text-danger">Withdraw</span>
                </div>
            @endif
        </div>
    </th>
    <td class="format-date" data-date="{{$transaction->created_at->format('c')}}"></td>
    @if($transaction->type == \App\Models\Transaction::TYPE_DEBIT)
        @if(!in_array($transaction->status, [ \App\Models\Transaction::STATUS_NEW,  \App\Models\Transaction::STATUS_ERROR]))
            <td class="budget text-success">
                + ${{number_format($transaction->price, '2', '.', ' ')}} USD
                <br/>
                @if ($transaction->commission)
                    <small class="text-danger"> - {{$transaction->commission_view}}</small>
                @else
                    <small class="text-success">commission free</small>
                @endif
            </td>
        @else
            <td class="budget text-gray">
                + ${{number_format($transaction->price, '2', '.', ' ')}} USD
                <br/>
                @if ($transaction->commission)
                    <small> - {{$transaction->commission_view}}</small>
                @else
                    <small>commission free</small>
                @endif
            </td>
        @endif
    @else
        <td class="budget text-danger">
            - ${{number_format($transaction->price, '2', '.', ' ')}} USD
        </td>
    @endif

    @switch($transaction->status)
        @case(\App\Models\Transaction::STATUS_ERROR)
            <td class="budget text-danger">
                {{$transaction->status}}
            </td>
            @break
        @case(\App\Models\Transaction::STATUS_SUCCESS)
        @case(\App\Models\Transaction::STATUS_PDF_SENT)
        @case(\App\Models\Transaction::STATUS_PAYED)
            <td class="budget text-success">
                {{$transaction->status}}
            </td>
            @break
        @default
            <td class="budget text-default">
                {{$transaction->status}}
            </td>
            @break
    @endswitch
    <td>
        @if(!empty($transaction->payment_data))
            <a href="#" class="btn-sm btn-creatory" data-toggle="modal" data-target="#modal-default-{{$transaction->id}}">Info</a>
            <div class="modal fade" id="modal-default-{{$transaction->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-default-{{$transaction->id}}" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h3 class="modal-title" id="modal-title-default">{{$transaction->transaction_id}}</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            {!! $transaction->payment_data_view !!}
{{--                            <pre>--}}
{{--                            {!! $transaction->payment_datas_view !!}--}}
{{--                            </pre>--}}
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </td>
</tr>
