<?php

namespace App\Http\Controllers\Home;

use Exception;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Category\CategoryService;
use App\Http\Services\Slider\SliderAdminService;
use App\Http\Services\Product\ProductAdminService;

class HomeController extends Controller
{
    const DEFAULT_OFFSET = 0;
    const DEFAULT_CATES_AMOUNT = 12;
    const SORT_METHODS = ['asc', 'desc', 'ASC', 'DESC'];

    protected $cates;
    protected $sliders;

    public function __construct(CategoryService $cates, SliderAdminService $sliders, ProductAdminService $products)
    {
        $this->cates = $cates;
        $this->sliders = $sliders;
        $this->products = $products;
    }

    public function index(Request $request)
    {
        $isGotParent = true;
        $sort = in_array($request->input('sortPrice'), self::SORT_METHODS) ? $request->input('sortPrice') : null;

        $searchKeyword = $request->input('search');

        $products = $searchKeyword 
                    ? Product::searchProducts($searchKeyword)->orderBy('price', $sort ?? 'ASC' )->get()
                    : $this->products->getWithPaginate(self::DEFAULT_OFFSET, $sort ?? 'ASC');

        return view('common.home', [
            'title'                 => 'Perfume shop',
            'cates'                 => $this->cates->get(self::DEFAULT_CATES_AMOUNT, $isGotParent),
            'sliders'               => $this->sliders->showBySorted(),
            'products'              =>  $products,
            'bestSellingProducts'   => Product::getBestSellingsInMonth()
        ]);
    }
}
