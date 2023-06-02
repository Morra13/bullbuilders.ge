                <div class="col-md-4 d-flex ftco-animate">
                    <div class="blog-entry align-self-stretch">
                        <a href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_CHARITY, $charity['id']) }}"
                           class="block-20 rounded" style="background-image: url({{ asset('storage') . '/' . $charity['main_img'] }});">
                        </a>
                        <div class="text mt-3 text-center">
                            <div class="meta mb-2">
                                <div>
                                    <a href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_CHARITY, $charity['id']) }}">
                                        {{ $charity['date'] }}
                                    </a>
                                </div>
                                <div>
                                    <a href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_CHARITY, $charity['id']) }}">
                                        {{ $charity['manager'] }}
                                    </a>
                                </div>
                            </div>
                            <h3 class="heading">
                                <a href="{{ route(\App\Http\Controllers\BullbuildersController::ROUTE_CHARITY, $charity['id']) }}">
                                    {{ $charity['name'] }}
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
