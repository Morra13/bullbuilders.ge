<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Products_en;
use App\Models\Products_ge;
use App\Models\Products_ru;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE_PRODUCT       = 'admin.products.createProduct';

    /** @var string  */
    const ROUTE_PRODUCT              = 'admin.products.product';

    /** @var string  */
    const ROUTE_PRODUCT_UPDATE       = 'admin.products.productUpdate';

    /**
     * Создать продукт
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createProduct()
    {
        return view('admin.products.createProduct');
    }

    /**
     * Страница продукта
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function product()
    {
        $arProducts = [];

        $obProducts = new Products_ge();

        if (session()->get('lang') == 'ru') {
            $obProducts = new Products_ru();
        } elseif (session()->get('lang') == 'en') {
            $obProducts = new Products_en();
        }

        $iCount = (new Products())
            ->get()
            ->count();

        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT > $iCount) {
            $iPage = 1;
        }

        $arProductsMain = (new Products())
            ->skip(($iPage - 1) * self::TABLE_ROWS_LIMIT)
            ->take(self::TABLE_ROWS_LIMIT)
            ->orderByDesc('created_at')
            ->get();

        foreach ($arProductsMain as $key => $product) {
            $arInfoProducts = $obProducts::all()->where('product_id', $product->id)->first();

            $arProducts [$key] = [
                'id'            => $product->id,
                'main_img'      => $product->main_img,
                'price'         => $product->price,
                'name'          => $arInfoProducts['name'],
                'title'         => $arInfoProducts['title'],
                'description'   => $arInfoProducts['description'],
            ];
        }

        return view(
            'admin.products.product',
            [
                'arProducts'    => $arProducts,
                'pagination'    => [
                    'total'       => $iCount,
                    'limit'       => self::TABLE_ROWS_LIMIT,
                    'page_count'  => ceil($iCount / self::TABLE_ROWS_LIMIT),
                    'page'        => $iPage,
                ]
            ]
        );
    }

    /**
     * Обновление продукта
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function productUpdate(int $id)
    {
        $arProduct = [];

        $obProductGe = new Products_ge();
        $obProductRu = new Products_ru();
        $obProductEn = new Products_en();

        $arProductMain = Products::all()->where('id', $id)->first();
        $arInfoProductGe = $obProductGe::all()->where('product_id', $arProductMain->id)->first();
        $arInfoProductRu = $obProductRu::all()->where('product_id', $arProductMain->id)->first();
        $arInfoProductEn = $obProductEn::all()->where('product_id', $arProductMain->id)->first();

        $arProduct = [
            'ge'    => [
                'id'            => $arProductMain->id,
                'main_img'      => $arProductMain->main_img,
                'price'         => $arProductMain->price,
                'name'          => $arInfoProductGe['name'],
                'title'         => $arInfoProductGe['title'],
                'description'   => $arInfoProductGe['description'],
            ],
            'ru'    => [
                'name'          => $arInfoProductRu['name'],
                'title'         => $arInfoProductRu['title'],
                'description'   => $arInfoProductRu['description'],
            ],
            'en'    => [
                'name'          => $arInfoProductEn['name'],
                'title'         => $arInfoProductEn['title'],
                'description'   => $arInfoProductEn['description'],
            ],
        ];

        return view(
            'admin.products.productUpdate',
            [
                'arProduct'  => $arProduct,
            ]
        );
    }

}
