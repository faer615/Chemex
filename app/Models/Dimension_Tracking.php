<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dimension_Tracking extends Model
{
    protected $table = 'dimension_tracking';

    public function dimension()
    {
        return $this->belongsTo(Dimension::class, 'dimension_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
