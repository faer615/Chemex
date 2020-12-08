<?php

namespace App\Models;

use App\Traits\HasCreator;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $key, string $value)
 * @property int check_id
 * @property int item_id
 * @property int status
 * @property string checker
 */
class CheckTrack extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;
    use HasCreator;

    protected $table = 'check_tracks';

    protected static function booted()
    {
        self::hasCreator();
    }

    /**
     * 盘点追踪有一个负责人
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(AdminUser::class, 'id', 'checker');
    }

    /**
     * 盘点追踪有一个盘点任务
     * @return HasOne
     */
    public function check(): HasOne
    {
        return $this->hasOne(CheckRecord::class, 'id', 'check_id');
    }
}
