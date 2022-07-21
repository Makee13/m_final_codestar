<?php

namespace App\Http\Controllers\Datatables;

use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AdminReviewDttbController
{
    public function showProducts()
    {
        $query = DB::table('products');

        return DataTables::of($query)
                            ->addColumn('image', function ($product) {
                                return "<img src='$product->thumb' alt='Product Image' width='50px'>";
                            })
                            ->addColumn('details_url', function ($product) {
                                return route('admin.reviews.showAllReviewsOfProduct', ['id' => $product->id]);
                            })
                            ->rawColumns(['details_url', 'image'])
                            ->make(true);
    }

    public function showAllReviewsOfProduct(Request $request)
    {
        $query = DB::table('reviews')->where('review_id', null)
            ->where('product_id', $request->input('id'))
            ->orderBy('created_at', 'DESC');

        return DataTables::of($query)
                            ->addColumn('reply', function ($review) {
                                $csrfToken = csrf_token();
                                $storeLink = route('admin.reviews.store');
                                return "
                                    <form action='$storeLink' method='POST' style='display: flex; align-items: center;'>
                                        <textarea name='reply-content' style='width: 100%;' rows='2'></textarea>
                                        <input type='hidden' name='_token' value='$csrfToken'>
                                        <input type='hidden' name='product_id' value='$review->product_id'>
                                        <input type='hidden' name='review_id' value='$review->id'>
                                        <button style='margin-left: 20px;' type='submit'>Reply</button>
                                    </form>
                                    ";
                            })
                            ->addColumn('created_at', function ($review) {
                                return Carbon::parse($review->created_at)->diffForHumans();
                            })
                            ->addColumn('replies_url', function ($review) {
                                return route('admin.replies.showAllRepliesOfReview', ['review' => $review->id]);
                            })
                            ->addColumn('replies-control', function ($review) {
                                return "<div class='d-flex justify-content-center align-items-center' style='height: 60px;'>
                                            <button class='replies-control btn-xs btn-primary' style='margin: auto;'>Show</button>
                                        </div>";
                            })
                            ->rawColumns(['reply', 'replies-control', 'created_at'])
                            ->make(true);
    }

    public function showAllRepliesOfReview(Review $review)
    {
        $query = $review->replies();

        return DataTables::of($query)
                            ->addColumn('created_at', function ($reply) {
                                return $reply->created_at->diffForHumans();
                            })
                            ->addColumn('destroy', function ($reply) {
                                $destroyLink = route('admin.replies.destroy', ['reply' => $reply->id]);
                                return "<div class='text-center'><a class='btn-xs btn-primary' href='$destroyLink'>Delete</a></div>";
                            })
                            ->rawColumns(['destroy', 'created_at'])
                            ->make(true);
    }
}
