<?php

namespace App\Http\Controllers\Home;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $product->price = Helper::getOfficePrice($product->price, $product->price_sale);

        if ($product) {
            return response()->json([
                'error' => false,
                'product' => $product
            ]);
        }
        
        return response()->json([
            'error' => true,
        ]);
    }
}
