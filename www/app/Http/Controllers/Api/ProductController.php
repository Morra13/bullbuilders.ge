<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE_PRODUCT = 'api.product.createProduct';

    /** @var string  */
    const ROUTE_CREATE_TYPE = 'api.product.createType';

    /** @var string  */
    const ROUTE_UPDATE_PRODUCT = 'api.product.updateProduct';


    /**
     * Создать новый продукт
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createProduct(Request $request)
    {
        $obProduct = new Product();

        $obProduct->nameGe          = $request->get('nameGe');
        $obProduct->nameRu          = $request->get('nameRu');
        $obProduct->nameEng         = $request->get('nameEng');
        $obProduct->descriptionGe   = $request->get('descriptionGe');
        $obProduct->descriptionRu   = $request->get('descriptionRu');
        $obProduct->descriptionEng  = $request->get('descriptionEng');
        $obProduct->price           = (float) str_replace(',', '.', $request->get('price'));
        $obProduct->category_id     = $request->get('category_id');
        $obProduct->weight          = 0;
        $obProduct->qty             = 0;

        if (!empty($request->file('main_img'))){
            $fileName = time().'_'.$request->file(  'main_img')->getClientOriginalName();
            $filePath = $request->file('main_img')->storeAs('/uploads', $fileName , 'public');
            $obProduct->main_img = $filePath;
        }
        if (!empty($request->file('more_img_0'))){
            $fileName = time().'_'.$request->file(  'more_img_0')->getClientOriginalName();
            $filePath = $request->file('more_img_0')->storeAs('/uploads', $fileName , 'public');
            $obProduct->more_img_0 = $filePath;
        }
        if (!empty($request->file('more_img_1'))){
            $fileName = time().'_'.$request->file(  'more_img_1')->getClientOriginalName();
            $filePath = $request->file('more_img_1')->storeAs('/uploads', $fileName , 'public');
            $obProduct->more_img_1 = $filePath;
        }
        if (!empty($request->file('more_img_2'))){
            $fileName = time().'_'.$request->file(  'more_img_2')->getClientOriginalName();
            $filePath = $request->file('more_img_2')->storeAs('/uploads', $fileName , 'public');
            $obProduct->more_img_2x = $filePath;
        }

        $obProduct->save();

        $i = 0;

        while ($i <= $request->get('codeCount')):
            if (!empty($request->get('code'.$i))) {
                $obCode = new Code();

                $obCode->product_id = $obProduct->id;
                $obCode->code = $request->get('code'.$i);
                $obCode->save();
            }
            $i++;
        endwhile;

        return redirect()->route(\App\Http\Controllers\ProductController::ROUTE_CREATE);
    }

    /**
     * Обновить продукт + Удалить продукт
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProduct(Request $request)
    {
        $obProduct = (new Product())
            ->where('id', $request->get('productId'))
            ->first()
        ;
        $obCode = (new Code())->where('product_id', $request->get('productId'))->get();

        if (!empty($request->get('deleteCode'))) {
            $obUpdateCode = (new Code())->where('id', $request->get('deleteCode'))->first();
            $obUpdateCode->delete();
        }

        if (!empty($request->get('delete'))) {
            foreach ($obCode as $value) {
                $value->delete();
            }
            $obProduct->delete();
        }

        if (!empty($request->get('newCode'))) {
            $obNewCode = new Code();
            $obNewCode->code = $request->get('newCode');
            $obNewCode->product_id = $request->get('productId');
            $obNewCode->save();
        }

        if (!empty($request->get('change'))) {

            $obProduct->price = $request->get('price');
            $obProduct->name = $request->get('name');
            $obProduct->qty = $request->get('qty');
            $obProduct->type = $request->get('type');

            $i = 0;
            while ($i < $request->get('countCode')) {
                $obUpdateCode = (new Code())->where('id', $request->get('codeId' . $i))->first();
                $obUpdateCode->code = $request->get('code' . $i);
                $obUpdateCode->update();
                $i++;
            }

            $obProduct->update();
        }

        return redirect()->route(\App\Http\Controllers\ProductController::ROUTE_REMAINS);
    }

    /**
     * Создать новую категорию
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createType(Request $request)
    {
        $obType = new Type();

        if (!empty($request->file())){
            $fileName = time().'_'.$request->file(  'img')->getClientOriginalName();
            $filePath = $request->file('img')->storeAs('/uploads', $fileName , 'public');
            $obType->img = $filePath;
        }

        $obType->nameGe  = $request->get('nameGe');
        $obType->nameRu  = $request->get('nameRu');
        $obType->nameEng = $request->get('nameEng');
        $obType->save();

        return redirect()->route(\App\Http\Controllers\ProductController::ROUTE_CREATE_TYPE);
    }
}
