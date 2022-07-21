<?php

namespace App\Helpers;

class Helper
{
    public static function menu($categories, $parent_id = 0, $char = '')
    {
        $html = '';

        foreach ($categories as $key => $category) {
            if ($category->parent_id == $parent_id) {
                $active = self::active($category->active);
                $delFunction = '"removeRow(' . $category->id . ',\'/admin/category/destroy\')" ';
                $html .= "
                    <tr>
                        <td style='width: 50px'>$category->id</td>
                        <td>$char $category->name</td>
                        <td>
                            <a href='$category->image' target='_blank'>
                                <img src='$category->image' alt='Category image' width='100px'>
                            </a>
                        </td>
                        <td>$active</td>
                        <td>$category->updated_at</td>
                        <td style='width: 50px'>
                            <a class='btn btn-primary btn-sm' href='/admin/category/edit/$category->id'><i class='fas fa-edit'></i></a>
                        </td>
                        <td style='width: 50px'>
                            <button class='btn btn-danger btn-sm' onClick=$delFunction><i class='fas fa-trash'></i></button>
                        </td>
                    </tr>
                ";

                unset($categories[$key]);

                $html .= self::menu($categories, $category->id, '|---');
            }
        }

        return $html;
    }

    public static function active($active = 0)
    {
        return $active === 0 ? '<span class="btn btn-danger btn-sm">NO</span>' : '<span class="btn btn-success btn-sm">YES</span>';
    }

    public static function getCates($cates, $parent_id = 0)
    {
        $html = '';
        foreach ($cates as $key => $cate) {
            if ($cate->parent_id == $parent_id) {
                $html .= "
                    <li>
                        <a href='/category/" . $cate->id . "-" . $cate->slug . "'>$cate->name</a>";
                if (self::hasChild($cates, $cate->id)) {
                    $html .= "<ul class='sub-menu'>";
                    $html .= self::getCates($cates, $cate->id);
                    $html .= "</ul>";
                }

                $html .= "
                    </li>
                ";
                unset($cate[$key]);
            }
        }
        return $html;
    }

    public static function hasChild($cates, $cate_id)
    {
        foreach ($cates as $cate) {
            if ($cate_id == $cate->parent_id) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get office price which be able to price or saled price
     *
     * @param float $price
     * @param float $priceSale
     * @return html
     */
    public static function getOfficePrice($price, $priceSale = 0)
    {
        $priceFormat = number_format($price);
        $priceSaleFormat = number_format($priceSale);
        if ($price != 0 && $priceSale != 0) {
            return "<div class='d-inline-block'>
                <span>$$priceSaleFormat</span> <s class='d-block'>$$priceFormat</s>
            </div>";
        }

        if ($priceSale == 0) {
            return $priceFormat;
        }

        return "<a href='/contact'>Contact</a>";
    }
}
