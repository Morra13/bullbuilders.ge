@extends('layouts.app', ['title' => __('გაყიდვები')])
@section('content')
    @include('user.partials.header', [
        'title' => __('Hello'),
        'class' => 'col-lg-7'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-9 order-xl-0">
                <div class="card bg-secondary shadow">
                    <div class="card-body">
                        <div class="col">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name">შეკვეთის ნომერი</th>
                                            <th scope="col" class="sort" data-sort="budget">დრო</th>
                                            <th scope="col" class="sort" data-sort="budget">ჯამი</th>
                                            <th scope="col" class="sort" data-sort="status">გადახდის მეთოდი</th>
                                        </tr>
                                        </thead>
                                        {{--                                            @foreach($arInstruction as $instruction)--}}
                                        {{--                                                @include('instruction.row', ['instruction' => $instruction])--}}
                                        {{--                                            @endforeach--}}
                                        {{--                                            @if(empty($instruction))--}}
                                        {{--                                            @endif--}}
                                    </table>
                                </div>
                                {{--                                    @include('layouts.copied-to-clipboard')--}}
                                {{--                                    @include('layouts.pagination')--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 order-xl-1 mb-5 mb-xl-2">
                <div class="card card-profile shadow">
                    <div class="card-body pt-0 pt-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group mb-3">
                                <span class="input-group-text badge-info" >{{ __('ნაღდი ანგარიშსწორება : 150 ₾') }}</span>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text badge-info" >{{ __('ბარათით გადახდილი : 150 ₾') }}</span>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text badge-info" >{{ __('ნისია : 150 ₾') }}</span>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text badge-warning" >{{ __('ჯამი : 150 ₾') }}</span>
                            </div>

                            <div class="input-daterange datepicker row align-items-center">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input type="date" class="form-control" placeholder="Start date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input type="date" class="form-control" placeholder="End date">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown center">
                                <select class="btn btn-secondary dropdown-toggle alert-danger" name="name">
                                    <option value=""> {{ __('აირჩიე გადახდის მეთოდი') }}</option>
                                    <option value=""> {{ __('ყველა') }}</option>
                                    <option value=""> {{ __('ნაღდი ანგარიშსწორება') }}</option>
                                    <option value=""> {{ __('ბარათით გადახდ') }}</option>
                                    <option value=""> {{ __('ნისია') }}</option>
                                </select>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-outline-success mt-4">{{ __('არჩევა') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
@endsection
