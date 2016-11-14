<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Expense extends Model
{
    public function getExpensesDetail(){
        $data = DB::table('expenses as ex')
            ->join('accounts as ac', 'ex.account_id', '=', 'ac.id')
            ->join('subcategories as sc', 'ex.subcategory_id' ,'=', 'sc.id')
            ->join('categories as c', 'sc.category_id', '=', 'c.id')
            //->where(DB::raw('YEAR(ex.date)'), '=', DB::raw('YEAR(now())'))
            //->where(DB::raw('MONTH(ex.date)'), '=', DB::raw('MONTH(now())'))

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
            ->get();
        
        return $data;
    }

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
    
    public function getExpensesByMonth(){
        //DB::enableQueryLog();
        $data = DB::table('expenses')
            ->where(DB::raw('YEAR(date)'), '=', DB::raw('YEAR(now())'))
            ->groupBy(DB::raw('MONTH(date)'))
            ->groupBy(DB::raw('YEAR(date)'))
            ->orderBy(DB::raw('MONTH(date)'), 'DESC')
            ->select(
                    DB::raw('sum(amount) as expenses'),
                    DB::raw('MONTHNAME(date) as period')
                    )
            ->get();

        //dd(DB::getQueryLog());

        return $data;
    }
    
    public function getExpensesPivot(){    
        //DB::enableQueryLog();
        $data = DB::table('expenses')
            ->join('subcategories', 'expenses.subcategory_id', '=', 'subcategories.id')
            ->join('categories', 'subcategories.category_id', '=', 'categories.id')
            ->where(DB::raw('YEAR(expenses.date)'), '=', DB::raw('YEAR(now())'))
            ->groupBy('expenses.subcategory_id')
            ->orderBy('categories.category')
            ->orderBy('subcategories.subcategory')
            ->select(
                    'categories.id',
                    'categories.category',
                    'subcategories.subcategory',
                    DB::raw("sum(case MONTH(expenses.date) WHEN 1 THEN (expenses.amount) else 0 END) 'JAN'"),
                    DB::raw("sum(case MONTH(expenses.date) WHEN 2 THEN (expenses.amount) else 0 END) 'FEB'"),
                    DB::raw("sum(case MONTH(expenses.date) WHEN 3 THEN (expenses.amount) else 0 END) 'MAR'"),
                    DB::raw("sum(case MONTH(expenses.date) WHEN 4 THEN (expenses.amount) else 0 END) 'APR'"),
                    DB::raw("sum(case MONTH(expenses.date) WHEN 5 THEN (expenses.amount) else 0 END) 'MAY'"),
                    DB::raw("sum(case MONTH(expenses.date) WHEN 6 THEN (expenses.amount) else 0 END) 'JUN'"),
                    DB::raw("sum(case MONTH(expenses.date) WHEN 7 THEN (expenses.amount) else 0 END) 'JUL'"),
                    DB::raw("sum(case MONTH(expenses.date) WHEN 8 THEN (expenses.amount) else 0 END) 'AUG'"),
                    DB::raw("sum(case MONTH(expenses.date) WHEN 9 THEN (expenses.amount) else 0 END) 'SEP'"),
                    DB::raw("sum(case MONTH(expenses.date) WHEN 10 THEN (expenses.amount) else 0 END) 'OCT'"),
                    DB::raw("sum(case MONTH(expenses.date) WHEN 11 THEN (expenses.amount) else 0 END) 'NOV'"),
                    DB::raw("sum(case MONTH(expenses.date) WHEN 12 THEN (expenses.amount) else 0 END) 'DEC'"),
                    DB::raw("sum(expenses.amount) as total"),
                    DB::raw("YEAR(expenses.date) as year")
                    )
            ->get();

        //dd(DB::getQueryLog());

        return $data;
    }
    
    public function getExpenseByMonthGraph() {
        //DB::enableQueryLog();
        $data = DB::table('expenses')
            ->where(DB::raw('YEAR(date)'), '=', DB::raw('YEAR(now())'))
            ->groupBy(DB::raw('MONTH(date)'))
            ->groupBy(DB::raw('YEAR(date)'))
            ->select(
                    DB::raw('sum(amount) as total'),
                    DB::raw("CONCAT(MONTHNAME(date), '/',YEAR(date)) as period")
                    )
            ->get();

        //dd(DB::getQueryLog());

        return $data;
    }
    
    public function getExpenseBySubcategory(){
        //DB::enableQueryLog();
        $data = DB::table('expenses')
            ->join('subcategories', 'expenses.subcategory_id', '=', 'subcategories.id')
            ->join('categories', 'subcategories.category_id', '=', 'categories.id')
            ->where(DB::raw('YEAR(expenses.date)'), '=', DB::raw('YEAR(now())'))
            ->groupBy('subcategories.id')
            ->orderBy('expenses.date', 'DESC')
            ->orderBy('subcategories.id')
            ->select(
                    'subcategories.subcategory',
                    DB::raw('sum(amount) as total')
                    )
            ->get();

        //dd(DB::getQueryLog());

        return $data;
    }
    
    public function getExpenseBySubcategoryMonth(){
        //DB::enableQueryLog();
        $data = DB::table('expenses')
            ->join('subcategories', 'expenses.subcategory_id', '=', 'subcategories.id')
            ->join('categories', 'subcategories.category_id', '=', 'categories.id')
            ->where(DB::raw('MONTH(expenses.date)'), '=', DB::raw('MONTH(NOW())'))
            ->groupBy('subcategories.id')
            ->orderBy('expenses.date', 'DESC')
            ->orderBy('subcategories.id')
            ->select(
                    'subcategories.subcategory',
                    DB::raw('sum(amount) as total')
                    )
            ->get();

        //dd(DB::getQueryLog());

        return $data;
    }
}
