<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserPostHidden extends Pivot
{
    public $table = 'users_posts_hidden';
}
