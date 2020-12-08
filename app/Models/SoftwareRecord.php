<?php

namespace App\Models;

use App\Traits\HasCreator;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $key, string $value)
 */
class SoftwareRecord extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;
    use HasCreator;

    protected $table = 'software_records';

    protected static function booted()
    {
        self::hasCreator();
    }

    /**
     * 软件记录有一个分类
     * @return HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(SoftwareCategory::class, 'id', 'category_id');
    }

    /**
     * 软件记录有一个制造商
     * @return HasOne
     */
    public function vendor(): HasOne
    {
        return $this->hasOne(VendorRecord::class, 'id', 'vendor_id');
    }

    /**
     * 软件记录有一个购入途径
     * @return HasOne
     */
    public function channel(): HasOne
    {
        return $this->hasOne(PurchasedChannel::class, 'id', 'purchased_channel_id');
    }
}
