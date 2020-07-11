<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function skus()
    {
        return $this->hasMany(Sku::class);
    }
}
