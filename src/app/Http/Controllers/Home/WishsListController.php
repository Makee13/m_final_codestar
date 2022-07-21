<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWishsListRequest;
use App\Http\Requests\UpdateWishsListRequest;
use App\Http\Traits\Matching;
use App\Models\WishsList;
use App\Models\WishsListProduct;
use Exception;
use Illuminate\Support\Facades\Auth;

class WishsListController extends Controller
{
    use Matching;

    public function index()
    {
        return view('home.wishs-list', [
            'title' => __('titles.list', ['name' => 'wishs']),
            'wishsListProds' => Auth::user()->wishsList->products
        ]);
    }

    public function store(StoreWishsListRequest $request)
    {
        $productId = $request->input('product_id');
        if (!$this->isProductInTheStore($productId)) {
            return response()->json(['err' => true], 422);
        }

        // Delete when existed in wishs list
        $wishsListId = Auth::user()->wishsList->id;
        $wishsListProduct = WishsListProduct::where('product_id', $productId)->where('wishs_list_id', $wishsListId)->first();
        if ($wishsListProduct) {
            $wishsListProduct->delete();
        }

        // Add when is not existed in wishs list
        $isAdd = false;
        if (!$wishsListProduct) {
            $wishsListProduct = WishsListProduct::create([
                'wishs_list_id' => $wishsListId,
                'product_id' => $productId,
            ]);
            $isAdd = true;
        }

        $amountProduct = WishsListProduct::where('wishs_list_id', $wishsListProduct->wishs_list_id)->count();
        return response()->json([
            'err' => false,
            'message' => __('messages.succ-add-mess', ['name' => 'wishslist']),
            'amountProduct' => $amountProduct,
            'isAdd' => $isAdd
        ]);
    }

    public function create()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function show(WishsList $wishsList)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function edit(WishsList $wishsList)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function update(UpdateWishsListRequest $request, WishsList $wishsList)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function destroy($productId)
    {
        WishsListProduct::where('product_id', $productId)->where('wishs_list_id', Auth::user()->wishsList->id)->delete();
        return redirect()->back();
    }
}
