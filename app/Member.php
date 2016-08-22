<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Member extends Model
{
    public function family(){
        return $this->belongsTo('App\Family');
    }

    public function getFamilies(){
        $data = DB::table('members as m')
                    ->join('families as f', 'f.id', '=', 'm.family_id')
                    ->select('f.name as family',
                            'm.*'
                    )
                    ->get();

        return $data;
    }
}
