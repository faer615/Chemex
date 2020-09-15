<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffRecord extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'staff_records';

    public function department()
    {
        return $this->hasOne(StaffDepartment::class, 'id', 'department_id');
    }
}
