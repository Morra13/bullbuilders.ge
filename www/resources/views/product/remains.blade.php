@extends('layouts.app', ['title' => __('დარჩენილი რაოდენობა')])
@section('content')

    <div class="header pb-8 pt-5" style="background-image: url(../argon/img/theme/instagram-2.jpg); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-8"></span>
        <div class="container-fluid">
            <div class="header-body">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-white">დარჩენილი რაოდენობა</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="dropdown p-1 center" style="z-index: 999">
                                        <button class="btn btn-info dropdown-toggle"  type="button" data-toggle="dropdown">
                                            {{$_REQUEST['type'] ?? 'აირჩიეთ კატეგორია'}}
                                            <span class="caret"></span>
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li class="dropdown-item"><a href="?">{{ __('ყველა') }}</a></li>
                                            @foreach($arTypes as $value)
                                                <li class="dropdown-item"><a href="{{ __('?type='.$value['type']) }}">{{ __($value['type']) }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">?</h5>
{{--                                        <span class="h2 font-weight-bold mb-0">{{$balance}}</span>--}}
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="ni ni-money-coins"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">?</h5>
{{--                                        <span class="h2 font-weight-bold mb-0">{{$balance}}</span>--}}
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="ni ni-money-coins"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">?</h5>
{{--                                        <span class="h2 font-weight-bold mb-0">{{$commission}}</span>--}}
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="ni ni-pin-3"></i>
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
                                <th scope="col" class="sort" data-sort="name">სახელი</th>
                                <th scope="col" class="sort" data-sort="budget">ფასი</th>
                                <th scope="col" class="sort" data-sort="budget">რაოდენობა</th>
                                <th scope="col" class="sort" data-sort="status">შტრიხკოდი</th>
                                <th scope="col" class="sort" data-sort="status">ახალი შტრიხკოდი</th>
                                <th scope="col" class="sort" data-sort="status">კატეგორია</th>
                                <th scope="col" class="sort" data-sort="status">შეცვლა</th>
                                <th scope="col" class="sort" data-sort="status">წაშლა</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($arProducts as $product)
                                @include('product.row-remains', ['product' => $product])
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
