<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PostTag extends Pivot
{
    public $table = 'posts_tags';
}
