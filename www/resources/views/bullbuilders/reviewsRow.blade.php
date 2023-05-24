<?
$lang = session()->get('lang');
$name       = 'name_' . $lang;
$surname    = 'surname_' . $lang;
$position   = 'position_' . $lang;
$comment    = 'comment_' . $lang;
?>
<div class="item">
    <div class="testimony-wrap py-4">
        <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
        <div class="text">
            <p class="mb-4">{{ __($review->$comment ?: $review->comment_ge) }}</p>
            <div class="d-flex align-items-center">
                <div class="user-img" style="background-image: url({{asset('argon')}}/bullbuilders/images/person_1.jpg)"></div>
                <div class="pl-3">
                    <p class="name">{{ __($review->$surname ?: $review->surname_ge) ." ". __($review->$name ?: $review->name_ge) }}</p>
                    <span class="position">{{ __($review->$position ?: $review->position_ge) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
