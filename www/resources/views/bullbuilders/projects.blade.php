@extends('bullbuilders.header', ['title' => __('nav.projects')])

@section('content')

    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-5 heading-section text-center ftco-animate">
                <div class=""></div>
                <span class="subheading"><b>Bull</b> <i>builders</i></span>
                <h2>{{__('nav.projects')}}</h2>
            </div>
            <div class="col-12 text-center">
                <div class="dropdown p-3">
                    @if(empty($_REQUEST['status']))
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">{{__('projects.all')}}<span class="caret"></span></button>
                    @elseif($_REQUEST['status'] == 'completed')
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">{{__('projects.completed')}}<span class="caret"></span></button>
                    @elseif($_REQUEST['status'] == 'incomplete')
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">{{__('projects.incomplete')}}<span class="caret"></span></button>
                    @endif
                    <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="{{url()->current()}}">{{__('projects.all')}}</a></li>
                        <li class="dropdown-item"><a href="?status=completed">{{__('projects.completed')}}</a></li>
                        <li class="dropdown-item"><a href="?status=incomplete">{{__('projects.incomplete')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-counter" id="section-counter">
        <div class="container">
            <div class="row">
                    <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 d-flex">
                            <div class="text-2">
                                <a href="?status=completed"><span> {{ __('projects.completed') }} <br> {{ __('projects.projects') }} </span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 d-flex">
                            <div class="text d-flex align-items-center">
                                <a href="?status=completed"><strong class="number" data-number="{{ $iCompletedCount }}">0</strong></a>
                            </div>
                        </div>
                    </div>
                <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 d-flex">
                        <div class="text-2">
                            <a href="?status=incomplete"><span> {{ __('projects.incomplete') }} <br> {{ __('projects.projects') }} </span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 d-flex">
                        <div class="text d-flex align-items-center">
                            <a href="?status=incomplete"><strong class="number" data-number="{{ $iIncompleteCount }}">0</strong></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container-fluid px-md-0">
            <div class="row no-gutters">
                @foreach($arProjects as $project)
                    @include('bullbuilders.projectsRow', ['project' => $project])
                @endforeach
            </div>
        </div>
    </section>

@endsection
