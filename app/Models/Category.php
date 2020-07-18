<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'category_id', 'departments', 'status_id'];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id')->where('type', 'general');
    }

    public function category()
    {
        return $this->belongsTo(self::class, 'category_id');
    }

    public function categories()
    {
        return $this->hasMany(self::class);
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'category_department', 'category_id', 'department_id');
    }
}
