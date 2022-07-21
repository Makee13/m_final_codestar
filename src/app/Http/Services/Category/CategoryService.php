<?php

namespace App\Http\Services\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Services\Service;

class CategoryService
{
    const PARENT_ID = 0;
    const DEFAULT_AMOUNT = 20;
    const DEFAULT_PAGINATE_VALUE = 10;

    use Service;

    /**
     * Get parent categories
     *
     * @return array
     */
    public function getParentCates()
    {
        return Category::where('parent_id', self::PARENT_ID)->get();
    }

    public function insert($request)
    {
        try {
            $inputs = $request->input();
            $inputs['slug'] = Str::slug($request->input('name'), '-');
            $inputs['active'] = $request->input('active') === 'on' ? 1 : 0;

            $this->create(Category::class, $inputs);
        } catch (\Exception $err) {
            return $err->getMessage();
        }

        return true;
    }

    /**
     * Get categories is parent or not with paginate default 20,
     * You can config paginate value with amount parameter
     *
     * @param [number] $amount
     * @param [boolean] $isGotParent
     * @return array
     */
    public function get($amount, $isGotParent)
    {
        if ($isGotParent) {
            return Category::where('parent_id', self::PARENT_ID)
                            ->where('active', 1)
                            ->paginate($amount ?? self::DEFAULT_PAGINATE_VALUE)
                            ->withQueryString();
        }
        return Category::paginate($amount ?? self::DEFAULT_PAGINATE_VALUE)->withQueryString();
    }

    /**
     * Destroy with child categories which have parent is requested or parent categories
     *
     * @param [Request] $request
     * @return boolean
     */
    public function destroy($request)
    {
        $categoryId = $request->id;
        $category = Category::where('id', $categoryId)->first();
        if ($category) {
            Category::where('id', $categoryId)->orWhere('parent_id', $categoryId)->delete();
            return true;
        }

        return false;
    }

    public function store($category, $request): bool
    {
        try {
            $inputs = $request->input();
            $inputs['slug'] = Str::slug($request->input('name'), '-');
            $inputs['active'] = $request->input('active') === 'on' ? 1 : 0;

            $this->update($category, $inputs);
        } catch (\Exception $err) {
            return $err->getMessage();
        }
        return true;
    }

    /**
     * Get category by id and slug
     *
     * @param [number] $id
     * @param [string] $slug
     * @return Category
     */
    public function getByIdAndSlug($id, $slug)
    {
        return Category::where(['id' => $id, 'active' => 1, 'slug' => $slug])->firstOrFail();
    }

    /**
     * Get 20 active products which belong to category with sort or not
     *
     * @param [Category] $cate
     * @param ['asc', 'desc'] $sort
     * @return array
     */
    public function getProducts($cate, $sort)
    {
        $query = $cate->products()
            ->select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1);
        if (in_array($sort, ['asc', 'desc'])) {
            $query->orderBy('price', $sort);
        }

        return $query->paginate(self::DEFAULT_PAGINATE_VALUE)->withQueryString();
    }
}
