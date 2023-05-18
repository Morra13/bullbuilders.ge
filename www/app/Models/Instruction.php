<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

/**
 * Class Instruction
 * @package App\Models
 *
 * @property int id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property int user_id
 * @property string main_img
 * @property string name
 * @property string link
 * @property float price
 * @property string price_view
 * @property string short_description
 * @property string content
 * @property string status
 * @property int sold_count
 * @property float sold
 * @property string sold_view
 * @property string instruction_link
 * @property User User
 *
 * @mixin Builder
 */
class Instruction extends Model
{
    use HasFactory;

    /** @var string  */
    const STATUS_SALE = 'sale';

    /** @var string  */
    const STATUS_ARCHIVE = 'archive';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE  = 'instructions';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * Generate instruction link
     * @return string
     */
    public function getInstructionLinkAttribute()
    {
        return route(
            'instruction.payment',
            [
                'nick' => $this->User->nick_name,
                'post' => $this->id
            ]
        );
    }

    /**
     * Get price for view
     * @return string
     */
    public function getPriceViewAttribute()
    {
        return '$' . number_format((float) $this->price, '2', '.', ' ') . ' USD';
    }

    /**
     * Get sold
     * @return int
     */
    public function getSoldCountAttribute()
    {
        return (new Transaction())
            ->where('instruction_id', $this->id)
            ->whereIn('status', [
                Transaction::STATUS_SUCCESS,
                Transaction::STATUS_PAYED,
                Transaction::STATUS_PDF_SENT
            ])
            ->count();
    }

    /**
     * Get sold for view
     * @return string
     */
    public function getSoldViewAttribute()
    {
        if ($this->sold) {
            return '$' . number_format((float) $this->sold, '2', '.', ' ')
                . ' [' . $this->sold_count . ']'
            ;
        } else {
            return '-';
        }
    }

    /**
     * Get sold count
     * @return float
     */
    public function getSoldAttribute()
    {
        return (float) (new Transaction())
            ->where('instruction_id', $this->id)
            ->whereIn('status', [
                Transaction::STATUS_SUCCESS,
                Transaction::STATUS_PAYED,
                Transaction::STATUS_PDF_SENT
            ])
            ->sum('price');
    }

    /**
     * Get the User associated with the Instruction.
     */
    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
