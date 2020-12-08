<?php

namespace App\Models;

use App\Traits\HasCreator;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $key, string $value)
 * @property string item
 * @property int item_id
 * @property string ng_description
 * @property string ng_time
 * @property int status
 */
class MaintenanceRecord extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;
    use HasCreator;

    protected $table = 'maintenance_records';

    protected static function booted()
    {
        self::hasCreator();
    }
}
