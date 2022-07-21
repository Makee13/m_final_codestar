<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'description',
        'content',
        'image',
        'slug',
        'active'
    ];

    const IMAGE_DEFAULT = '/storage/uploads/2/2022-06-15/photo-1615108395437-df128ad79e80.jpg';

    public function products() {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
