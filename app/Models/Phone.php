<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    public $timestamps = false;

    protected $fillable = ['country_code', 'ddd', 'number', 'status_id'];

    public function phoneable()
    {
        return $this->morphTo();
    }
}
