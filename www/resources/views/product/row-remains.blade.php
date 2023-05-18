<?php
/** @var \App\Models\Product $product */
/** @var \App\Models\Code $code */
$code = (new \App\Models\Code())->where('product_id', $product->id)->get();
?>
<tr>
    <form method="post" action="{{ route(\App\Http\Controllers\Api\ProductController::ROUTE_UPDATE_PRODUCT) }}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method('post')
        <td class="budget col-xl-2">
            <div class="input-group mb-3">
                <input id="name" class="form-control" type="text" name="name" value="{{ $product->name }}">
            </div>
        </td>
        <td class="budget col-xl-1">
            <div class="input-group mb-3">
                <span class="input-group-text badge-success" >{{ $product->price }}</span>
                <input id="price" class="form-control" type="text" name="price" value="{{ $product->price }}">
            </div>
        </td>
        <td class="budget col-xl-1">
            <div class="input-group mb-3">
                <span class="input-group-text badge-success" >{{ $product->qty }}</span>
                <input id="qty" class="form-control" type="text" name="qty" value="{{ $product->qty }}">
            </div>
        </td>
        <td class="budget col-xl-1">
            @foreach($code as $key => $value)
                <div class="input-group mb-3">
                    <input id="code" class="form-control" type="text" name="{{'code' . $key}}" value="{{ $value['code'] }}">
                    <button type="submit" name="deleteCode" value="{{$value['id']}}" class="btn btn-outline-danger">X</button>
                </div>
                <input type="hidden" name="{{'codeId' . $key}}" value="{{$value['id']}}">
            @endforeach
                <input type="hidden" name="{{'countCode'}}" value="{{count($code)}}">
        </td>
        <td class="budget col-xl-1">
            <div class="form-group{{ $errors->has('newCode') ? ' has-danger' : '' }}">
                <input
                    type="text"
                    name="newCode"
                    id="newCode"
                    class="form-control form-control-alternative{{ $errors->has('newCode') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('ახალი შტრიხკოდი') }}"
                >
            </div>
        </td>
        <td class="budget col-xl-1">
            <div class="input-group mb-3">
                <div class="dropdown">
                    <select class="btn btn-info dropdown-toggle-split" name="type">
                        <option class="btn-danger" value="{{ $product->type }}"> {{ $product->type }}</option>
                        @foreach($arTypes as $value)
                            <option value="{{ $value['type'] }}"> {{ $value['type'] }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </td>
        <td class="budget col-xl-1">
            <div class="input-group mb-3">
                <input type="hidden" name="productId" value="{{ $product->id }}">
                <button id="change" class="btn btn-outline-secondary" name="change" value="change" type="submit">{{ __('შეცვლა') }}</button>
            </div>
        </td>
        <td class="budget col-xl-1">
            <div class="input-group mb-3">
                <button type="submit" name="delete" value="delete" class="btn btn-outline-danger">X</button>
            </div>
        </td>
    </form>
</tr>

<script type="text/javascript">
    document.addEventListener('keypress', function (e) {
        if (e.keyCode === 13 || e.which === 13) {
            e.preventDefault();
            return  false;
        }
    });
</script>
