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
use App\Http\Controllers\BullbuildersController;
use App\Http\Controllers\AdminCotroller;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\PartnersController;

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
Route::get('/about',                    [BullbuildersController::class, 'about']     )->name(BullbuildersController::ROUTE_ABOUT);
Route::get('/partners',                 [BullbuildersController::class, 'partners']  )->name(BullbuildersController::ROUTE_PARTNERS);
Route::get('/products',                 [BullbuildersController::class, 'products']  )->name(BullbuildersController::ROUTE_PRODUCTS);
Route::get('/projects',                 [BullbuildersController::class, 'projects']  )->name(BullbuildersController::ROUTE_PROJECTS);
Route::get('/project/{id}',             [BullbuildersController::class, 'project']   )->name(BullbuildersController::ROUTE_PROJECT);
Route::get('/contact',                  [BullbuildersController::class, 'contact']   )->name(BullbuildersController::ROUTE_CONTACT);
Route::get('/changeLang/{lang}',        [PublicController::class, 'changeLang']      )->name(PublicController::ROUTE_CHANGE_LANG);

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

        Route::get('/admin',                  [AdminCotroller::class, 'admin']                  )->name(AdminCotroller::ROUTE_ADMIN);
        Route::get('/admin/user/{id}',        [AdminCotroller::class, 'userRoleUpdate']         )->name(AdminCotroller::ROUTE_USER_ROLE_UPDATE);
        Route::get('/createStaff',            [StaffController::class, 'createStaff']           )->name(StaffController::ROUTE_CREATE_STAFF);
        Route::get('/staff',                  [StaffController::class, 'staff']                 )->name(StaffController::ROUTE_STAFF);
        Route::get('/staffUpdate/{id}',       [StaffController::class, 'staffUpdate']           )->name(StaffController::ROUTE_STAFF_UPDATE);
        Route::get('/createReviews',          [ReviewsController::class, 'createReviews']       )->name(ReviewsController::ROUTE_CREATE_REVIEWS);
        Route::get('/reviews',                [ReviewsController::class, 'reviews']             )->name(ReviewsController::ROUTE_REVIEWS);
        Route::get('/reviewsUpdate/{id}',     [ReviewsController::class, 'reviewsUpdate']       )->name(ReviewsController::ROUTE_REVIEWS_UPDATE);
        Route::get('/createProject',          [ProjectsController::class, 'createProject']      )->name(ProjectsController::ROUTE_CREATE_PROJECT);
        Route::get('/project',                [ProjectsController::class, 'project']            )->name(ProjectsController::ROUTE_PROJECT);
        Route::get('/projectUpdate/{id}',     [ProjectsController::class, 'projectUpdate']      )->name(ProjectsController::ROUTE_PROJECT_UPDATE);
        Route::get('/projectUpdateImg/{id}',  [ProjectsController::class, 'projectUpdateImg']   )->name(ProjectsController::ROUTE_PROJECT_UPDATE_IMG);
        Route::get('/createPartner',          [PartnersController::class, 'createPartner']      )->name(PartnersController::ROUTE_CREATE_PARTNER);
        Route::get('/partner',                [PartnersController::class, 'partner']            )->name(PartnersController::ROUTE_PARTNER);
        Route::get('/partnerUpdate/{id}',     [PartnersController::class, 'partnerUpdate']      )->name(PartnersController::ROUTE_PARTNER_UPDATE);

    }
);
