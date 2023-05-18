@extends('layouts.app', ['title' => __('Instructions')])

@section('content')
    @include('instruction.admin.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Light table -->
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col-12 text-right">
                                <div class="dropdown p-3">
                                    <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">{{$_REQUEST['status'] ?? 'Status'}}<span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item"><a href="?">All</a></li>
                                        <li class="dropdown-item"><a href="?status=Sale">Sale</a></li>
                                        <li class="dropdown-item"><a href="?status=Archive">Archive</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">User</th>
                                <th scope="col" class="sort" data-sort="name">Instruction</th>
                                <th scope="col" class="sort" data-sort="budget">Date</th>
                                <th scope="col" class="sort" data-sort="budget">Price</th>
                                <th scope="col" class="sort" data-sort="status">Sold</th>
                                <th scope="col" class="sort" data-sort="status">Status</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                                @foreach($arInstructionList as $instruction)
                                    @include('instruction.admin.row', ['instruction' => $instruction])
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @include('layouts.pagination')
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')

    </div>
@endsection
