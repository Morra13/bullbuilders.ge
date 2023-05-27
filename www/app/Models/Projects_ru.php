<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Projects_ru
 * @package App\Models
 *
 * @property int project_id
 * @property string name
 * @property string manager
 * @property string address
 * @property string description
 */
class Projects_ru extends Model
{
    use HasFactory;

    public $primaryKey = null;
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE  = 'projects_ru';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;
}
