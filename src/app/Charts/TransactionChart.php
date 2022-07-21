<?php

namespace App\Charts;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class TransactionChart
{
    /**
     * Transaction chart which include total transaction for each day in month and amount of product
     *
     * @return LaravelChart
     */
    public static function getChartTransactionEachMonth()
    {
        $total_chart_options = [
            'chart_title'       => 'Total ($)',
            'report_type'       => 'group_by_date',
            'model'             => 'App\Models\Order',
            'group_by_field'    => 'created_at',
            'group_by_period'   => 'day',
            'aggregate_function'=> 'sum',
            'aggregate_field'   => 'total_price',
            'chart_type'        => 'bar',
            'filter_field'      => 'created_at',
            'filter_period'     => 'month',
            'continuous_time'   => true,
            'chart_color'       => '75,192,192',
        ];

        $amount_chart_options = [
            'chart_title'       => 'Amount of products (products)',
            'report_type'       => 'group_by_date',
            'model'             => 'App\Models\Order',
            'group_by_field'    => 'created_at',
            'group_by_period'   => 'day',
            'aggregate_function'=> 'sum',
            'aggregate_field'   => 'amount_product',
            'chart_type'        => 'bar',
            'filter_field'      => 'created_at',
            'filter_period'     => 'month',
            'continuous_time'   => true,
            'chart_color'       => '255,99,132',
        ];

        return new LaravelChart($total_chart_options, $amount_chart_options);
    }
}
