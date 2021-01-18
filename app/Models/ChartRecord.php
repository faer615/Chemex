<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChartRecord extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'chart_records';

}
