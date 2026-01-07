<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\LensTypeController;
use App\Http\Controllers\Admin\LensCoatingController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SupportMessageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ProfileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{slug}', [FrontendProductController::class, 'show'])->name('product.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [CartController::class, 'placeOrder'])->name('checkout.place');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/orders', [ProfileController::class, 'orders'])->name('profile.orders');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {

    // Auth
    Route::get('/login', [AdminAuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Protected Routes
    // Note: Add middleware('auth:admin') later once guard is set up
    Route::group(['middleware' => 'auth:admin'], function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Catalog
        Route::resource('brands', BrandController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('sub-categories', SubCategoryController::class);
        Route::resource('attributes', AttributeController::class);
        Route::resource('products', ProductController::class);

        // Optical
        Route::resource('lens-types', LensTypeController::class);
        Route::resource('lens-coatings', LensCoatingController::class);

        // Sales
        Route::resource('orders', OrderController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::resource('transactions', TransactionController::class)->only(['index', 'show']);
        Route::resource('coupons', CouponController::class);

        // Content
        Route::resource('sliders', SliderController::class);
        Route::resource('pages', PageController::class);

        // Support
        Route::resource('chats', ChatController::class)->only(['index', 'show', 'update']);
        Route::resource('reviews', ReviewController::class)->only(['index', 'destroy', 'update']);

        // Users
        Route::resource('users', UserController::class)->only(['index', 'show', 'update']);
        Route::resource('support-messages', SupportMessageController::class)->only(['index', 'show', 'destroy']);
        Route::get('unread-support-count', [App\Http\Controllers\Admin\SupportMessageController::class, 'getUnreadCount'])->name('support-messages.unread-count');
        Route::resource('admins', AdminAuthController::class); // Manage other admins

        // Settings
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
        Route::get('/settings/business', [SettingController::class, 'business'])->name('settings.business');
        Route::post('/settings/business', [SettingController::class, 'businessUpdate'])->name('settings.business.update');

    });
});
