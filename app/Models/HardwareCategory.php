<?php

namespace App\Models;

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

    protected $table = 'hardware_categories';

    /**
     * 硬件分类有一个折旧规则
     * @return HasOne
     */
    public function depreciation(): HasOne
    {
        return $this->hasOne(DepreciationRule::class, 'id', 'depreciation_rule_id');
    }
}
