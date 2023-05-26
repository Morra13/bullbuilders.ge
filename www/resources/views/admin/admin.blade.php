@extends('layouts.app', ['title' => __('admin.users') ])

@section('content')
    <div class="header pb-8 pt-5" style="background-image: url(../../../argon/img/theme/example-4.png); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-8"></span>
        <div class="container-fluid">
            <div class="header-body">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-white">{{ __('admin.users') }}</h1>
                        <p class="text-white mt-0 mb-5"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
        <div class="row">

            <div class="col">
                <div class="card">
                    <div class="row">
                        <div class="col-12 text-right">
                            <div class="dropdown p-3">
                                @if(empty($_REQUEST['role']))
                                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown">{{__('admin.all')}}<span class="caret"></span></button>
                                @elseif($_REQUEST['role'] == 'Creator')
                                    <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown">{{__('admin.creator')}}<span class="caret"></span></button>
                                @elseif($_REQUEST['role'] == 'Admin')
                                    <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">{{__('admin.admin')}}<span class="caret"></span></button>
                                @endif
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item"><a href="{{url()->current()}}">{{ __('admin.all') }}</a></li>
                                    <li class="dropdown-item"><a href="?role=Creator">{{ __('admin.creator') }}</a></li>
                                    <li class="dropdown-item"><a href="?role=Admin">{{ __('admin.admin') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">{{ __('admin.name') }}</th>
                                <th scope="col" class="sort" data-sort="name">{{ __('admin.email') }}</th>
                                <th scope="col" class="sort" data-sort="name">{{ __('admin.role') }}</th>
                                <th scope="col" class="sort" data-sort="name">{{ __('admin.date_register') }}</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach ($users as $user)
                                @include('admin.userRow', ['user' => $user])
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @include('layouts.pagination')
                </div>
            </div>
        </div>
        @include('user.admin.withdraw')
        @include('layouts.copied-to-clipboard')
        @include('layouts.footers.auth')
    </div>
@endsection



