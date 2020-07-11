<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nation extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
