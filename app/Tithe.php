<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tithe extends Model
{
    public function getTithe(){
       // DB::enableQueryLog();

        $data = DB::table('tithes as t')
            ->join('members as m', 'm.id', '=', 't.member_id')
            ->join('types as ty', 'ty.id', '=', 't.type_id')
            ->where('t.period', '>', DB::raw('CURDATE() - INTERVAL 30 DAY'))
            ->where('t.period', '<=', DB::raw('CURDATE()'))
            ->orderBy('t.period', 'ASC')
            ->select('t.id',
                    't.type_id',
                    't.member_id',
                    money_format('t.amount', 2),
                    't.period',
                    'm.name',
                    'ty.type',
                    't.created_at',
                    't.updated_at'
                    )
            ->get();

        //dd(DB::getQueryLog());

        return $data;
    }

    public function getCountTithes(){
        //DB::enableQueryLog();

        $data = DB::table('tithes as t')
            ->where(DB::raw('YEAR(t.period)'), '=', DB::raw('YEAR(now())'))
            ->where(DB::raw('MONTH(t.period)'), '=', DB::raw('MONTH(now())'))
            ->sum('t.amount');

        //dd(DB::getQueryLog());

        return $data;
    }

    public function getTithesMonth(){
        //DB::enableQueryLog();

        $data = DB::table('tithes as t')
            ->groupBy(DB::raw('month(t.period)'))
            ->select(DB::raw('DATE_FORMAT(t.period,\'%M\') as month'),
            DB::raw('DATE_FORMAT(t.period,\'%Y\') as year'),
            DB::raw('SUM(amount) AS total'))
            ->get();

        //dd(DB::getQueryLog());

        return $data;

    }
}
