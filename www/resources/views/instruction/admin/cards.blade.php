<div class="header pb-8 pt-5" style="background-image: url(../../../argon/img/theme/instagram-1.jpg); background-size: cover; background-position: center top;">
    <span class="mask bg-gradient-default opacity-8"></span>
    <div class="container-fluid">
        <div class="header-body">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-white">Instructions</h1>
                    <p class="text-white mt-0 mb-5"></p>
                </div>
            </div>
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Authors</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $authors }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="ni ni-circle-08"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Instructions</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ ($instructions) }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="ni ni-archive-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">For sale</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $forSale }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                        <i class="ni ni-money-coins"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
