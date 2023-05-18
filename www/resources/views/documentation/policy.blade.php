@extends('layouts.app', ['title' => __('Privacy Policy')])

@section('content')
    @include('user.partials.header', [
        'title' => __('Privacy Policy'),
        'description' => '',
        'class' => 'col-xl-12'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                @include('documentation.policy-content')
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
