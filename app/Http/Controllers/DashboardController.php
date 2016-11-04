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

            if (!empty($month) or !empty($values)){
                $data['chart'] = Charts::create ('line', 'highcharts')
                        ->setTitle(trans('messages.amount_tithes') .' / '. date('Y'))
                        ->setElementLabel(trans('messages.tithes'))
                        ->setLabels($month)
                        ->setValues($values)
                        ->setResponsive(true);
            }else{
                $data['chart'] = Charts::create ('line', 'highcharts')
                        ->setTitle(trans('messages.amount_tithes') .' / '. date('Y'))
                        ->setElementLabel(trans('messages.tithes'))
                        ->setResponsive(true);
            }
            
            $data['member'] = Member::count();
            $data['data'] = User::count();
            $data['tithes'] = $tithes->getCountTithes();
            $data['balance'] = $account->getSumBalance();
            $data['expense'] = $expense->getCountExpenses();
            
            foreach ($expense->getExpenses() as $ex){
                $total[] = $ex->total;
                $category[] = $ex->subcategory;
                
            }
            
            /*
             * If tables are null
             */
            if (!empty($total) or ! empty($category)){
                $data['expenses'] = Charts::create('donut', 'highcharts')
                                        ->setTitle(trans('messages.amount_expenses'))
                                        ->setValues($total)
                                        ->setLabels($category)
                                        ->setElementLabel("Total")
                                        ->setLibrary('morris')
                                        ->setResponsive(true);
            }else{
                 $data['expenses'] = Charts::create('donut', 'highcharts')
                        ->setTitle(trans('messages.amount_expenses'))
                        ->setElementLabel("Total")
                        ->setLibrary('morris')
                        ->setResponsive(true);
            }
                                    
                    
            $data['month'] = $tithes->getTithesMonth();


            return View::make('dashboard.index', $data);
        }else{
            Auth::logout();
            return View::make('login');
        }
    }

    public function show() {
        if (Auth::check()){
            $data['user'] = User::find(Auth::user()->id);

            return View::make('user.account', $data);
        }
    }
}