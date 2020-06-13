<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function sKus()
    {
        return $this->hasMany(Sku::class, 'product_id', 'id');
    }
}
