<?php

namespace App\Http\Controllers\Home;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Category\CategoryService;

class CategoryController extends Controller
{
    protected $categories;
    const SORT_METHODS = ['asc', 'desc', 'ASC', 'DESC'];
    const DEFAULT_PAGINATE_VALUE = 8;

    public function __construct(CategoryService $categories)
    {
        $this->categories = $categories;
    }

    public function show(Request $request, $id, $slug)
    {
        $cate = $this->categories->getByIdAndSlug($id, $slug);
        $sort = in_array($request->input('sortPrice'), self::SORT_METHODS) ? $request->input('sortPrice') : null;

        if ($cate) {
            $searchKeyword = $request->input('search');

            $products = $searchKeyword 
                        ? Product::searchProducts($searchKeyword, $categoryIdForSeach = $id)
                                    ->orderBy('price', $sort ?? 'ASC')
                                    ->paginate(self::DEFAULT_PAGINATE_VALUE)
                                    ->withQueryString() 
                        : 
                        $this->categories->getProducts($cate, $sort);

            return view('common.category', [
                'title' => $cate->name,
                'products' => $products,
                'cate' => $cate,
            ]);
        }
    }
}
