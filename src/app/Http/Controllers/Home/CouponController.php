<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Coupon;
use Exception;

class CouponController extends Controller
{
    public function index()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function create()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function store(StoreCouponRequest $request)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function show(Coupon $coupon)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function edit(Coupon $coupon)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function destroy(Coupon $coupon)
    {
        throw new Exception('The feature is not implemented!');
    }
}
