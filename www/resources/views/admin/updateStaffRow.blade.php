<div class="col-xl-4 order-xl-1">
    @csrf
    @method('post')
    <div class="card card-profile shadow"  style="min-height: 700px;">
        @if($lang == 'ge')
            <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">
                        <label for="chooseFile">
                            @if(!empty($staff['photo']))
                                <img id="avatar" src="{{ asset('storage') . '/' . $staff['photo']}}" class="rounded-circle">
                            @else
                                <img id="avatar" src="{{ asset('storage') . '/uploads/defaultUploadImg.png'}}" class="rounded-circle">
                            @endif
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
                    {{-- <a href="#" class="btn btn-sm btn-info mr-4">{{ __('Copy link') }}</a>--}}
                    {{-- <a href="#" class="btn btn-sm btn-default float-right">{{ __('My sales') }}</a>--}}
                </div>
            </div>
        @elseif($lang == 'ru')
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <h1> Rus </h1>
            </div>
        @elseif($lang == 'en')
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <h1> Eng </h1>
            </div>
        @endif
        <div class="card-body pt-0 pt-md-4">
            <div class="mt-md-5">
                <div>
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-name">{{ __('admin.name') }}</label>
                        <input
                            type="text"
                            name="name_{{$lang}}"
                            id="input-name_{{$lang}}"
                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('admin.name') }}"
                            value="{{$staff['name']}}"
                            required
                        >
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-name">{{ __('admin.surname') }}</label>
                        <input
                            type="text"
                            name="surname_{{$lang}}"
                            id="input-surname_{{$lang}}"
                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('admin.surname') }}"
                            value="{{$staff['surname']}}"
                            required
                        >
                    </div>
                    <div class="form-group{{ $errors->has('link') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-link">{{ __('admin.position') }}</label>
                        <input
                            type="text"
                            name="position_{{$lang}}"
                            id="position_{{$lang}}"
                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('admin.position') }}"
                            value="{{$staff['position']}}"
                            required
                        >
                    </div>
                    <div class="form-group{{ $errors->has('short_description') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-short_description">{{ __('admin.comment') }}</label>
                        <textarea
                            name="comment_{{$lang}}"
                            id="comment_{{$lang}}"
                            class="form-control form-control-alternative{{ $errors->has('short_description') ? ' is-invalid' : '' }}"
                            rows="5"
                            placeholder="{{ __('admin.comment') }}"
                            required
                        >{{$staff['comment']}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
