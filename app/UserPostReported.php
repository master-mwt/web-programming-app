<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserPostReported extends Pivot
{
    public $table = 'users_posts_reported';
}
