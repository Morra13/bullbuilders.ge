@component('mail::layout')
{{-- Header --}}
@slot('header')
    <table cellpadding="0" cellspacing="0" width="100%">
        <tbody>
        <tr>
            <td align="center" class="esd-block-image" style="font-size: 0px;"><a target="_blank" href="https://creatory.pro"><img src="https://creatory.pro/argon/img/brand/logo_4.png" alt="Logo" style="display: block; margin-top: 20px; margin-bottom: 20px;" width="235" title="Logo"></a></td>
        </tr>
        </tbody>
    </table>
{{--@component('mail::header', ['url' => config('app.url')])--}}
{{--{{ config('app.name') }}--}}
{{--@endcomponent--}}
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent
