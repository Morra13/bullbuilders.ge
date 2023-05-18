<?php
/** @var \App\Models\Debtors $debtors */
?>
<?
$obOrderContent = (new \App\Models\OrderContent())
    ->where('order_id', $debtors->order_id)
    ->get();

$obDebtPayment = (new \App\Models\DebtPayments())
    ->where('order_id', $debtors->order_id )
    ->get();
?>
<tr>
    <form method="post" action="{{ route(\App\Http\Controllers\Api\DebtorsController::ROUTE_DEBT_PAYMENT) }}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method('post')
        <th scope="row">
            <span>{{ __($debtors->order_id) }}</span>
                <details>
                    <?
                    $arSumm = [];
                    foreach ($obOrderContent as $value) {
                        $arSumm [] = $value->qty * $value->price;
                    }
                    ?>
                    <summary> {{ __('შეკვეთა') }} </summary>
                    @foreach($obOrderContent as $value)
                        <? $arTotal[] = $value->qty * $value->price; ?>
                        <li>{{ __($value->name . ' | რაოდენობა : ' . $value->qty . ' | ფასი : ' . $value->price  . ' | ჯამი : ' . $value->qty * $value->price ) }}</li>
                    @endforeach
                    <li class="badge-warning">{{ __('სრული თანხა : ' . array_sum($arSumm)) }}</li>
                </details>
        </th>
        <td class="budget">
            <span>{{ __($debtors->name) }}</span>
        </td>
        <td class="budget col-xl-2">
            <span>{{ __($debtors->created_at->format('H:i:s || d.m.Y')) }}</span>
        </td>
        <td class="budget">
            @if($debtors->status == 'გადასახდელი')
            <span class="badge-primary">{{ __( 'დარჩენილი თანხა : ' . $debtors->total) }}</span>
            @endif
            <details>
                <summary> {{ __('გადახდილი თანხები') }} </summary>
                @foreach($obDebtPayment as $value)
                    <li>{{ __($value->created_at->format('d.m H:i') . ' |  სახელი : ' . $value->creator . ' | თანხა : ' . $value->payment) }}</li>
                @endforeach
            </details>
        </td>
        @if($debtors->status == 'გადასახდელი')
        <td class="budget btn-danger">
            @else
        <td class="budget btn-success">
        @endif
            <span>{{ __( $debtors->status ) }}</span>
        </td>
        @if($debtors->status != 'გადახდილი')
        <td class="budget col-xl-2">
            <div class="input-group mb-3">
                <input class="form-control" type="text" name="payment">
                <button class="btn btn-outline-secondary btn-success" name="pay" value="pay" type="submit">{{ __('გამოკლება') }}</button>
            </div>
        </td>
        <td class="budget">
            <div class="input-group mb-3">
                <input type="hidden" name="orderId" value="{{ $debtors->order_id }}">
                <button type="submit" name="payAll" value="payAll" class="btn btn-outline-success">{{ __('ვალის დაფარვა') }}</button>
            </div>
        </td>
        @endif
    </form>
</tr>
