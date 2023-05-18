<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Debtors;
use App\Models\Order;
use App\Models\OrderContent;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE_ORDER = 'api.order.create';

    /** @var string  */
    const ROUTE_DELETE_ORDER = 'api.order.delete';

    /**
     * Оформить заказ
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $obBasket = new Basket();

        if (empty($request->name) && !empty($request->nameInput)) {
            $sName = $request->nameInput;
        } else {
            $sName = $request->name;
        }

        $type = 'ნაღდი ანგარიშსწორება';
        if ($request->type == 'ბარათით გადახდილი' && empty($sName)) {
            $type = 'ბარათით გადახდილი';
        } else if (!empty($sName)) {
            $type = 'ნისია';
        }

        $obOrder = new Order();
        $obOrder->total = $request->get('total');
        $obOrder->type = $type;
        $obOrder->debtor = mb_strtolower($sName);
        $obOrder->seller = null;

        if ($obOrder->save()) {
            if ($type == 'ნისია') {
                $obDebtors = new Debtors();
                $obDebtors->order_id    = $obOrder->id;
                $obDebtors->name        = mb_strtolower($sName);
                $obDebtors->total       = $request->get('total');
                $obDebtors->status      = 'გადასახდელი';
                $obDebtors->save();
            }

            foreach ($obBasket->all() as $value) {
                $obOrderContent = new OrderContent();
                $obOrderContent->order_id   = $obOrder->id;
                $obOrderContent->product_id = $value->product_id;
                $obOrderContent->name       = $value->name;
                $obOrderContent->price      = $value->price;
                $obOrderContent->qty        = $value->qty;
                $obOrderContent->save();

                $obProduct = (new Product())->where('id', $value->product_id)->first();
                $obProduct->qty = ($obProduct->qty - $value->qty);
                $obProduct->update();
            }

            $obBasket->truncate();
        }

        return redirect()->route(\App\Http\Controllers\PublicController::ROUTE_INDEX);
    }

    /**
     * Удалить заказ
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $obOrder = (new Order())
            ->where('id', $request->get('orderId'))
            ->first();

        $obOrder->delete();

        $obOrderContent = (new OrderContent())
            ->where('order_id', $request->get('orderId'))
            ->get();
        foreach ($obOrderContent as $value) {
            $value->delete();
        }

        return redirect()->route(\App\Http\Controllers\OrderController::ROUTE_ORDERS);
    }

}
