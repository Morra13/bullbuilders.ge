<?
$lang = session()->get('lang');
$name       = 'name_' . $lang;
$surname    = 'surname_' . $lang;
$position   = 'position_' . $lang;
$comment    = 'comment_' . $lang;
?>
<div class="col-lg-3 col-sm-6">
    <div class="block-2 ftco-animate">
        <div class="flipper">
            <div class="front" style="background-image: url({{asset('argon') }}/bullbuilders/images/team-1.jpg);">
                <div class="box">
                    <h2>{{ __($staff->$surname ?: $staff->surname_ge) ." ". __($staff->$name ?: $staff->name_ge) }}</h2>
                    <p>{{ __($staff->$position ?: $staff->position_ge) }}</p>
                </div>
            </div>
            <div class="back">
                <!-- back content -->
                <blockquote>
                    <p>{{ __($staff->$comment ?: $staff->comment_ge) }}</p>
                </blockquote>
                <div class="author d-flex">
                    <div class="image align-self-center">
                        <img src="{{asset('argon') }}/bullbuilders/images/team-1.jpg" alt="">
                    </div>
                    <div class="name align-self-center ml-3">
                        {{ __($staff->$surname ?: $staff->surname_ge) ." ". __($staff->$name ?: $staff->name_ge) }}
                        <span class="position">
                            {{ __($staff->$position ?: $staff->position_ge) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
