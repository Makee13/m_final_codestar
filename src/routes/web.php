<?php

use App\Models\Order;
use App\Models\Product;
use Khsing\World\World;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\OrderController;
use App\Http\Controllers\SocialAuthController;

use App\Http\Controllers\UserLogoutController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\SignupController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Home\WishsListController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\PassResetByMailController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Home\CartProductController;
use App\Http\Controllers\Admin\AdminCouponController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\UploadImageController;
use App\Http\Controllers\EmailVerificationController;

use App\Http\Controllers\Home\NotificationController;
use App\Http\Controllers\MailResetPasswordController;
use App\Http\Controllers\Home\ProductDetailController;
use App\Http\Controllers\PassResetByPassTwoController;

use App\Http\Controllers\Admin\AdminCommunityController;
use App\Http\Controllers\Admin\PaginateProductController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Datatables\AdminUserDttbController;
use App\Http\Controllers\Datatables\AdminOrderDttbController;
use App\Http\Controllers\Datatables\AdminCouponDttbController;
use App\Http\Controllers\Datatables\AdminReviewDttbController;
use App\Http\Controllers\Home\HomeController as UserHomeController;
use App\Http\Controllers\Datatables\AdminNotificationDttbController;
use App\Http\Controllers\User\LoginController as UserLoginController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Home\ProductController as HomeProductController;
use App\Http\Controllers\Home\CategoryController as HomeCategoryController;

/**
 * -----------------------------------------------------------------------------------------------------
 * Home section                                                                                        |
 * -----------------------------------------------------------------------------------------------------
 */
Route::get('/', [UserHomeController::class, 'index'])->name('home');

Route::get('category/{id}-{slug}', [HomeCategoryController::class, 'show'])->name('home.category.show');

Route::get('product/detail/{product}', [ProductDetailController::class, 'show'])->name('home.product-detail.show');
Route::post('product/{product}', [HomeProductController::class, 'show'])->name('home.product.show');

Route::post('services/load-product', [PaginateProductController::class, 'show'])->name('services.product.show');

Route::get('error', [ErrorController::class, 'show'])->name('error.show');

Route::get('about', [AboutController::class, '__invoke'])->name('about.invoke');

/**
 * -----------------------------------------------------------------------------------------------------
 * Admin section                                                                                       |
 * -----------------------------------------------------------------------------------------------------
 */

// Admin Login
Route::get('admin/login/create', [AdminLoginController::class, 'create'])->name('admin.login.create');
Route::post('admin/login/store', [AdminLoginController::class, 'store'])->name('admin.login.store');

Route::middleware(['admin.auth'])->group(function () {

    // Home
    Route::get('admin', [ChartController::class, 'index'])->name('admin');

    // Orders
    Route::get('admin/orders/list', [AdminOrderController::class, 'index'])->name('admin.orders.list');
    Route::get('admin/orders/edit/{order}-{delivered}', [AdminOrderController::class, 'update'])->name('admin.orders.update');
    Route::get('admin/orders/destroy/{order}', [AdminOrderController::class, 'destroy'])->name('admin.orders.destroy');
    Route::get('admin/orders', [AdminOrderDttbController::class, 'getMasterOrders'])->name('admin.orders');
    Route::get('admin/orders/get-details/{id}', [AdminOrderDttbController::class, 'getDetailOrders'])->name('admin.orders.get-details');

    // Category
    Route::get('admin/category/list', [CategoryController::class, 'index'])->name('admin.category.list');
    Route::get('admin/category/add', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('admin/category/add', [CategoryController::class, 'store']);
    Route::get('admin/category/edit/{category}', [CategoryController::class, 'show']);
    Route::post('admin/category/edit/{category}', [CategoryController::class, 'update']);
    Route::delete('admin/category/destroy', [CategoryController::class, 'destroy']);
    Route::post('admin/category/product/import', [CategoryController::class, 'import'])->name('admin.category.product.import');

    // Product
    Route::get('admin/product/list', [ProductController::class, 'index'])->name('admin.product.list');
    Route::get('admin/product/add', [ProductController::class, 'create'])->name('admin.product.create');
    Route::post('admin/product/add', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('admin/product/edit/{product}', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::post('admin/product/edit/{product}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::delete('admin/product/destroy', [ProductController::class, 'destroy'])->name('admin.product.destroy');

    // Slider
    Route::get('admin/slider/list', [SliderController::class, 'index'])->name('admin.slider.list');
    Route::get('admin/slider/add', [SliderController::class, 'create'])->name('admin.slider.create');
    Route::post('admin/slider/add', [SliderController::class, 'store'])->name('admin.slider.store');
    /** Todo: show?edit */
    Route::get('admin/slider/edit/{slider}', [SliderController::class, 'show'])->name('admin.slider.edit');
    Route::post('admin/slider/edit/{slider}', [SliderController::class, 'update'])->name('admin.slider.update');
    Route::delete('admin/slider/destroy', [SliderController::class, 'destroy'])->name('admin.slider.destroy');

    // Coupon
    Route::get('admin/coupon/list', [AdminCouponController::class, 'index'])->name('admin.coupon.list');

    Route::get('admin/coupon/add', [AdminCouponController::class, 'create'])->name('admin.coupon.create');
    Route::post('admin/coupon/add', [AdminCouponController::class, 'store'])->name('admin.coupon.store');
    Route::get('admin/coupon/edit/{coupon}', [AdminCouponController::class, 'edit'])->name('admin.coupon.edit');
    Route::post('admin/coupon/edit/{coupon}', [AdminCouponController::class, 'update'])->name('admin.coupon.update');
    Route::get('admin/coupon/destroy/{coupon}', [AdminCouponController::class, 'destroy'])->name('admin.coupon.destroy');
    Route::get('admin/coupon/show/{id}', [AdminCouponController::class, 'show'])->name('admin.coupon.show');
    Route::get('admin/coupon/list/show', [AdminCouponDttbController::class, 'showAll'])->name('admin.coupon.showAll');

    // Upload
    Route::post('admin/upload/services', [UploadImageController::class, 'store']);

    // Logout
    Route::post('admin/logout', [UserLogoutController::class, '__invoke'])->name('admin.logout.invoke');

    // Notification
    Route::get('admin/notifications/list', [AdminNotificationController::class, 'index'])->name('admin.notifications.list');
    Route::get('admin/notifications/add', [AdminNotificationController::class, 'create'])->name('admin.notifications.create');
    Route::post('admin/notifications/add', [AdminNotificationController::class, 'store'])->name('admin.notifications.store');
    Route::get('admin/notifications/edit/{notification}', [AdminNotificationController::class, 'show'])->name('admin.notifications.edit');
    Route::post('admin/notifications/edit/{notification}', [AdminNotificationController::class, 'update'])->name('admin.notifications.update');
    Route::get('admin/notifications/destroy/{notification}', [AdminNotificationController::class, 'destroy'])->name('admin.notifications.destroy');
    Route::get('admin/notifications/list/show', [AdminNotificationDttbController::class, 'showAll'])->name('admin.notifications.showAll');

    // Review
    Route::get('admin/reviews/list', [AdminReviewController::class, 'index'])->name('admin.reviews.list');
    Route::post('admin/reviews/add', [AdminReviewController::class, 'store'])->name('admin.reviews.store');
    Route::get('admin/replies/destroy/{reply}', [AdminReviewController::class, 'destroy'])->name('admin.replies.destroy');
    Route::post('admin/reviews/product/{review}', [AdminReviewController::class, 'update'])->name('admin.reviews.update');
    Route::get('admin/reviews/destroy/{review}', [AdminReviewController::class, 'destroy'])->name('admin.reviews.destroy');
    Route::get('admin/reviews/list/show', [AdminReviewDttbController::class, 'showProducts'])->name('admin.reviews.showAll');
    Route::get('admin/reviews/product/show', [AdminReviewDttbController::class, 'showAllReviewsOfProduct'])->name('admin.reviews.showAllReviewsOfProduct');
    Route::get('admin/replies/show/{review}', [AdminReviewDttbController::class, 'showAllRepliesOfReview'])->name('admin.replies.showAllRepliesOfReview');

    // User
    Route::get('admin/users/list', [AdminUserController::class, 'index'])->name('admin.users.list');
    Route::post('admin/users/update', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::get('admin/users/update', [AdminUserController::class, 'updateUnBlock'])->name('admin.users.updateUnBlock');
    Route::get('admin/users/list/show', [AdminUserDttbController::class, 'showAllUsers'])->name('admin.users.showAllUsers');

    Route::get('admin/community', [AdminCommunityController::class, '__invoke'])->name('admin.community');

    // Chart
    Route::get('admin/orders/district-chart/show/{province}', [ChartController::class, 'getDistrictOrdersChartInProvince'])->name('admin.orders.district-chart.show');
});

/**
 * -----------------------------------------------------------------------------------------------------
 * User section                                                                                        |
 * -----------------------------------------------------------------------------------------------------
 */
Route::get('sign/', [UserLoginController::class, 'index'])->name('user.sign');
Route::post('sign/sign-in', [UserLoginController::class, 'store'])->middleware('user.check-block');
Route::post('sign/sign-up', [SignupController::class, 'store']);
Route::post('sign/sign-out', [UserLogoutController::class, '__invoke']);

Route::middleware(['user.auth', 'verified', 'user.check-block'])->group(function () {
    // Profile
    Route::get('profile/info', [ProfileController::class, 'create'])->name('user.profile.info.create');
    Route::post('profile/info', [ProfileController::class, 'store']);

    Route::get('profile/change-password', [ProfileController::class, 'createCPass']);
    Route::post('profile/change-password', [ProfileController::class, 'storeCPass']);

    Route::get('profile/more-secure', [ProfileController::class, 'createMoreSecure']);
    Route::post('profile/more-secure', [ProfileController::class, 'storeMoreSecure']);

    // Cart
    Route::get('cart/{cart}', [CartController::class, 'show'])->name('user.cart.products.show');
    Route::get('cart/products/list', [CartController::class, 'index'])->name('user.cart.products.list');

    Route::post('cart', [CartProductController::class, 'store'])->name('user.cart.product.store');
    Route::get('cart/product/{productId}', [CartProductController::class, 'destroy'])->name('user.cart.product.destroy');
    Route::post('cart/products/edit', [CartProductController::class, 'update'])->name('user.cart.products.update');

    // Order
    Route::get('orders/list', [OrderController::class, 'index'])->name('user.orders.list');
    Route::post('orders', [OrderController::class, 'store'])->name('user.orders.store');

    Route::post('paypal-orders', [PaymentController::class, 'pay'])->name('user.orders.paypal.store');
    Route::get('paypal-orders/handle-success', [PaymentController::class, 'handlePaySuccess'])->name('user.orders.paypal.info');
    Route::get('paypal-orders/handle-error', [PaymentController::class, 'handlePayError'])->name('user.orders.paypal.error');

    // WishsList
    Route::get('wishs-list/list', [WishsListController::class, 'index'])->name('wishs-list.list');
    Route::get('wishs-list/add', [WishsListController::class, 'create'])->name('wishs-list.create');
    Route::post('wishs-list/add', [WishsListController::class, 'store'])->name('wishs-list.store');
    Route::get('wishs-list/edit/{wishs-list}', [WishsListController::class, 'edit'])->name('wishs-list.edit');
    Route::post('wishs-list/edit/{wishs-list}', [WishsListController::class, 'update'])->name('wishs-list.update');
    Route::get('wishs-list/destroy/{productId}', [WishsListController::class, 'destroy'])->name('wishs-list.destroy');

    // Review
    Route::get('reviews/list', [ReviewController::class, 'index'])->name('reviews.list');
    Route::post('reviews/add', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('reviews/edit/{reviews}', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::post('reviews/edit/{reviews}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::get('reviews/destroy/{productId}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Notification
    Route::get('notifications/list', [NotificationController::class, 'index'])->name('notifications.list');
    Route::post('notifications/add', [NotificationController::class, 'store'])->name('notifications.store');
    Route::get('notifications/edit', [NotificationController::class, 'update'])->name('notifications.update');
    Route::get('notifications/destroy/{productId}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

    // Message
    Route::get('messages/list', [MessageController::class, 'index'])->name('messages.list');
});

/**
 * -----------------------------------------------------------------------------------------------------
 * Reset pass section                                                                                  |
 * -----------------------------------------------------------------------------------------------------
 */
// By Password level 2
Route::post('password/reset', [PassResetByPassTwoController::class, 'store']);

// By Mail
Route::post('password/forgot', [MailResetPasswordController::class, '__invoke']);
Route::get('password/reset/bymail', [PassResetByMailController::class, 'create'])->name('password.reset.create');
Route::post('password/reset/bymail', [PassResetByMailController::class, 'store'])->name('password.reset.store');

/**
 * -----------------------------------------------------------------------------------------------------
 * Verify account section                                                                               |
 * -----------------------------------------------------------------------------------------------------
 */
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

// Resend Notification
Route::get('/email/verification-notification', [EmailVerificationController::class, 'send'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');
/**
 * -----------------------------------------------------------------------------------------------------
 * Social auth section                                                                                  |
 * -----------------------------------------------------------------------------------------------------
 */

// Redirecting the user to the OAuth provider
Route::get('/auth/redirect/{social}', [SocialAuthController::class, 'verify'])->name('social.verify');

// Receiving the callback from the provider after authentication
Route::get('/auth/callback/{social}', [SocialAuthController::class, 'handleProviderCallback'])->name('social.handleCallback');

/**
 * -----------------------------------------------------------------------------------------------------
 * Test section                                                                                         |
 * -----------------------------------------------------------------------------------------------------
 */
Route::get('test', function () {
    return Order::getAmountOfDistrictOrdersInProvice('Wyoming');
});
