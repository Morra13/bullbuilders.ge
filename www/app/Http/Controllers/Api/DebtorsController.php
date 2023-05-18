<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Debtors;
use App\Models\DebtPayments;
use App\Models\Order;
use Illuminate\Http\Request;

/**
 * Class DebtorsController
 * @package App\Http\Controllers\Api
 */
class DebtorsController extends Controller
{
    /** @var string  */
    const ROUTE_DEBT_PAYMENT = 'api.debt.payment';

    /**
     * Оплата долга
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payment(Request $request)
    {
        $obDebtPayments = new DebtPayments();

        if (!empty($request->get('pay'))){
            $obDebtors = (new Debtors())->where('order_id', $request->get('orderId'))->first();
            if (($obDebtors->total - $request->get('payment')) > 0) {
                $obDebtors->total = ($obDebtors->total - $request->get('payment'));
                $obDebtors->update();

                $obDebtPayments->payment = $request->get('payment');
            } else {
                $obOrder = (new Order())->where('id', $request->get('orderId'))->first();
                $obOrder->type = 'გადახდილი ვალი';
                $obOrder->save();

                $obDebtPayments->payment = $obDebtors->total;

                $obDebtors->total = 0;
                $obDebtors->status = 'გადახდილი';
                $obDebtors->update();
            }
            $obDebtPayments->order_id = $request->get('orderId');
            $obDebtPayments->creator = auth()->user()->name;
            $obDebtPayments->save();
        }

        if (!empty($request->get('payAll'))){
            $obOrder = (new Order())->where('id', $request->get('orderId'))->first();
            $obOrder->type = 'გადახდილი ვალი';
            $obOrder->save();

            $obDebtors = (new Debtors())->where('order_id', $request->get('orderId'))->first();

            $obDebtPayments->payment = $obDebtors->total;

            $obDebtors->status = 'გადახდილი';
            $obDebtors->total = 0;
            $obDebtors->update();

            $obDebtPayments->order_id = $request->get('orderId');
            $obDebtPayments->creator = auth()->user()->name;
            $obDebtPayments->save();
        }

        return redirect()->route(\App\Http\Controllers\ProductController::ROUTE_DEBTORS);
    }
}
