<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Charity
 * @package App\Models
 *
 * @property int id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property string main_img
 * @property string manager_phone
 * @property Carbon date
 */
class Charity extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE  = 'charity';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;
}
