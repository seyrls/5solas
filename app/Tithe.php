<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tithe extends Model
{
    public function member(){
        return $this->belongsTo('App\Member');
    }

    public function getTithe(){
        //DB::enableQueryLog();

        $data = DB::table('tithes as t')
            ->join('members as m', 'm.id', '=', 't.member_id')
            ->join('types as ty', 'ty.id', '=', 't.type_id')
            ->where(DB::raw('YEAR(t.period)'), '=', DB::raw('YEAR(now())'))
            ->orderBy('t.period', 'ASC')
            ->select('t.id',
                    't.type_id',
                    't.member_id',
                    money_format('t.amount', 2),
                    't.period',
                    'm.name',
                    'ty.type',
                    DB::raw('YEAR(now()) as year'),
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

    public function getTithesTotalMember(){
        //DB::enableQueryLog();
        $data = DB::table('tithes as t')
            ->join('members as m', 't.member_id', '=', 'm.id')
            ->join('families as f', 'm.family_id', '=', 'f.id')
            ->where(DB::raw('YEAR(t.period)'), '=', DB::raw('YEAR(now())'))
            ->groupBy('t.member_id')
            ->select(
                    't.member_id',
                    DB::raw('sum(t.amount) as total'),
                    DB::raw('m.name as member'),
                    DB::raw('f.name as family')
                    )
            ->get();
        //dd(DB::getQueryLog());

        return $data;
    }
}
