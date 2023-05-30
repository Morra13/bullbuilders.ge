<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Products
 * @package App\Models
 *
 * @property int id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property string main_img
 * @property float price
 */
class Products extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE  = 'products';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;
}
