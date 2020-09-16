<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceRecord extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'device_records';

    public function category()
    {
        return $this->hasOne(DeviceCategory::class, 'id', 'category_id');
    }

    public function vendor()
    {
        return $this->hasOne(VendorRecord::class, 'id', 'vendor_id');
    }

}
