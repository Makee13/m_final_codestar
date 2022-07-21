<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AdminOrderController extends Controller
{
    public function index()
    {
        return view('admin.order.list', ['title' => __('titles.list', ['name' => 'orders'])]);
    }

    public function create()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function store(Request $request)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function show()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function edit($id)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function update(Order $order, $delivered)
    {
        try {
            $order->status = $delivered == 'delivered' ? Order::DELIVERED_STATUS : Order::CONFIRMED_STATUS;
            $order->payment_status = Order::OFFLINE_PAID_STATUS;
            $order->save();

        } catch (Exception $err) {
            throw new Exception($err->getMessage());
        }

        return back()->with([
            'success' => true,
            'message' => __('Update status successfully')
        ]);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with([
            'success' => true,
            'message' => __('Deleted successfully')
        ]);
    }
}
