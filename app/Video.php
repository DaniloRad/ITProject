<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}   
