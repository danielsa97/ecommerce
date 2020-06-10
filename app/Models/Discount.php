<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';

    protected $fillable = ['value', 'voucher', 'status_id', 'type', 'priority'];
    protected $dates = ['data_start', 'date_finish', 'created_at', 'updated_at'];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id')->where('type', 'general');
    }
}
