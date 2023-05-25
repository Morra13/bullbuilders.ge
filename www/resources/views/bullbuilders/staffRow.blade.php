<div class="col-lg-3 col-sm-6">
    <div class="block-2 ftco-animate">
        <div class="flipper">
            <div class="front" style="background-image: url({{asset('argon') }}/bullbuilders/images/team-1.jpg);">
                <div class="box">
                    <h2>{{ __($staff['surname'] ." ". $staff['name']) }}</h2>
                    <p>{{ __($staff['position']) }}</p>
                </div>
            </div>
            <div class="back">
                <!-- back content -->
                <blockquote>
                    <p>{{ __($staff['comment']) }}</p>
                </blockquote>
                <div class="author d-flex">
                    <div class="image align-self-center">
                        <img src="{{asset('argon') }}/bullbuilders/images/team-1.jpg" alt="">
                    </div>
                    <div class="name align-self-center ml-3">
                        {{ __($staff['surname'] ." ". $staff['name']) }}
                        <span class="position">
                            {{ __($staff['position']) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
