<?php

namespace App\Observers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\CartProduct;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;

class OrderProductObserver
{
    public function created(OrderProduct $orderProduct)
    {

    }

    public function updated(OrderProduct $orderProduct)
    {
        //
    }

    public function deleted(OrderProduct $orderProduct)
    {
        //
    }

    public function restored(OrderProduct $orderProduct)
    {
        //
    }

    public function forceDeleted(OrderProduct $orderProduct)
    {
        //
    }

}
