<?php

use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OffsController;
use App\Http\Controllers\ReturnGoodsController;
use App\Http\Controllers\AmadoController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
 */

// Register the typical authentication routes for an application.
Auth::routes();

Route::get('/',                         [PublicController::class, 'index']           )->name(PublicController::ROUTE_INDEX);

Route::get('/amado/about',              [AmadoController::class, 'about']            )->name(AmadoController::ROUTE_ABOUT);
Route::get('/amado/product',            [AmadoController::class, 'product']          )->name(AmadoController::ROUTE_PRODUCT);
Route::get('/amado/productDetail',      [AmadoController::class, 'productDetail']    )->name(AmadoController::ROUTE_PRODUCT_DETAIL);
Route::get('/amado/basket',             [AmadoController::class, 'basket']           )->name(AmadoController::ROUTE_BASKET);

Route::get('/how-it-work',              [PublicController::class, 'howItWork']       )->name(PublicController::ROUTE_HOW_IT_WORK);
Route::get('/policy',                   [PublicController::class, 'policy']          )->name(PublicController::ROUTE_POLICY);
Route::get('/cookie',                   [PublicController::class, 'cookie']          )->name(PublicController::ROUTE_COOKIE);

Route::get('/i/{nick}/{post}',          [InstructionController::class, 'payment']    )->name(InstructionController::ROUTE_PAYMENT);

Route::get('/transaction/success/{id}', [TransactionController::class, 'success']    )->name(TransactionController::ROUTE_SUCCESS);
Route::get('/transaction/error/{id}',   [TransactionController::class, 'error']      )->name(TransactionController::ROUTE_ERROR);

Route::get('/instruction/pdf/{id}',     [InstructionController::class, 'pdf']        )->name(InstructionController::ROUTE_PDF);

Route::get('/auth/google/redirect',     [SocialController::class, 'googleRedirect']  )->name(SocialController::ROUTE_GOOGLE_REDIRECT);
Route::get('/auth/facebook/redirect',   [SocialController::class, 'facebookRedirect'])->name(SocialController::ROUTE_FACEBOOK_REDIRECT);


Route::group(
    ['middleware' => 'auth'],
    function () {
        Route::get('/box',                       [PublicController::class, 'box']           )->name(PublicController::ROUTE_BOX);

        Route::get('/user/edit',                 [UserController::class, 'edit']              )->name(UserController::ROUTE_EDIT);
        Route::get('/user/password',             [UserController::class, 'password']          )->name(UserController::ROUTE_PASSWORD);

        Route::get('/instruction/create',        [InstructionController::class, 'create']     )->name(InstructionController::ROUTE_CREATE);
        Route::get('/instruction/list',          [InstructionController::class, 'list']       )->name(InstructionController::ROUTE_LIST);
        Route::get('/instruction/edit/{id}',     [InstructionController::class, 'edit']       )->name(InstructionController::ROUTE_EDIT);
        Route::get('/instruction/download/{id}', [InstructionController::class, 'download']   )->name(InstructionController::ROUTE_DOWNLOAD);

        Route::get('/product/create',            [ProductController::class, 'create']         )->name(ProductController::ROUTE_CREATE);
        Route::get('/product/create-type',       [ProductController::class, 'createType']     )->name(ProductController::ROUTE_CREATE_TYPE);
        Route::get('/product/remains',           [ProductController::class, 'remains']        )->name(ProductController::ROUTE_REMAINS);
        Route::get('/product/debtors',           [ProductController::class, 'debtors']        )->name(ProductController::ROUTE_DEBTORS);
        Route::get('/product/sales',             [ProductController::class, 'sales']          )->name(ProductController::ROUTE_SALES);
        Route::get('/product/entrance',          [ProductController::class, 'entrance']       )->name(ProductController::ROUTE_ENTRANCE);
        Route::get('/product/entranceCheck',     [ProductController::class, 'entranceCheck']  )->name(ProductController::ROUTE_ENTRANCE_CHECK);
        Route::get('/product/orders',            [OrderController::class, 'orders']           )->name(OrderController::ROUTE_ORDERS);

        Route::get('/offs/offs',                 [OffsController::class, 'offs']              )->name(OffsController::ROUTE_OFFS);
        Route::get('/offs/offsCheck',            [OffsController::class, 'offsCheck']         )->name(OffsController::ROUTE_OFFS_CHECK);

        Route::get('/returnGoods/returnGoods',             [ReturnGoodsController::class, 'returnGoods']              )->name(ReturnGoodsController::ROUTE_RETURN);
        Route::get('/returnGoods/returnGoodsCheck',        [ReturnGoodsController::class, 'returnGoodsCheck']         )->name(ReturnGoodsController::ROUTE_RETURN_CHECK);

        Route::get('/earning/list',              [EarningController::class, 'list']           )->name(EarningController::ROUTE_LIST);

        Route::get('/documentation/how-it-work', [DocumentationController::class, 'howItWork'])->name(DocumentationController::ROUTE_HOW_IT_WORK);
        Route::get('/documentation/policy',      [DocumentationController::class, 'policy']   )->name(DocumentationController::ROUTE_POLICY);
    }
);

Route::group(
    ['middleware' => 'admin.area'],
    function () {
        Route::get('/user/admin/list',        [UserController::class, 'adminList']       )->name(UserController::ROUTE_ADMIN_LIST);
        Route::get('/user/admin/user/{id}',   [UserController::class, 'adminUser']       )->name(UserController::ROUTE_ADMIN_USER);
        Route::get('/instruction/admin/list', [InstructionController::class, 'adminList'])->name(InstructionController::ROUTE_ADMIN_LIST);
        Route::get('/transaction/admin/list', [TransactionController::class, 'adminList'])->name(TransactionController::ROUTE_ADMIN_LIST);
        Route::get('/settings/admin/index',   [SettingsController::class, 'adminIndex']  )->name(SettingsController::ROUTE_ADMIN_INDEX);
    }
);
