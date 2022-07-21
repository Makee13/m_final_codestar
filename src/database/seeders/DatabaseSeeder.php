<?php

namespace Database\Seeders;

use Exception;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Review;
use App\Models\Slider;
use App\Models\Message;
use App\Models\Product;
use App\Models\Category;
use App\Models\CartProduct;
use App\Models\Notification;
use App\Models\OrderProduct;
use Illuminate\Database\Seeder;
use App\Models\UserNotification;
use App\Models\WishsListProduct;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->factorySeedAndPreventError(User::class,             $amount = 1000);
        $this->factorySeedAndPreventError(Notification::class,     $amount = 100);
        $this->factorySeedAndPreventError(Slider::class,           $amount = 3);
        $this->factorySeedAndPreventError(Message::class,          $amount = 100);
        $this->factorySeedAndPreventError(Coupon::class,           $amount = 100);
        $this->factorySeedAndPreventError(Category::class,         $amount = 8);
        $this->factorySeedAndPreventError(Product::class,          $amount = 13);
        $this->factorySeedAndPreventError(Review::class,           $amount = 100);
        $this->factorySeedAndPreventError(UserNotification::class, $amount = 100);
        $this->factorySeedAndPreventError(WishsListProduct::class, $amount = 100);
        $this->factorySeedAndPreventError(CartProduct::class,      $amount = 100);
        // Not be able to use with created that call to observer("error will be returned")
        // Default OrderSeeder amount is 500 records
        $this->call([OrderSeeder::class]);
        $this->factorySeedAndPreventError(OrderProduct::class,      $amount = 500);
    }

    public function factorySeedAndPreventError($model, $amount) {
        try {
             $model::factory($amount)->create();
        } catch(Exception $err) {}
    }
}
