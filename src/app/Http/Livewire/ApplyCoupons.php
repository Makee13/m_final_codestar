<?php

namespace App\Http\Livewire;

use App\Models\CartCoupon;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ApplyCoupons extends Component
{
    public $errMessage;
    public $successMessage;
    public $couponText;
    public $cartTotal;

    public function render()
    {
        return view('livewire.apply-coupons');
    }

    public function mount()
    {
        $this->cartTotal = Auth::user()->cart->total;
    }

    public function resetMessages()
    {
        $this->reset('successMessage');
        $this->reset('errMessage');
    }

    public function checkCoupon()
    {
        // Reset
        session()->forget(['decreasedPrice', 'coupon_id']);
        $this->emit('setCartTotal', $this->cartTotal);
        $this->resetMessages();

        $coupon = Coupon::where('code', $this->couponText)->first();
        // Check true coupon
        if (!$coupon || $coupon->expired_date < now()) {
            $this->errMessage = "The coupon hasn't been used";
            return;
        }

        // Check coupon which is used in cart
        if (CartCoupon::where('cart_id', Auth::user()->cart->id)
                        ->where('coupon_id', $coupon->id)
                        ->exists()
        ) {
            $this->errMessage = "The coupon has been used in your cart";
            return;
        }

        // Setup decrease_price for total
        $decreasedPrice = $this->cartTotal - $coupon->decreased_price;
        // Setup if decreasedPrice is less than 1
        $decreasedPrice = $decreasedPrice <= 0 ? 1 : $decreasedPrice;
        
        $this->emit('setCartTotal', $decreasedPrice);
        $this->successMessage = "Coupon is used successfully";

        // Setup for checkout process
        session([
            'decreasedPrice' => $decreasedPrice,
            'coupon_id' => $coupon->id
        ]);
    }
}
