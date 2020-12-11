<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $id)
 */
class Notification extends Model
{
    use HasFactory;
    use HasDateTimeFormatter;

    protected $table = 'notifications';
}
