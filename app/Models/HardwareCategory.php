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
 * @property string description
 */
class HardwareCategory extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;
    use HasCreator;

    protected $table = 'hardware_categories';

    protected static function booted()
    {
        static::saving(function ($model) {
            self::hasCreator($model);
        });
    }

    /**
     * 硬件分类有一个折旧规则
     * @return HasOne
     */
    public function depreciation(): HasOne
    {
        return $this->hasOne(DepreciationRule::class, 'id', 'depreciation_rule_id');
    }
}
