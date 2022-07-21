<?php

namespace App\Charts;
use App\Models\Order;
use Khill\Lavacharts\Lavacharts;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DistrictAreaOrderChart
{
    /**
     * Get transactions in each area
     *
     * @return LaravelChart
     */
    public static function getChartDistrictOrderEachMonth()
    {
        $chart_options = [
            'chart_title'           => 'Amount transaction for each province/city',
            'chart_type'            => 'pie',
            'report_type'           => 'group_by_relationship',
            'model'                 => 'App\Models\Order',
            'where_raw'             => "status = 'delivered'",
            'relationship_name'     => 'user', // represents function orders() on User model
            'group_by_field'        => 'district', // users.province
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'total_price',
            'filter_field'          => 'orders.created_at',
            'filter_period'         => 'month', // show only transactions for this month
        ];

        return new LaravelChart($chart_options);
    }

    public static function initialDistrictOrdersChart() {
        $districtOrderDttb = \Lava::DataTable();
        
        $districtOrderDttb->addStringColumn('District')
                            ->addNumberColumn('Total amount of products');

        \Lava::PieChart('District Orders', $districtOrderDttb, [    
            'width' => 500,
            'is3D'   => true,
            'backgroundColor' =>'#f1f1f1'
        ]);
    }

    public static function getDistrictOrdersDttbInProvince($province) {
        $districtOrderDttb = \Lava::DataTable();
        
        $districtOrders = Order::getAmountOfDistrictOrdersInProvice($province);
        $districtOrderDttb->addStringColumn('District')
                            ->addNumberColumn('Total amount of products')
                            ->addRows($districtOrders);

        \Lava::GeoChart('District Orders', $districtOrderDttb, []);
        
        return $districtOrderDttb->toJson();
    }
}
