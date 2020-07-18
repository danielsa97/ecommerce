<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'description', 'status_id'];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id')->where('type', 'general');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_department', 'department_id', 'category_id');
    }
}
