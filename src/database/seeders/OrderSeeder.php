<?php

namespace Database\Seeders;

use Exception;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    private $faker;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function __construct() {
        $this->faker = Faker::create();   
    }

    public function run()
    {
        // DB::table('orders')->delete();
        // DB::table('order_product')->delete();

        $this->insertAndPreventError($modelName = 'orders', 
                                    $data = $this->preparedOrderData($amount = 500));
    }
    
    private function preparedOrderData($amount)
    {
        $userIds = User::pluck('id');

        $orderData = [];
        for ($i = 0; $i < $amount; $i++) {
            $randomDay = Carbon::today()->subDays(rand(0, 365));

            array_push($orderData, [
                'amount_product' => $this->faker->numberBetween(10, 100),
                'total_price' => $this->faker->randomFloat(null, 500.00, 2000.00),
                'user_id' => $this->faker->randomElement($userIds),
                'status' => $this->faker->randomElement(['delivered']),
                'created_at' => $randomDay,
                'updated_at' => $randomDay,
            ]);

        }
        
        return $orderData;
    }

    private function insertAndPreventError($modelName, $data) {
        try {
            DB::table($modelName)->insert($data);
        } catch (Exception $err){}
    }
}
