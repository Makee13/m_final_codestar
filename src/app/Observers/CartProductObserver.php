<?php

namespace App\Observers;

use App\Models\Cart;
use App\Models\CartProduct;

class CartProductObserver
{
    const CREATED_ACTION = 'create';
    const INCREASE_UPDATING_ACTION = 'update_to_increase';
    const DECREASE_UPDATING_ACTION = 'update_to_decrease';
    const DELETED_ACTION = 'delete';

    private function getOfficialPrice($product)
    {
        return $product->price_sale == 0 ? $product->price : $product->price_sale;
    }

    private function updateCartDependOn($cartProduct, $action = self::CREATED_ACTION)
    {
        $cart = $cartProduct->cart;
        $product = $cartProduct->product;

        $officePrice = $this->getOfficialPrice($product);
        $oldAmount = $cartProduct->getRawOriginal('amount_product');
        $newAmount = $cartProduct->amount_product;

        switch ($action) {
            case self::CREATED_ACTION:
                $cart->amount_product += $cartProduct->amount_product;
                $cart->total += ($officePrice * $cartProduct->amount_product);
                break;

            case self::INCREASE_UPDATING_ACTION:
                $cart->amount_product += ($newAmount - $oldAmount);
                $cart->total += ($officePrice * (($newAmount - $oldAmount)));
                break;

            case self::DECREASE_UPDATING_ACTION:
                $cart->amount_product -= ($oldAmount - $newAmount);
                $cart->total -= ($officePrice * ($oldAmount - $newAmount));
                break;

            case self::DELETED_ACTION:
                $cart->amount_product -= $cartProduct->amount_product;
                $cart->total -= ($officePrice * $cartProduct->amount_product);
                break;
            default:
                break;
        }

        $cart->save();
    }

    /**
     * Handle the CartProduct "created" event.
     *
     * @param  \App\Models\CartProduct  $cartProduct
     * @return void
     */
    public function created(CartProduct $cartProduct)
    {
        $this->updateCartDependOn($cartProduct);
    }

    /**
     * Handle the CartProduct "updated" event.
     *
     * @param  \App\Models\CartProduct  $cartProduct
     * @return void
     */
    public function updated(CartProduct $cartProduct)
    {
        if ($cartProduct->isDirty('amount_product')) {
            $isIncrease = $cartProduct->amount_product > $cartProduct->getOriginal('amount_product');

            if ($isIncrease) {
                $this->updateCartDependOn($cartProduct, self::INCREASE_UPDATING_ACTION);
            } else {
                $this->updateCartDependOn($cartProduct, self::DECREASE_UPDATING_ACTION);
            }
        }
    }

    /**
     * Handle the CartProduct "deleted" event.
     *
     * @param  \App\Models\CartProduct  $cartProduct
     * @return void
     */
    public function deleted(CartProduct $cartProduct)
    {
        $this->updateCartDependOn($cartProduct, self::DELETED_ACTION);
    }

    /**
     * Handle the CartProduct "restored" event.
     *
     * @param  \App\Models\CartProduct  $cartProduct
     * @return void
     */
    public function restored(CartProduct $cartProduct)
    {

    }

    /**
     * Handle the CartProduct "force deleted" event.
     *
     * @param  \App\Models\CartProduct  $cartProduct
     * @return void
     */
    public function forceDeleted(CartProduct $cartProduct)
    {
        $this->updateCartDependOn($cartProduct, self::DELETED_ACTION);
    }
}
