<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserCouponRequest;
use App\Http\Requests\UpdateUserCouponRequest;
use App\Models\UserCoupon;
use Exception;

class UserCouponController extends Controller
{
    public function index()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function create()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function store(StoreUserCouponRequest $request)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function show(UserCoupon $userCoupon)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function edit(UserCoupon $userCoupon)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function update(UpdateUserCouponRequest $request, UserCoupon $userCoupon)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function destroy(UserCoupon $userCoupon)
    {
        throw new Exception('The feature is not implemented!');
    }
}
