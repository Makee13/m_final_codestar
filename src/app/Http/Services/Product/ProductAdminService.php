<?php
namespace App\Http\Services\Product;

use App\Http\Services\Service;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class ProductAdminService
{
    const LIMIT_AMOUNT = 12;
    const ACTIVE_STATUS = true;

    use Service;

    public function getActivedCates()
    {
        return $this->readWithActive(Category::class, self::ACTIVE_STATUS);
    }

    private function isValidPrices($request)
    {
        if ($request->price >= $request->price_sale) {
            return true;
        }

        return false;
    }

    /**
     * Get products with catgory, whole is sorted ASC and limit amount is 12
     *
     * @return array
     */
    public function getWithCates()
    {
        return Product::with('category')->orderBy('id', 'ASC')->paginate(self::LIMIT_AMOUNT);
    }

    public function store($request, $product)
    {
        if ($this->isValidPrices($request)) {
            try {
                $inputs                 = $request->input();
                $inputs['category_id']  = $request->input('category_id');
                $inputs['thumb']        = $request->input('thumb');
                $inputs['active']       = $request->input('active') === 'on' ? 1 : 0;

                $this->update($product, $inputs);

            } catch (\Exception $error) {
                return false;
            }
            return true;
        }
        Session::flash('message-err', 'The price must be less than sale price');
        return false;
    }

    public function destroy($request)
    {
        $result = $this->delete(Product::class, $request->input('id'));
        if ($result === true) {
            return true;
        }
        return false;
    }

    public function getAllActivedPro()
    {
        return Product::where('active', '1')->get();
    }

    /**
     * Get products with paginate amount is 12 and control products according to page
     *
     * @param [number] $page
     * @return array
     */
    public function getWithPaginate($page = 0, $sort = 'asc')
    {
        return Product::where('active', 1)
                        ->orderBy('price', $sort)
                        ->offset($page * self::LIMIT_AMOUNT)
                        ->take(self::LIMIT_AMOUNT)
                        ->get();
    }
}
