<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Code;
use App\Models\Debtors;
use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    /** @var string  */
    const ROUTE_ADD_IN_BASKET = 'api.basket.addInBasket';

    /** @var string  */
    const ROUTE_UPDATE_BASKET = 'api.basket.updateBasket';

    /**
     * Добавление
     *
     * @param $obProduct
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($obProduct){
        $obBasket = new Basket();

        foreach ($obBasket->get('product_id') as $value) {

            if ($value['product_id'] == $obProduct->id) {
                $obBasketUpdate = (new Basket())
                    ->where('product_id', $value['product_id'])
                    ->first()
                ;
                $obBasketUpdate->qty = $obBasketUpdate->qty + 1;
                $obBasketUpdate->update();
                return redirect()->route(\App\Http\Controllers\PublicController::ROUTE_INDEX);
            }
        }

        $obBasket->name = $obProduct->name;
        $obBasket->price = $obProduct->price;
        $obBasket->product_id = $obProduct->id;
        $obBasket->qty = 1;

        $obBasket->save();

        return redirect()->route(\App\Http\Controllers\PublicController::ROUTE_INDEX);
    }

    /**
     * Добавить продукт в корзину
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addInBasket(Request $request)
    {
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
            return redirect()->route(\App\Http\Controllers\PublicController::ROUTE_INDEX);
        }

        if (count($obCode) == 1) {
            foreach ($obCode as $value) {
                $code = $value['code'];
                $obProduct = (new Product())
                    ->where('id', $value['product_id'])
                    ->first()
                ;
            }
        }

        if (count($obCode) > 1) {
            foreach ($obCode as $value) {
                $obProduct[] = (new Product())->where('id', $value['product_id'])->get()->first();
            }

            $obBasket = (new Basket())
                ->orderBy('updated_at', 'desc')
                ->get()
            ;

            $arName = [];
            $obDebtorsName = (new Debtors())->get('name')->all();
            foreach ($obDebtorsName as $value) {
                $arName[] = $value->name;
            }
            $arName = array_unique($arName);

            return view('public.index', [
                    'arBasket'    => $obBasket,
                    'arName'    => $arName,
                    'obProduct'    => $obProduct,
                ]
            );
        }

        self::add($obProduct);

        return redirect()->route(\App\Http\Controllers\PublicController::ROUTE_INDEX);
    }

    /**
     * Обновить корзину
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateBasket(Request $request)
    {
        $obBasketUpdate = (new Basket())
            ->where('id', $request->get('id'))
            ->first()
        ;

        if ($request->get('plus')) {
            $obBasketUpdate->qty = $obBasketUpdate->qty + 1;
        }
        if ($request->get('minus')) {
            if (($obBasketUpdate->qty - 1) <= 0){
                $obBasketUpdate->delete();
            }
            $obBasketUpdate->qty = $obBasketUpdate->qty - 1;
        }
        if ($request->get('delete')) {
            $obBasketUpdate->delete();
        }
        if ($request->get('add')) {
            $obBasketUpdate->qty = $request->get('qty');
        }

        $obBasketUpdate->update();

        return redirect()->route(\App\Http\Controllers\PublicController::ROUTE_INDEX);
    }

}
