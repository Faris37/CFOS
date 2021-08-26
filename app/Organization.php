<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function menus()
    {
        return $this->belongsToMany('App\Menu');
    }
}
