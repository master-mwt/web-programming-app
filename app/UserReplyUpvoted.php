<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserReplyUpvoted extends Pivot
{
    public $table = 'users_replies_upvoted';
}
