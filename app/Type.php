<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function tithe(){
        $this->hasMany('App\Tithe');
    }
}
