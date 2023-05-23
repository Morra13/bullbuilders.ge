<?php

use App\Http\Controllers\Api\InstructionController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ValidationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SocialController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\BasketController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\EntranceController;
use App\Http\Controllers\Api\DebtorsController;
use App\Http\Controllers\Api\OffsController;
use App\Http\Controllers\Api\ReturnGoodsController;
use App\Http\Controllers\Enum\LangController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::post('/setLang',          [LangController::class, 'setLang']        )->name(LangController::ROUTE_SET_LANG);


Route::post('/validation/nick',          [ValidationController::class, 'nick']        )->name(ValidationController::ROUTE_NICK);
Route::post('/validation/email/exist',   [ValidationController::class, 'emailExist']  )->name(ValidationController::ROUTE_EMAIL_EXISTS);
Route::post('/validation/email/correct', [ValidationController::class, 'emailCorrect'])->name(ValidationController::ROUTE_EMAIL_CORRECT);
Route::post('/validation/password',      [ValidationController::class, 'password']    )->name(ValidationController::ROUTE_PASSWORD);

Route::post('/transaction/create',       [TransactionController::class, 'create']     )->name(TransactionController::ROUTE_CREATE);
Route::post('/transaction/success',      [TransactionController::class, 'success']    )->name(TransactionController::ROUTE_SUCCESS);
Route::post('/transaction/error',        [TransactionController::class, 'error']      )->name(TransactionController::ROUTE_ERROR);

Route::get('/auth/google/callback',      [SocialController::class, 'googleCallback']  )->name(SocialController::ROUTE_GOOGLE_CALLBACK);
Route::get('/auth/facebook/callback',    [SocialController::class, 'facebookCallback'])->name(SocialController::ROUTE_FACEBOOK_CALLBACK);

Route::group(
    ['middleware' => 'auth'],
    function () {
        Route::post('/user/update',                      [UserController::class, 'update']          )->name(UserController::ROUTE_UPDATE);
        Route::post('/user/role',                        [UserController::class, 'role']            )->name(UserController::ROUTE_ROLE);
        Route::post('/user/password',                    [UserController::class, 'password']        )->name(UserController::ROUTE_PASSWORD);
        Route::post('/user/avatar',                      [UserController::class, 'avatar']          )->name(UserController::ROUTE_AVATAR);
        Route::post('/user/validation/nick',             [ValidationController::class, 'nick']      )->name(ValidationController::ROUTE_USER_NICK);
        Route::post('/user/validation/email/exist',      [ValidationController::class, 'emailExist'])->name(ValidationController::ROUTE_USER_EMAIL_EXISTS);

        Route::post('/instruction/create',               [InstructionController::class, 'create']  )->name(InstructionController::ROUTE_CREATE);
        Route::post('/instruction/update',               [InstructionController::class, 'update']  )->name(InstructionController::ROUTE_UPDATE);
        Route::post('/instruction/status/{id}/{status}', [InstructionController::class, 'status']  )->name(InstructionController::ROUTE_STATUS);

        Route::post('/product/create',                   [ProductController::class, 'createProduct']    )->name(ProductController::ROUTE_CREATE_PRODUCT);
        Route::post('/product/create-type',              [ProductController::class, 'createType']       )->name(ProductController::ROUTE_CREATE_TYPE);
        Route::post('/product/update-product',           [ProductController::class, 'updateProduct']    )->name(ProductController::ROUTE_UPDATE_PRODUCT);

        Route::post('/basket/add',                       [BasketController::class, 'addInBasket']       )->name(BasketController::ROUTE_ADD_IN_BASKET);
        Route::post('/basket/update',                    [BasketController::class, 'updateBasket']      )->name(BasketController::ROUTE_UPDATE_BASKET);

        Route::post('/order/create',                     [OrderController::class, 'create']             )->name(OrderController::ROUTE_CREATE_ORDER);
        Route::post('/order/delete',                     [OrderController::class, 'delete']             )->name(OrderController::ROUTE_DELETE_ORDER);

        Route::post('/entrance/add',                     [EntranceController::class, 'addInEntrance']   )->name(EntranceController::ROUTE_ADD_IN_ENTRANCE);
        Route::post('/entrance/create',                  [EntranceController::class, 'createEntrance']  )->name(EntranceController::ROUTE_CREATE_ENTRANCE);
        Route::post('/entrance/update',                  [EntranceController::class, 'updateEntrance']  )->name(EntranceController::ROUTE_UPDATE_ENTRANCE);
        Route::post('/entrance/delete',                  [EntranceController::class, 'delete']          )->name(EntranceController::ROUTE_DELETE_ENTRANCE);

        Route::post('/offs/add',                         [OffsController::class, 'addInOffs']           )->name(OffsController::ROUTE_ADD_IN_OFFS);
        Route::post('/offs/create',                      [OffsController::class, 'createOffs']          )->name(OffsController::ROUTE_CREATE_OFFS);
        Route::post('/offs/update',                      [OffsController::class, 'updateOffs']          )->name(OffsController::ROUTE_UPDATE_OFFS);
        Route::post('/offs/delete',                      [OffsController::class, 'delete']              )->name(OffsController::ROUTE_DELETE_OFFS);

        Route::post('/return/add',                       [ReturnGoodsController::class, 'addInReturn']  )->name(ReturnGoodsController::ROUTE_ADD_IN_RETURN);
        Route::post('/return/create',                    [ReturnGoodsController::class, 'createReturn'] )->name(ReturnGoodsController::ROUTE_CREATE_RETURN);
        Route::post('/return/update',                    [ReturnGoodsController::class, 'updateReturn'] )->name(ReturnGoodsController::ROUTE_UPDATE_RETURN);
        Route::post('/return/delete',                    [ReturnGoodsController::class, 'delete']       )->name(ReturnGoodsController::ROUTE_DELETE_RETURN);

        Route::post('/debtors/payment',                  [DebtorsController::class, 'payment']          )->name(DebtorsController::ROUTE_DEBT_PAYMENT);
    }
);

Route::group(
    ['middleware' => 'admin.area'],
    function () {
        Route::post('/transaction/withdraw', [TransactionController::class, 'withdraw'])->name(TransactionController::ROUTE_WITHDRAW);
        Route::post('/settings/update',      [SettingsController::class, 'update']     )->name(SettingsController::ROUTE_UPDATE);
    }
);

