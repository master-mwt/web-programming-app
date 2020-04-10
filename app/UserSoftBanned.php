<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserSoftBanned extends Pivot
{
    public $table = 'users_soft_banned';
}
