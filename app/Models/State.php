<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function nation()
    {
        return $this->belongsTo(Nation::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
