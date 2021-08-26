<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function class()
    {
        return $this->belongsToMany('App\Classes');
    }
}
