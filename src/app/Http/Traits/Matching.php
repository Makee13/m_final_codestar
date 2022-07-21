<?php

namespace App\Http\Traits;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

trait Matching
{
    public function isMatchUserWithCart($userIdInCart) {
        return Auth::id() === $userIdInCart;
    }

    public function isProductInTheStore($productId) {
        return Product::find($productId);
    }
}
