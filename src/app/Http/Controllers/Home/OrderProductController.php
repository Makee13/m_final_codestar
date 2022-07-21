<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderProductRequest;
use App\Http\Requests\UpdateOrderProductRequest;
use App\Models\OrderProduct;
use Exception;

class OrderProductController extends Controller
{
    public function index()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function create()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function store(StoreOrderProductRequest $request)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function show(OrderProduct $orderProduct)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function edit(OrderProduct $orderProduct)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function update(UpdateOrderProductRequest $request, OrderProduct $orderProduct)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function destroy(OrderProduct $orderProduct)
    {
        throw new Exception('The feature is not implemented!');
    }
}
