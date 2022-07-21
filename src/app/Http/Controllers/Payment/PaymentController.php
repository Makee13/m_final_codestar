<?php

namespace App\Http\Controllers\Payment;

use Exception;
use Omnipay\Omnipay;
use App\Models\Order;
use App\Models\CartCoupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function pay()
    {
        $totalInCart = Auth::user()->cart->total;
        // Get coupon price 
        $amount = session('decreasedPrice') ?? $totalInCart;

        try {
            $response = $this->gateway->purchase([
                'amount' => $amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => route('user.orders.paypal.info'),
                'cancelUrl' => route('user.orders.paypal.error'),
            ])->send();

            if ($response->isRedirect()) {
                $response->redirect();

            } else {
                return $response->getMessage();
            }

        } catch (Exception $err) {
            throw new Exception($err->getMessage());
        }
    }

    public function handlePaySuccess(Request $request)
    {
        $transaction = null;
        if ($request->input('paymentId') && $request->input('PayerID')) {

            $transaction = $this->gateway->completePurchase([
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ])->send();
        }

        $response = $transaction ?? $transaction->send();

        if ($response->isSuccessful()) {
            $arrData = $response->getData();
            // Setup session to create order
            session([Order::ONLINE_PAID_STATUS => true]);

            if(Auth::user()->checkInValidAddress()) {
                return redirect()->route('user.cart.products.list')->with([
                    'alert' => 'danger',
                    'message' => __('Please fill full your address!!!')
                ]);
            }
    
            if (!Order::createOrderAndProductOrder()) {
                return redirect()->route('user.cart.products.list')->with([
                    'alert' => 'danger',
                    'message' => __('messages.err-add-mess', ['name' => 'order']),
                ]);
            }
    
            // Add cartcoupon and reset sessions
            // session coupon_id are created when user uses true coupon 
            if (session('coupon_id')) {
                CartCoupon::create([
                    'cart_id' => Auth::user()->cart->id,
                    'coupon_id' => session('coupon_id')
                ]);
    
                session()->forget('coupon_id');
            }
    
            session()->forget(Order::ONLINE_PAID_STATUS);
            return redirect()->route('user.cart.products.list')->with([
                'alert' => 'success',
                'message' => __('messages.succ-add-mess', ['name' => 'order']),
            ]);            
        }
    }

    public function handlePayError()
    {
        return redirect()->route('user.cart.products.list')->with([
            'alert' => 'danger',
            'message' => __('messages.err-add-mess', ['name' => 'order']),
        ]);
    }
}
