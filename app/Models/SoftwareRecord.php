<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SoftwareRecord extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'software_records';

    public function category()
    {
        return $this->hasOne(SoftwareCategory::class, 'id', 'category_id');
    }

    public function vendor()
    {
        return $this->hasOne(VendorRecord::class, 'id', 'vendor_id');
    }
}
