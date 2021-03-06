<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    // protected $fillable = [
    //     'name',
    //     'title',
    //     'description',
    //     'rules',
    //     'creator_id',
    // ];

    protected $guarded = [];

    public function users() {
        return $this->hasMany('\App\User');
    }

    public function roles() {
        return $this->hasMany('\App\Role');
    }

    public function posts() {
        return $this->hasMany('\App\Post');
    }

    public function image() {
        return $this->hasOne('\App\Image', 'id');
    }

    public function creator() {
        return $this->hasOne('\App\User', 'id');
    }
}
