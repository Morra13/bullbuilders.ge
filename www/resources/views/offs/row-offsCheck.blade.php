<?php
/** @var \App\Models\Offs $offs */
?>
<?
$obOffsContent = (new \App\Models\OffsContent())
    ->where('off_id', $offs->id)
    ->get();
?>
<tr>
    <form method="post" action="{{ route(\App\Http\Controllers\Api\OffsController::ROUTE_DELETE_OFFS) }}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method('post')
        <th scope="row">
            <span>{{ __($offs->id) }}</span>
        </th>
        <th scope="row">
            <span>{{ __($offs->creator) }}</span>
        </th>
        <td class="budget col-xl-2">
            <details>
                <summary> {{ __('შემადგენლობა') }} </summary>
                @foreach($obOffsContent as $value)
                <li>{{ __($value->name . ' | რაოდენობა : ' . $value->qty ) }}</li>
                @endforeach
            </details>
        </td>
        <td class="budget col-xl-2">
            <span>{{ __($offs->created_at->format('H:i:s || d.m.Y')) }}</span>
        </td>
        @if(auth()->user()->isAdmin())
            <td class="budget">
                <div class="input-group mb-3">
                    <input type="hidden" name="offsId" value="{{ $offs->id }}">
                    <button type="submit" name="delete" value="delete" class="btn btn-outline-danger">X</button>
                </div>
            </td>
        @endif
    </form>
</tr>
