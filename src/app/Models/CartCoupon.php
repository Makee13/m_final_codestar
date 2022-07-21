<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartCoupon extends Model
{
    use HasFactory;

    protected $table = 'cart_coupon';

    protected $fillable = [
        'coupon_id',
        'cart_id',
    ];

    public $incrementing = false;

    protected $primaryKey = ['coupon_id', 'cart_id'];

    protected function setKeysForSaveQuery($query)
    {
        return $query->where('coupon_id', $this->getAttribute('coupon_id'))
                    ->where('cart_id', $this->getAttribute('cart_id'));
    }

    public function cart()
    {
        return $this->hasOne(Product::class, 'id', 'cart_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id', 'id');
    }
}
