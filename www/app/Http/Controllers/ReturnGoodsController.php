<?php

namespace App\Http\Controllers;

use App\Models\ReturnGoods;
use App\Models\ReturnGoodsStore;
use Illuminate\Http\Request;

class ReturnGoodsController extends Controller
{
    /** @var string  */
    const ROUTE_RETURN = 'returnGoods.returnGoods';

    /** @var string  */
    const ROUTE_RETURN_CHECK = 'returnGoods.returnGoodsCheck';

    /**
     * Списания
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function returnGoods()
    {
        $arReturn = (new ReturnGoodsStore())
            ->orderBy('updated_at', 'desc')
            ->get()
        ;

        return view('returnGoods.returnGoods', [
                'arReturn'    => $arReturn,
            ]
        );
    }

    /**
     * Просмотр возвращенных товаров
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function returnGoodsCheck(Request $request)
    {
        $dateTo = date('Y-m-d H:i:s');
        $dateFrom = $dateTo;

        if (!empty((new ReturnGoods())->get('created_at')->first())) {
            $dateFrom = (new ReturnGoods())->get('created_at')->first()->created_at->format('Y-m-d');
        }

        if (!empty($request->get('from'))) {
            $dateFrom = $request->get('from');
        }
        if (!empty($request->get('to'))) {
            $dateTo = date("Y-m-d", strtotime($request->get('to').'+ 1 days'));
        }

        $iCount = (new ReturnGoods())->when($request->get('creator'), function (Builder $query) use ($request) {
            return $query->where('creator', (string) $request->get('creator'));
        })
            ->where('created_at' , '>=',  $dateFrom)
            ->where('created_at' , '<=',  $dateTo)
            ->get()->count();
        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT > $iCount) {
            $iPage = 1;
        }

        $arReturn = (new ReturnGoods())
            ->where('created_at' , '>=',  $dateFrom)
            ->where('created_at' , '<=',  $dateTo)
            ->skip(($iPage - 1) * self::TABLE_ROWS_LIMIT)
            ->take(self::TABLE_ROWS_LIMIT)
            ->orderByDesc('created_at')
            ->get()
            ->all()
        ;

        return view('returnGoods.returnGoodsCheck',
            [
                'arReturn'    => $arReturn,
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
