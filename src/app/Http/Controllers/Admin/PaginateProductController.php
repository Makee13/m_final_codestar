<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Product\ProductAdminService;

class PaginateProductController extends Controller
{
    const SORT_METHODS = ['asc', 'desc', 'ASC', 'DESC'];

    protected $productAdminService;

    public function __construct(ProductAdminService $productAdminService)
    {
        $this->productAdminService = $productAdminService;
    }

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
    
    /**
     * Todo
     * Make explixit
     */
    public function show(Request $request)
    {
        $page = $request->input('page');
        $sort = in_array($request->input('sortPrice'), self::SORT_METHODS) ? $request->input('sortPrice') : 'asc';

        $result = $this->productAdminService->getWithPaginate($page, $sort);

        if (count($result) > 0) {
            $html = view('common.product-list', ['products' => $result])->render();
            return response()->json(['html' => $html]);
        }
        return response()->json(['html' => '']);
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
