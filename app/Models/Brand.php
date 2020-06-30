<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name', 'description', 'status_id'];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id')->where('type', 'general');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
