<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function reply() {
        return $this->belongsTo('\App\Reply');
    }

    public function images() {
        return $this->hasMany('\App\Image');
    }
}
