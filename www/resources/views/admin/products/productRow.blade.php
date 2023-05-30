<tr>
    <th scope="row">
        <div class="media align-items-center">
            <a href="{{ route(\App\Http\Controllers\ProductsController::ROUTE_PRODUCT_UPDATE, $product['id']) }}" class="mr-3">
                <div class="table-avatar" style="background-image: url('{{asset('storage/' . $product['main_img'])}}');"></div>
            </a>
            <div class="media-body">
                <a href="{{ route(\App\Http\Controllers\ProductsController::ROUTE_PRODUCT_UPDATE, $product['id']) }}">
                    <span class="name mb-0 text-sm text-danger">{{$product['name']}}</span>
                </a><br/>
            </div>
        </div>
    </th>
    <td>
        <span>{{ $product['title'] }}</span>
    </td>
    <td>
        {{$product['description']}}
    </td>
    <td>
        {{$product['price']}}
    </td>
    <td>
        <a href="{{route(\App\Http\Controllers\Api\ProductsController::ROUTE_PRODUCT_DELETE, $product['id'])}}" class="h3 btn-outline-danger">{{__('admin.delete')}}</a>
    </td>
</tr>
