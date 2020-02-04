<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleCapability extends Pivot
{
    public $table = 'roles_capabilities';
}
