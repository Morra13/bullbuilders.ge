<?php
/** @var \App\Models\Basket $basket */
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
    <form method="post" action="{{ route(\App\Http\Controllers\Api\BasketController::ROUTE_UPDATE_BASKET) }}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method('post')
        <th class="budget col-xl-1">
            <span> {{ $basket->name }}</span>
        </th>
        <td class="budget col-xl-1">
            <div class="input-group mb-3">
                <span class="input-group-text badge-warning">{{ $basket->price }}</span>
            </div>
        </td>
        <td class="budget col-xl-2">
            <div class="input-group mb-3">
                <span class="input-group-text badge-success" >{{ $basket->qty  }}</span>
                <input type="text" class="form-control min-vh-100" aria-label="" name="qty" id="qty" value="{{ $basket->qty }}" placeholder="{{ $basket->qty }}">
                <button class="btn btn-outline-secondary badge-success" type="submit" id="add" name="add" value="add">დამატება</button>
                <button class="btn btn-outline-secondary badge-warning" type="submit" id="minus" name="minus" value="minus">-</button>
                <button class="btn btn-outline-secondary badge-primary" type="submit" id="plus" name="plus" value="plus">+</button>
            </div>
        </td>
        <td class="budget col-xl-1">
            <div class="input-group mb-3">
                <span class="input-group-text badge-warning">{{ $basket->qty * $basket->price }}</span>
            </div>
        </td>
        <td class="budget col-xl-1">
            <div class="input-group mb-3">
                <input type="hidden" name="id" value="{{ $basket->id }}">
                <button type="submit" name="delete" value="delete" class="btn btn-outline-danger">X</button>
            </div>
        </td>
    </form>
</tr>
