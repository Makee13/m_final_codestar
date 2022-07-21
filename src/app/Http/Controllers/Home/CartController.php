<?php

namespace App\Http\Controllers\Home;

use Exception;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Traits\Matching;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateCartRequest;

class CartController extends Controller
{
    use Matching;

    public function index()
    {
        $cart = Auth::user()->cart;
        $cartProducts = Cart::showJoinCartProdAndProdWith($cart->id);
        
        // Reset coupon
        session()->forget('decreasedPrice');

        return view('shopping-cart', [
            'title' => __('titles.list', ['name' => 'cart products']),
            'cartProducts' => $cartProducts,
        ]);
    }

    public function create()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function store(Request $request)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function show(Cart $cart)
    {
        if ($this->isMatchUserWithCart($cart->user_id)) {

            $cartProducts = Cart::showJoinCartProdAndProdWith($cart->id);

            $html = view('modal.cart', [
                'cartProducts' => $cartProducts,
            ])->render();

            return response()->json([
                'error' => false,
                'html' => $html,
            ]);
        }
        return response()->json([
            'error' => true,
        ]);
    }

    public function edit(Cart $cart)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function update(UpdateCartRequest $request, Cart $cart)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function destroy(Cart $cart)
    {
        throw new Exception('The feature is not implemented!');
    }
}
