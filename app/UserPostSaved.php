<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserPostSaved extends Pivot
{
    public $table = 'users_posts_saved';
}
