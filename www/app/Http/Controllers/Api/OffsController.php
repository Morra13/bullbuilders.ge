<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\Offs;
use App\Models\OffsContent;
use App\Models\OffsStore;
use App\Models\Product;
use Illuminate\Http\Request;

class OffsController extends Controller
{
    /** @var string  */
    const ROUTE_ADD_IN_OFFS = 'api.offs.addInOffs';

    /** @var string  */
    const ROUTE_UPDATE_OFFS = 'api.offs.updateOffs';

    /** @var string  */
    const ROUTE_CREATE_OFFS = 'api.offs.createOffs';

    /** @var string  */
    const ROUTE_DELETE_OFFS = 'api.offs.deleteOffs';

    /**
     * Добавление
     *
     * @param $obProduct
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($obProduct){

        $obOffsStore = new OffsStore();

        foreach ($obOffsStore->get('product_id') as $value) {
            if ($value['product_id'] == $obProduct->id) {
                $obOffsStoreUpdate = (new OffsStore())
                    ->where('product_id', $value['product_id'])
                    ->first()
                ;
                $obOffsStoreUpdate->qty = $obOffsStoreUpdate->qty + 1;
                $obOffsStoreUpdate->update();
                return redirect()->route(\App\Http\Controllers\OffsController::ROUTE_OFFS);
            }
        }

        $obOffsStore->name = $obProduct->name;
        $obOffsStore->product_id = $obProduct->id;
        $obOffsStore->qty = 1;

        $obOffsStore->save();
    }

    /**
     * Добавить продукт в списание
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addInOffs(Request $request)
    {
        $obOffsStore = new OffsStore();

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
            return redirect()->route(\App\Http\Controllers\OffsController::ROUTE_OFFS);
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
            $arOffs = (new OffsStore())
                ->orderBy('updated_at', 'desc')
                ->get()
            ;

            return view('offs.offs', [
                    'arOffs'        => $arOffs,
                    'obProduct'     => $obProduct,
                ]
            );
        }

        return redirect()->route(\App\Http\Controllers\OffsController::ROUTE_OFFS);
    }

    /**
     * Оформить списание
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOffs(Request $request)
    {
        $obOffsStore = new OffsStore();

        $obOffs = new Offs();
        $obOffs->creator = auth()->user()->name;
        $obOffs->comment = $request->get('comment') ?? '';
        if ($obOffs->save()) {
            foreach ($obOffsStore->all() as $value) {
                $obOffsContent = new OffsContent();
                $obOffsContent->off_id = $obOffs->id;
                $obOffsContent->product_id  = $value->product_id;
                $obOffsContent->name        = $value->name;
                $obOffsContent->qty         = $value->qty;
                $obOffsContent->save();

                $obProduct = (new Product())->where('id', $value->product_id)->first();
                $obProduct->qty = ($obProduct->qty - $value->qty);
                $obProduct->update();
            }

            $obOffsStore->truncate();
        }

        return redirect()->route(\App\Http\Controllers\OffsController::ROUTE_OFFS);
    }

    /**
     * Обновить
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateOffs(Request $request)
    {
        $obOffsStore = (new OffsStore())
            ->where('id', $request->get('id'))
            ->first()
        ;

        if ($request->get('plus')) {
            $obOffsStore->qty = $obOffsStore->qty + 1;
        }
        if ($request->get('minus')) {
            $obOffsStore->qty = $obOffsStore->qty - 1;
        }
        if ($request->get('delete')) {
            $obOffsStore->delete();
        }
        if ($request->get('add')) {
            $obOffsStore->qty = $request->get('qty');
        }

        $obOffsStore->update();

        return redirect()->route(\App\Http\Controllers\OffsController::ROUTE_OFFS);
    }

    /**
     * Удалить списание
     *
     * @param Request $request
     */
    public function delete (Request $request)
    {
        $obOffs = (new Offs())->where('id', $request->get('offsId'))->first();
        $obOffs->delete();

        $obOffsContent = (new OffsContent())->where('off_id', $request->get('offId'))->get();

        foreach ($obOffsContent as $value) {
            $obProduct = (new Product())->where('id', $value->product_id)->first();
            $obProduct->qty = ($obProduct->qty + $value->qty);
            $obProduct->update();

            $value->delete();
        }

        return redirect()->route(\App\Http\Controllers\OffsController::ROUTE_OFFS_CHECK);
    }

}
