<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 *
 * @property int id
 * @property int category_id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property string nameGe
 * @property string nameRu
 * @property string nameEng
 * @property string descriptionGe
 * @property string descriptionRu
 * @property string descriptionEng
 * @property string main_img
 * @property string more_img_0
 * @property string more_img_1
 * @property string more_img_2
 * @property float weight
 * @property float qty
 * @property float price
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE  = 'product';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;
}
