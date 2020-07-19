<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [];
    protected $hidden = ['imageable_type', 'group', 'created_at', 'updated_at'];

    public function imageable()
    {
        return $this->morphTo();
    }
}
