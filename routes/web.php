<?php

use App\Http\Controllers\Access\LoginController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Finance\PaymentController;
use App\Http\Controllers\Finance\ReceivablesController;
use App\Http\Controllers\Finance\TranferController;
use App\Http\Controllers\Finance\WalletController;
use App\Http\Controllers\Marketing\BannerController;
use App\Http\Controllers\Marketing\LinkController;
use App\Http\Controllers\Product\Categories\CategoriesController;
use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Product\ImageController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Sale\CouponController;
use App\Http\Controllers\Sale\OrderController;
use App\Http\Controllers\Sale\PdvController;
use App\Http\Controllers\User\UserController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    
    return redirect()->route('adm.login');
})->name('login');

Route::prefix('adm')->group(function () {

    //Access
    Route::get('/login', [LoginController::class, 'login'])->name('adm.login');
    Route::post('/logon', [LoginController::class, 'logon'])->name('adm.logon');

    Route::middleware('auth')->group(function () {

        //App
        Route::get('/app', [AppController::class, 'app'])->name('adm.app');
        Route::get('/search', [AppController::class, 'search'])->name('adm.search');

        //Order
        Route::get('/list-orders', [OrderController::class, 'listOrders'])->name('adm.list-orders');
        Route::post('/create-order', [OrderController::class, 'createOrder'])->name('adm.create-order');
        Route::post('/remove-order', [OrderController::class, 'deleteOrder'])->name('adm.remove-order');

        //PDV
        Route::get('/pdv', [PdvController::class, 'pdv'])->name('adm.pdv');
        Route::post('/add-pdv', [PdvController::class, 'addPdv'])->name('adm.add-pdv');
        Route::post('/remove-pdv', [PdvController::class, 'removePdv'])->name('adm.remove-pdv');

        //Coupons
        Route::get('/list-coupons', [CouponController::class, 'listCoupons'])->name('adm.list-coupons');
        Route::get('/view-coupon/{id}', [CouponController::class, 'viewCoupon'])->name('adm.view-coupon');
        Route::get('/create-coupon', [CouponController::class, 'createCoupon'])->name('adm.create-coupon');
        Route::post('/created-coupon', [CouponController::class, 'createdCoupon'])->name('adm.created-coupon');
        Route::post('/updated-coupon', [CouponController::class, 'updatedCoupon'])->name('adm.updated-coupon');
        Route::post('/deleted-coupon', [CouponController::class, 'deletedCoupon'])->name('adm.deleted-coupon');

        //Marketing
        Route::get('list-banners', [BannerController::class, 'banners'])->name('adm.list-banners');
        Route::post('created-banner', [BannerController::class, 'createdBanner'])->name('adm.created-banner');
        Route::post('deleted-banner', [BannerController::class, 'deletedbanner'])->name('adm.deleted-banner');
        Route::get('list-links', [LinkController::class, 'links'])->name('adm.list-links');
        Route::post('created-link', [LinkController::class, 'createdLink'])->name('adm.created-link');

        //Product
        Route::get('/list-product', [ProductController::class, 'listProduct'])->name('adm.list-product');
        Route::get('/view-product/{id}', [ProductController::class, 'viewProduct'])->name('adm.view-product');
        Route::post('/created-product', [ProductController::class, 'createdProduct'])->name('adm.created-product');
        Route::post('/updated-product', [ProductController::class, 'updatedProduct'])->name('adm.updated-product');
        Route::post('/deleted-product', [ProductController::class, 'deletedProduct'])->name('adm.deleted-product');
        Route::get('/copy-product/{id}', [ProductController::class, 'copyProduct'])->name('adm.copy-product');

        Route::post('/created-image', [ImageController::class, 'createdImage'])->name('adm.created-image');
        Route::post('/deleted-image', [ImageController::class, 'deletedImage'])->name('adm.deleted-image');

        Route::post('/created-product-category', [CategoryController::class, 'createdCategory'])->name('adm.created-product-category');
        Route::post('/deleted-product-category', [CategoryController::class, 'deletedCategory'])->name('adm.deleted-product-category');

        //Category
        Route::get('/list-categories', [CategoriesController::class, 'listCategories'])->name('adm.list-categories');
        Route::get('/view-category/{id}', [CategoriesController::class, 'viewCategory'])->name('adm.view-category');
        Route::get('/create-category', [CategoriesController::class, 'createCategory'])->name('adm.create-category');
        Route::post('/created-category', [CategoriesController::class, 'createdCategory'])->name('adm.created-category');
        Route::post('/updated-category', [CategoriesController::class, 'updatedCategory'])->name('adm.updated-category');
        Route::post('/deleted-category', [CategoriesController::class, 'deletedCategory'])->name('adm.deleted-category');

        //User
        Route::get('/profile', [UserController::class, 'profile'])->name('adm.profile');
        Route::get('/create-user', [UserController::class, 'createUser'])->name('adm.create-user');
        Route::post('/created-user', [UserController::class, 'createdUser'])->name('adm.created-user');
        Route::post('/update-user', [UserController::class, 'updateUser'])->name('adm.update-user');
        Route::get('/list-users/{type}', [UserController::class, 'listUsers'])->name('adm.list-users');
        Route::post('/deleted-user', [UserController::class, 'deletedUser'])->name('adm.deleted-user');
        Route::get('/view-user/{id}', [UserController::class, 'viewUser'])->name('adm.view-user');

        //Finance
        Route::get('/wallet', [WalletController::class, 'wallet'])->name('adm.wallet');
        Route::post('/transfer-wallet', [WalletController::class, 'transferWallet'])->name('adm.transfer-wallet');
        Route::get('/transfers', [TranferController::class, 'transfers'])->name('adm.transfers');
        Route::get('/payments', [PaymentController::class, 'payments'])->name('adm.payments');
        Route::get('/receivables', [ReceivablesController::class, 'receivables'])->name('adm.receivables');

        //Logout
        Route::get('/logout', [LoginController::class, 'logout'])->name('adm.logout');
    });
});