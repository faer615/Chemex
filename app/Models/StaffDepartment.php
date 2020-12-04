<?php

namespace App\Models;

use Dcat\Admin\Admin;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $key, string $value)
 */
class StaffDepartment extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'staff_departments';

    /**
     * 模型的 "booted" 方法
     *
     * @return void
     */
    protected static function booted()
    {
        static::saving(function ($model) {
            $admin_user = Admin::user();
            $jwt_user = auth('api')->user();
            if (empty($admin_user) && !empty($jwt_user)) {
                $name = $jwt_user->name;
            } elseif (!empty($admin_user) && empty($jwt_user)) {
                $name = $admin_user->name;
            } else {
                $name = '未知';
            }
            $model->creator = $name;
        });
    }

    public function parent(): HasOne
    {
        return $this->hasOne(StaffDepartment::class, 'id', 'parent_id');
    }
}
