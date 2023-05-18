@extends('layouts.app', ['title' => __('Create new instruction')])

@section('content')
    <div class="header pb-8 pt-5 d-flex align-items-center" style="background-image: url(../argon/img/theme/instagram-1.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-white">Create new instruction</h1>
                    <p class="text-white mt-0 mb-5">Don’t forget to include some secrets, that you only share with those, who’ve purchase this instruction, this will make it even more valuable to them</p>
                </div>
            </div>
        </div>
    </div>

    <form method="post" action="{{ route(\App\Http\Controllers\Api\InstructionController::ROUTE_CREATE) }}" autocomplete="off" enctype="multipart/form-data">
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-4 order-xl-1 mb-5 mb-xl-0">
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
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                            <div class="d-flex justify-content-between">
                                {{--                            <a href="#" class="btn btn-sm btn-info mr-4">{{ __('Copy link') }}</a>--}}
                                {{--                            <a href="#" class="btn btn-sm btn-default float-right">{{ __('My sales') }}</a>--}}
                            </div>
                        </div>
                        <div class="card-body pt-0 pt-md-4">
                            <div class="mt-md-5">
                                <div>
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                        <input
                                            type="text"
                                            name="name"
                                            id="input-name"
                                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Name') }}"
                                            required
                                        >

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('link') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-link">{{ __('Your link to Instagram or YouTube') }}</label>
                                        <input
                                            type="text"
                                            name="link"
                                            id="input-link"
                                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('https://www.instagram.com/') }}"
                                        >

                                        @if ($errors->has('link'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('link') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="price">{{ __('Price, $') }}</label>
                                        <input
                                            type="text"
                                            name="price"
                                            id="price"
                                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('8.99') }}"
                                            required
                                        >

                                        @if ($errors->has('price'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('short_description') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-short_description">{{ __('Short description') }}</label>
                                        <textarea
                                            name="short_description"
                                            id="input-short_description"
                                            class="form-control form-control-alternative{{ $errors->has('short_description') ? ' is-invalid' : '' }}"
                                            rows="8"
                                            required
                                            placeholder="{{ __('Describe your instructions in a few words to interest the buyer.') }}"
                                        ></textarea>

                                        @if ($errors->has('short_description'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('short_description') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 order-xl-2">
                    <div class="card bg-secondary shadow" style="min-height: 700px;">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <h3 class="mb-0">{{ __('Content') }}</h3>
                            </div>
                        </div>
                        <div class="card-body bg-white">
                            <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                                <textarea
                                    name="content"
                                    id="input-content"
                                    class="valid-feedback form-control form-control-alternative{{ $errors->has('content') ? ' is-invalid' : '' }}"
                                    rows="20"
                                    placeholder="{{ __('Describe your instructions in detail.') }}"
                                ></textarea>
                                @if ($errors->has('content'))
                                    <span class="content-feedback" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-creatory mt-4">{{ __('Create') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footers.auth')
        </div>
    </form>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            const inputElement = document.getElementById('price')
            const maskOptions = {
                mask: Number,
                thousandsSeparator: ' '
            }
            IMask(inputElement, maskOptions);
        })
    </script>
    @include('layouts.classic-editor')
@endsection
