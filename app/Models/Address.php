<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $fillable = ['city_id', 'street', 'district', 'zipcode', 'number', 'complement','status_id'];

    public function addressable()
    {
        return $this->morphTo();
    }
}
