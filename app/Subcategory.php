<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subcategory extends Model
{
    public function getCategories(){
        $data = DB::table('subcategories as sc')
            ->join('categories as c', 'c.id', '=', 'sc.category_id')
            ->select('c.category',
                'sc.*'
            )
            ->get();

        return $data;
    }

    public function getSubcategories($category_id){
        $data = DB::table('subcategories as sc')
            ->where('sc.category_id', '=', $category_id)
            ->get();

        return $data;
    }
}
