<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\CartCoupon;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders;

        return view('order', [
            'title' => __('titles.list', ['name' => 'orders']),
            'orders' => $orders
        ]);
    }

    public function store(Request $request)
    {
        if(Auth::user()->checkInValidAddress()) {
            return response()->json([
                'error' => true,
                'message' => __('Please fill full your address!!!'),
            ]);
        }

        if (!Order::createOrderAndProductOrder()) {
            return response()->json([
                'error' => true,
                'message' => __('messages.err-add-mess', ['name' => 'order']),
            ]);
        }

        // Add cartcoupon and reset sessions
        // session coupon_id and decreasedPrice are created when user uses true coupon 
        if (session('coupon_id') || session('decreasedPrice')) {
            CartCoupon::create([
                'cart_id' => Auth::user()->cart->id,
                'coupon_id' => session('coupon_id')
            ]);

            session()->forget(['decreasedPrice', 'coupon_id']);
        }

        return response()->json([
            'error' => false,
            'message' => __('messages.succ-add-mess', ['name' => 'order']),
        ]);
    }

    public function create()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function show(Order $order)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function edit(Order $order)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function destroy(Order $order)
    {
        throw new Exception('The feature is not implemented!');
    }
}
