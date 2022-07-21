<?php

namespace App\Imports;

use App\Imports\CategoryProductSheetImport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CategoryProductImport implements WithMultipleSheets 
{
    public function sheets(): array
    {
        return [
            0 => new CategoryProductSheetImport()
        ];
    }
}

