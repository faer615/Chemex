<?php

namespace App\Models;

use App\Traits\HasCreator;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $key, string $value)
 * @method static whereBetween(string $string, array $array)
 * @property int service_id
 * @property string issue
 * @property int status
 * @property string start
 */
class ServiceIssue extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;
    use HasCreator;

    protected $table = 'service_issues';

    protected static function booted()
    {
        static::saving(function ($model) {
            self::hasCreator($model);
        });
    }

    /**
     * 服务程序异常有一个服务程序记录
     * @return HasOne
     */
    public function service(): HasOne
    {
        return $this->hasOne(ServiceRecord::class, 'id', 'service_id');
    }
}
