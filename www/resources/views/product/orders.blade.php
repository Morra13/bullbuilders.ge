@extends('layouts.app', ['title' => __('შეკვეთები')])
@section('content')
    <div class="header pb-8 pt-5" style="background-image: url(../argon/img/theme/instagram-2.jpg); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-8"></span>
        <div class="container-fluid">
            <div class="header-body">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-white">შეკვეთები</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="dropdown p-1 center" style="z-index: 999">
                                        <button class="btn btn-info dropdown-toggle"  type="button" data-toggle="dropdown">
                                            {{$_REQUEST['pay'] ?? 'აირჩიეთ გადახდის ტიპი'}}
                                            <span class="caret"></span>
                                        </button>
                                        <?
                                        $url = '?';
                                        if (!empty($_GET['from'])) {
                                            $url = $url .'from='. $_GET['from'] . '&';
                                        }
                                        if (!empty($_GET['to'])) {
                                            $url = $url .'to=' . $_GET['to'] . '&';
                                        }
                                        ?>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-item"><a href="{{'?'}}">{{ __('ყველა') }}</a></li>
                                            @if(!empty($_GET['from']) || !empty($_GET['from']))
                                                <?
                                                $from = '';
                                                $to = '';
                                                if (!empty($_GET['from'])) {
                                                    $from = $_GET['from'] . ' დან ';
                                                }
                                                if (!empty($_GET['to'])) {
                                                    $to = $_GET['to'] . ' მდე ';
                                                }
                                                ?>
                                                <li class="dropdown-item"><a href="{{$url}}">{{ __('ყველა '. $from . $to  ) }}</a></li>
                                            @endif
                                            <li class="dropdown-item"><a href="{{ __($url . 'pay=ნაღდი ანგარიშსწორება') }}">{{ __('ნაღდი ანგარიშსწორება') }}</a></li>
                                            <li class="dropdown-item"><a href="{{ __($url . 'pay=ბარათით გადახდილი') }}">{{ __('ბარათით გადახდილი') }}</a></li>
                                            <li class="dropdown-item"><a href="{{ __($url . 'pay=ნისია') }}">{{ __('ნისია') }}</a></li>
                                            <li class="dropdown-item"><a href="{{ __($url . 'pay=გადახდილი ვალი') }}">{{ __('გადახდილი ვალი') }}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <form method="get" action="{{ route(\App\Http\Controllers\OrderController::ROUTE_ORDERS) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('get')
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="input-daterange datepicker row align-items-center">
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control" placeholder="Start date" name="from">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control" placeholder="End date" name="to">
                                                </div>
                                            </div>
                                        </div>
                                            <button class="btn btn-primary form-control" type="submit"><i class="ni ni-watch-time"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">ნაღდი</th>
                                            <th scope="col">ბარათი</th>
                                            <th scope="col">ნისია</th>
                                            <th scope="col">გადახდილი ვალი</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td> {{ $arTotal['cash'] }} </td>
                                            <td> {{ $arTotal['card'] }} </td>
                                            <td> {{ $arTotal['debt'] }} </td>
                                            <td> {{ $arTotal['debtPay'] }} </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="alert alert-success text-center" role="alert">
                                            <span class="h3 font-weight-bold mb-0"> {{ 'ჯამი : ' . $arTotal['all'] }} </span>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="ni ni-money-coins"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0 text-center">
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">შეკვეთის ნომერი</th>
                                <th scope="col" class="sort" data-sort="budget">შეკვეთა</th>
                                <th scope="col" class="sort" data-sort="budget">დრო</th>
                                <th scope="col" class="sort" data-sort="status">გადახდის ტიპი</th>
                                <th scope="col" class="sort" data-sort="status">ჯამი</th>
                                <th scope="col" class="sort" data-sort="status">მოვალის სახელი</th>
                                @if(auth()->user()->isAdmin())
                                    <th scope="col" class="sort" data-sort="status">წაშლა</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($arOrders as $order)
                                @include('product.row-orders', ['order' => $order])
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @include('layouts.pagination')
                </div>
            </div>
        </div>

    @include('layouts.footers.auth')
@endsection
