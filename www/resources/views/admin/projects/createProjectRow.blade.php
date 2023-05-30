<div class="col-xl-3 order-xl-1">
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

        @elseif($key === 1)
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <h1> Rus </h1>
            </div>
        @elseif($key === 2)
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <h1> Eng </h1>
            </div>
        @endif
        <div class="card-body pt-0 pt-md-4">
            <div>
                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">{{ __('admin.name') }}</label>
                    <input
                        type="text"
                        name="name_{{$lang}}"
                        id="input-name_{{$lang}}"
                        class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('admin.name') }}"
                        required
                    >
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">{{ __('admin.manager') }}</label>
                    <input
                        type="text"
                        name="manager_{{$lang}}"
                        id="input-manager_{{$lang}}"
                        class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('admin.manager') }}"
                        required
                    >
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">{{ __('admin.address') }}</label>
                    <input
                        type="text"
                        name="address_{{$lang}}"
                        id="input-address_{{$lang}}"
                        class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('admin.address') }}"
                        required
                    >
                </div>
                <div class="form-group{{ $errors->has('short_description') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-short_description">{{ __('admin.description') }}</label>
                    <textarea
                        name="description_{{$lang}}"
                        id="description_{{$lang}}"
                        class="form-control form-control-alternative{{ $errors->has('short_description') ? ' is-invalid' : '' }}"
                        rows="5"
                        placeholder="{{ __('admin.description') }}"
                        required
                    ></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
