<div class="col-xl-4 order-xl-1">
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
                {{-- <a href="#" class="btn btn-sm btn-default float-right">{{ __('My sales') }}</a>--}}
            </div>
        </div>
        <div class="card-body pt-0 pt-md-4">
            <div class="mt-md-5">
                <div>
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-name">{{ __('admin.name') }}</label>
                        <input
                            type="text"
                            name="name_ge"
                            id="input-name_ge"
                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('admin.name') }}"
                            required
                        >
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-name">{{ __('admin.surname') }}</label>
                        <input
                            type="text"
                            name="surname_ge"
                            id="input-surname_ge"
                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('admin.surname') }}"
                            required
                        >
                    </div>
                    <div class="form-group{{ $errors->has('link') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-link">{{ __('admin.position') }}</label>
                        <input
                            type="text"
                            name="position_ge"
                            id="position_ge"
                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('admin.position') }}"
                            required
                        >
                    </div>
                    <div class="form-group{{ $errors->has('short_description') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-short_description">{{ __('admin.comment') }}</label>
                        <textarea
                            name="comment_ge"
                            id="comment_ge"
                            class="form-control form-control-alternative{{ $errors->has('short_description') ? ' is-invalid' : '' }}"
                            rows="5"
                            placeholder="{{ __('admin.comment') }}"
                            required
                        ></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
