<?php

namespace App\Charts;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class CategoryProductChart
{
    /**
     * Get amount of products in each category
     *
     * @return LaravelChart
     */
    public static function getChartCateProdEachMonth()
    {
        /**
         * The feature is in the implementation process 
         */
        // $chart_options = [
            // 'chart_title' => 'Amount transaction for product in category',
            // 'chart_type' => 'pie',
            // 'report_type' => 'group_by_relationship',
            // 'model' => 'App\Models\Category',
            
            // 'relationship_name' => 'products', // represents function product() on OrderProduct model
            // 'group_by_field' => 'categories.name', // users.name
            
            // 'relationship_name' => '', // represents function category() on OrderProduct model
            
            // 'aggregate_function' => 'sum',
            // 'aggregate_field' => 'amount_product',
            
            // 'group_by_field' => 'category_id',
            // 'group_by_period' => 'day',
            // 'chart_type' => 'bar',
            // 'filter_field' => 'created_at',
            // 'filter_period' => 'month',
            // 'continuous_time' => true,
            // 'chart_color' => '100, 100, 150',
        // ];

        // return new LaravelChart($chart_options);
    }
}
