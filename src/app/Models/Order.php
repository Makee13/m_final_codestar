<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount_product',
        'total_price',
        'user_id',
        'status',
        'payment_status',
    ];

    const CONFIRMED_STATUS = 'confirmed';
    const CONFIRMING_STATUS = 'confirming';
    const DELIVERED_STATUS = 'delivered';

    const ONLINE_PAID_STATUS = 'online';
    const OFFLINE_PAID_STATUS = 'offline';
    const UNPAID_STATUS = 'unpaid';

    const PAYPAL_ORDER = 'paypal_order';
    const INDEX_OF_AMOUNT_PRODUCT = 1;

    public static function createOrderAndProductOrder()
    {
        $user = Auth::user();
        $cart = $user->cart;

        try {
            $descreasedPrice = session('decreasedPrice');

            $order = self::create([
                'amount_product' => $cart->amount_product,
                'total_price' => $descreasedPrice ?? $cart->total,
                'user_id' => $user->id,
                'payment_status' => session(self::ONLINE_PAID_STATUS) 
                                        ? self::ONLINE_PAID_STATUS 
                                        : self::UNPAID_STATUS,
            ]);

            OrderProduct::createOrderProducts($order->id, $cart->cartProducts);

            // Delete all cart product
            CartProduct::where('cart_id', $cart->id)->delete();

        } catch (Exception $err) {
            throw new Exception($err->getMessage());
        }

        return true;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id');
    }

    public static function getAmountOfProvinceOrdersInMonth()
    {
        return array_map(function ($item) {
            return (array) $item;
        }, DB::select(DB::raw("SELECT province AS '0', total_sold_product as '1'
                                        FROM (
                                            SELECT province, SUM(amount_product) as total_sold_product
                                            FROM orders INNER JOIN users ON users.id = orders.user_id
                                            WHERE MONTH(orders.created_at) = MONTH(NOW()) AND YEAR(orders.created_at) = YEAR(NOW()) AND status = 'delivered'
                                            GROUP BY province
                                        ) AS order_province")
        ));
    }

    public static function getAmountOfDistrictOrdersInProvice($province)
    {
        return array_map(function ($item) {

            // Convert amount from string to int
            $item = (array) $item;
            $item[self::INDEX_OF_AMOUNT_PRODUCT] = (int)$item[self::INDEX_OF_AMOUNT_PRODUCT];
            return $item;
            
        }, DB::select(DB::raw("SELECT district AS '0', total_sold_product as '1'
                                FROM (
                                    SELECT district, SUM(amount_product) as total_sold_product
                                    FROM orders INNER JOIN users ON users.id = orders.user_id
                                    WHERE MONTH(orders.created_at) = MONTH(NOW()) AND YEAR(orders.created_at) = YEAR(NOW()) AND status = 'delivered' AND province = '$province'
                                    GROUP BY district
                                ) AS order_district"))
        );
    }

}
