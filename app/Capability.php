<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capability extends Model
{
    public function roles() {
        return $this->hasMany('\App\Role');
    }
}
