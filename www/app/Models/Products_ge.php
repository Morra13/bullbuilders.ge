<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Products_ge
 * @package App\Models
 *
 * @property int id
 * @property int product_id
 * @property string name
 * @property string title
 * @property string description
 */
class Products_ge extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE  = 'products_ge';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;
}
