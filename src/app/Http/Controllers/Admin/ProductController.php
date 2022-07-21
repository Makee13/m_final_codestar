<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Helpers\Helper;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\ValidateService;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\Product\ProductAdminService;

class ProductController extends Controller
{
    protected $productAdminService;
    use ValidateService;

    public function __construct(ProductAdminService $productAdminService)
    {
        $this->productAdminService = $productAdminService;
    }

    public function index()
    {
        return view('admin.product.list', [
            'title' => __('titles.list', ['name' => 'product']),
            'products' => $this->productAdminService->getWithCates(),
        ]);
    }

    public function create()
    {
        return view('admin.product.add', [
            'title' => __('titles.add', ['name' => 'product']),
            'categories' => $this->productAdminService->getActivedCates(),
        ]);
    }

    public function show(Product $product)
    {
        $product->price = Helper::getOfficePrice($product->price, $product->price_sale);
        if ($product) {
            return response()->json([
                'error' => false,
                'product' => $product,
            ]);
        }
        return response()->json([
            'error' => true,
        ]);
    }

    public function edit(Product $product)
    {
        return view('admin.product.edit', [
            'title' => __('titles.edit', ['name' => 'product']),
            'product' => $product,
            'categories' => $this->productAdminService->getActivedCates(),
        ]);
    }

    public function update(StoreProductRequest $request, Product $product)
    {
        $isUpdated = $this->productAdminService->store($request, $product);
        
        if ($isUpdated) {
            return redirect()->route('admin.product.list')
                ->with('success', __('messages.succ-edit-mess', ['name' => 'product']));
        }

        return back()->withInput()->withErrors([
            'error' => __('messages.err-edit-mess', ['name' => 'product']),
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        if(Product::salePriceIsLessThanPrice($request)) {
            try {
                Product::create([
                    'name'          => $request->input('name'),
                    'price'         => $request->input('price'),
                    'category_id'   => $request->input('category_id'),
                    'price_sale'    => $request->input('price_sale'),
                    'description'   => $request->input('description'),
                    'content'       => $request->input('content'),
                    'thumb'         => $request->input('thumb'),
                    'active'        => Product::checkActive($request->input('active'))
                ]);

                return back()->with('success', __('messages.succ-add-mess', ['name' => 'product']));
            } catch (Exception $err) {
                throw new Exception($err->getMessage());
                return back()->withInput()->withErrors(['error' => __('messages.err-add-mess'),]);
            }
        }
        Session::flash('message-err', __('The price must be less than sale price'));
    }

    public function destroy(Request $request)
    {
        try {
            Product::destroy($request->input('id'));
            
            return response()->json([
                'error' => false,
                'message' => __('messages.succ-del-mess', ['name' => 'product']),
            ]);
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }
}
