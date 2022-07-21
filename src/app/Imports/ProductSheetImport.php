<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductSheetImport implements OnEachRow, WithHeadingRow, WithValidation
{
    public function onRow(Row $row)
    {
        $row = $row->toArray();

        Product::create([
            'name'          =>    $row['prod_name'],
            'description'   =>    $row['prod_description'],
            'content'       =>    $row['prod_content'],
            'thumb'         =>    $row['prod_thumb'],
            'category_id'   =>    $row['prod_category_id'],
            'price'         =>    $row['prod_price'],
            'price_sale'    =>    $row['prod_price_sale'],
            'active'        =>    $row['prod_active'],
        ]);
    }

    public function rules(): array
    {
        return [
            'prod_category_id' => Rule::in(Category::pluck('id')),
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            'prod_category_id.in' => 'In list products that have category_id to relation which is invalid!',
        ];
    }
}
