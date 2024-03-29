<div class="col-xl-3 order-xl-1">
    <div class="card card-profile shadow"  style="min-height: 700px;">
        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
            <h1> {{__('admin.info_ge')}} </h1>
        </div>
        <div class="card-body pt-0 pt-md-4">
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
                    <label class="form-control-label" for="input-name">{{ __('admin.manager') }}</label>
                    <input
                        type="text"
                        name="manager_ge"
                        id="input-manager_ge"
                        class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('admin.manager') }}"
                        required
                    >
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">{{ __('admin.title') }}</label>
                    <input
                        type="text"
                        name="title_ge"
                        id="input-title_ge"
                        class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('admin.title') }}"
                        required
                    >
                </div>
                <div class="form-group{{ $errors->has('short_description') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-short_description">{{ __('admin.description') }}</label>
                    <textarea
                        name="description_ge"
                        id="description_ge"
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
