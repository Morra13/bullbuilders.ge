<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reviews_ge
 * @package App\Models
 *
 * @property int review_id
 * @property string name
 * @property string surname
 * @property string position
 * @property string comment
 */
class Reviews_ge extends Model
{
    use HasFactory;

    public $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE  = 'reviews_ge';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;
}
