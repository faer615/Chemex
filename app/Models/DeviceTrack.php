<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceTrack extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'device_tracks';

    public function device()
    {
        return $this->hasOne(DeviceRecord::class, 'id', 'device_id');
    }

    public function staff()
    {
        return $this->hasOne(StaffRecord::class, 'id', 'staff_id');
    }
}
