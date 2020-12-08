<?php

namespace App\Models;

use App\Traits\HasCreator;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $key, string $value)
 */
class DeviceTrack extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;
    use HasCreator;

    protected $table = 'device_tracks';

    protected static function booted()
    {
        self::hasCreator();
    }

    /**
     * 设备追踪有一个设备记录
     * @return HasOne
     */
    public function device(): HasOne
    {
        return $this->hasOne(DeviceRecord::class, 'id', 'device_id');
    }

    /**
     * 设备追踪有一个使用者（雇员）
     * @return HasOne
     */
    public function staff(): HasOne
    {
        return $this->hasOne(StaffRecord::class, 'id', 'staff_id');
    }
}
