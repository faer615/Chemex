<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
