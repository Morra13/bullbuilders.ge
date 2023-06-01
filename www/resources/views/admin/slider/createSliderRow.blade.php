<div class="col-xl-4 order-xl-1">
    @csrf
    @method('post')
    <div class="card card-profile shadow"  style="min-height: 700px;">
        @if($key === 0)
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
                    {{-- <a href="#" class="btn btn-sm btn-default float-right">{{ __('My sales') }}</a>--}}
                </div>
            </div>
        @elseif($key === 1)
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <h1> {{__('admin.info_ru')}} </h1>
            </div>
        @elseif($key === 2)
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <h1> {{__('admin.info_en')}} </h1>
            </div>
        @endif
        <div class="card-body pt-0 pt-md-4">
            <div class="mt-md-5">
                <div>
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-name">{{ __('admin.subtitle') }}</label>
                        <input
                            type="text"
                            name="subtitle_{{$lang}}"
                            id="input-subtitle_{{$lang}}"
                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('admin.subtitle') }}"
                            required
                        >
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-name">{{ __('admin.title') }}</label>
                        <input
                            type="text"
                            name="title_{{$lang}}"
                            id="input-title_{{$lang}}"
                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('admin.title') }}"
                            required
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
