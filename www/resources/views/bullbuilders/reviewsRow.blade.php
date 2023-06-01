<div class="item">
    <div class="testimony-wrap py-4">
        <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
        <div class="text">
            <p class="mb-4">{{ __($review['comment']) }}</p>
            <div class="d-flex align-items-center">
                <div class="user-img" style="background-image: url({{asset('storage') . '/' . $review['photo']}})"></div>
                <div class="pl-3">
                    <p class="name">{{ __($review['surname'] ." ". $review['name']) }}</p>
                    <span class="position">{{ __($review['position']) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
