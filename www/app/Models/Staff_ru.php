<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Staff_ru
 * @package App\Models
 *
 * @property int staff_id
 * @property string name
 * @property string surname
 * @property string position
 * @property string comment
 */
class Staff_ru extends Model
{
    use HasFactory;

    public $primaryKey = null;
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE  = 'staff_ru';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;
}
