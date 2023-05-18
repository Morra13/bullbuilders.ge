<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\Entrance;
use App\Models\EntranceContent;
use App\Models\EntranceStore;
use App\Models\Product;
use Illuminate\Http\Request;

class EntranceController extends Controller
{
    /** @var string  */
    const ROUTE_ADD_IN_ENTRANCE = 'api.entrance.addInEntrance';

    /** @var string  */
    const ROUTE_UPDATE_ENTRANCE = 'api.entrance.updateEntrance';

    /** @var string  */
    const ROUTE_CREATE_ENTRANCE = 'api.entrance.create';

    /** @var string  */
    const ROUTE_DELETE_ENTRANCE = 'api.entrance.delete';

    /**
     * Добавление
     *
     * @param $obProduct
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($obProduct){

        $obEntranceStore = new EntranceStore();

        foreach ($obEntranceStore->get('product_id') as $value) {
            if ($value['product_id'] == $obProduct->id) {
                $obEntranceStoreUpdate = (new EntranceStore())
                    ->where('product_id', $value['product_id'])
                    ->first()
                ;
                $obEntranceStoreUpdate->qty = $obEntranceStoreUpdate->qty + 1;
                $obEntranceStoreUpdate->update();
                return redirect()->route(\App\Http\Controllers\ProductController::ROUTE_ENTRANCE);
            }
        }

        $obEntranceStore->name = $obProduct->name;
        $obEntranceStore->product_id = $obProduct->id;
        $obEntranceStore->qty = 1;

        $obEntranceStore->save();
    }

    /**
     * Добавить продукт в приход товаров
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addInEntrance(Request $request)
    {
        $obEntranceStore = new EntranceStore();

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
            return redirect()->route(\App\Http\Controllers\ProductController::ROUTE_ENTRANCE);
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
            $arEntrance = (new EntranceStore())
                ->orderBy('updated_at', 'desc')
                ->get()
            ;

            return view('product.entrance', [
                    'arEntrance'    => $arEntrance,
                    'obProduct'     => $obProduct,
                ]
            );
        }

        return redirect()->route(\App\Http\Controllers\ProductController::ROUTE_ENTRANCE);
    }

    /**
     * Оформить прием товаров
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createEntrance(Request $request)
    {
        $obEntranceStore = new EntranceStore();

        $obEntrance = new Entrance();
        $obEntrance->creator = auth()->user()->name;
        if ($obEntrance->save()) {
            foreach ($obEntranceStore->all() as $value) {
                $obEntranceContent = new EntranceContent();
                $obEntranceContent->entrance_id = $obEntrance->id;
                $obEntranceContent->product_id  = $value->product_id;
                $obEntranceContent->name        = $value->name;
                $obEntranceContent->qty         = $value->qty;
                $obEntranceContent->save();

                $obProduct = (new Product())->where('id', $value->product_id)->first();
                $obProduct->qty = ($obProduct->qty + $value->qty);
                $obProduct->update();
            }

            $obEntranceStore->truncate();
        }

        return redirect()->route(\App\Http\Controllers\ProductController::ROUTE_ENTRANCE);
    }

    /**
     * Обновить
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateEntrance(Request $request)
    {
        $obEntrance = (new EntranceStore())
            ->where('id', $request->get('id'))
            ->first()
        ;

        if ($request->get('plus')) {
            $obEntrance->qty = $obEntrance->qty + 1;
        }
        if ($request->get('minus')) {
            $obEntrance->qty = $obEntrance->qty - 1;
        }
        if ($request->get('delete')) {
            $obEntrance->delete();
        }
        if ($request->get('add')) {
            $obEntrance->qty = $request->get('qty');
        }

        $obEntrance->update();

        return redirect()->route(\App\Http\Controllers\ProductController::ROUTE_ENTRANCE);
    }

    /**
     * Удалить прием товаров
     *
     * @param Request $request
     */
    public function delete (Request $request)
    {
        $obEntrance = (new Entrance())->where('id', $request->get('entranceId'))->first();
        $obEntrance->delete();

        $obEntranceContent = (new EntranceContent())->where('entrance_id', $request->get('entranceId'))->get();

        foreach ($obEntranceContent as $value) {
            $obProduct = (new Product())->where('id', $value->product_id)->first();
            $obProduct->qty = ($obProduct->qty - $value->qty);
            $obProduct->update();

            $value->delete();
        }

        return redirect()->route(\App\Http\Controllers\ProductController::ROUTE_ENTRANCE_CHECK);
    }
}
