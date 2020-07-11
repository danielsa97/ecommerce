<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    public $timestamps = false;

    protected $fillable = ['mail', 'status_id'];

    public function mailable()
    {
        return $this->morphTo();
    }
}
