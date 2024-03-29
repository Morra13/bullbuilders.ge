<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Staff_ge
 * @package App\Models
 *
 * @property int id
 * @property int staff_id
 * @property string name
 * @property string surname
 * @property string position
 * @property string comment
 */
class Staff_ge extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE  = 'staff_ge';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;
}
