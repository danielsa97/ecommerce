<?php

namespace App;

use App\Models\Image;
use App\Models\Status;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_verified_at', 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id')->where('type', 'general');
    }

    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = bcrypt($value);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
