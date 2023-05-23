@extends('layouts.app', ['title' => __($obEnum::ADMIN) ])

@section('content')
    <div class="header pb-8 pt-5" style="background-image: url(../../../argon/img/theme/example-4.png); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-8"></span>
        <div class="container-fluid">
            <div class="header-body">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-white">Users</h1>
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
                                <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">{{$_REQUEST['role'] ?? 'Role'}}<span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item"><a href="?role=">All</a></li>
                                    <li class="dropdown-item"><a href="?role=Creator">Creator</a></li>
                                    <li class="dropdown-item"><a href="?role=Admin">Admin</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Name</th>
                                <th scope="col" class="sort" data-sort="name">Email</th>
                                <th scope="col" class="sort" data-sort="name">Role</th>
                                <th scope="col" class="sort" data-sort="name">Register Date</th>
                                <th scope="col" class="sort" data-sort="budget">Last seen date</th>
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



