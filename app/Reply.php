<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];

    public function post() {
        return $this->belongsTo('\App\Post');
    }

    public function comments() {
        return $this->hasMany('\App\Comment');
    }

    public function images() {
        return $this->hasMany('\App\Image');
    }
}
