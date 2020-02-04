<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users() {
        return $this->hasMany('\App\User');
    }

    public function channels() {
        return $this->hasMany('\App\Channel');
    }

    public function capabilities() {
        return $this->hasMany('\App\Capability');
    }
}
