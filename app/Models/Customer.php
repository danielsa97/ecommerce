<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function gender()
    {
        return $this->belongsTo(Status::class,'gender_id', 'id')->where('type', 'gender');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id')->where('type', 'general');
    }
}
