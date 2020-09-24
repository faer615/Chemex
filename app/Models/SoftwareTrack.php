<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SoftwareTrack extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'software_tracks';

    public function software()
    {
        return $this->hasOne(SoftwareRecord::class, 'id', 'software_id');
    }

    public function device()
    {
        return $this->hasOne(DeviceRecord::class, 'id', 'device_id');
    }
}
