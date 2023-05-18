@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <div class="header pb-3 pt-7 d-flex align-items-center" style="background-image: url(../argon/img/theme/instagram-2.jpg); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-9"></span>
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-white mt-0 mb-7"></p>
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
                                        <th scope="col" class="sort" data-sort="budget">ფასი</th>
                                        <th scope="col" class="sort" data-sort="budget">რაოდენობა</th>
                                        <th scope="col" class="sort" data-sort="budget">{{ __('ჯამი : ') }}</th>
                                        <th scope="col" class="sort" data-sort="status">წაშლა</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list">
                                    <?
                                    $arSum = [];
                                    ?>
                                    @foreach($arBasket as $key => $basket)
                                        @include('product.row-basket', [
                                            'basket'    => $basket,
                                            'key'       => $key,
                                            ]
                                        )
                                        <?
                                        $arSum[] = $basket->qty * $basket->price;
                                        ?>
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
                        <form method="post" action="{{ route(\App\Http\Controllers\Api\BasketController::ROUTE_ADD_IN_BASKET) }}" autocomplete="off" enctype="multipart/form-data">
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
                                    {{--                                    required--}}
                                >
                                <button class="btn btn-outline-primary" name="add" type="submit" id="button-addon2">{{ __('დამატება') }}</button>
                            </div>
                            <?
                            if (!empty($obProduct)) {
                            foreach ($obProduct as $value) {
                            ?>
                            <div class="input-group mb-3" >
                                <span class="input-group-text badge-warning">{{$value['name'] }}</span>
                                <span class="input-group-text badge-warning">{{'ფასი: ' .  $value['price'] }}</span>
                                <button class="btn btn-outline-secondary badge-success" type="submit" id="chose" name="chose" value="{{$value['id']}}">{{ __('არჩევა') }}</button>
                            </div>
                            <?
                            }
                            }
                            ?>
                        </form>
                        <div class="input-group mb-3">
                            <span class="input-group-text badge-primary" >{{ __('ჯამი : ') }}</span>
                            <span class="input-group-text badge-primary" id="total">{{ array_sum($arSum) }}</span>
                            <span class="input-group-text badge-primary">₾</span>
                            <input type="text" class="form-control" id="taken" aria-label="" placeholder="{{ __('დათვლა') }}">
                        </div>
                        <div class="input-group mb-3" >
                            <span class="input-group-text">{{ __('მიღება : ') }}</span>
                            <span class="input-group-text" id="takenValue"></span>
                            <span class="input-group-text">₾</span>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="result1">{{ __('ხურდა : ') }}</span>
                            <span class="input-group-text" id="result"></span>
                            <span class="input-group-text" id="result2"> ₾ </span>
                        </div>
                        <?
                        $bool = false;
                        foreach ($arBasket as $value) {
                            $bool = (!empty($value));
                        }
                        if ($bool) {
                        ?>
                        <form method="post" action="{{ route(\App\Http\Controllers\Api\OrderController::ROUTE_CREATE_ORDER) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <input type="checkbox" class="btn-check " id="btn-check-outlined1" name="type" value="ბარათით გადახდილი">
                            <label class="btn btn-outline-primary" for="btn-check-outlined1">{{ __('ბარათით გადახდა') }}</label><br>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" aria-label="Ввод текста с помощью раскрывающейся кнопки" name="nameInput">
                                <div class="dropdown">
                                    <select class="btn btn-secondary dropdown-toggle alert-danger" name="name" id="name">

                                        <option value=""> {{ __('აირჩიე მევალე') }}</option>
                                        @foreach($arName as $value)
                                            <option value="{{ __($value) }}"> {{ __($value) }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="total" value="{{ array_sum($arSum) }}">
                            <div class="pl-lg-4">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-outline-success mt-4" name="create" value="create">{{ __('შეკვეთის გაფორმება') }}</button>
                                </div>
                            </div>
                        </form>
                        <?}?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var taken               = $("#taken");
        taken.keyup(function() {
            if(this.value.length > 0) {
                calculate();
            }
        });

        /**
         * Calculate
         */
        function calculate() {
            var taken = document.getElementById('taken').value;
            var total = document.getElementById('total').innerText;
            var span = document.getElementById('result');
            var span1 = document.getElementById('result1');
            var span2 = document.getElementById('result2');

            takenValue.innerHTML = taken;
            result.innerHTML = (taken.replace(',', '.') - total.replace(',', '.')).toFixed(2);
            result.class = 'badge-danger';

            if ((taken - total) < 0) {
                span.className = 'input-group-text badge-danger';
                span1.className = 'input-group-text badge-danger';
                span2.className = 'input-group-text badge-danger';
            } else {
                span.className = 'input-group-text badge-success';
                span1.className = 'input-group-text badge-success';
                span2.className = 'input-group-text badge-success';
            }
        }
    </script>

@endsection
