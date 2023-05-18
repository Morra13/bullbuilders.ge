<?php
/** @var \App\Models\User $user */
/** @var \App\Models\Instruction $instruction */
?>
@extends(
    'layouts.app',
    [
        'no_sidebar' => true
    ]
)

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-6">
            <div class="bg-white">
                <div class="row justify-content-center pt-5">
                    <a href="https://creatory.pro">
                        <img src="https://creatory.pro/argon/img/brand/logo_4.png"
                             alt="Creatory.PRO"
                             style="width: 200px;"
                        >
                    </a>
                </div>
                <div class="card-body pt-0 pt-md-4">
                    <div class="text-center">
                        <h1>{{$instruction->name}}</h1>
                    </div>
                </div>
                <div class="row pdf-profile-image justify-content-center pt-2">
                    <img src="{{asset('storage/' . $user->logo)}}"/>
                </div>
                <div class="p-5">
                    <div class="text-center">
                        <h3>
                            {{ $user->name }}
                        </h3>
                        @if($user->position)
                        <div class="h5 mt-2">
                            {{ $user->position }}, {{ $user->work }}
                        </div>
                        @endif
                        <hr class="my-4" />
                        <p class="text-justify">
                            {!! $user->welcome_text_view !!}
                        </p>
                    </div>
                </div>
                @if($instruction->main_img)
                    <div class="row pdf-profile-image-big justify-content-center pt-2">
                        <img src="{{asset('storage/' . $instruction->main_img)}}"/>
                    </div>
                @endif
                <div class="pl-5 pr-5 pt-6 text-justify">
                    {!! $instruction->content !!}
                </div>

                @if ($user->pdf_img)
                    <div class="pl-5 pr-5 pb-5 pt-2 text-center">
                        <img src="{{asset('storage/' . $user->pdf_img)}}" style="max-width: 700px; border-radius: 20px"/>
                    </div>
                @endif

                <div class="row justify-content-center pb-5 pt-5">
                    <a href="https://creatory.pro">
                        <img src="https://creatory.pro/argon/img/brand/logo_4.png"
                             alt="Creatory.PRO"
                             style="width: 200px;"
                        >
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
