<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Member extends Model
{
    public function family(){
        return $this->belongsTo('App\Family');
    }

    public function tithe(){
        return $this->hasMany('App\Tithe');
    }

    public function getFamilies(){
        $data = DB::table('members as m')
                    ->join('families as f', 'f.id', '=', 'm.family_id')
                    ->select('f.name as family','m.*')
                    ->get();

        return $data;
    }

    public function getMembers($id){
        //DB::enableQueryLog();

        $data = DB::table('members as m')
            ->where('m.family_id', '=', $id)
            ->select('m.name','m.id')
            ->get();

        //dd(DB::getQueryLog());
        return $data;
    }
}
