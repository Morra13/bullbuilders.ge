<?php

use App\Http\Controllers\Api\InstructionController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ValidationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SocialController;
use App\Http\Controllers\Api\BasketController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\EntranceController;
use App\Http\Controllers\Api\DebtorsController;
use App\Http\Controllers\Api\OffsController;
use App\Http\Controllers\Api\ReturnGoodsController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\ReviewsController;
use App\Http\Controllers\Api\ProjectsController;
use App\Http\Controllers\Api\PartnersController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\CharityController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/


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
        Route::post('/staff/create',                     [StaffController::class, 'createStaff']            )->name(StaffController::ROUTE_CREATE_STAFF);
        Route::post('/staff/update',                     [StaffController::class, 'staffUpdate']            )->name(StaffController::ROUTE_STAFF_UPDATE);
        Route::get ('/staff/delete/{id}',                [StaffController::class, 'staffDelete']            )->name(StaffController::ROUTE_STAFF_DELETE);
        Route::post('/reviews/create',                   [ReviewsController::class, 'createReviews']        )->name(ReviewsController::ROUTE_CREATE_REVIEWS);
        Route::post('/reviews/update',                   [ReviewsController::class, 'reviewsUpdate']        )->name(ReviewsController::ROUTE_REVIEWS_UPDATE);
        Route::get ('/reviews/delete/{id}',              [ReviewsController::class, 'reviewsDelete']        )->name(ReviewsController::ROUTE_REVIEWS_DELETE);
        Route::post('/project/create',                   [ProjectsController::class, 'createProject']       )->name(ProjectsController::ROUTE_CREATE_PROJECT);
        Route::post('/project/update',                   [ProjectsController::class, 'projectUpdate']       )->name(ProjectsController::ROUTE_PROJECT_UPDATE);
        Route::get ('/project/delete/{id}',              [ProjectsController::class, 'projectDelete']       )->name(ProjectsController::ROUTE_PROJECT_DELETE);
        Route::post('/project/img/update/{id}',          [ProjectsController::class, 'projectUpdateImg']    )->name(ProjectsController::ROUTE_PROJECT_UPDATE_IMG);
        Route::get ('/project/img/delete/{id}',          [ProjectsController::class, 'projectImgDelete']    )->name(ProjectsController::ROUTE_PROJECT_IMG_DELETE);
        Route::post('/partners/create',                  [PartnersController::class, 'createPartner']       )->name(PartnersController::ROUTE_CREATE_PARTNER);
        Route::post('/partners/update',                  [PartnersController::class, 'partnerUpdate']       )->name(PartnersController::ROUTE_PARTNER_UPDATE);
        Route::get ('/partners/delete/{id}',             [PartnersController::class, 'partnerDelete']       )->name(PartnersController::ROUTE_PARTNER_DELETE);
        Route::post('/products/create',                  [ProductsController::class, 'createProduct']       )->name(ProductsController::ROUTE_CREATE_PRODUCT);
        Route::post('/products/update',                  [ProductsController::class, 'productUpdate']       )->name(ProductsController::ROUTE_PRODUCT_UPDATE);
        Route::get ('/products/delete/{id}',             [ProductsController::class, 'productDelete']       )->name(ProductsController::ROUTE_PRODUCT_DELETE);
        Route::post('/slider/create',                    [SliderController::class, 'createSlider']          )->name(SliderController::ROUTE_CREATE_SLIDER);
        Route::post('/slider/update',                    [SliderController::class, 'updateSlider']          )->name(SliderController::ROUTE_UPDATE_SLIDER);
        Route::get ('/slider/delete/{id}',               [SliderController::class, 'deleteSlider']          )->name(SliderController::ROUTE_DELETE_SLIDER);
        Route::post('/charity/create',                   [CharityController::class, 'createCharity']       )->name(CharityController::ROUTE_CREATE_CHARITY);
        Route::post('/charity/update',                   [CharityController::class, 'updateCharity']       )->name(CharityController::ROUTE_UPDATE_CHARITY);
        Route::get ('/charity/delete/{id}',              [CharityController::class, 'deleteCharity']       )->name(CharityController::ROUTE_DELETE_CHARITY);
        Route::post('/charity/img/update/{id}',          [CharityController::class, 'updateCharityImg']    )->name(CharityController::ROUTE_UPDATE_CHARITY_IMG);
        Route::get ('/charity/img/delete/{id}',          [CharityController::class, 'deleteCharityImg']    )->name(CharityController::ROUTE_DELETE_CHARITY_IMG);

        Route::post('/user/update',                      [UserController::class, 'update']          )->name(UserController::ROUTE_UPDATE);
        Route::post('/user/role',                        [UserController::class, 'role']            )->name(UserController::ROUTE_ROLE);
        Route::post('/user/password',                    [UserController::class, 'password']        )->name(UserController::ROUTE_PASSWORD);
        Route::post('/user/avatar',                      [UserController::class, 'avatar']          )->name(UserController::ROUTE_AVATAR);
        Route::post('/user/validation/nick',             [ValidationController::class, 'nick']      )->name(ValidationController::ROUTE_USER_NICK);
        Route::post('/user/validation/email/exist',      [ValidationController::class, 'emailExist'])->name(ValidationController::ROUTE_USER_EMAIL_EXISTS);

        Route::post('/instruction/create',               [InstructionController::class, 'create']  )->name(InstructionController::ROUTE_CREATE);
        Route::post('/instruction/update',               [InstructionController::class, 'update']  )->name(InstructionController::ROUTE_UPDATE);
        Route::post('/instruction/status/{id}/{status}', [InstructionController::class, 'status']  )->name(InstructionController::ROUTE_STATUS);

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

