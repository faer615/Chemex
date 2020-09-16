<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HardwareTrack extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'hardware_tracks';

    public function device()
    {
        return $this->hasOne(DeviceRecord::class, 'id', 'device_id');
    }
}
