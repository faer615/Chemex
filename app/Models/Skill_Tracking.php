<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill_Tracking extends Model
{
    protected $table = 'skill_tracking';

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

