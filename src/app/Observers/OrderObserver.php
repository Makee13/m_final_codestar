<?php

namespace App\Observers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderObserver
{
    public function created(Order $order)
    {
        $cart = Auth::user()->cart;

        // Reset cart
        $cart->amount_product = 0;
        $cart->total = 0;
        $cart->save();
    }

    public function updated(Order $order)
    {
        //
    }

    public function deleted(Order $order)
    {
        //
    }

    public function restored(Order $order)
    {
        //
    }

    public function forceDeleted(Order $order)
    {
        //
    }
}
