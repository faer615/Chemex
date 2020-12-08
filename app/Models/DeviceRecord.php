<?php

namespace App\Models;

use App\Traits\HasCreator;
use Dcat\Admin\Form\Field\Datetime;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

/**
 * @method static where(string $key, string $value, string $value = null)
 * @property string name
 * @property string description
 * @property int category_id
 * @property int vendor_id
 * @property string sn
 * @property string mac
 * @property string ip
 * @property double price
 * @property Datetime purchased
 * @property Datetime expired
 * @property int purchased_channel_id
 * @property string security_password
 * @property string admin_password
 */
class DeviceRecord extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;
    use HasCreator;

    protected $table = 'device_records';

    protected static function boot()
    {
        parent::boot();
        self::hasCreator();
    }

    /**
     * 设备分类
     * @return HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(DeviceCategory::class, 'id', 'category_id');
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

    /**
     * 设备下所有硬件
     * @return HasManyThrough
     */
    public function hardware(): HasManyThrough
    {
        return $this->hasManyThrough(
            HardwareRecord::class,  // 远程表
            HardwareTrack::class,   // 中间表
            'device_id',    // 中间表对主表的关联字段
            'id',   // 远程表对中间表的关联字段
            'id',   // 主表对中间表的关联字段
            'hardware_id'); // 中间表对远程表的关联字段
    }

    /**
     * 设备下所有软件
     * @return HasManyThrough
     */
    public function software(): HasManyThrough
    {
        return $this->hasManyThrough(
            SoftwareRecord::class,  // 远程表
            SoftwareTrack::class,   // 中间表
            'device_id',    // 中间表对主表的关联字段
            'id',   // 远程表对中间表的关联字段
            'id',   // 主表对中间表的关联字段
            'software_id'); // 中间表对远程表的关联字段
    }

    /**
     * 设备下所有软件
     * @return HasManyThrough
     */
    public function service(): HasManyThrough
    {
        return $this->hasManyThrough(
            ServiceRecord::class,  // 远程表
            ServiceTrack::class,   // 中间表
            'device_id',    // 中间表对主表的关联字段
            'id',   // 远程表对中间表的关联字段
            'id',   // 主表对中间表的关联字段
            'service_id'); // 中间表对远程表的关联字段
    }

    /**
     * 设备所属雇员
     * @return HasManyThrough
     */
    public function staff(): HasManyThrough
    {
        return $this->hasOneThrough(
            StaffRecord::class,  // 远程表
            DeviceTrack::class,   // 中间表
            'device_id',    // 中间表对主表的关联字段
            'id',   // 远程表对中间表的关联字段
            'id',   // 主表对中间表的关联字段
            'staff_id'); // 中间表对远程表的关联字段
    }

    /**
     * 对安全密码字段读取做解密转换
     * @param $security_password
     * @return array|string
     */
    public function getSecurityPasswordAttribute($security_password)
    {
        if (!empty($security_password)) {
            return Crypt::decryptString($security_password);
        }
    }

    /**
     * 对安全密码字段写入做加密转换
     * @param $security_password
     */
    public function setSecurityPasswordAttribute($security_password)
    {
        $this->attributes['security_password'] = Crypt::encryptString($security_password);
    }

    /**
     * 对管理员密码字段读取做解密转换
     * @param $admin_password
     * @return array|string
     */
    public function getAdminPasswordAttribute($admin_password)
    {
        if (!empty($admin_password)) {
            return Crypt::decryptString($admin_password);
        }
    }

    /**
     * 对管理员密码字段写入做加密转换
     * @param $admin_password
     */
    public function setAdminPasswordAttribute($admin_password)
    {
        $this->attributes['admin_password'] = Crypt::encryptString($admin_password);
    }
}
