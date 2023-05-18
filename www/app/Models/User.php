<?php

namespace App\Models;

use App\Services\Transactions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 *
 * @property int id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property string avatar
 * @property string name
 * @property string logo
 * @property string role creator|admin|subscriber
 * @property string nick_name
 * @property string email
 * @property string password
 * @property string remember_token
 *
 * @mixin Builder
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The table associated with the model.
     */
    const TABLE = 'users';

    /** @var string  */
    const CURRENCY = '$';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get user logo with default
     * @return string
     */
    public function getLogoAttribute()
    {
        return empty($this->avatar) ? '/uploads/avatar_default.png' : $this->avatar;
    }

    /**
     * Get instruction count
     * @return int
     */
    public function getInstructionCountAttribute()
    {
        return (new Instruction())->where('user_id', $this->id)->count();
    }

    /**
     * Get balance
     * @return int
     */
    public function getBalanceAttribute()
    {
        return Transactions::getBalance($this->id);
    }

    /**
     * Get balance for view
     * @return string
     */
    public function getBalanceViewAttribute()
    {
        return number_format($this->balance, 2, ',', ' ') . ' ' . self::CURRENCY;
    }

    /**
     * Get total sales
     * @return int
     */
    public function getSalesAttribute()
    {
        return Transactions::getSales($this->id);
    }

    /**
     * Get sales for view
     * @return string
     */
    public function getSalesViewAttribute()
    {
        return number_format($this->sales, 2, ',', ' ') . ' ' . self::CURRENCY;
    }

    /**
     * Get welcome text for view
     * @return string
     */
    public function getWelcomeTextViewAttribute()
    {
        return str_replace(PHP_EOL, '<br/>', $this->welcome_text);
    }

    /**
     * Check is admin
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role == 'admin';
    }
}
