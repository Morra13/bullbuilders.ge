<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class OrderController extends Controller
{
    /** @var string  */
    const ROUTE_ORDERS      = 'product.orders';

    /**
     * Получение заказов
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function orders(Request $request)
    {
        $dateTo = date('Y-m-d H:i:s');
        $dateFrom = $dateTo;
        if (!empty((new Order())->get('created_at')->first())) {
            $dateFrom = (new Order())->get('created_at')->first()->created_at->format('Y-m-d');
        }

        if (!empty($request->get('from'))) {
            $dateFrom = $request->get('from');
        }
        if (!empty($request->get('to'))) {
            $dateTo = date("Y-m-d", strtotime($request->get('to').'+ 1 days'));
        }

        $iCount = (new Order())->when($request->get('pay'), function (Builder $query) use ($request) {
        return $query->where('type', (string) $request->get('pay'));
        })
            ->where('created_at' , '>=',  $dateFrom)
            ->where('created_at' , '<=',  $dateTo)
            ->get()->count();
        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT > $iCount) {
            $iPage = 1;
        }

        $arOrders = (new Order())
            ->when($request->get('pay'), function (Builder $query) use ($request) {
                return $query->where('type', (string) $request->get('pay'));
            })
            ->where('created_at' , '>=',  $dateFrom)
            ->where('created_at' , '<=',  $dateTo)
            ->skip(($iPage - 1) * self::TABLE_ROWS_LIMIT)
            ->take(self::TABLE_ROWS_LIMIT)
            ->orderByDesc('created_at')
            ->get()
            ->all()
        ;

        $arOrderAll = (new Order())
            ->where('created_at' , '>=',  $dateFrom)
            ->where('created_at' , '<=',  $dateTo)
            ->get()
        ;

        $cash = [];
        $card = [];
        $debt = [];
        $debtPay = [];

        foreach ($arOrderAll as $value) {
            if ($value->type == 'ნაღდი ანგარიშსწორება') {
                $cash[] = $value->total;
            }
            if ($value->type == 'ბარათით გადახდილი') {
                $card[] = $value->total;
            }
            if ($value->type == 'ნისია') {
                $debt[] = $value->total;
            }
            if ($value->type == 'გადახდილი ვალი') {
                $debtPay[] = $value->total;
            }
        }

        $arTotal = [
            'cash'      => array_sum($cash),
            'card'      => array_sum($card),
            'debt'      => array_sum($debt),
            'debtPay'   => array_sum($debtPay),
            'all'       => array_sum($cash) + array_sum($card) + array_sum($debt) + array_sum($debtPay),
        ];

        return view(
            'product.orders',
            [
                'arOrders' => $arOrders,
                'arTotal' => $arTotal,
                'pagination'    => [
                    'total'       => $iCount,
                    'limit'       => self::TABLE_ROWS_LIMIT,
                    'page_count'  => ceil($iCount / self::TABLE_ROWS_LIMIT),
                    'page'        => $iPage,
                ]
            ]
        );
    }
}
