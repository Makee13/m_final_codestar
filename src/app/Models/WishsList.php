<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\WishsListProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WishsList extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount_product',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function wishsListProducts() {
        return $this->hasMany(WishsListProduct::class, 'wishs_list_id', 'id');
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'wishs_list_product', 'wishs_list_id', 'product_id');
    }
}
