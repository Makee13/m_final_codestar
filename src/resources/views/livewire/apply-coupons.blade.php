<div class="coupon-section">
    <p class="text-danger m-l-10" style="position: absolute; bottom: 15px;">{{$errMessage}}</p>
    <p class="text-success m-l-10" style="position: absolute; bottom: 15px;">{{$successMessage}}</p>
    <div class="flex-w flex-m m-r-20 m-tb-5">
        <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5 text-dark" type="text"
               name="coupon" placeholder="Coupon Code" wire:model.defer="couponText">
        <button
            wire:click.prevent="checkCoupon"
            class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
            {{ __('Apply coupon') }}
        </button>
    </div>
</div>
