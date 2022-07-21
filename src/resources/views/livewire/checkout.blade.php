<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
        <h4 class="mtext-109 cl2 p-b-30 text-dark">
            {{ __('Cart Totals') }}
        </h4>

        <div class="flex-w flex-t bor12 p-b-13">
            <div class="size-208">
                <span class="stext-110 cl2 text-dark">{{ __('Subtotal') }}:</span>
            </div>

            <div class="size-209">
                <span class="mtext-110 cl2 text-dark">${{ $total }}</span>
            </div>
        </div>

        <div class="flex-w flex-t bor12 p-t-15 p-b-30">
            <div class="size-208 w-full-ssm">
                <span class="stext-110 cl2 text-dark">{{ __('Shipping') }}:</span>
            </div>

            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                <p class="stext-111 cl6 p-t-2">
                    {{ __('Please check your detail information') }}. <br>
                    {{ __('We are going to phone you to confirm your order') }}.
                </p>
            </div>
        </div>

        <div class="flex-w flex-t bor12 p-t-15 p-b-30">
            <div class="size-208 w-full-ssm">
                <span class="stext-110 cl2 text-dark">{{ __('Address') }}:</span>
            </div>

            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                <p>
                    {{ \Auth::user()->province }}
                </p>
                <p>
                    {{ \Auth::user()->district }}
                </p>
                <p>
                    {{ \Auth::user()->commune }}
                </p>
                <a class="text-dark" href="{{ route('user.profile.info.create') }}"
                    style="text-decoration: underline;"><b>{{ __('Modify') }}</b>
                </a>
            </div>
        </div>

        <div class="flex-w flex-t p-t-27 p-b-33">
            <div class="size-208">
                <span class="mtext-101 cl2 text-dark">
                    {{ __('Total') }}:
                </span>
            </div>

            <div class="size-209 p-t-1">
                <span class="mtext-110 cl2 text-dark">
                    ${{ $total }}
                </span>
            </div>
        </div>
        {{-- Offline payment --}}
        <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer js-checkout m-b-20">
            {{ __('Cash on delivery') }}
        </button>
        {{-- Paypal Online payment --}}
        @csrf
        <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 trans-04 pointer m-b-20"
            style="background-color: transparent;">
            <input type="image" border="0" src="/template/images/paypal-button.png" alt="Check out"
                style="width: 100%; max-height: 100%;">
        </button>
    </div>
</div>
