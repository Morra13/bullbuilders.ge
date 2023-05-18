<?php
namespace App\Services;


use App\Models\Settings;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Transactions
 * @package App\Services
 */
class Transactions
{
    /**
     * Get total sales
     * @param int|null $iUserId
     * @return float
     */
    public static function getSales(?int $iUserId = null)
    {
        return (float) (new Transaction())
            ->whereIn('status', [Transaction::STATUS_PAYED, Transaction::STATUS_PDF_SENT, Transaction::STATUS_SUCCESS])
            ->when($iUserId, function (Builder $query) use ($iUserId) {
                $query->where('author_id', $iUserId);
            })
            ->where('type', Transaction::TYPE_DEBIT)
            ->sum('price')
        ;
    }

    /**
     * Get total commissions
     * @param int|null $iUserId
     * @return float
     */
    public static function getCommission(?int $iUserId = null)
    {
        return (float) (new Transaction())
            ->whereIn('status', [Transaction::STATUS_PAYED, Transaction::STATUS_PDF_SENT, Transaction::STATUS_SUCCESS])
            ->when($iUserId, function (Builder $query) use ($iUserId) {
                $query->where('author_id', $iUserId);
            })
            ->where('type', Transaction::TYPE_DEBIT)
            ->sum('commission')
        ;
    }

    /**
     * Get total sales
     * @param int|null $iUserId
     * @return float
     */
    public static function getWithdraws(?int $iUserId = null)
    {
        return (float) (new Transaction())
            ->whereIn('status', [Transaction::STATUS_PAYED, Transaction::STATUS_SUCCESS])
            ->when($iUserId, function (Builder $query) use ($iUserId) {
                $query->where('author_id', $iUserId);
            })
            ->where('type', Transaction::TYPE_CREDIT)
            ->sum('price')
        ;
    }

    /**
     * Get total sales for view
     * @param int|null $iUserId
     * @return string
     */
    public static function getSalesView(?int $iUserId = null)
    {
        return '$' . number_format(self::getSales($iUserId), '2', '.', ' ') . ' USD';
    }

    /**
     * Get total commission for view
     * @param int|null $iUserId
     * @return string
     */
    public static function getCommissionView(?int $iUserId = null)
    {
        return '$' . number_format(self::getCommission($iUserId), '2', '.', ' ') . ' USD';
    }

    /**
     * Get balance
     * @param int|null $iUserId
     * @return float|int
     */
    public static function getBalance(?int $iUserId = null)
    {
        return (float) self::getSales($iUserId) - self::getCommission($iUserId) - self::getWithdraws($iUserId);
    }

    /**
     * Get balance for view
     * @param int|null $iUserId
     * @return string
     */
    public static function getBalanceView(?int $iUserId = null)
    {
        return '$' . number_format(self::getBalance($iUserId), '2', '.', ' ') . ' USD';
    }
}
