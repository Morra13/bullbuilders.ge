<?php
/** @var \App\Models\ReturnGoods $return */
?>
<?
$obReturnContent = (new \App\Models\ReturnGoodsContent())
    ->where('return_id', $return->id)
    ->get();
?>
<tr>
    <form method="post" action="{{ route(\App\Http\Controllers\Api\ReturnGoodsController::ROUTE_DELETE_RETURN) }}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method('post')
        <th scope="row">
            <span>{{ __($return->id) }}</span>
        </th>
        <th scope="row">
            <span>{{ __($return->creator) }}</span>
        </th>
        <td class="budget col-xl-2">
            <details>
                <summary> {{ __('შემადგენლობა') }} </summary>
                @foreach($obReturnContent as $value)
                <li>{{ __($value->name . ' | რაოდენობა : ' . $value->qty ) }}</li>
                @endforeach
            </details>
        </td>
        <td class="budget col-xl-2">
            <span>{{ __($return->created_at->format('H:i:s || d.m.Y')) }}</span>
        </td>
        <td class="budget col-xl-2">
            <span>{{ __($return->comment) }}</span>
        </td>
    @if(auth()->user()->isAdmin())
            <td class="budget">
                <div class="input-group mb-3">
                    <input type="hidden" name="returnId" value="{{ $return->id }}">
                    <button type="submit" name="delete" value="delete" class="btn btn-outline-danger">X</button>
                </div>
            </td>
        @endif
    </form>
</tr>
