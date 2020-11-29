<?php

namespace App\Models;

use Dcat\Admin\Admin;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $key, string $value)
 */
class HardwareRecord extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'hardware_records';

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

    /**
     * 硬件分类
     * @return HasOne
     */
    public function category()
    {
        return $this->hasOne(HardwareCategory::class, 'id', 'category_id');
    }

    /**
     * 制造商
     * @return HasOne
     */
    public function vendor()
    {
        return $this->hasOne(VendorRecord::class, 'id', 'vendor_id');
    }

    /**
     * 购入途径
     * @return HasOne
     */
    public function channel()
    {
        return $this->hasOne(PurchasedChannel::class, 'id', 'purchased_channel_id');
    }

    /**
     * 所属设备
     * @return BelongsTo
     */
    /**
     * 设备所属雇员
     * @return HasManyThrough
     */
    public function device()
    {
        return $this->hasOneThrough(
            DeviceRecord::class,  // 远程表
            HardwareTrack::class,   // 中间表
            'hardware_id',    // 中间表对主表的关联字段
            'id',   // 远程表对中间表的关联字段
            'id',   // 主表对中间表的关联字段
            'device_id'); // 中间表对远程表的关联字段
    }
}
