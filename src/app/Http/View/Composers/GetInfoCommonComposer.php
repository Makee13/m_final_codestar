<?php

namespace App\Http\View\Composers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use App\Models\UserNotification;
use App\Models\WishsListProduct;
use Illuminate\Support\Facades\Auth;

class GetInfoCommonComposer
{
    const IS_READ = "read";
    const UN_READ = "unread";

    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $categories = Category::select('id', 'name', 'parent_id', 'slug')
                                ->where('active', 1)
                                ->whereIn('id', Product::where('active', Product::ACTIVE_STATUS)->pluck('category_id'))
                                ->get();
        $user = Auth::user();
        $amountWishsList = 0;
        $amountNotification = 0;
        if($user) {
            $amountWishsList = WishsListProduct::where('wishs_list_id', $user->wishsList->id)->count();
            $amountNotification = $user->userNotifications->where('is_read', self::UN_READ)->count();
        }

        $view->with([
            'categories' => $categories,
            'amountWishsList' => $amountWishsList,
            'amountNotification' => $amountNotification,
        ]);
    }
}
