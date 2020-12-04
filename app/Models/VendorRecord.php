<?php

namespace App\Models;

use Dcat\Admin\Admin;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $key, string $value)
 */
class VendorRecord extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'vendor_records';

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
     * 对联系人字段读取做数据类型转换，json字符串解析为数组
     * @param $contacts
     * @return array
     */
    public function getContactsAttribute($contacts): array
    {
        return array_values(json_decode($contacts, true) ?: []);
    }

    /**
     * 对联系人字段写入做数据类型转换，数组转为json字符串
     * @param $contacts
     */
    public function setContactsAttribute($contacts)
    {
        $this->attributes['contacts'] = json_encode(array_values($contacts));
    }
}
