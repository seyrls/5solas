<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    public function member(){
        return $this->hasMany('App\Member');
    }
}
