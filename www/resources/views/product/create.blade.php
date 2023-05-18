<?
$obEnum = (new \App\Http\Controllers\Enum\LangController())::getLang();
?>
@extends('layouts.app', ['title' => __($obEnum::CREATE_NEW_PRODUCT)])

@section('content')
    <div class="header pb-8 pt-5 d-flex align-items-center" style="background-image: url(../argon/img/theme/instagram-1.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-white">{{ __($obEnum::CREATE_NEW_PRODUCT) }}</h1>
                </div>
            </div>
        </div>
    </div>

    <form method="post" action="{{ route(\App\Http\Controllers\Api\ProductController::ROUTE_CREATE_PRODUCT) }}" autocomplete="off" enctype="multipart/form-data">
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-4 order-xl-1 mb-5 mb-xl-0">
                    @csrf
                    @method('post')
                    <div class="card card-profile shadow"  style="min-height: 700px;">
                        <div class="card-body pt-0 pt-md-4">
                            <div class="row justify-content-center">
                                <div class="col-lg-3 order-lg-2">
                                    <div class="card-profile-image">
                                        <label for="chooseFile">
                                            <img id="main_img" src="{{ asset('storage') . '/uploads/defaultUploadImg.png'}}" class="rounded-circle">
                                        </label>
                                        <input
                                            id="chooseFile"
                                            name="main_img"
                                            type="file"
                                            class="d-none"
                                            onchange="document.getElementById('main_img').src = window.URL.createObjectURL(this.files[0])"
                                            accept=".jpg,.jpeg,.png"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                            </div>
                            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                            </div>
                            <div class="mt-md-5">
                                <div>
                                    <div class="input-group mb-3">
                                        <div class="dropdown center">
                                            <select name="category_id" class="btn btn-secondary dropdown-toggle alert-primary"  required>
                                                <option name="category_id" value="" class="badge-danger"> {{ __($obEnum::SELECT_CATEGORY) }}</option>
                                                @foreach($arTypes as $value)
                                                <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('nameGe') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __($obEnum::NAME . '(GE)') }}</label>
                                        <input
                                            type="text"
                                            name="nameGe"
                                            id="input-name"
                                            class="form-control form-control-alternative{{ $errors->has('nameGe') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __($obEnum::NAME . '(GE)') }}"
                                            required
                                        >
                                        @if ($errors->has('nameGe'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nameGe') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('nameRu') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __($obEnum::NAME . '(RU)') }}</label>
                                        <input
                                            type="text"
                                            name="nameRu"
                                            id="input-name"
                                            class="form-control form-control-alternative{{ $errors->has('nameRu') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __($obEnum::NAME . '(RU)') }}"

                                        >
                                        @if ($errors->has('nameRu'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nameRu') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('nameEng') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __($obEnum::NAME . '(ENG)') }}</label>
                                        <input
                                            type="text"
                                            name="nameEng"
                                            id="input-name"
                                            class="form-control form-control-alternative{{ $errors->has('nameEng') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __($obEnum::NAME . '(ENG)') }}"

                                        >
                                        @if ($errors->has('nameEng'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nameEng') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="price">{{ __($obEnum::PRICE . '₾') }}</label>
                                        <input
                                            type="text"
                                            name="price"
                                            id="price"
                                            class="form-control form-control-alternative{{ $errors->has('price') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __($obEnum::PRICE) }}"
                                            required
                                        >

                                        @if ($errors->has('price'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('code0') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="price">{{ __($obEnum::BARCODE) }}</label>
                                        <input
                                            type="text"
                                            name="code0"
                                            id="price"
                                            class="form-control form-control-alternative{{ $errors->has('code0') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __($obEnum::BARCODE) }}"
                                            required
                                        >

                                        @if ($errors->has('code0'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('code0') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div id="input0"></div>
                                    <div class="btn btn-creatory mt-4" onclick="addInput()">{{ __('+ ' . $obEnum::BARCODE) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 order-xl-2">
                    <div class="card bg-secondary shadow" style="min-height: 700px;">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <h3 class="mb-0">{{ __($obEnum::DESCRIPTION) }}</h3>
                            </div>
                        </div>
                        <div class="card-body bg-white">
                            <div class="form-group{{ $errors->has('descriptionGe') ? ' has-danger' : '' }}">
                                <textarea
                                    name="descriptionGe"
                                    id="descriptionGe"
                                    class="form-control form-control-alternative{{ $errors->has('descriptionGe') ? ' is-invalid' : '' }}"
                                    rows="5"
                                    required
                                    placeholder="{{ __($obEnum::DESCRIPTION . ' (GE)') }}"
                                ></textarea>

                                @if ($errors->has('descriptionGe'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('descriptionGe') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('descriptionRu') ? ' has-danger' : '' }}">
                                <textarea
                                    name="descriptionRu"
                                    id="descriptionRu"
                                    class="form-control form-control-alternative{{ $errors->has('descriptionRu') ? ' is-invalid' : '' }}"
                                    rows="5"
                                    placeholder="{{ __($obEnum::DESCRIPTION . ' (RU)') }}"
                                ></textarea>

                                @if ($errors->has('descriptionRu'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('descriptionRu') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('descriptionEng') ? ' has-danger' : '' }}">
                                <textarea
                                    name="descriptionEng"
                                    id="descriptionEng"
                                    class="form-control form-control-alternative{{ $errors->has('descriptionEng') ? ' is-invalid' : '' }}"
                                    rows="5"
                                    placeholder="{{ __($obEnum::DESCRIPTION . ' (ENG)') }}"
                                ></textarea>

                                @if ($errors->has('descriptionEng'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('descriptionEng') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div id="more_img_div" style="display:none;">
                                <div class="row align-items-center">
                                    <div class="col-6 card-profile-pdf-image pl-0">
                                        <img id="more_img_show_0" src="{{ asset('storage') . '/uploads/defaultUploadImg.png' }}" class="rounded">
                                    </div>
                                    <div class="col-6">
                                        <label for="more_img_0" class="btn btn-creatory">{{ __($obEnum::SELECT_FILE) }}</label>
                                        <label for="clear_0" class="btn btn-creatory">{{ __($obEnum::CLEAR) }}</label>
                                        <input hidden name="clear_0" id="clear_0">
                                    </div>
                                </div>
                                <input
                                    hidden
                                    name="more_img_0"
                                    type="file"
                                    id="more_img_0"
                                    onchange="document.getElementById('more_img_show_0').src = window.URL.createObjectURL(this.files[0])"
                                    accept=".jpg,.jpeg,.png"
                                />
                                <div class="row align-items-center">
                                    <div class="col-6 card-profile-pdf-image pl-0">
                                        <img id="more_img_show_1" src="{{ asset('storage') . '/uploads/defaultUploadImg.png' }}" class="rounded">
                                    </div>
                                    <div class="col-6">
                                        <label for="more_img_1" class="btn btn-creatory">{{ __($obEnum::SELECT_FILE) }}</label>
                                        <label for="clear_1" class="btn btn-creatory">{{ __($obEnum::CLEAR) }}</label>
                                        <input hidden name="clear_1" id="clear_1">
                                    </div>
                                </div>
                                <input
                                    hidden
                                    name="more_img_1"
                                    type="file"
                                    id="more_img_1"
                                    onchange="document.getElementById('more_img_show_1').src = window.URL.createObjectURL(this.files[0])"
                                    accept=".jpg,.jpeg,.png"
                                />
                                <div class="row align-items-center">
                                    <div class="col-6 card-profile-pdf-image pl-0">
                                        <img id="more_img_show_2" src="{{ asset('storage') . '/uploads/defaultUploadImg.png' }}" class="rounded">
                                    </div>
                                    <div class="col-6">
                                        <label for="more_img_2" class="btn btn-creatory">{{ __($obEnum::SELECT_FILE) }}</label>
                                        <label for="clear_2" class="btn btn-creatory">{{ __($obEnum::CLEAR) }}</label>
                                        <input hidden name="clear_2" id="clear_2">
                                    </div>
                                </div>
                                <input
                                    hidden
                                    name="more_img_2"
                                    type="file"
                                    id="more_img_2"
                                    onchange="document.getElementById('more_img_show_2').src = window.URL.createObjectURL(this.files[0])"
                                    accept=".jpg,.jpeg,.png"
                                />
                            </div>
                            <div id="showMoreButton" class="btn btn-creatory mt-4 d-block" onclick="showMoreImg('more_img_div')">{{ __($obEnum::ADD_MORE_PHOTO) }}</div>

                            <div class="card-body bg-white">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-creatory mt-4">{{ __($obEnum::CREATE) }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footers.auth')
        </div>
    </form>

    <script>
        let img_0 = document.querySelector("#more_img_0");
        let img_1 = document.querySelector("#more_img_1");
        let img_2 = document.querySelector("#more_img_2");
        let clear_0 = document.querySelector("#clear_0");
        let clear_1 = document.querySelector("#clear_1");
        let clear_2 = document.querySelector("#clear_2");
        let img_show_0 = document.querySelector("#more_img_show_0")
        let img_show_1 = document.querySelector("#more_img_show_1")
        let img_show_2 = document.querySelector("#more_img_show_2")
        let default_img_src = 'https://smf.com.ge/storage/uploads/defaultUploadImg.png';

        // Событие по клику на кнопку
        clear_0.addEventListener("click", function(){
            img_0.value = '';
            img_show_0.src = default_img_src;
        });

        clear_1.addEventListener("click", function(){
            img_1.value = '';
            img_show_1.src = default_img_src;
        });

        clear_2.addEventListener("click", function(){
            img_2.value = '';
            img_show_2.src = default_img_src;
        });

        function showMoreImg(Div) {
            var x = document.getElementById(Div);
            var showMoreButton = document.getElementById("showMoreButton");
            {
                if(x.style.display == "none") {
                    x.style.display = "block";
                    showMoreButton.innerHTML = "{{ __($obEnum::HIDE) }}";
                } else {
                    x.style.display = "none";
                    showMoreButton.innerHTML = "{{ __($obEnum::ADD_MORE_PHOTO) }}";
                }
            }
        }

        var x = 0;
        function addInput() {
            var code = '<input type="text" class="form-control form-control-alternative" placeholder="{{ __($obEnum::BARCODE) }}" name="code' + (x+1) +'" > <div id="input' + (x + 1) + '"></div>';
            document.getElementById('input' + x).innerHTML = code;
            x++;
            var codeCount = '<input type="hidden" name="codeCount" value="'+ x +'"> ';
            document.getElementById('input' + x).innerHTML = codeCount;
        }
    </script>

    @include('layouts.classic-editor')
@endsection
