<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\Product;
use App\Models\ReturnGoods;
use App\Models\ReturnGoodsContent;
use App\Models\ReturnGoodsStore;
use Illuminate\Http\Request;

class ReturnGoodsController extends Controller
{
    /** @var string  */
    const ROUTE_ADD_IN_RETURN = 'api.return.addInReturn';

    /** @var string  */
    const ROUTE_UPDATE_RETURN = 'api.return.updateReturn';

    /** @var string  */
    const ROUTE_CREATE_RETURN = 'api.return.createReturn';

    /** @var string  */
    const ROUTE_DELETE_RETURN = 'api.return.deleteReturn';

    /**
     * Добавление
     *
     * @param $obProduct
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($obProduct){

        $obReturnStore = new ReturnGoodsStore();

        foreach ($obReturnStore->get('product_id') as $value) {
            if ($value['product_id'] == $obProduct->id) {
                $obReturnStoreUpdate = (new ReturnGoodsStore())
                    ->where('product_id', $value['product_id'])
                    ->first()
                ;
                $obReturnStoreUpdate->qty = $obReturnStoreUpdate->qty + 1;
                $obReturnStoreUpdate->update();
                return redirect()->route(\App\Http\Controllers\ReturnGoodsController::ROUTE_RETURN);
            }
        }

        $obReturnStore->name = $obProduct->name;
        $obReturnStore->product_id = $obProduct->id;
        $obReturnStore->qty = 1;

        $obReturnStore->save();
    }

    /**
     * Добавить продукт в списание
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addInReturn(Request $request)
    {
        $obReturnStore = new ReturnGoodsStore();

        if (!empty($request->get('chose'))) {
            $obProduct = (new Product())->where('id',$request->get('chose'))->first();

            self::add($obProduct);
        }

        if (strlen($request->get('code')) > 3 ) {
            $obCode = (new Code())->where('code', 'like', '%'.$request->get('code'))->get();
        } else {
            $obCode = (new Code())->where('code', $request->get('code'))->get();
        }

        if (count($obCode) == 0) {
            return redirect()->route(\App\Http\Controllers\ReturnGoodsController::ROUTE_RETURN);
        }

        if (count($obCode) == 1) {
            foreach ($obCode as $value) {
                $code = $value['code'];
                $obProduct = (new Product())
                    ->where('id', $value['product_id'])
                    ->first()
                ;
            }
            self::add($obProduct);
        }

        if (count($obCode) > 1) {
            foreach ($obCode as $value) {
                $obProduct[] = (new Product())->where('id', $value['product_id'])->get()->first();
            }
            $arReturn = (new ReturnGoodsStore())
                ->orderBy('updated_at', 'desc')
                ->get()
            ;

            return view('offs.offs', [
                    'arReturn'        => $arReturn,
                    'obProduct'     => $obProduct,
                ]
            );
        }

        return redirect()->route(\App\Http\Controllers\ReturnGoodsController::ROUTE_RETURN);
    }

    /**
     * Оформить списание
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createReturn(Request $request)
    {
        $obReturnStore = new ReturnGoodsStore();

        $obReturn = new ReturnGoods();
        $obReturn->creator = auth()->user()->name;
        $obReturn->comment = $request->get('comment') ?? '';
        if ($obReturn->save()) {
            foreach ($obReturnStore->all() as $value) {
                $obReturnContent = new ReturnGoodsContent();
                $obReturnContent->return_id   = $obReturn->id;
                $obReturnContent->product_id  = $value->product_id;
                $obReturnContent->name        = $value->name;
                $obReturnContent->qty         = $value->qty;
                $obReturnContent->save();

                $obProduct = (new Product())->where('id', $value->product_id)->first();
                $obProduct->qty = ($obProduct->qty + $value->qty);
                $obProduct->update();
            }

            $obReturnStore->truncate();
        }

        return redirect()->route(\App\Http\Controllers\ReturnGoodsController::ROUTE_RETURN);
    }

    /**
     * Обновить
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateReturn(Request $request)
    {
        $obReturnStore = (new ReturnGoodsStore())
            ->where('id', $request->get('id'))
            ->first()
        ;

        if ($request->get('plus')) {
            $obReturnStore->qty = $obReturnStore->qty + 1;
        }
        if ($request->get('minus')) {
            $obReturnStore->qty = $obReturnStore->qty - 1;
        }
        if ($request->get('delete')) {
            $obReturnStore->delete();
        }
        if ($request->get('add')) {
            $obReturnStore->qty = $request->get('qty');
        }

        $obReturnStore->update();

        return redirect()->route(\App\Http\Controllers\ReturnGoodsController::ROUTE_RETURN);
    }

    /**
     * Удалить списание
     *
     * @param Request $request
     */
    public function delete (Request $request)
    {
        $obReturn = (new ReturnGoods())->where('id', $request->get('returnId'))->first();
        $obReturn->delete();

        $obReturnContent = (new ReturnGoodsContent())->where('return_id', $request->get('returnId'))->get();

        foreach ($obReturnContent as $value) {
            $obProduct = (new Product())->where('id', $value->product_id)->first();
            $obProduct->qty = ($obProduct->qty - $value->qty);
            $obProduct->update();

            $value->delete();
        }

        return redirect()->route(\App\Http\Controllers\ReturnGoodsController::ROUTE_RETURN_CHECK);
    }

}
