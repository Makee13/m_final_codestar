<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;
use Exception;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function store(StoreReviewRequest $request)
    {
        Review::create([
            'content' => $request->input('content'),
            'product_id' => $request->input('product_id'),
            'user_id' => Auth::id(),
            'amount_of_stars' => $request->input('rating'),
        ]);

        return back()->with([
            'success' => true,
            'message' => __('messages.succ-add-mess', ['name' => 'review'])
        ]);
    }

    public function create()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function show(Review $review)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function edit(Review $review)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function destroy(Review $review)
    {
        throw new Exception('The feature is not implemented!');
    }
}
