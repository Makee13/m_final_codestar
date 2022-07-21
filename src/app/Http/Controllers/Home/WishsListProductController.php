<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWishsListProductRequest;
use App\Http\Requests\UpdateWishsListProductRequest;
use App\Models\WishsListProduct;
use Exception;

class WishsListProductController extends Controller
{
    public function index()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function create()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function store(StoreWishsListProductRequest $request)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function show(WishsListProduct $wishsListProduct)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function edit(WishsListProduct $wishsListProduct)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function update(UpdateWishsListProductRequest $request, WishsListProduct $wishsListProduct)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function destroy(WishsListProduct $wishsListProduct)
    {
        throw new Exception('The feature is not implemented!');
    }
}
