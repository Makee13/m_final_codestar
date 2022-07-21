<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Order;
use App\Models\CartProduct;
use App\Models\OrderProduct;
use App\Observers\UserObserver;
use App\Observers\OrderObserver;
use App\Observers\CartProductObserver;
use App\Observers\OrderProductObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        CartProduct::observe(CartProductObserver::class);
        OrderProduct::observe(OrderProductObserver::class);
        Order::observe(OrderObserver::class);
    }
}
