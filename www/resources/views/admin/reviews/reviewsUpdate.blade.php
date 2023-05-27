@extends('layouts.app', ['title' => __('admin.update_review')])

@section('content')
    <div class="header pb-8 pt-5 d-flex align-items-center" style="background-image: url(../argon/img/theme/instagram-1.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-5"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-white">{{__('admin.update_review')}}</h1>
                </div>
            </div>
        </div>
    </div>

    <form method="post" action="{{ route(\App\Http\Controllers\Api\ReviewsController::ROUTE_REVIEWS_UPDATE) }}" autocomplete="off" enctype="multipart/form-data">
        <div class="container-fluid mt--4">
            <div class="row">
                <input name="id" value="{{$arReviews['ge']['id']}}" hidden>
                @foreach($arReviews as $lang => $review)
                    @include(
                                'admin.reviews.updateReviewsRow', [
                                     'lang'     => $lang,
                                     'review'   => $review,
                                ]
                            )
                @endforeach
                <div class="col-xl-12 order-xl-4">
                    <div class="text-center">
                        <button type="submit" class="btn btn-creatory mt-4">{{ __('admin.update') }}</button>
                    </div>
                </div>
            </div>
            @include('layouts.footers.auth')
        </div>
    </form>
@endsection
