<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Charity_ru
 * @package App\Models
 *
 * @property int id
 * @property int charity_id
 * @property string name
 * @property string manager
 * @property string title
 * @property string description
 */
class Charity_ru extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE  = 'charity_ru';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;
}
