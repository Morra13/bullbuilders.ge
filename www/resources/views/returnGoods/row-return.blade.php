<?php
/** @var \App\Models\ReturnGoods $return */
?>
<?
if ($key % 2 == 0 && $key !=0) {
        $style = 'background-color: #faf1fc';
    } else if ($key == 0) {
        $style = 'background-color: #d7f2f8';
    } else {
        $style = 'background-color: #ffffff';
    }
?>
<tr style="{{ $style }}">
    <form method="post" action="{{ route(\App\Http\Controllers\Api\ReturnGoodsController::ROUTE_UPDATE_RETURN) }}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method('post')
        <th class="budget col-xl-1">
            <span> {{ $return->name }}</span>
        </th>
        <td class="budget col-xl-1">
            <div class="input-group mb-3">
                <span class="input-group-text badge-success" >{{ $return->qty }}</span>
                <input type="text" class="form-control min-vh-100" aria-label="" name="qty" id="qty" value="{{ $return->qty }}" placeholder="{{ $return->qty }}">
                <button class="btn btn-outline-secondary badge-success" type="submit" id="add" name="add" value="add">add</button>
            </div>
        </td>
        <td class="budget col-xl-1">
            <div class="input-group mb-3">
                <button class="btn btn-outline-secondary badge-warning" type="submit" id="minus" name="minus" value="minus">-</button>
                <button class="btn btn-outline-secondary badge-primary" type="submit" id="plus" name="plus" value="plus">+</button>
            </div>
        </td>
        <td class="budget col-xl-1">
            <div class="input-group mb-3">
                <input type="hidden" name="id" value="{{ $return->id }}">
                <button type="submit" name="delete" value="delete" class="btn btn-outline-danger">X</button>
            </div>
        </td>
    </form>
</tr>
