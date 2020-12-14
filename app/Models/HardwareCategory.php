<?php

namespace App\Models;

use App\Traits\HasCreator;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $key, string $value)
 * @property string name
 * @property int category_id
 * @property int vendor_id
 * @property string specification
 * @property mixed description
 * @property mixed price
 * @property mixed purchased
 * @property mixed expired
 * @property mixed purchased_channel_id
 */
class HardwareCategory extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;
    use HasCreator;

    protected $table = 'hardware_categories';

    protected static function booted()
    {
        static::saving(function ($model) {
            self::hasCreator($model);
        });
    }
}
