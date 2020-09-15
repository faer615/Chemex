<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffDepartment extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'staff_departments';

    public function parent()
    {
        return $this->hasOne(StaffDepartment::class, 'id', 'parent_id');
    }
}
