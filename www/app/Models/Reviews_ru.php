<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reviews_ru
 * @package App\Models
 *
 * @property int id
 * @property int review_id
 * @property string name
 * @property string surname
 * @property string position
 * @property string comment
 */
class Reviews_ru extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE  = 'reviews_ru';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;
}
