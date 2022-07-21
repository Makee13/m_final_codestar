<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Row;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CategoryProductSheetImport implements OnEachRow, WithHeadingRow, WithValidation
{
    const BASE_PARENT_ID = 0;

    public function onRow(Row $row)
    {
        $row = $row->toArray();

        $category = Category::firstOrCreate(
            ['name'          =>  $row['category_name']],
            [            
                'description'   =>  $row['category_desc'],
                'content'       =>  $row['category_content'],
                'image'         =>  Category::IMAGE_DEFAULT,
                'slug'          =>  Str::slug($row['category_name']),
                'active'        =>  $row['category_active'],
                'parent_id'     =>  $row['category_parent_id'],
            ]
        );

        Product::create([
            'name'              => $row['prod_name'],
            'description'       => $row['prod_description'],
            'content'           => $row['prod_content'],
            'thumb'             => Product::IMAGE_DEFAULT,
            'category_id'       => $category->id,
            'price'             => $row['prod_price'],
            'price_sale'        => $row['prod_price_sale'],
            'active'            => $row['prod_active']
        ]);
    }

    public function rules(): array
    {
        $parentIds = Category::pluck('id')->all();
        array_push($parentIds, self::BASE_PARENT_ID);

        return [
            'cate_parent_id'  => Rule::in($parentIds)
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            'cate_parent_id.in' => "In list products that haven't category to add to insert parent id",
        ];
    }
}
