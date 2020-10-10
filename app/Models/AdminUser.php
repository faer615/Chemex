<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $key, string $value)
 */
class AdminUser extends Model
{
    use HasFactory;
    use HasDateTimeFormatter;

    protected $table = 'admin_users';
}
