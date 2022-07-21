<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount_product', 
        'total', 
        'user_id', 
    ];

    public function cartProducts() {
        return $this->hasMany(CartProduct::class);
    }

    public function user() {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'cart_product', 'cart_id', 'product_id');
    }

    public static function showJoinCartProdAndProdWith($idCart) {
        return DB::table('carts')
                    ->join('cart_product', 'carts.id', '=', 'cart_product.cart_id')
                    ->join('products', 'cart_product.product_id', '=', 'products.id')
                    ->where('carts.id', $idCart)
                    ->get();
    }
}
