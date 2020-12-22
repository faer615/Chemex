<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $key, string $value)
 * @property int hardware_id
 * @property int device_id
 */
class HardwareTrack extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'hardware_tracks';

    /**
     * 硬件追踪有一个硬件记录
     * @return HasOne
     */
    public function hardware(): HasOne
    {
        return $this->hasOne(HardwareRecord::class, 'id', 'hardware_id');
    }

    /**
     * 硬件追踪有一个设备记录
     * @return HasOne
     */
    public function device(): HasOne
    {
        return $this->hasOne(DeviceRecord::class, 'id', 'device_id');
    }
}
