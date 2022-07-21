<?php

namespace App\Models;

use App\Models\Product;
use App\Models\WishsList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishsListProduct extends Model
{
    use HasFactory;

    protected $table = "wishs_list_product";

    protected $fillable = [
        'wishs_list_id',
        'product_id',
    ];

    public $incrementing = false;

    protected $primaryKey = ['wishs_list_id', 'product_id'];

    protected function setKeysForSaveQuery($query)
    {
        return $query->where('wishs_list_id', $this->getAttribute('wishs_list_id'))
                        ->where('product_id', $this->getAttribute('product_id'));
    }

    public function wishsList()
    {
        return $this->belongsTo(WishsList::class, 'wishs_list_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
