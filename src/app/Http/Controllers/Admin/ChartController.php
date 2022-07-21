<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Charts\AreaOrderChart;
use App\Charts\UserSignupChart;
use App\Charts\TransactionChart;
use Illuminate\Support\Facades\DB;
use App\Charts\CategoryProductChart;
use App\Http\Controllers\Controller;
use App\Charts\DistrictAreaOrderChart;
use App\Charts\ProvinceAreaOrderGeoChart;

class ChartController extends Controller
{
    public function index()
    {
        $selectOfficialPrice = DB::raw("(CASE WHEN price_sale=null THEN price ELSE price_sale END) as officialPrice");

        // Setup and get  data for geo and pie charts 
        $provinceOrders = ProvinceAreaOrderGeoChart::getChartAndProvinceOrderCurMonth();
        DistrictAreaOrderChart::initialDistrictOrdersChart();

        return view('admin.home', [
            'title'                         => __('Analysis bussiness'),
            'chartTransaction'              => TransactionChart::getChartTransactionEachMonth(),
            'chartUserSignup'               => UserSignupChart::getChartUserSignUpEachMonth(),
            'areaOrder'                     => DistrictAreaOrderChart::getChartDistrictOrderEachMonth(),
            'amountOfUserSignupInMonth'     => User::whereRaw('MONTH(created_at) = MONTH(NOW()) AND YEAR(created_at) = YEAR(NOW())')->get()->count(),
            'transInMonth'                  => Order::whereRaw('MONTH(created_at) = MONTH(NOW()) AND YEAR(created_at) = YEAR(NOW())')->where('status', 'delivered')->get(),
            'soldProductPrice'              => DB::table('order_product')
                                                    ->select($selectOfficialPrice)
                                                    ->join('products', 'product_id', '=', 'products.id')
                                                    ->whereRaw('MONTH(order_product.created_at) = MONTH(NOW()) AND YEAR(order_product.created_at) = YEAR(NOW())')
                                                    ->get(),
            'provinceOrders'                => $provinceOrders,
        ]);
    }

    public function getDistrictOrdersChartInProvince($province) {
        return DistrictAreaOrderChart::getDistrictOrdersDttbInProvince($province);
    }

}
