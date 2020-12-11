<?php

namespace App\Models;

use App\Traits\HasCreator;
use Dcat\Admin\Form\Field\Datetime;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $key, string $value)
 * @property int id
 * @property int user_id
 * @property string check_item
 * @property Datetime end_time
 */
class CheckRecord extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;
    use HasCreator;

    protected $table = 'check_records';

    protected static function booted()
    {
        static::saving(function ($model) {
            self::hasCreator($model);
        });
    }

    /**
     * 盘点记录有一个雇员
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(AdminUser::class, 'id', 'user_id');
    }
}
