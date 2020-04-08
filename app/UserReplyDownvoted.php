<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserReplyDownvoted extends Pivot
{
    public $table = 'users_replies_downvoted';
}
