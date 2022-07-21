<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminReviewController extends Controller
{
    public function index()
    {
        return view('admin.review.reviews-product', ['title' => __('titles.list', ['name' => 'reviews-product'])]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'reply-content' => 'required',
            'product_id' => 'required|exists:reviews,product_id',
            'review_id' => 'required|exists:reviews,id',
        ]);

        Review::create([
            'content' => $request->input('reply-content'),
            'product_id' => $request->input('product_id'),
            'review_id' => $request->input('review_id'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.reviews.list')->with([
            'success' => true,
            'message' => __('messages.succ-add-mess', ['name' => 'reply']),
        ]);
    }

    public function destroy(Review $reply)
    {
        $reply->delete();

        return redirect()->route('admin.reviews.list')->with([
            'success' => true,
            'message' => __('messages.succ-del-mess', ['name' => 'reply']),
        ]);
    }
}
