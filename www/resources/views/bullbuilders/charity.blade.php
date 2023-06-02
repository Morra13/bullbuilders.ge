@extends('bullbuilders.header', ['title' => $page])

@section('content')
    <section class="ftco-section ftco-degree-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 ftco-animate">
                <h1 class="mb-3 text-center">{{ $arCharity['title'] }}</h1>
                <p>
                    <img src="{{ asset('storage') . '/' . $arCharity['main_img'] }}" alt="" class="img-fluid">
                </p>
                <h5 class="mb-3">{{ __('admin.manager') . ' : ' . $arCharity['manager'] }}</h5>
                <h5 class="mb-3">{{ __('admin.manager_phone') . ' : ' . $arCharity['manager_phone'] }}</h5>
                <div class="comment-body">
                    <span> {{ $arCharity['description'] }} </span>
                </div>
                <div class="pt-5 mt-5">
                    <h3 class="mb-5">6 Comments</h3>
                    <ul class="comment-list">
                        <li class="comment">
                            <div class="vcard bio">
                                <img src="images/person_1.jpg" alt="Image placeholder">
                            </div>
                            <div class="comment-body">
                                <h3>John Doe</h3>
                                <div class="meta">October 18, 2018 at 2:21pm</div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                            </div>
                        </li>
                    </ul>

                        <!-- END comment-list -->
                    <div class="comment-form-wrap pt-5">
                        <h3 class="mb-5">Leave a comment</h3>
                        <form action="#" class="p-5 bg-light">
                            <div class="form-group">
                                <label for="name">Name *</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="url" class="form-control" id="website">
                            </div>

                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Post Comment" class="btn py-3 px-4 btn-primary">
                            </div>

                        </form>
                    </div>
                </div>

            </div>

            <div class="col-lg-4 sidebar pl-lg-5 ftco-animate">
                <div class="sidebar-box ftco-animate">
                    <div class="categories">
                        <h3>{{ __('admin.more_img') }}</h3>
                        <ul>
                            @foreach($arImg as $key => $img)
                                <li>
                                    <span class="block-20 rounded" style="background-image: url('{{ asset('storage') . '/' . $img['img'] }}');">
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
