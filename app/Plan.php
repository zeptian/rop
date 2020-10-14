<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    //
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function subcategory()
    {
        return $this->belongsTo(Category::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function real()
    {
        return $this->hasMany(Real::class);
    }
}