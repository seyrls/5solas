<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Expense extends Model
{
    public function getExpenses(){
        //DB::enableQueryLog();

        $data = DB::table('expenses as ex')
            ->join('accounts as ac', 'ex.account_id', '=', 'ac.id')
            ->join('subcategories as sc', 'ex.subcategory_id' ,'=', 'sc.id')
            ->join('categories as c', 'sc.category_id', '=', 'c.id')
            ->where('ex.date', '>', DB::raw('CURDATE() - INTERVAL 30 DAY'))
            ->where('ex.date', '<=', DB::raw('CURDATE()'))
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
        //dd(DB::getQueryLog());

        return $data;
    }
}
