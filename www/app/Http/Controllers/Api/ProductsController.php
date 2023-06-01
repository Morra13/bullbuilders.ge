<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Products_en;
use App\Models\Products_ge;
use App\Models\Products_ru;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE_PRODUCT        = 'api.admin.createProduct';

    /** @var string  */
    const ROUTE_PRODUCT_UPDATE        = 'api.admin.productUpdate';

    /** @var string  */
    const ROUTE_PRODUCT_DELETE        = 'api.admin.productDelete';

    /**
     * Добавление нового продукта
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createProduct(Request $request)
    {
        $obProduct = new Products();
        $obProductGe = new Products_ge();
        $obProductRu = new Products_ru();
        $obProductEn = new Products_en();

        if (!empty($request->file())){
            $fileName = time().'_'.$request->file('main_img')->getClientOriginalName();
            $filePath = $request->file('main_img')->storeAs('/uploads', $fileName , 'public');
            $obProduct->main_img = $filePath;
            $obProduct->price = $request->get('price');
            $obProduct->save();
            $iProductId = $obProduct->id;
        }

        if (!empty($iProductId)) {
            $obProductGe->product_id    = $iProductId;
            $obProductGe->name          = $request->get('name_ge');
            $obProductGe->title         = $request->get('title_ge');
            $obProductGe->description   = $request->get('description_ge');
            $obProductGe->save();

            $obProductRu->product_id    = $iProductId;
            $obProductRu->name          = $request->get('name_ru');
            $obProductRu->title         = $request->get('title_ru');
            $obProductRu->description   = $request->get('description_ru');
            $obProductRu->save();

            $obProductEn->product_id    = $iProductId;
            $obProductEn->name          = $request->get('name_en');
            $obProductEn->title         = $request->get('title_en');
            $obProductEn->description   = $request->get('description_en');
            $obProductEn->save();
        }

        return redirect()->route(\App\Http\Controllers\ProductsController::ROUTE_CREATE_PRODUCT);
    }

    /**
     * Обновление продукта
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function productUpdate(Request $request)
    {
        $obProduct = (new Products())
            ->where('id', (int) $request->get('id'))
            ->first()
        ;

        $fileMainImg = storage_path('app/public/' . $obProduct['main_img']);

        if (!empty($request->file('main_img'))){
            if (file_exists($fileMainImg)) {
                if (!empty($obProduct['main_img'])) {
                    unlink(storage_path('app/public/' . $obProduct['main_img']));
                }
            }
            $fileName = time().'_'.$request->file('main_img')->getClientOriginalName();
            $filePath = $request->file('main_img')->storeAs('/uploads', $fileName , 'public');
            $obProduct->main_img = $filePath;
        }
        $obProduct->price = $request->get('price');
        $obProduct->update();


        $obProductGe = (new Products_ge())
            ->where('product_id', (int) $request->get('id'))
            ->update(
                [
                    'name'          => $request->get('name_ge'),
                    'title'         => $request->get('title_ge'),
                    'description'   => $request->get('description_ge'),
                ]
            )
        ;
        $obProductRu = (new Products_ru())
            ->where('product_id', (int) $request->get('id'))
            ->update(
                [
                    'name'          => $request->get('name_ru'),
                    'title'         => $request->get('title_ru'),
                    'description'   => $request->get('description_ru'),
                ]
            )
        ;
        $obProductEn = (new Products_en())
            ->where('product_id', (int) $request->get('id'))
            ->update(
                [
                    'name'          => $request->get('name_en'),
                    'title'         => $request->get('title_en'),
                    'description'   => $request->get('description_en'),
                ]
            )
        ;

        return redirect()->route(\App\Http\Controllers\ProductsController::ROUTE_PRODUCT);
    }

    /**
     * Удаление продукта
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function productDelete($id)
    {
        $obProduct = (new Products())->where('id', $id)->first();
        if (!empty($obProduct['main_img'])) {
            unlink(storage_path('app/public/' . $obProduct['main_img']));
        }
        $obProduct->delete();
        $obProductGe = (new Products_ge())->where('product_id', $id)->delete();
        $obProductRu = (new Products_ru())->where('product_id', $id)->delete();
        $obProductEn = (new Products_en())->where('product_id', $id)->delete();

        return redirect()->route(\App\Http\Controllers\ProductsController::ROUTE_PRODUCT);
    }

}
