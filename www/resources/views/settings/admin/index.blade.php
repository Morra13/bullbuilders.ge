@extends('layouts.app', ['title' => 'Settings'])

@section('content')
    @include('user.partials.header', [
        'title' => 'Settings',
        'description' => ' ',
        'class' => 'col-lg-7'
    ])

    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-xl-6 order-xl-1 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                        <div class="card bg-secondary shadow">
                            <div class="card-body">
                                <form method="POST" action="{{ route(\App\Http\Controllers\Api\SettingsController::ROUTE_UPDATE) }}" autocomplete="off" enctype="multipart/form-data" id="update-form">
                                    @csrf
                                    @method('post')
                                    <div class="pl-lg-4">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-commission">{{ __('Commission, %') }}</label>
                                            <input
                                                type="text"
                                                name="commission"
                                                id="input-commission"
                                                class="form-control form-control-alternative{{ $errors->has('commission') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('15') }}"
                                                value="{{ old('commission', $commission) }}" required
                                            >

                                            @if($errors->has('commission'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('commission') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-creatory mt-4">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            const inputElement = document.getElementById('input-commission')
            const maskOptions = {
                mask: Number,
                radix: '.',  // fractional delimiter
                mapToRadix: [','], // symbols to process as radix
                min: 0,
                max: 100
            }
            IMask(inputElement, maskOptions);
        })
    </script>
@endsection
