<div class="col-xl-4 order-xl-1">
    @csrf
    @method('post')
    <div class="card card-profile shadow"  style="min-height: 700px;">
        @if($lang === 'ru')
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <h1> {{__('admin.info_ru')}} </h1>
            </div>
        @elseif($lang === 'en')
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <h1> {{__('admin.info_en')}} </h1>
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
                        ></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
