<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserChannelRole extends Pivot
{
    public $table = 'users_channels_roles';
}
