<?php

namespace App\Models;

use App\Traits\HasCreator;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $key, string $value)
 * @property string name
 */
class VendorRecord extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;
    use HasCreator;

    protected $table = 'vendor_records';

    protected static function booted()
    {
        static::saving(function ($model) {
            self::hasCreator($model);
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
