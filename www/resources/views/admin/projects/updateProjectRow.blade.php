<div class="col-xl-3 order-xl-1">
    <div class="card card-profile shadow"  style="min-height: 700px;">
        @if($lang == 'ge')
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <h1> {{__('admin.info_ge')}} </h1>
            </div>
        @elseif($lang == 'ru')
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <h1> {{__('admin.info_ru')}} </h1>
            </div>
        @elseif($lang == 'en')
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <h1> {{__('admin.info_en')}} </h1>
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
                        value="{{$project['name']}}"
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
                        value="{{$project['manager']}}"
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
                        value="{{$project['address']}}"
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
                    >{{$project['description']}}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
