<?php

namespace App\Http\Controllers\Datatables;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AdminCouponDttbController
{
    public function showAll()
    {
        $query = DB::table('coupons');

        return DataTables::of($query)
                            ->addColumn('update', function ($coupon) {
                                return '<a href="' . route('admin.coupon.edit', $coupon->id) . '" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i>Update</a>';
                            })
                            ->addColumn('destroy', function ($coupon) {
                                return '<a href="' . route('admin.coupon.destroy', $coupon->id) . '" class="btn btn-danger"><i class="glyphicon glyphicon-edit"></i>Destroy</a>';
                            })
                            ->rawColumns(['update', 'destroy'])
                            ->make(true);
    }
}
