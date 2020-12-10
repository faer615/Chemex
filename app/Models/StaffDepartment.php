<?php

namespace App\Models;

use App\Traits\HasCreator;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $key, string $value)
 * @property string name
 */
class StaffDepartment extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;
    use HasCreator;

    protected $table = 'staff_departments';

    protected static function booted()
    {
        static::saving(function ($model) {
            self::hasCreator($model);
        });
    }

    /**
     * 组织部门有一个父组织部门
     * @return HasOne
     */
    public function parent(): HasOne
    {
        return $this->hasOne(StaffDepartment::class, 'id', 'parent_id');
    }
}
