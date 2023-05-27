@extends('layouts.app', ['title' => __('admin.projects') ])

@section('content')
    <div class="header pb-8 pt-5" style="background-image: url(../../../argon/img/theme/example-4.png); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-8"></span>
        <div class="container-fluid">
            <div class="header-body">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-white">{{ __('admin.projects') }}</h1>
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
                    <!-- Light table -->
                    <div class="row">
                        <div class="col-12 text-right">
                            <div class="dropdown p-3">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">{{ __('admin.name') }}</th>
                                <th scope="col" class="sort" data-sort="name">{{ __('admin.status') }}</th>
                                <th scope="col" class="sort" data-sort="name">{{ __('admin.manager_phone') }}</th>
                                <th scope="col" class="sort" data-sort="name">{{ __('admin.description') }}</th>
                                <th scope="col" class="sort" data-sort="name">{{ __('admin.delete') }}</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach ($arProjects as $project)
                                @include('admin.projects.projectsRow', ['project' => $project])
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
