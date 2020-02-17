<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function tags() {
        return $this->hasMany('\App\Tag');
    }

    public function channel() {
        return $this->belongsTo('\App\Channel');
    }

    public function user() {
        return $this->belongsTo('\App\User');
    }
}
