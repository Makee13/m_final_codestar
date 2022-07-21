<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCouponProductRequest;
use App\Http\Requests\UpdateCouponProductRequest;
use App\Models\CartCoupon;
use Exception;

class CouponProductController extends Controller
{
    public function index()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function create()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function store(StoreCouponProductRequest $request)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function show(CartCoupon $couponProduct)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function edit(CartCoupon $couponProduct)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function update(UpdateCouponProductRequest $request, CartCoupon $couponProduct)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function destroy(CartCoupon $couponProduct)
    {
        throw new Exception('The feature is not implemented!');
    }
}
