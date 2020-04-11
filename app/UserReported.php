<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserReported extends Pivot
{
    public $table = 'users_reported';
}
