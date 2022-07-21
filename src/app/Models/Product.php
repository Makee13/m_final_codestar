<?php

namespace App\Models;

use App\Models\Review;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'content',
        'thumb',
        'category_id',
        'price',
        'price_sale',
        'active'
    ];

    const AMOUNT_OF_BEST_SELLING_PRODUCTS = 10;
    const AMOUNT_OF_SEARCH_PRODUCTS = 12;

    const ACTIVE_STATUS = 1;
    const UNACTIVE_STATUS = 0;

    const IMAGE_DEFAULT = '/storage/uploads/2/2022-06-15/photo-1615108395437-df128ad79e80.jpg';

    public function getOfficePrice()
    {
        return $this->price_sale == 0 ? $this->price : $this->price_sale;
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_product', 'product_id', 'cart_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id');
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_product', 'coupon_id', 'product_id');
    }

    public function couponProduct()
    {
        return $this->belongsTo(CartCoupon::class, 'id', 'product_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }

    public function wishsLists()
    {
        return $this->belongsToMany(WishsList::class, 'wishs_list_product', 'product_id', 'wishs_list_id');
    }

    public function wishsListProducts()
    {
        return $this->hasMany(WishsListProduct::class, 'id', 'product_id');
    }

    public static function checkActive($isActive) {
        return $isActive ? self::ACTIVE_STATUS : self::UNACTIVE_STATUS;
    }

    public static function salePriceIsLessThanPrice($request)
    {
        return $request->price >= $request->price_sale;
    }

    public function getAmountOfSoldProduct() {
        return OrderProduct::where('product_id', $this->id)->get()->count();
    }

    public function getAvgStarOfProduct() {
        return Review::where('product_id', $this->id)
                    ->where('review_id', null)
                    ->pluck('amount_of_stars')->avg();
    }

    /**
     * Search all product or folllow category id
     *
     * @param [string] $searchingKeyword
     * @param [integer] $categoryId
     * @return Collection
     */
    public static function searchProducts($searchingKeyword, $categoryId = null)
    {
        $searchingKeyword = htmlspecialchars($searchingKeyword);

        $query = self::where('active', self::ACTIVE_STATUS);

        if($categoryId !== null) {
            $query = $query->where('category_id', $categoryId);
        }

        return $query->where(function($query) use ($searchingKeyword) {
                    $query->where('name', 'like', "%$searchingKeyword%")
                        ->orWhere('description', 'like', "%$searchingKeyword%")
                            ->orWhere('content', 'like', "%$searchingKeyword%")
                            ->orWhere([
                                'price' => "$searchingKeyword",
                                'price_sale' => "$searchingKeyword"
                            ])
                            ->orWhere(function ($query) use ($searchingKeyword) {
                                $query->whereIn('category_id', Category::where('name', 'like', "%$searchingKeyword%")
                                        ->orWhere('description', 'like', "%$searchingKeyword%")
                                        ->orWhere('content', 'like', "%$searchingKeyword%")
                                        ->pluck('id'));
                            });
                })
                ->limit(self::AMOUNT_OF_SEARCH_PRODUCTS);
    }

    public static function getBestSellingsInMonth() {
        return DB::table('order_product')
                    ->select('products.*', 'product_id', DB::raw('SUM(amount_product) AS total_product'))
                    ->join('products', 'products.id' , '=', 'order_product.product_id')
                    ->groupBy('product_id')
                    ->whereRaw("MONTH(NOW()) = MONTH(order_product.created_at) AND YEAR(NOW()) = YEAR(order_product.created_at)")
                    ->orderBy('total_product', 'DESC')
                    ->limit(self::AMOUNT_OF_BEST_SELLING_PRODUCTS)
                    ->get();
    }

    public function getOfficialPrice() {
        return $this->price_sale != 0.0 ? $this->price_sale : $this->price;
    }
}
