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
 * @property int service_id
 * @property string issue
 * @property int status
 * @property Datetime start
 */
class ServiceIssue extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;
    use HasCreator;

    protected $table = 'service_issues';

    protected static function boot()
    {
        parent::boot();
        self::hasCreator();
    }

    public function service(): HasOne
    {
        return $this->hasOne(ServiceRecord::class, 'id', 'service_id');
    }
}
