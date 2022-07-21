<?php

namespace App\Charts;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class UserSignupChart
{
    /**
     * Amount of User signup chart which include amount of all users who are sign up in month
     *
     * @return LaravelChart
     */
    public static function getChartUserSignUpEachMonth()
    {
        $chart_options = [
            'chart_title'       => 'Amount of users (users)',
            'report_type'       => 'group_by_date',
            'model'             => 'App\Models\User',
            'group_by_field'    => 'created_at',
            'group_by_period'   => 'day',
            'chart_type'        => 'bar',
            'aggregate_function'=> 'count',
            'aggregate_field'   => 'id',
            'filter_field'      => 'created_at',
            'filter_period'     => 'month',
            'continuous_time'   => true,
            'chart_color'       => '0, 0, 255',
        ];

        return new LaravelChart($chart_options);
    }
}
