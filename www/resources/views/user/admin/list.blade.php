@extends('layouts.app', ['title' => __('Users')])

@section('content')
    @include('user.admin.cards')

    <div class="container-fluid mt--7">
        <div class="row">

            <div class="col">
                <div class="card">
                    @if($error)
                        <div class="alert alert-danger m-3" role="alert">
                            <strong>Attention!</strong> {!! $error !!}
                        </div>
                    @endif
                    @if($success)
                        <div class="alert alert-success m-3" role="alert">
                            <strong>{!! $success !!}</strong>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12 text-right">
                            <div class="dropdown p-3">
                                <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">{{$_REQUEST['role'] ?? 'Role'}}<span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item"><a href="?role=">All</a></li>
                                    <li class="dropdown-item"><a href="?role=Subscriber">Subscriber</a></li>
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
                                <th scope="col" class="sort" data-sort="budget">Instructions</th>
                                <th scope="col" class="sort" data-sort="budget">Balance</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach ($users as $user)
                                @include('user.admin.row', ['user' => $user])
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

        <script type="text/javascript">
            function Withdraw(userId, userName, balance, balanceView) {
                $('#user-name').html(userName);
                $('#user-balance').html(balanceView);
                $('#user-amount').val(balance);
                $('#user-id').val(userId);
            }
        </script>

        @include('layouts.footers.auth')
    </div>
@endsection
