<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Products_ru
 * @package App\Models
 *
 * @property int id
 * @property int product_id
 * @property string name
 * @property string title
 * @property string description
 */
class Products_ru extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE  = 'products_ru';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;
}
