<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tithe extends Model
{
    public function member(){
        return $this->belongsTo('App\Member');
    }
    
    public function account(){
        return $this->belongsTo('App\Account');
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
            $data = DB::table('tithes')
            ->join('members', 'tithes.member_id', '=', 'members.id')
            ->join('families', 'members.family_id', '=', 'families.id')
            ->where(DB::raw('YEAR(tithes.period)'), '=', DB::raw('YEAR(now())'))
            ->groupBy('members.id')
            ->orderBy('members.name')
            ->select(
                    DB::raw('families.name as family'),
                    DB::raw('members.name as member'),
                    DB::raw("sum(case MONTH(tithes.period) WHEN 1 THEN (tithes.amount) else 0 END) 'JAN'"),
                    DB::raw("sum(case MONTH(tithes.period) WHEN 2 THEN (tithes.amount) else 0 END) 'FEB'"),
                    DB::raw("sum(case MONTH(tithes.period) WHEN 3 THEN (tithes.amount) else 0 END) 'MAR'"),
                    DB::raw("sum(case MONTH(tithes.period) WHEN 4 THEN (tithes.amount) else 0 END) 'APR'"),
                    DB::raw("sum(case MONTH(tithes.period) WHEN 5 THEN (tithes.amount) else 0 END) 'MAY'"),
                    DB::raw("sum(case MONTH(tithes.period) WHEN 6 THEN (tithes.amount) else 0 END) 'JUN'"),
                    DB::raw("sum(case MONTH(tithes.period) WHEN 7 THEN (tithes.amount) else 0 END) 'JUL'"),
                    DB::raw("sum(case MONTH(tithes.period) WHEN 8 THEN (tithes.amount) else 0 END) 'AUG'"),
                    DB::raw("sum(case MONTH(tithes.period) WHEN 9 THEN (tithes.amount) else 0 END) 'SEP'"),
                    DB::raw("sum(case MONTH(tithes.period) WHEN 10 THEN (tithes.amount) else 0 END) 'OCT'"),
                    DB::raw("sum(case MONTH(tithes.period) WHEN 11 THEN (tithes.amount) else 0 END) 'NOV'"),
                    DB::raw("sum(case MONTH(tithes.period) WHEN 12 THEN (tithes.amount) else 0 END) 'DEC'")
                    
                    )
            ->get();
        //DB::enableQueryLog();
        /*$data = DB::table('tithes as t')
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
            ->get();*/
        //dd(DB::getQueryLog());

        return $data;
    }
    
    public function getTithesByMonth(){
        //DB::enableQueryLog();
        $data = DB::table('tithes')
                    ->where(DB::raw('YEAR(tithes.period)'), '=', DB::raw('YEAR(now())'))
                    ->groupBy(DB::raw('MONTH(tithes.period)'))
                    ->groupBy(DB::raw('YEAR(tithes.period)'))
                    ->select(
                        DB::raw('sum(tithes.amount) as total'),
                        DB::raw('MONTHNAME(tithes.period) as month')
                    )
                    ->get();
        //dd(DB::getQueryLog());

        return $data;   
    }
    
    public function getTithesByTypes(){
        //DB::enableQueryLog();
        $data = DB::table('tithes')
                    ->join('types', 'tithes.type_id', '=', 'types.id')
                    ->where(DB::raw('MONTH(tithes.period)'), '=', DB::raw('MONTH(now())'))
                    ->where(DB::raw('YEAR(tithes.period)'), '=', DB::raw('YEAR(now())'))
                    ->groupBy('types.id')
                    ->groupBy(DB::raw('MONTH(tithes.period)'))
                    ->groupBy(DB::raw('YEAR(tithes.period)'))
                    ->select(
                            DB::raw('sum(tithes.amount) as total'),
                            DB::raw('types.type'),
                            DB::raw('MONTHNAME(tithes.period) as month'),
                            DB::raw('YEAR(tithes.period) as year')
                    )
                    ->get();
        //dd(DB::getQueryLog());

        return $data;   
    }
    
    public function getTithesByMembers(){
        //DB::enableQueryLog();
        $data = DB::table('tithes')
                    ->join('members', 'tithes.member_id', '=', 'members.id')
                    //->where(DB::raw('MONTH(tithes.period)'), '=', DB::raw('MONTH(now())'))
                    ->where(DB::raw('YEAR(tithes.period)'), '=', DB::raw('YEAR(now())'))
                    ->groupBy('members.id')
                    ->orderBy(DB::raw('members.name'), 'DESC')
                    ->select(
                            DB::raw('sum(tithes.amount) as total'),
                            DB::raw('members.name')
                    )
                    ->get();
        //dd(DB::getQueryLog());

        return $data;
    }
    
    public function getTithesByExpenses(){
       // DB::enableQueryLog();
        $data = DB::table('tithes')
                    ->join('accounts', 'tithes.account_id', '=', 'accounts.id')
                    ->join('expenses','accounts.id', '=', 'expenses.account_id')
                    ->where(DB::raw('YEAR(tithes.period)'), '=', DB::raw('YEAR(now())'))
                    ->groupBy(DB::raw('MONTH(tithes.period)'))
                    ->groupBy(DB::raw('YEAR(tithes.period)'))
                    ->orderBy(DB::raw('MONTH(tithes.period)'), 'desc')
                    ->select(
                            DB::raw('sum(tithes.amount) as tithes'),
                            DB::raw('sum(expenses.amount) as expenses'),
                            DB::raw('sum(tithes.amount) - sum(expenses.amount) as diff'),
                            DB::raw("MONTHNAME(tithes.period) as period")
                    )
                    ->get();
       // dd(DB::getQueryLog());

        return $data;
    }
}
