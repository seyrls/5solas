<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Expense extends Model
{
    public function getExpenses(){
        //DB::enableQueryLog();
        
        $data = DB::table('expenses as ex')
                ->join('subcategories as sc', 'ex.subcategory_id', '=', 'sc.id')
                ->join('categories as c','sc.category_id', '=', 'c.id')
                ->join('accounts as a','ex.account_id', '=', 'a.id')
                ->groupBy('ex.subcategory_id')
                ->groupBy('ex.account_id')
                ->select(DB::raw('sum(ex.amount) as total'),
                        'c.category',
                        'sc.subcategory',
                        'ex.created_at')
                ->get();

       /* $data = DB::table('expenses as ex')
            ->join('accounts as ac', 'ex.account_id', '=', 'ac.id')
            ->join('subcategories as sc', 'ex.subcategory_id' ,'=', 'sc.id')
            ->join('categories as c', 'sc.category_id', '=', 'c.id')
            ->where(DB::raw('YEAR(ex.date)'), '=', DB::raw('YEAR(now())'))
            ->where(DB::raw('MONTH(ex.date)'), '=', DB::raw('MONTH(now())'))

            ->select('ex.id',
                      'ex.description',
                      'ex.observation',
                      'ex.amount',
                      'ex.date',
                      'ex.tag',
                      'ac.account_name',
                      'sc.subcategory',
                      'c.category',
                      'ex.created_at',
                      'ex.updated_at'
            )
            ->get();*/
        //dd(DB::getQueryLog());

        return $data;
    }

    public function getCountExpenses(){
        //DB::enableQueryLog();
     
	
	

        $data = DB::table('expenses as e')
            ->where(DB::raw('YEAR(e.date)'), '=', DB::raw('YEAR(now())'))
            ->where(DB::raw('MONTH(e.date)'), '=', DB::raw('MONTH(now())'))
            ->sum('e.amount');

        //dd(DB::getQueryLog());

        return $data;

    }
}
