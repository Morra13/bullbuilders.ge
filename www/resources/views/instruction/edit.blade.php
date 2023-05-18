<?php
/** @var \App\Models\Instruction $instruction */
?>

@extends('layouts.app', ['title' => $instruction->name])

@section('content')
    <div class="header pb-8 pt-5 d-flex align-items-center" style="background-image: url(../../argon/img/theme/instagram-1.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-white">{{ $instruction->name }}</h1>
                    <p class="text-white mt-0 mb-5"></p>
                </div>
            </div>
        </div>
    </div>
    <form method="post" action="{{ route(\App\Http\Controllers\Api\InstructionController::ROUTE_UPDATE) }}" autocomplete="off" enctype="multipart/form-data">
        <input hidden name="instructionId" id="instructionId" type="text" value="{{ $instruction->id }}">
        @csrf
        @method('post')
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-4 order-xl-1 mb-5 mb-xl-0">
                    <div class="card card-profile shadow"  style="min-height: 700px;">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    <label for="chooseFile">
                                        <img id="avatar" src="{{ empty($instruction->main_img) ? asset('storage') . '/uploads/defaultUploadImg.png' : asset('storage/' . $instruction->main_img) }}" class="rounded-circle">
                                    </label>
                                    <input
                                        id="chooseFile"
                                        name="main_img"
                                        type="file"
                                        class="d-none"
                                        onchange="document.getElementById('avatar').src = window.URL.createObjectURL(this.files[0])"
                                        accept=".jpg,.jpeg,.png"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                            <div class="d-flex justify-content-between">
                                <label>
                                    <a
                                        href="#"
                                        data-toggle="modal"
                                        data-target="#modal-notification"
                                        class="btn btn-sm btn-info mr-4"
                                        onclick="copyToClipboard('{{$instruction->instruction_link}}')"
                                    >{{ __('Copy link') }}</a>
                                </label>

                                @include('layouts.copied-to-clipboard')

                                <button type="button" class="btn btn-sm btn-danger float-right change-status {{$instruction->status == 'archive' ? ' d-none' : ''}}" data-status="archive">{{ __('To archive') }}</button>
                                <button type="button" class="btn btn-sm btn-success float-right change-status {{$instruction->status == 'sale' ? ' d-none' : ''}}" data-status="sale">{{ __('Start selling') }}</button>
                            </div>
                        </div>
                        <div class="card-body pt-10 pt-md-4">
                            <div class="mt-md-5">
                                <div>
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                        <input
                                            type="text"
                                            name="name"
                                            id="input-name"
                                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Name') }}"
                                            value="{{ $instruction->name }}"
                                            required
                                        >

                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('link') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-link">{{ __('Your link to Instagram or YouTube') }}</label>
                                        <input
                                            type="text"
                                            name="link"
                                            id="input-link"
                                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('https://www.instagram.com/') }}"
                                            value="{{ $instruction->link }}"
                                        >

                                        @if ($errors->has('link'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('link') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="price">{{ __('Price, $') }}</label>
                                        <input
                                            type="text"
                                            name="price"
                                            id="price"
                                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('8.99') }}"
                                            value="{{ $instruction->price }}"
                                            required
                                        >

                                        @if ($errors->has('price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('short_description') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-short_description">{{ __('Short description') }}</label>
                                        <textarea
                                            name="short_description"
                                            id="input-short_description"
                                            class="form-control form-control-alternative{{ $errors->has('short_description') ? ' is-invalid' : '' }}"
                                            required
                                            rows="8"
                                        >{{ $instruction->short_description }}
                                        </textarea>

                                        @if ($errors->has('short_description'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('short_description') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="text-center mt-4">
                                            <a
                                                href="{{ route(\App\Http\Controllers\InstructionController::ROUTE_DOWNLOAD, $instruction->id ) }}"
                                                class="btn btn-creatory"
                                            >{{ __('Download PDF') }}</a>
                                        <button type="submit" class="btn btn-creatory">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 order-xl-2">
                    <div class="card bg-secondary shadow" style="min-height: 700px;">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <h3 class="mb-0">{{ __('Content') }}</h3>
                            </div>
                        </div>
                        <div class="card-body bg-white">
                            <div>
                                <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                                    <textarea
                                        name="content"
                                        id="input-content"
                                        class="form-control form-control-alternative{{ $errors->has('content') ? ' is-invalid' : '' }}"
                                        required
                                        rows="20"
                                    >{{ $instruction->content }}
                                    </textarea>

                                @if ($errors->has('content'))
                                    <span class="content-feedback" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-creatory mt-4">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            @include('layouts.footers.auth')
        </div>
    </form>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            const inputElement = document.getElementById('price')
            const maskOptions = {
                mask: Number,
                thousandsSeparator: ' '
            }
            IMask(inputElement, maskOptions);
        })

        $(".change-status").click(function() {
            var status = this.getAttribute('data-status');
            $.ajax({
                url: "/api/instruction/status/{{$instruction->id}}/" + status,
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: "application/json; charset=utf-8",
                dataType: "json"
            })
                .done(function(data) {
                    $('.change-status[data-status]').removeClass('d-none');
                    $('.change-status[data-status="' + data.instruction.status + '"]').addClass('d-none');
                });
        });
    </script>

    @include('layouts.classic-editor')
@endsection
