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

    protected static function boot()
    {
        parent::boot();
        self::hasCreator();
    }

    public function user(): HasOne
    {
        return $this->hasOne(AdminUser::class, 'id', 'checker');
    }

    public function check(): HasOne
    {
        return $this->hasOne(CheckRecord::class, 'id', 'check_id');
    }
}
