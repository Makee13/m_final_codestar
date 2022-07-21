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
                {{ __('Wishs List') }}
            </span>
        </div>
    </div>

    @if (count($wishsListProds) > 0)
        <!-- Shoping Cart -->
        <form class="bg0 p-t-75 p-b-85">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-xl-12 m-lr-auto m-b-50">
                        <div class="m-l-25 m-r--38 m-lr-0-xl">
                            <div class="wrap-table-shopping-cart">
                                <table class="table-shopping-cart">
                                    <tr class="table_head">
                                        <th class="column-1">{{ __('Product') }}</th>
                                        <th class="column-2">{{ __('Name') }}</th>
                                        <th class="column-3">{{ __('Price') }}</th>
                                        <th class="column-3 text-center">{{ __('More detail') }}</th>
                                    </tr>

                                    @foreach ($wishsListProds as $wishsListProd)
                                        <tr class="table_row">
                                            <td class="column-1">
                                                <a class="how-itemcart1 d-block"
                                                    href="{{ route('wishs-list.destroy', ['productId' => $wishsListProd->id]) }}">
                                                    <img src="{{ $wishsListProd->thumb }}" alt="IMG">
                                                </a>
                                            </td>
                                            <td class="column-2">{{ $wishsListProd->name }}</td>
                                            <td class="column-3">{!! \App\Helpers\Helper::getOfficePrice($wishsListProd->price, $wishsListProd->price_sale) !!}</td>
                                            <td class="column-1" style="padding-left: 0;">                            
                                                <a href={{route('home.product-detail.show', $wishsListProd->id)}} class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 trans-04 pointer" style="max-width: 80px; margin: auto;">
                                                    {{ __('Details') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
@endsection
