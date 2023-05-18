<?php
namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\Transaction;
use App\Services\Transactions;
use Illuminate\Support\Facades\Auth;

/**
 * Class EarningController
 * @package App\Http\Controllers
 */
class EarningController extends Controller
{
    /** @var string  */
    const ROUTE_LIST = 'earning.list';

    /**
     * Earning list page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function list()
    {
        $iCount = (new Transaction())
            ->where('author_id', Auth::user()->id)
            ->whereIn(
                'status',
                [
                    Transaction::STATUS_PAYED,
                    Transaction::STATUS_PDF_SENT,
                    Transaction::STATUS_SUCCESS
                ]
            )
            ->get()
            ->count()
        ;

        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT > $iCount) {
            $iPage = 1;
        }

        return view(
            'earning.list',
            [
                'transactions'  => (new Transaction())
                    ->where('author_id', Auth::user()->id)
                    ->whereIn(
                        'status',
                        [
                            Transaction::STATUS_PAYED,
                            Transaction::STATUS_PDF_SENT,
                            Transaction::STATUS_SUCCESS
                        ]
                    )
                    ->skip(($iPage - 1) * self::TABLE_ROWS_LIMIT)
                    ->take(self::TABLE_ROWS_LIMIT)
                    ->orderByDesc('created_at')
                    ->get()
                    ->all(),
                'sales'         => Transactions::getSalesView(Auth::user()->id),
                'balance'       => Transactions::getBalanceView(Auth::user()->id),
                'commission'    => Settings::getCommission() . ' %',
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
