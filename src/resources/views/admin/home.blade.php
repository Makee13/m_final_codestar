@extends('admin.main')

@section('header')
@endsection

@section('content')
    <div class="container" style="max-width: unset;">
        <h2>{{ __('In') . ' ' . now()->format('M') }}</h2>
        {{-- Analisys section --}}
        <div class="row">
            @if (isset($amountOfUserSignupInMonth))
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $amountOfUserSignupInMonth }}</h3>
                            <p>{{ __('User Registrations') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
            @endif
            @if (isset($transInMonth))
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ number_format($transInMonth->sum('total_price'), 2) }}$ /
                                {{ $transInMonth->count() }}</h3>
                            <p>{{ __('New Orders') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
            @endif
            @if (isset($soldProductPrice))
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>${{ $soldProductPrice->median('officialPrice') }}</h3>
                            <p>{{ __('Median of sold products') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
            @endif
            @if (isset($soldProductPrice))
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>${{ number_format($soldProductPrice->avg('officialPrice'), 2) }}</h3>
                            <p>{{ __('Mean of sold products') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        {{-- Chart section --}}
        <div class="row justify-content-center">
            {{-- Transactions Chart --}}
            <div class="col-md-6">
                <div class="card">
                    <h3 class="card-header">{{ __('Transactions') }}</h3>
                    <div class="card-body">
                        {!! $chartTransaction->renderHtml() !!}
                    </div>
                </div>
            </div>
            {{-- User Signup Chart --}}
            <div class="col-md-6">
                <div class="card">
                    <h3 class="card-header">{{ __('User by days') }}</h3>
                    <div class="card-body">
                        {!! $chartUserSignup->renderHtml() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            {{-- GeoChart --}}
            <div class="col-md-6">
                <div class="card">
                    <h3 class="card-header">{{ __('Amount of products in each province') }}</h3>
                    <div id="province-order-chart" class="card-body">
                        <?= \Lava::render('GeoChart', 'Province Orders', 'province-order-chart') ?>
                    </div>
                </div>
            </div>
            {{-- PieChart --}}
            <div class="col-md-6">
                <div class="card" style="height: calc(100% - 16px);">
                    <h3 class="card-header">{{ __('Amount of products in each district') }} <span class="text-muted d-block" style="font-size: 14px;"><em>{{__('Click for each province to get statistics')}}</em></span></h3>
                    <div id="district-order-chart" class="card-body">
                        <?= \Lava::render('PieChart', 'District Orders', 'district-order-chart') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h3 class="card-header">{{ __('Transactions in districts') }}</h3>
                    <div class="card-body">
                        {!! $areaOrder->renderHtml() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Innitialize chart library --}}
    {!! $chartTransaction->renderChartJsLibrary() !!}

    {{-- Render transaction chart --}}
    {!! $chartTransaction->renderJs() !!}

    {{-- Render user signup chart --}}
    {!! $chartUserSignup->renderJs() !!}

    {{-- Render amount of transactions in each area --}}
    {!! $areaOrder->renderJs() !!}

    {{-- Todo --}}
    {{-- Render amount of products in each category --}}
    {{-- {!! $soldProductsInCates->renderJs() !!} --}}

    <script>
        function selectHandler(event, chart) {
            const provinceOrders = @json($provinceOrders);
            const province = provinceOrders[chart.getSelection()[0].row][0];

            const link = "admin/orders/district-chart/show/" + province;

            $.getJSON(link, function (dataTableJson) {
                lava.loadData('District Orders', dataTableJson, function (chart) {});
            });
        }
    </script>
@endsection
