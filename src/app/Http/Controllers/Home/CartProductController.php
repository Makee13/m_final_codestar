<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartProductRequest;
use App\Http\Traits\Matching;
use App\Models\Cart;
use App\Models\CartProduct;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartProductController extends Controller
{
    use Matching;

    public function index()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function store(StoreCartProductRequest $request)
    {
        $cart = Auth::user()->cart;

        ['product_id' => $productId, 'amount_product' => $amountProduct] = $request->all();

        if (!$this->isProductInTheStore($productId)) {
            return response()->json([
                'error' => true,
                'message' => __('messages.err-match-mess', ['object1' => 'Product', 'object2' => 'store']),
            ]);
        }

        $cartId = $cart->id;
        /**
         * Notes:
         * Laravel 9 support updateOrCreate option to replace this. But Our application is 8x version
         *
         * Update amount if existed or create new
         */
        if ($this->isUpdateCartProduct($cartId, $productId, (int)$amountProduct) ||
            $this->isCreatedCartProduct($cartId, $productId, (int)$amountProduct)
        ) {
            return response()->json([
                'error' => false,
                'cart' => Cart::find($cartId),
            ]);
        }
    }

    private function isUpdateCartProduct($cartId, $productId, $amountProduct)
    {
        $cartExistedProd = CartProduct::where('cart_id', $cartId)
                                        ->where('product_id', $productId)
                                        ->first();
        if ($cartExistedProd) {
            try {
                return $this->isUpdateAmount($cartExistedProd, $amountProduct);

            } catch (Exception $err) {
                throw new Exception($err->getMessage());
            }
        }
        return false;
    }

    private function isUpdateAmount($cartProduct, $amountProduct)
    {
        $cartProduct->amount_product += $amountProduct;
        return $cartProduct->save();
    }

    private function isCreatedCartProduct($cartId, $productId, $amountProduct)
    {
        try {
            return CartProduct::create([
                'cart_id' => $cartId,
                'product_id' => $productId,
                'amount_product' => $amountProduct,
            ]);
        } catch (Exception $err) {
            throw new Exception($err->getMessage());
        }
    }

    public function show(CartProduct $cartProduct)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function edit(CartProduct $cartProduct)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function update(Request $request)
    {
        $productIds = $request->input('productIds');
        $amountProducts = $request->input('amountProducts');
        $prodsWithAmountInCart = array_combine($productIds, $amountProducts);

        if (!$this->isValidProducts($prodsWithAmountInCart)) {
            return response()->json([
                'error' => true,
                'message' => __('messages.err-update-mess', ['name' => 'product']),
            ]);
        }

        if ($this->isUpdateCartProducts($prodsWithAmountInCart)) {
            return response()->json([
                'error' => true,
                'message' => __('messages.succ-update-mess', ['name' => 'product']),
            ]);
        }
    }

    private function isValidProducts($prodsWithAmountInCart)
    {
        foreach ($prodsWithAmountInCart as $productId => $amountProduct) {
            if (!$this->isProductInTheStore($productId)) {
                return false;
            }
            // Validate amount and amount is integer
            if ((int)$amountProduct < 1 || (int)$amountProduct != $amountProduct) {
                return false;
            }
        }

        return true;
    }

    private function isUpdateCartProducts($prodsWithAmountInCart)
    {
        try {
            foreach ($prodsWithAmountInCart as $productId => $amountProduct) {
                $cartProduct = CartProduct::where('product_id', $productId)
                    ->where('cart_id', Auth::user()->cart->id)
                    ->first();

                $cartProduct->amount_product = $amountProduct;
                $cartProduct->save();

                /**
                 * Observer work on only save() method.
                 * And it's not working on function of query builder that you call by magic methods.
                 */
            }
        } catch (Exception $err) {
            throw new Exception($err->getMessage());
        }
        return true;
    }

    public function destroy($productId)
    {
        if (!$this->isProductInTheStore($productId)) {
            return redirect()->route('error.show', [
                'message' => 'Error product',
                'contentError' => __('messages.err-match-mess', ['object1' => 'Product', 'object2' => 'store']),
            ]);
        }

        try {
            CartProduct::where('product_id', $productId)
                ->where('cart_id', Auth::user()->cart->id)->first()->delete();
        } catch (Exception $err) {
            throw new Exception($err->getMessage());
        }

        // After deleted, CartProductObserver had triggered to update cart amount and total with updated function
        return redirect()->route('user.cart.products.list');
    }
}
