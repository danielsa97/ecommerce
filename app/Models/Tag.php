<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;
    protected $fillable = ['value'];

    public function taggable()
    {
        return $this->morphTo();
    }
}
