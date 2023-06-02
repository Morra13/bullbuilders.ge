<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Charity_comment
 * @package App\Models
 *
 * @property int id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property int charity_id
 * @property string name
 * @property string comment
 */
class Charity_comment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE  = 'charity_comment';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = self::TABLE;
}
