<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill_Class extends Model
{
    protected $table = 'skill_classes';

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}
