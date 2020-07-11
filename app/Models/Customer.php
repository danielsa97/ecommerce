<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id')->where('type', 'general');
    }

    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function mails()
    {
        return $this->morphMany(Mail::class, 'mailable');
    }
}
