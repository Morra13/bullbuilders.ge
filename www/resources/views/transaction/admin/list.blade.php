@extends('layouts.app', ['title' => __('Transactions')])

@section('content')
    @include('transaction.admin.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Author</th>
                                <th scope="col" class="sort" data-sort="name">Buyer</th>
                                <th scope="col" class="sort" data-sort="name">Instruction</th>
                                <th scope="col" class="sort" data-sort="budget">Date</th>
                                <th scope="col" class="sort" data-sort="budget">Amount</th>
                                <th scope="col" class="sort" data-sort="budget">Status</th>
                                <th scope="col" class="sort" data-sort="budget"></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($transactions as $transaction)
                                @include('transaction.admin.row', ['transaction' => $transaction])
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
