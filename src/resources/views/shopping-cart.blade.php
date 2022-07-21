@extends('common.main')
<style>
    .wrap-menu-desktop {
        position: static !important;
        background-color: #fff;
    }
</style>
@section('style')
@endsection

@section('middle')
    <div class="container">
        {{-- Notice for paypal checkout --}}
        @if (session('alert'))
            <div class="paypal-checkout-notice bread-crumb flex-w p-l-25 p-r-15 m-t-30 p-lr-0-lg alert alert-{{session('alert')}}"
                role="alert">
                {{session('message')}}
            </div>
        @endif
        {{-- <div class="paypal-checkout-notice bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
           alert alert-success
        </div> --}}
        <!-- breadcrumb -->
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('home') }}" class="stext-109 cl8 hov-cl1 trans-04">
                {{ __('Home') }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                {{ __('Shoping Cart') }}
            </span>
        </div>
    </div>

    @if (count($cartProducts) > 0)
        <!-- Shoping Cart -->
        <form action="{{ route('user.orders.paypal.store') }}" method="POST" class="bg0 p-t-75 p-b-85">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                        <div class="m-l-25 m-r--38 m-lr-0-xl">
                            <div class="wrap-table-shopping-cart">
                                <table class="table-shopping-cart">
                                    <tr class="table_head">
                                        <th class="column-1">{{ __('Product') }}</th>
                                        <th class="column-2"></th>
                                        <th class="column-3">{{ __('Price') }}</th>
                                        <th class="column-4">{{ __('Quantity') }}</th>
                                        <th class="column-5">{{ __('Total') }}</th>
                                    </tr>

                                    @foreach ($cartProducts as $cartProduct)
                                        <tr class="table_row">
                                            <td class="column-1">
                                                <a class="how-itemcart1 d-block"
                                                    href="{{ route('user.cart.product.destroy', ['productId' => $cartProduct->product_id]) }}">
                                                    <img src="{{ $cartProduct->thumb }}" alt="IMG">
                                                </a>
                                            </td>
                                            <td class="column-2">{{ $cartProduct->name }}</td>
                                            <td class="column-3">{!! \App\Helpers\Helper::getOfficePrice($cartProduct->price, $cartProduct->price_sale) !!}</td>
                                            <td class="column-4">
                                                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                                    </div>

                                                    <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                        name="num-product-{{ $cartProduct->product_id }}"
                                                        value="{{ $cartProduct->amount_product }}"
                                                        data-product-id="{{ $cartProduct->product_id }}">

                                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            @if ($cartProduct->price_sale != 0)
                                                <td class="column-5">$
                                                    {{ $cartProduct->price_sale * $cartProduct->amount_product }}</td>
                                            @endif
                                            @if ($cartProduct->price_sale == 0)
                                                <td class="column-5">$
                                                    {{ $cartProduct->price * $cartProduct->amount_product }}</td>
                                            @endif
                                        </tr>
                                    @endforeach

                                </table>
                            </div>

                            <div class="flex-w flex-sb-m bor15 p-t-30 p-b-32 p-lr-40 p-lr-15-sm" style="position: relative;">
                                @livewire('apply-coupons')

                                <div
                                    class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10 js-update-cart">
                                    {{ __('Update Cart') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @livewire('checkout')
                </div>
            </div>
        </form>
    @endif
@endsection
