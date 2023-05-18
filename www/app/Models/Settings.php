<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Settings
 * @package App\Models
 *
 * @property int id
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @property string name
 * @property string value
 *
 * @mixin Builder
 */
class Settings extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE = 'settings';

    /** @var string  */
    const S_COMMISSION = 'commission';

    /**
     * Get commission
     * @return float
     */
    public static function getCommission() : float
    {
        return (float) self::get(self::S_COMMISSION);
    }

    /**
     * Set commission
     * @param float $value
     * @return float
     */
    public static function setCommission(float $value) : float
    {
        return (float) self::set(self::S_COMMISSION, (string) $value);
    }

    /**
     * Get Value
     * @param string $name
     * @return string
     */
    public static function get(string $name) : string
    {
        $model = (new self)->where('name', $name)->first();

        if (!$model) {
            $model = new self;
            $model->name = $name;
            $model->save();
        }

        return (string) $model->value;
    }

    /**
     * Set Value
     * @param string $name
     * @param string $value
     * @return string
     */
    public static function set(string $name, string $value) : string
    {
        $model = (new self)->where('name', $name)->first();

        if (!$model) {
            $model = new self;
            $model->name = $name;
            $model->save();
        }

        $model->value = $value;
        $model->save();

        return (string) $model->value;
    }
}
