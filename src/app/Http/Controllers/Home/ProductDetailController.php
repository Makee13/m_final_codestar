<?php

namespace App\Http\Controllers\Home;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function index()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function create()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function store(Request $request)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function show(Product $product)
    {
        $product->officePrice = Helper::getOfficePrice($product->price, $product->price_sale);

        $relatedProducts = Product::where('active', Product::ACTIVE_STATUS)
            ->where('category_id', $product->category_id)
            ->get();

        return view('common.product-detail', [
            'title' => $product->name,
            'product' => $product,
            'category' => $product->category,
            'relatedProducts' => $relatedProducts,
            'reviews' => $product->reviews()->where('review_id', null)->get(),
            'amountOfReviews' => Review::where('product_id', $product->id)
                ->where('review_id', null)
                ->count(),
            'reviewAverage' => Review::where('product_id', $product->id)
                ->where('review_id', null)
                ->pluck('amount_of_stars')->avg(),

        ]);
    }

    public function edit($id)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function update(Request $request, $id)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function destroy($id)
    {
        throw new Exception('The feature is not implemented!');
    }
}
