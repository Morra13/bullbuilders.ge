<?php
namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\Transactions;

/**
 * Class TransactionController
 * @package App\Http\Controllers
 */
class TransactionController extends Controller
{
    /** @var string  */
    const ROUTE_SUCCESS    = 'transaction.success';

    /** @var string  */
    const ROUTE_ERROR      = 'transaction.error';

    /** @var string  */
    const ROUTE_ADMIN_LIST = 'transaction.admin.list';

    /**
     * Payment success
     * @param $transactionId
     * @return mixed
     */
    public function success($transactionId)
    {
        $obTransaction = (new Transaction())->where('transaction_id', $transactionId)->first();

        if (!$obTransaction) {
            abort(404);
        }

        return view(
            'transaction.success',
            [
                'title'       => $obTransaction->Instruction->name . ' by ' . $obTransaction->Instruction->User->name,
                'user'        => $obTransaction->Instruction->User,
                'instruction' => $obTransaction->Instruction
            ]
        );
    }

    /**
     * Payment error
     * @param $transactionId
     * @return mixed
     */
    public function error($transactionId)
    {
        $obTransaction = (new Transaction())->where('transaction_id', $transactionId)->first();

        if (!$obTransaction) {
            abort(404);
        }

        return view(
            'transaction.error',
            [
                'title'       => $obTransaction->Instruction->name . ' by ' . $obTransaction->Instruction->User->name,
                'user'        => $obTransaction->Instruction->User,
                'instruction' => $obTransaction->Instruction
            ]
        );
    }

    /**
     * Transaction list for admin
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function adminList()
    {
        $iCount = (new Transaction())->get()->count();
        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT > $iCount) {
            $iPage = 1;
        }

        return view(
            'transaction.admin.list',
            [
                'transactions'  => (new Transaction())
                    ->skip(($iPage - 1) * self::TABLE_ROWS_LIMIT)
                    ->take(self::TABLE_ROWS_LIMIT)
                    ->orderByDesc('created_at')
                    ->get()
                    ->all(),
                'commission'    => Transactions::getCommissionView(),
                'sales'         => Transactions::getSalesView(),
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
