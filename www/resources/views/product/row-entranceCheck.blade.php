<?php
/** @var \App\Models\Entrance $entrance */
?>
<?
$obEntranceContent = (new \App\Models\EntranceContent())
    ->where('entrance_id', $entrance->id)
    ->get();
?>
<tr>
    <form method="post" action="{{ route(\App\Http\Controllers\Api\EntranceController::ROUTE_DELETE_ENTRANCE) }}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method('post')
        <th scope="row">
            <span>{{ __($entrance->id) }}</span>
        </th>
        <th scope="row">
            <span>{{ __($entrance->creator) }}</span>
        </th>
        <td class="budget col-xl-2">
            <details>
                <summary> {{ __('შემადგენლობა') }} </summary>
                @foreach($obEntranceContent as $value)
                <li>{{ __($value->name . ' | რაოდენობა : ' . $value->qty ) }}</li>
                @endforeach
            </details>
        </td>
        <td class="budget col-xl-2">
            <span>{{ __($entrance->created_at->format('H:i:s || d.m.Y')) }}</span>
        </td>
        @if(auth()->user()->isAdmin())
            <td class="budget">
                <div class="input-group mb-3">
                    <input type="hidden" name="entranceId" value="{{ $entrance->id }}">
                    <button type="submit" name="delete" value="delete" class="btn btn-outline-danger">X</button>
                </div>
            </td>
        @endif
    </form>
</tr>
