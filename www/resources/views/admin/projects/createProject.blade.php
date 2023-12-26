@extends('layouts.app', ['title' => __('admin.create_project')])

@section('content')
    <div class="header pb-8 pt-5 d-flex align-items-center" style="background-image: url(../argon/img/theme/instagram-1.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-5"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-white">{{__('admin.create_project')}}</h1>
                </div>
            </div>
        </div>
    </div>

    <form method="post" action="{{ route(\App\Http\Controllers\Api\ProjectsController::ROUTE_CREATE_PROJECT) }}" autocomplete="off" enctype="multipart/form-data">
        <div class="container-fluid mt--4">
            <div class="row">
                <div class="col-xl-3 order-xl-1">
                    @csrf
                    @method('post')
                    <div class="card card-profile shadow"  style="min-height: 700px;">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    <label for="chooseFile">
                                        <img id="avatar" src="{{ asset('storage') . '/uploads/defaultUploadImg.png'}}" class="rounded-circle">
                                    </label>
                                    <input
                                        id="chooseFile"
                                        name="main_img"
                                        type="file"
                                        class="d-none"
                                        onchange="document.getElementById('avatar').src = window.URL.createObjectURL(this.files[0])"
                                        accept=".jpg,.jpeg,.png"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                            <div class="d-flex justify-content-between">
                                <span class="btn btn-sm btn-danger mr-4">{{ __('admin.required') }}</span>
{{--                                    <a href="#" class="btn btn-sm btn-default float-right">{{ __('My sales') }}</a>--}}
                            </div>
                        </div>
                        <div class="card-body pt-0 pt-md-4">
                            <div class="dropdown p-3">
                                <label class="form-control-label" for="input-name">{{ __('admin.status')}}</label>
                                <select class="btn btn-outline-primary dropdown-toggle" name="status" id="status">
                                    <option class="btn btn-danger" value="incomplete">{{__('admin.incomplete')}}</option>
                                    <option class="btn btn-success" value="completed">{{__('admin.completed')}}</option>
                                </select>
                            </div>
                            <div class="form-group{{ $errors->has('link') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-link">{{ __('admin.manager_phone') }}</label>
                                <input
                                    type="text"
                                    name="manager_phone"
                                    id="manager_phone"
                                    class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('admin.manager_phone') }}"
                                    required
                                >
                            </div>
                            <div class="form-group{{ $errors->has('link') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-link">{{ __('admin.date_begin') }}</label>
                                <input
                                    type="date"
                                    name="date_begin"
                                    id="date_begin"
                                    class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('admin.date_begin') }}"
                                    required
                                >
                            </div>
                            <div class="form-group{{ $errors->has('link') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-link">{{ __('admin.date_end') }}</label>
                                <input
                                    type="date"
                                    name="date_end"
                                    id="date_end"
                                    class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('admin.date_end') }}"
                                    required
                                >
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.projects.createProjectRow')
                <?
                $arLang = ['ru', 'en'];
                ?>
                @foreach($arLang as $lang)
                    @include('admin.projects.createProjectRowNoRequire', ['lang' => $lang])
                @endforeach
                <div class="col-xl-12 order-xl-4">
                    <div class="text-center">
                        <button type="submit" class="btn btn-creatory mt-4">{{ __('admin.create') }}</button>
                    </div>
                </div>
            </div>
            @include('layouts.footers.auth')
        </div>
    </form>
@endsection
