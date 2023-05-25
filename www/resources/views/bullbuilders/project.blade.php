@extends('bullbuilders.header', ['title' => __($page)])

@section('content')

    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row d-flex no-gutters">
                <div class="col-md-6 d-flex">
                    <div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-end"
                         style="background-image:url({{ asset('argon') }}/bullbuilders/images/about.jpg);">
                    </div>
                </div>
                <div class="col-md-6 pl-md-5">
                    <div class="row justify-content-start py-5">
                        <div class="col-md-12 heading-section ftco-animate pl-md-4 py-md-4">
                            <span class="subheading">{{ $arProject['name'] }}</span>
                            @if($arProject['status'] == 'completed')
                                <h3>{{ __('projects.status') }} : {{ __('projects.status_completed') }}</h3>
                            @endif
                            @if($arProject['status'] == 'incomplete')
                                <h3>{{ __('projects.status') }} : {{ __('projects.status_incomplete') }}</h3>
                            @endif
                            <p>{{ __('projects.address') }} : {{ $arProject['address'] }}</p>
                            <p>{{ __('projects.manager') }} : {{ $arProject['manager'] }}</p>
                            <p>{{ __('projects.manager_phone') }} : {{ $arProject['manager_phone'] }}</p>
                            <div class="tabulation-2 mt-4">
                                <div class="tab-content bg-light rounded mt-2">
                                    <div class="tab-pane container p-0 active">
                                        <p>{{ $arProject['description'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container-fluid px-md-0">
            <div class="row no-gutters">
                @foreach($arImg as $img)
                    @include('bullbuilders.projectImgRow')
                @endforeach
            </div>
        </div>
    </section>

@endsection
