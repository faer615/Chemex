<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';

    public function skill_class()
    {
        return $this->belongsTo(Skill_Class::class, 'class_id');
    }
}
