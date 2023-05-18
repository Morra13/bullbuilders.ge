@extends('layouts.app', ['title' => __('My earnings')])

@section('content')
    @include('earning.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0 text-center">
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Name</th>
                                <th scope="col" class="sort" data-sort="budget">Date</th>
                                <th scope="col" class="sort" data-sort="budget">Amount</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                                @foreach($transactions as $transaction)
                                    @include('earning.row', ['transaction' => $transaction])
                                @endforeach
                                @if(empty($transactions))
                                    <tr>
                                        <td colspan="3" style="text-align: center!important;">- not found - </td>
                                    </tr>
                                @endif
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
