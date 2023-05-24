<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reviews
 * @package App\Models
 *
 * @property int id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property string photo
 * @property string name_ge
 * @property string surname_ge
 * @property string position_ge
 * @property string comment_ge
 * @property string name_ru
 * @property string surname_ru
 * @property string position_ru
 * @property string comment_ru
 * @property string name_en
 * @property string surname_en
 * @property string position_en
 * @property string comment_en
 */
class Reviews extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE  = 'reviews';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;
}
