@extends('layouts.app', ['title' => __('პროდუქციის დაბრუნება')])

@section('content')
    <div class="header pb-3 pt-7 d-flex align-items-center" style="background-image: url(../argon/img/theme/instagram-2.jpg); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-9"></span>
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-white mt-0 mb-7">პროდუქციის დაბრუნება</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-9 order-xl-0">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header border-0 text-center">
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">სახელი</th>
                                        <th scope="col" class="sort" data-sort="budget">რაოდენობა</th>
                                        <th scope="col" class="sort" data-sort="budget"> </th>
                                        <th scope="col" class="sort" data-sort="status">წაშლა</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list">
                                    @foreach($arReturn as $key => $return)
                                        @include('returnGoods.row-return', [
                                            'return'      => $return,
                                            'key'       => $key,
                                            ]
                                        )
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 order-xl-1 mb-5 mb-xl-2">
                <div class="card card-profile shadow">
                    <div class="card-body pt-0 pt-md-4">
                        <form method="post" action="{{ route(\App\Http\Controllers\Api\ReturnGoodsController::ROUTE_ADD_IN_RETURN) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="input-group mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="code"
                                    placeholder="{{ __('კოდი') }}"
                                    aria-describedby="button-addon2"
                                    autofocus
                                >
                                <button class="btn btn-outline-primary" name="add" type="submit" id="button-addon2">{{ __('დამატება') }}</button>
                            </div>
                            <?
                            if (!empty($obProduct)) {
                                foreach ($obProduct as $value) {
                            ?>
                            <div class="input-group mb-3" >
                                <span class="input-group-text badge-warning">{{$value['name'] }}</span>
                                <span class="input-group-text badge-warning">{{'Price: ' .  $value['price'] }}</span>
                                <button class="btn btn-outline-secondary badge-success" type="submit" id="chose" name="chose" value="{{$value['id']}}">{{ __('არჩევა') }}</button>
                            </div>
                            <?
                                }
                            }
                            ?>
                        </form>
                        <?
                        $bool = false;
                        foreach ($arReturn as $value) {
                            $bool = (!empty($value));
                        }
                        if ($bool) {
                        ?>
                        <form method="post" action="{{ route(\App\Http\Controllers\Api\ReturnGoodsController::ROUTE_CREATE_RETURN) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="pl-lg-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text badge-success" >{{ __('კომენტარი') }}</span>
                                    <input type="text" class="form-control min-vh-100" aria-label="" name="comment">
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-outline-success mt-4" name="create" value="create">{{ __('მიღება') }}</button>
                                </div>
                            </div>
                        </form>
                        <?}?>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
