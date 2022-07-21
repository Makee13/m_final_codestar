<?php

namespace App\Http\Controllers\Datatables;

use App\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AdminOrderDttbController
{
    const CONFIRM_TEXT_TYPES = [
        Order::CONFIRMED_STATUS => 'success',
        Order::CONFIRMING_STATUS => 'danger',
        Order::DELIVERED_STATUS => 'info',
    ];

    const PAYMENT_TEXT_TYPES = [
        Order::ONLINE_PAID_STATUS => 'success',
        Order::OFFLINE_PAID_STATUS => 'success',
        Order::UNPAID_STATUS => 'danger',
    ];

    public function getMasterOrders()
    {
        $query = DB::table('orders')->select([
            'users.name',
            'users.phone',
            'users.email',
            'users.province',
            'users.district',
            'users.commune',
            'orders.id',
            'orders.total_price',
            'orders.created_at',
            'orders.updated_at',
            'orders.status',
            'orders.payment_status',
        ])
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->orderByDesc('created_at');

        return DataTables::of($query)
                            ->addColumn('confirm', function ($order) {
                                return '<a href="' . route('admin.orders.update', ['order' => $order->id, 'delivered' => 'undelivered']) . '" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i>Confirm</a>';
                            })
                            ->addColumn('status-confirm', function ($data) {
                                $textType = self::CONFIRM_TEXT_TYPES[$data->status];

                                return "<span class='alert alert-$textType' style='display: inline-block; font-size: 12px;'><b>$data->status</b></span>";
                            })
                            ->addColumn('payment-status', function ($data) {
                                $textType = self::PAYMENT_TEXT_TYPES[$data->payment_status];

                                return "<span class='alert alert-$textType' style='display: inline-block; font-size: 12px;'><b>$data->payment_status</b></span>";
                            })
                            ->addColumn('status-delivered', function ($order) {
                                return '<a href="' . route('admin.orders.update', ['order' => $order->id, 'delivered' => 'delivered']) . '" class="btn btn-warning text-white"><i class="glyphicon glyphicon-edit"></i>Delivered</a>';
                            })
                            ->addColumn('details_url', function ($order) {
                                return route('admin.orders.get-details', ['id' => $order->id]);
                            })
                            ->addColumn('total', function ($order) {
                                return "$" . $order->total_price;
                            })
                            ->addColumn('created_at', function ($order) {
                                return "<div>
                                            <span class='d-block m-b-20'>$order->created_at</span>
                                            <span class='text-info'>". Carbon::parse($order->created_at)->diffForHumans() ."</span>
                                        </div>";
                            })
                            ->addColumn('updated_at', function ($order) {
                                return "<div>
                                            <span class='d-block m-b-20'>$order->updated_at</span>
                                            <span class='text-info'>". Carbon::parse($order->updated_at)->diffForHumans() ."</span>
                                        </div>";
                            })
                            ->rawColumns(['status-confirm', 'payment-status', 'destroy', 'confirm', 'status-delivered', 'created_at', 'updated_at'])
                            ->make(true);
    }

    public function getDetailOrders($id)
    {
        $query = DB::table('orders')
                    ->select([
                        'orders.*',
                        'order_product.amount_product as amount_order_product',
                        'products.*',
                    ])
                    ->where('orders.id', $id)
                    ->join('order_product', 'orders.id', '=', 'order_product.order_id')
                    ->join('products', 'order_product.product_id', '=', 'products.id');

                return Datatables::of($query)
                    ->addColumn('image', function ($data) {
                        return "<img width='50px' src='$data->thumb' alt='Product Image'>";
                    })
                    ->rawColumns(['image'])
                    ->make(true);
            }
}
