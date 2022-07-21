<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CategoryProductImport;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Services\Category\CategoryService;
use Maatwebsite\Excel\Validators\ValidationException;

class CategoryController extends Controller
{
    const DEFAULT_PAGINATE = 10;

    /**
     * Todo
     * Make explixit for all, remove Services
     */
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $isGotParent = false;
        return view('admin.category.list', [
            'title' => __('titles.list', ['name' => 'product-categories']),
            'categories' => $this->categoryService->get(self::DEFAULT_PAGINATE, $isGotParent),
        ]);
    }

    public function create()
    {
        return view('admin.category.add', [
            'title' => __('titles.add', ['name' => 'category']),
            'categories' => $this->categoryService->getParentCates(),
        ]);
    }

    public function destroy(Request $request)
    {
        try {
            Category::destroy($request->input('id'));

            return response()->json([
                'error' => false,
                'message' => __('messages.succ-del-mess', ['name' => 'category']),
            ]);
        } catch (Exception $err) {
            throw new Exception($err->getMessage());
        }
    }

    public function show(Category $category)
    {
        return view('admin.category.edit', [
            'title' => __('titles.edit', ['name' => $category->name]),
            'category' => $category,
            'categories' => $this->categoryService->get(self::DEFAULT_PAGINATE, null),
        ]);
    }

    public function update(Category $category, UpdateCategoryRequest $request)
    {
        try {
            $category->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'content' => $request->input('content'),
                'image' => $request->input('thumb'),
                'slug' => Str::slug($request->input('name')),
                'active' => $request->input('active') ? 1 : 0,
            ]);
        } catch (Exception $err) {
            return redirect()->route('admin.category.list')->withInput()->with('error', $err->getMessage());
        }
        return redirect()->route('admin.category.list')->with('success', __('messages.succ-edit-mess', ['name' => 'product category']));
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            Category::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'content' => $request->input('content'),
                'parent_id' => $request->input('parent_id'),
                'slug' => Str::slug($request->input('name')),
                'image' => $request->input('thumb'),
                'active' => $request->input('active') ? 1 : 0,
            ]);
        } catch (Exception $err) {
            return back()->withInput()->with('error', $err->getMessage());
        }

        return back()->with('success', __('messages.succ-add-mess', ['name' => 'product category']));
    }

    public function import(Request $request)
    {
        $request->validate(['products_and_categories' => 'required|mimes:xls,xlsx']);
        $import = new CategoryProductImport();

        try {
            Excel::import($import, $request->file('products_and_categories'));

            return back()->with([
                'success' => true,
                'message' => __('messages.add', ['name' => 'categories and products']),
            ]);

        } catch (ValidationException $err) {
            return back()->with(['failures' => $err->failures()]);

        } catch (Exception $err) {
            return back()->withErrors($err->getMessage());
        }
    }
}
