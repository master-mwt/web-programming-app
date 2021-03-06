<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function roles() {
        return $this->hasMany('\App\Role');
    }

    public function groups() {
        return $this->hasMany('\App\Group');
    }
}
