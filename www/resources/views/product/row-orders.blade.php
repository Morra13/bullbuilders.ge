<?php
/** @var \App\Models\Order $order */
?>
<?
$obOrderContent = (new \App\Models\OrderContent())
    ->where('order_id', $order->id)
    ->get();
?>
<tr>
    <form method="post" action="{{ route(\App\Http\Controllers\Api\OrderController::ROUTE_DELETE_ORDER) }}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method('post')
        <th scope="row">
            <span>{{ __($order->id) }}</span>
        </th>
        <td class="budget col-xl-2">
            <details>
                <summary> {{ __('შეკვეთა') }} </summary>
                @foreach($obOrderContent as $value)
                <li>{{ __($value->name . ' | რაოდენობა : ' . $value->qty . ' | ფასი : ' . $value->price  . ' | ჯამი : ' . $value->qty * $value->price ) }}</li>
                @endforeach
            </details>
        </td>
        <td class="budget col-xl-2">
            <span>{{ __($order->created_at->format('H:i:s || d.m.Y')) }}</span>
        </td>
        <td class="budget">
            <span>{{ __($order->type) }}</span>
        </td>
        <td class="budget col-xl-2">
            <span class="badge-success">{{ __($order->total) }}</span>
        </td>
        <td class="budget">
            <span>{{ __($order->debtor) }}</span>
        </td>
        @if(auth()->user()->isAdmin())
            <td class="budget">
                <div class="input-group mb-3">
                    <input type="hidden" name="orderId" value="{{ $order->id }}">
                    <button type="submit" name="delete" value="delete" class="btn btn-outline-danger">X</button>
                </div>
            </td>
        @endif
    </form>
</tr>
