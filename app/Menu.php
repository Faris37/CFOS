<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function school()
    {
        return $this->belongsToMany('App\Organization');
    }
}
