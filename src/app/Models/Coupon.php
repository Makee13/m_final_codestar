<?php

namespace App\Models;

use App\Models\UserCoupon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'decreased_price',
        'expired_date',
    ];

    protected $casts = [
        'expired_date' => 'datetime:Y-m-d',
    ];

    public function cartCoupons()
    {
        return $this->hasMany(CartCoupon::class, 'coupon_id', 'id');
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_coupon', 'coupon_id', 'cart_id');
    }

    public function users() {
        return $this->belongsToMany(UserCoupon::class, 'user_coupon', 'coupon_id', 'user_id');
    }
}
