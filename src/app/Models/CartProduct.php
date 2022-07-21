<?php

namespace App\Models;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;

    protected $table = 'cart_product';

    protected $fillable = [
        'cart_id',
        'product_id',
        'user_id',
        'amount_product',
    ];

    public $incrementing = false;

    protected $primaryKey = ['cart_id', 'product_id'];

    protected function setKeysForSaveQuery($query)
    {
        return $query->where('cart_id', $this->getAttribute('cart_id'))
                    ->where('product_id', $this->getAttribute('product_id'));
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'id', 'cart_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
