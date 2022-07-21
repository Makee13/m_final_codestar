<div class="s-full js-hide-cart" onClick="hideCart()"></div>

<div class="header-cart flex-col-l p-l-65 p-r-25">
    <div class="header-cart-title flex-w flex-sb-m p-b-8">
        <span class="mtext-103 cl2">
            {{ __('Your Cart') }}
        </span>

        <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart" onClick="hideCart()">
            <i class="zmdi zmdi-close"></i>
        </div>
    </div>

    @if (isset($cartProducts))
        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full">
                @foreach ($cartProducts as $cartProduct)
                    <li class="header-cart-item flex-w flex-t m-b-12">
                        <a class="how-itemcart1 d-block"
                            href="{{ route('user.cart.product.destroy', ['productId' => $cartProduct->product_id]) }}">
                            <img src="{{ $cartProduct->thumb }}" alt="IMG">
                        </a>

                        <div class="header-cart-item-txt p-t-8 d-flex justify-content-between">
                            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                {{ \Str::ucfirst($cartProduct->name) }}
                            </a>

                            <span class="header-cart-item-info d-flex">
                                <span class="m-r-5">
                                    {{ $cartProduct->amount_product }} x
                                </span>
                                {!! App\Helpers\Helper::getOfficePrice($cartProduct->price, $cartProduct->price_sale) !!}
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    @if (isset($cartProducts[0]))
                        {{ __('Total') }}: ${{ $cartProducts[0]->total }}
                    @endif
                </div>
    @endif
    <div class="header-cart-buttons flex-w w-full">
        <a href="{{ route('user.cart.products.list') }}"
            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
            {{ __('View Cart') }}
        </a>

        <a href="{{ route('user.cart.products.list') }}"
            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
            {{ __('Check Out') }}
        </a>
    </div>
</div>
</div>
</div>
