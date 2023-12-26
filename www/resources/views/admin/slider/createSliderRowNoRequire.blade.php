<div class="col-xl-4 order-xl-1">
    @csrf
    @method('post')
    <div class="card card-profile shadow"  style="min-height: 700px;">
        @if($lang == 'ru')
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <h1> {{__('admin.info_ru')}} </h1>
            </div>
        @elseif($lang == 'en')
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
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
