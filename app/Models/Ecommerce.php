<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ecommerce extends Model
{

    protected $fillable = ['name', 'description', 'status_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function brand()
    {
        return $this->morphOne(Image::class, 'imageable')->where('group', 'brand');
    }

    public function favicon()
    {
        return $this->morphOne(Image::class, 'imageable')->where('group', 'favicon');
    }

    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    public function tags()
    {
        return $this->morphMany(Tag::class, 'taggable');
    }

    public function mails()
    {
        return $this->morphMany(Mail::class, 'mailable');
    }


    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}
