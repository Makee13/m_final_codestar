<?php

namespace App\Charts;

use App\Models\Order;
use Khill\Lavacharts\Lavacharts;

class ProvinceAreaOrderGeoChart
{
    public static function getChartAndProvinceOrderCurMonth()
    {
        $provinceOrderDttb = \Lava::DataTable();
        
        $provinceOrders = Order::getAmountOfProvinceOrdersInMonth();
        $provinceOrderDttb->addStringColumn('Province')
                            ->addNumberColumn('Total amount of products')
                            ->addRows($provinceOrders);

        \Lava::GeoChart('Province Orders', $provinceOrderDttb, [
            'displayMode' => 'auto',
            'enableRegionInteractivity' => true,
            'keepAspectRatio' => true,
            'region' => 'US',
            'magnifyingGlass' => ['enable' => true, 'zoomFactor' => 7.5], //MagnifyingGlass Options
            'markerOpacity' => 1.0,
            'resolution' => 'provinces',
            'sizeAxis' => null,
            'events' => ['select' => 'selectHandler']
        ]);
        
        return $provinceOrders;
    }
}
