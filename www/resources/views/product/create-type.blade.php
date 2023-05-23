@extends('layouts.app', ['title' => __($obEnum::CREATE_NEW_CATEGORY) ])

@section('content')
    <div class="header pb-8 pt-5 d-flex align-items-center" style="background-image: url(../argon/img/theme/instagram-1.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-white">{{ __($obEnum::CREATE_NEW_CATEGORY) }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-1 mb-5 mb-xl-0 left">
                <form method="post" action="{{ route(\App\Http\Controllers\Api\ProductController::ROUTE_CREATE_TYPE) }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                @method('post')
                    <div class="card card-profile shadow"  style="min-height: 400px;">
                        <div class="card-body pt-0 pt-md-4">
                            <div class="mt-md-5">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 order-lg-2">
                                        <div class="card-profile-image">
                                            <label for="chooseFile">
                                                <img id="img" src="{{asset('storage') . '/uploads/defaultUploadImg.png'}}" class="rounded-circle">
                                            </label>
                                            <input
                                                id="chooseFile"
                                                name="img"
                                                type="file"
                                                class="d-none"
                                                onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])"
                                                accept=".jpg,.jpeg,.png"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                                </div>
                                <div class="card-body pt-0 pt-md-4">
                                    <div class="mt-md-5">
                                        <div>
                                            <div class="form-group{{ $errors->has('nameGe') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-name">{{ __($obEnum::NAME . ' (GE)') }}</label>
                                                <input
                                                    type="text"
                                                    name="nameGe"
                                                    id="input-name"
                                                    class="form-control form-control-alternative{{ $errors->has('nameGe') ? ' is-invalid' : '' }}"
                                                    placeholder="{{ __($obEnum::NAME . ' (GE)') }}"
                                                    required
                                                >
                                                @if ($errors->has('nameGe'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('nameGe') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group{{ $errors->has('nameRu') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-name">{{ __($obEnum::NAME . ' (RU)') }}</label>
                                                <input
                                                    type="text"
                                                    name="nameRu"
                                                    id="input-name"
                                                    class="form-control form-control-alternative{{ $errors->has('nameRu') ? ' is-invalid' : '' }}"
                                                    placeholder="{{ __($obEnum::NAME . ' (RU)') }}"
                                                    required
                                                >
                                                @if ($errors->has('nameRu'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('nameRu') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group{{ $errors->has('nameEng') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-name">{{ __($obEnum::NAME . ' (ENG)') }}</label>
                                                <input
                                                    type="text"
                                                    name="nameEng"
                                                    id="input-name"
                                                    class="form-control form-control-alternative{{ $errors->has('nameEng') ? ' is-invalid' : '' }}"
                                                    placeholder="{{ __($obEnum::NAME . ' (ENG)') }}"
                                                    required
                                                >
                                                @if ($errors->has('nameEng'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('nameEng') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body bg-white">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-creatory mt-4">{{ __($obEnum::CREATE) }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xl-4 order-xl-1 mb-5 mb-xl-0 right">
                <div class="card card-profile shadow"  style="min-height: 700px;">
                    <div class="card-body pt-0 pt-md-4">
                        <div class="mt-md-5">
                            <ul class="list-group">
                                @foreach($arTypes as $value)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="header-avatar" style="background-image: url('{{!empty($value['img']) ?  asset('storage') . '/' . $value['img'] : asset('storage') . '/uploads/defaultUploadImg.png' }}');"></div>
                                        <a href="{{$value['id']}}">
                                            <span>{{ __($value['name']) }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
    @include('layouts.classic-editor')
@endsection
