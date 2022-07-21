@extends('common.main')

@section('middle')
    <!-- breadcrumb -->
    <div class="container m-t-100">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('home') }}" class="stext-109 cl8 hov-cl1 trans-04">
                {{ __('Home') }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                {{ __('Order') }}
            </span>
        </div>
    </div>

    @if (count($orders) > 0)
        <!-- Shoping Cart -->
        <form class="bg0 p-t-75 p-b-85">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-xl-12 m-lr-auto m-b-50">
                        <div class="m-l-25 m-r--38 m-lr-0-xl" style="max-height: 500px;overflow-y: auto;">
                            @foreach ($orders as $index => $order)
                                <div class="wrap-table-shopping-cart m-b-30">
                                    <table class="table-shopping-cart">
                                        <tr class="table_head">
                                            <th class="column-1">
                                                {{ __('Order') }} {{ $index }} -
                                                @if($order->status == 'confirming')
                                                    <span class="text-danger" style="font-weight: bold;">{{$order->status}}</span>
                                                @else
                                                    <span class="text-success" style="font-weight: bold;">{{$order->status}}</span>
                                                @endif
                                            </th>
                                            <th class="column-5">{{__('Total')}}:  ${{$order->total_price}}</th>
                                        </tr>

                                        <tr>
                                            <table class="table-shopping-cart">
                                                <tr class="table_head">
                                                    <th class="column-1">{{ __('Image') }}</th>
                                                    <th class="column-2">{{ __('Product') }}</th>
                                                    <th class="column-3">{{ __('Price') }}</th>
                                                    <th class="column-4">{{ __('Quantity') }}</th>
                                                    <th class="column-4">{{ __('Order date') }}</th>
                                                    <th class="column-5">{{ __('Total') }}</th>
                                                </tr>
                                                
                                                @foreach ($order->orderProducts as $orderProduct)
                                                    <tr class="">
                                                        <td class="column-1">
                                                            <img style="width: 60px;position: relative;margin-right: 20px;" src="{{ $orderProduct->product->thumb }}" alt="IMG">
                                                        </td>
                                                        <td class="column-2">{{ $orderProduct->product->name }}
                                                        </td>
                                                        <td class="column-3">{!! \App\Helpers\Helper::getOfficePrice($orderProduct->product->price, $orderProduct->product->price_sale) !!}</td>
                                                        <td class="column-4">{{ $orderProduct->amount_product }}
                                                            <td class="column-4">{{ $order->created_at }}
                                                        </td>
                                                        @if ($orderProduct->product->price_sale != 0)
                                                            <td class="column-5">$
                                                                {{ $orderProduct->product->price_sale * $orderProduct->amount_product }}
                                                            </td>
                                                        @endif
                                                        @if ($orderProduct->product->price_sale == 0)
                                                            <td class="column-5">$
                                                                {{ $orderProduct->product->price * $orderProduct->amount_product }}
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </tr>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
@endsection
