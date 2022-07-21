<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProduct extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $table = 'order_product';
    protected $fillable = [
        'order_id',
        'product_id',
        'amount_product',
        'created_at', 
        'updated_at'
    ];

    protected $primaryKey = ['order_id', 'product_id'];

    protected function setKeysForSaveQuery($query)
    {
        return $query->where('order_id', $this->getAttribute('order_id'))
                    ->where('product_id', $this->getAttribute('product_id'));
    }

    public static function createOrderProducts($orderId, $cartProducts)
    {
        try {
            $data = [];
            foreach ($cartProducts as $cartProduct) {
                array_push($data, [
                    'order_id' => $orderId,
                    'product_id' => $cartProduct->product_id,
                    'amount_product' => $cartProduct->amount_product,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            self::insert($data);

        } catch (Exception $err) {
            throw new Exception($err->getMessage());
        }

        return true;
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
