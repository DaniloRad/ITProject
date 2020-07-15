<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function recipe() {
        return $this->belongsTo(Recipe::class, 'recipe_id');
    }

    public function video() {
        return $this->belongsTo(Video::class, 'video_id');
    }
}
