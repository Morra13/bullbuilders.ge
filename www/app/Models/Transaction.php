<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * @package App\Models
 *
 * @property int id
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @property int user_id
 * @property User User
 *
 * @property int author_id
 * @property User Author
 *
 * @property int instruction_id
 * @property Instruction Instruction
 *
 * @property string transaction_id
 * @property float price
 * @property string status
 *
 * @property float commission
 * @property string commission_view
 *
 * @property string type
 * @property array payment_data
 * @property string payment_data_view
 *
 * @mixin Builder
 */
class Transaction extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE = 'transactions';

    const STATUS_NEW      = 'new';
    const STATUS_PAYED    = 'payed';
    const STATUS_ERROR    = 'error';
    const STATUS_SUCCESS  = 'success';
    const STATUS_PDF_SENT = 'pdf_sent';
    const TYPE_DEBIT      = 'debit';
    const TYPE_CREDIT     = 'credit';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;

    protected $casts = [
        'payment_data' => 'json',
    ];

    /**
     * Get commission for view
     * @return float|int
     */
    public function getCommissionViewAttribute()
    {
        return '$' . number_format($this->commission, '2', '.', ' ') . ' USD';
    }

    /**
     * Get commission for view
     * @return float|int
     */
    public function getPaymentDatasViewAttribute()
    {
        return print_r($this->payment_data, true);
    }

    /**
     * Get payment info
     * @return float|int
     */
    public function getPaymentDataViewAttribute()
    {
        $arData = $this->payment_data;
        if (!is_array($arData)) {
            $arData = json_decode($this->payment_data, true);
        }

        $arResult = [];

        if (isset($arData['id']))                     $arResult[] = ['ID', $arData['id']];
        if (isset($arData['create_time']))            $arResult[] = ['Create time', $arData['create_time']];
        if (isset($arData['status']))                 $arResult[] = ['Status', $arData['status']];
        if (isset($arData['payer']['email_address'])) $arResult[] = ['Email', $arData['payer']['email_address']];

        $arAddress = [];
        if (isset($arData['payer']['address']['country_code']))   $arAddress[] = $arData['payer']['address']['country_code'];
        if (isset($arData['payer']['address']['admin_area_2']))   $arAddress[] = $arData['payer']['address']['admin_area_2'];
        if (isset($arData['payer']['address']['address_line_1'])) $arAddress[] = $arData['payer']['address']['address_line_1'];
        if ($arAddress) $arResult[] = ['Address', implode(', ', $arAddress)];

        $arName = [];
        if (isset($arData['payer']['name']['given_name'])) $arName[] = $arData['payer']['name']['given_name'];
        if (isset($arData['payer']['name']['surname']))    $arName[] = $arData['payer']['name']['surname'];
        if ($arName) $arResult[] = ['Name', implode(', ', $arName)];

        if (isset($arData['payer']['phone']['phone_number']['national_number'])) $arResult[] = ['Phone', '+' . $arData['payer']['phone']['phone_number']['national_number']];

        if (isset($arData['purchase_units']) && is_array($arData['purchase_units'])) {
            foreach ($arData['purchase_units'] as $arUnit) {
                $arResult[] = ['PAYMENT INFO'];
                if (isset($arUnit['soft_descriptor'])) $arResult[] = ['Soft Descriptor', $arUnit['soft_descriptor']];

                if (isset($arUnit['payments']['captures']) && is_array($arUnit['payments']['captures'])) {
                    foreach ($arUnit['payments']['captures'] as $arPayment) {
                        if (isset($arPayment['id'])) $arResult[] = ['ID', $arPayment['id']];
                        if (isset($arPayment['status'])) $arResult[] = ['Status', $arPayment['status']];

                        $arAmount = [];
                        if (isset($arPayment['amount']['value']))         $arAmount[] = $arPayment['amount']['value'];
                        if (isset($arPayment['amount']['currency_code'])) $arAmount[] = $arPayment['amount']['currency_code'];
                        if ($arAmount) $arResult[] = ['Amount', implode(' ', $arAmount)];
                    }
                }
            }
        }

        $sResult = '<table class="table"><tbody>';
        foreach ($arResult as $arRow) {
            $sResult .= '<tr><td class="font-weight-bold">' . implode('</td><td>', $arRow) . '</td></tr>';
        }
        $sResult .= '</tbody></table>';

        return $sResult;
    }

    /**
     * Get the User associated with the Transaction.
     */
    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get the Author associated with the Transaction.
     */
    public function Author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    /**
     * Get the Instruction associated with the Transaction.
     */
    public function Instruction()
    {
        return $this->hasOne(Instruction::class, 'id', 'instruction_id');
    }
}
