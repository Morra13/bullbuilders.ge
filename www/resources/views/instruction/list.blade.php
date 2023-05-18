@extends('layouts.app', ['title' => __('My instructions')])

@section('content')
{{--    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="background-image: url(../argon/img/theme/instagram-2.jpg); background-size: cover; background-position: center top;">--}}
    <div class="header pb-8 pt-5 d-flex align-items-center" style="background-image: url(../argon/img/theme/instagram-2.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-white">My instructions</h1>
                    <p class="text-white mt-0 mb-5"></p>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0 text-center">
                        <a class="btn btn-creatory" href="{{ route(\App\Http\Controllers\InstructionController::ROUTE_CREATE) }}">Create new instruction</a>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Name</th>
                                <th scope="col" class="sort" data-sort="budget">Date</th>
                                <th scope="col" class="sort" data-sort="budget">Price</th>
                                <th scope="col" class="sort" data-sort="status">Sold</th>
                                <th scope="col" class="sort" data-sort="status">Status</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            @foreach($arInstruction as $instruction)
                                @include('instruction.row', ['instruction' => $instruction])
                            @endforeach
                            @if(empty($instruction))
                                <tr>
                                    <td colspan="6" style="text-align: center!important;">- not found - </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    @include('layouts.copied-to-clipboard')
                    @include('layouts.pagination')
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
