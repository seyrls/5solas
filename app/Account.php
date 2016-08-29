<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Account extends Model
{
    public function getSumBalance(){
        //DB::enableQueryLog();

        $data = DB::table('accounts as a')
            ->sum('a.balance');

        //dd(DB::getQueryLog());

        return $data;

    }
}
