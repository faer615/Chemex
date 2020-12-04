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
class SoftwareRecord extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'software_records';

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
     * 软件分类
     * @return HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(SoftwareCategory::class, 'id', 'category_id');
    }

    /**
     * 制造商
     * @return HasOne
     */
    public function vendor(): HasOne
    {
        return $this->hasOne(VendorRecord::class, 'id', 'vendor_id');
    }

    /**
     * 购入途径
     * @return HasOne
     */
    public function channel(): HasOne
    {
        return $this->hasOne(PurchasedChannel::class, 'id', 'purchased_channel_id');
    }
}
