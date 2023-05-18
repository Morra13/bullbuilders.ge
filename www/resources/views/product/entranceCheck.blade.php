@extends('layouts.app', ['title' => __('მიღებული პროდუქტების ნახვა')])
@section('content')
    <div class="header pb-8 pt-5" style="background-image: url(../argon/img/theme/instagram-2.jpg); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-8"></span>
        <div class="container-fluid">
            <div class="header-body">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-white">მიღებული პროდუქტების ნახვა</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <form method="get" action="{{ route(\App\Http\Controllers\ProductController::ROUTE_ENTRANCE_CHECK) }}" autocomplete="off" enctype="multipart/form-data">
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
                                <th scope="col" class="sort" data-sort="name">მიღების ნომერი</th>
                                <th scope="col" class="sort" data-sort="budget">სახელი</th>
                                <th scope="col" class="sort" data-sort="budget">შემადგენლობა</th>
                                <th scope="col" class="sort" data-sort="budget">დრო</th>
                                @if(auth()->user()->isAdmin())
                                    <th scope="col" class="sort" data-sort="status">წაშლა</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($arEntrance as $entrance)
                                @include('product.row-entranceCheck', ['entrance' => $entrance])
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
