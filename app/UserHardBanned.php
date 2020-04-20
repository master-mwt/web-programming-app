<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserHardBanned extends Pivot
{
    public $table = 'users_hard_banned';
}
