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
class StaffRecord extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;
    use HasCreator;

    protected $table = 'staff_records';

    protected static function boot()
    {
        parent::boot();
        self::hasCreator();
    }

    /**
     * 雇员记录有一个组织部门记录
     * @return HasOne
     */
    public function department(): HasOne
    {
        return $this->hasOne(StaffDepartment::class, 'id', 'department_id');
    }
}
