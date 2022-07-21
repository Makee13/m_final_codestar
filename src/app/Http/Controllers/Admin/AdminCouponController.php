<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\CartCoupon;
use App\Models\CouponProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCouponRequest;


class AdminCouponController extends Controller
{
    public function index()
    {
        return view('admin.coupon.list', [
            'title' => __('titles.list', ['name' => 'coupons']),
        ]);
    }

    public function create()
    {
        return view('admin.coupon.add', [
            'title' => __('titles.add', ['name' => 'coupon']),
            'products' => Product::all(),
        ]);
    }

    public function store(StoreCouponRequest $request)
    {
        try {
            Coupon::create([
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'decreased_price' => $request->input('decreased_price'),
                'expired_date' => $request->input('expired_date'),
            ]);

        } catch (Exception $err) {
            throw new Exception($err->getMessage());
        }

        return back()->with('success', __('messages.succ-add-mess', ['name' => 'coupon']));
    }

    public function show($id)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function edit($id)
    {
        return view('admin.coupon.edit', [
            'title' => __('titles.edit', ['name' => 'coupon']),
            'coupon' => Coupon::find($id),
            'products' => Product::all(),
        ]);
    }

    public function update(StoreCouponRequest $request, Coupon $coupon)
    {
        if (!$coupon) {
            return back()->with('error', __('messages.err-update-mess', ['name' => 'coupon']));
        }

        try {
            $coupon->update([
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'decreased_price' => $request->input('decreased_price'),
                'expired_date' => $request->input('expired_date'),
            ]);

        } catch (Exception $err) {
            throw new Exception($err->getMessage());
        }

        return back()->with('success', __('messages.succ-edit-mess', ['name' => 'coupon']));
    }

    public function destroy(Coupon $coupon)
    {
        if (!$coupon) {
            return back()->with('error', __('messages.err-del-mess', ['name' => 'coupon']));
        }

        $coupon->delete();

        return back()->with('success', __('messages.succ-del-mess', ['name' => 'coupon']));
    }
}
