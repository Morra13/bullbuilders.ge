@extends('layouts.app', ['title' => __('How its work')])

@section('content')
    @include('user.partials.header', [
        'title' => __('How its work'),
        'description' => '',
        'class' => 'col-xl-12'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-body">
                        <div class="pl-lg-4">
                            <p class="text-center">
                                <img src="https://upload.wikimedia.org/wikipedia/en/1/10/HowItsMade.jpg" class="rounded">
                            </p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="pl-lg-4">
                            <p class="text-justify"><b>How It's Made (Comment c'est fait in Quebec)</b> is a Canadian documentary television series that premiered on January 6, 2001, on the Discovery Channel in Canada and the Science Channel in the United States. The program is produced in the Canadian province of Quebec by Productions MAJ, Inc. and Productions MAJ.
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-4">Format</h6>
                        <div class="pl-lg-4">
                            <p class="text-justify">The show is a documentary showing how common, everyday items (such as clothing and accessories, food, industrial products, musical instruments, and sporting goods) are manufactured. It also features the restoration processes of old items in some episodes.
                            <p class="text-justify">How It's Made does not include explanatory texts to simplify dubbing in different languages. The show also avoids having an onscreen host (after Season 1 in the Canadian version) and an interview with employees explaining the process. Instead, an off-screen narrator explains the process, often with humorous puns.
                            <p class="text-justify">Each episode features three or four products divided by segments, with each product getting a demonstration of approximately five minutes; exceptions are allowed in the allotted time for more complex ones. The scripts are almost identical across regional versions of the show; however, the main difference in the U.S. version is that the units of measurement are given in the United States customary units instead of metric units used in the Canadian version. At one point in the U.S. run, a subtitled conversion was shown on-screen over the original narration.
                            <p class="text-justify">The "Historical Capsule" segment, which is available until Season 5, introduces historical background information for the last featured product in each episode, showing how and where the product originated, and what people used before it. It presents a series of single-line drawings which got colored for a brief amount of time after completed.
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-4">Hosts</h6>
                        <div class="pl-lg-4">
                            <p class="text-justify">The show has different narrators for different regions.
                            <p class="text-justify">In the Canadian version, it features Mark Tewksbury (Season 1, 2001) as the host of the show. Lynn Herzeg (Seasons 2–4, 2002–2005), June Wallack (Season 5, 2005) and Lynne Adams (Season 6 onwards, 2006–present) are the narrators.
                            <p class="text-justify">In the U.S. version, Brooks Moore and Zac Fine (Season 9–10, 2007–2008) are the narrators.
                            <p class="text-justify">In the United Kingdom, the rest of Europe, and in some cases in Southeast Asia, the series is narrated by Tony Hirst.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
