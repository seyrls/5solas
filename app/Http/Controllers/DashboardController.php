<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Member;
use App\Tithe;
use App\Account;
use Illuminate\Support\Facades\View;
use Charts;

class DashboardController extends Controller
{
    public function index() {
        $data = "";
        $tithes = new Tithe();
        $account = new Account();
        $expense = new Expense();

        if (Auth::check()){
            foreach ($tithes->getTithesMonth() as $t){
                $month[] = $t->month;
                $values[] = $t->total;
            }

            $data['chart'] = Charts::new ('line', 'highcharts')
                    ->setTitle(trans('messages.amount_tithes') .' / '. date('Y'))
                    ->setElementLabel(trans('messages.tithes'))
                    ->setLabels($month)
                    ->setValues($values)
                    ->setResponsive(true);
            
            $data['member'] = Member::count();
            $data['data'] = User::count();
            $data['tithes'] = $tithes->getCountTithes();
            $data['balance'] = $account->getSumBalance();
            $data['expense'] = $expense->getCountExpenses();
            
            foreach ($expense->getExpenses() as $ex){
                $total[] = $ex->total;
                $category[] = $ex->subcategory;
                
            }
            $data['expenses'] = Charts::new('donut', 'highcharts')
                                    ->setTitle('Relatório')
                                    ->setValues($total)
                                    ->setLabels($category)
                                    ->setElementLabel("Total")
                                    ->setLibrary('morris')
                                    ->setResponsive(true);
                                    
                    
            $data['month'] = $tithes->getTithesMonth();


            return View::make('dashboard.index', $data);
        }else{
            Auth::logout();
            return View::make('login');
        }
    }

    public function show() {
        $data['user'] = User::find(Auth::user()->id);

        return View::make('user.account', $data);
    }
}