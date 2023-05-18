<?php

namespace App\Http\Controllers;

use App\Models\Offs;
use App\Models\OffsStore;
use Illuminate\Http\Request;

class OffsController extends Controller
{
    /** @var string  */
    const ROUTE_OFFS = 'offs.offs';

    /** @var string  */
    const ROUTE_OFFS_CHECK = 'offs.check';

    /**
     * Списания
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function offs()
    {
        $arOffs = (new OffsStore())
            ->orderBy('updated_at', 'desc')
            ->get()
        ;

        return view('offs.offs', [
                'arOffs'    => $arOffs,
            ]
        );
    }

    /**
     * Просмотр списаний
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function offsCheck(Request $request)
    {
        $dateTo = date('Y-m-d H:i:s');
        $dateFrom = $dateTo;

        if (!empty((new Offs())->get('created_at')->first())) {
            $dateFrom = (new Offs())->get('created_at')->first()->created_at->format('Y-m-d');
        }

        if (!empty($request->get('from'))) {
            $dateFrom = $request->get('from');
        }
        if (!empty($request->get('to'))) {
            $dateTo = date("Y-m-d", strtotime($request->get('to').'+ 1 days'));
        }

        $iCount = (new Offs())->when($request->get('creator'), function (Builder $query) use ($request) {
            return $query->where('creator', (string) $request->get('creator'));
        })
            ->where('created_at' , '>=',  $dateFrom)
            ->where('created_at' , '<=',  $dateTo)
            ->get()->count();
        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT > $iCount) {
            $iPage = 1;
        }


        $arOffs = (new Offs())
            ->where('created_at' , '>=',  $dateFrom)
            ->where('created_at' , '<=',  $dateTo)
            ->skip(($iPage - 1) * self::TABLE_ROWS_LIMIT)
            ->take(self::TABLE_ROWS_LIMIT)
            ->orderByDesc('created_at')
            ->get()
            ->all()
        ;

        return view('offs.offsCheck',
            [
                'arOffs'    => $arOffs,
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
