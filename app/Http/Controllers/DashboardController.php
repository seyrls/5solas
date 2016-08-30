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

class DashboardController extends Controller
{
    public function index() {
        $data = "";
        $tithes = new Tithe();
        $account = new Account();
        $expense = new Expense();
        if (Auth::check()){
            $data['member'] = Member::count();
            $data['data'] = User::count();
            $data['tithes'] = $tithes->getCountTithes();
            $data['balance'] = $account->getSumBalance();
            $data['expense'] = $expense->getCountExpenses();
            $data['month'] = $tithes->getTithesMonth();

            return View::make('dashboard.index', $data);
        }else{
            return Redirect::to('/logout');
        }
    }

    public function show() {
        $data['user'] = User::find(Auth::user()->id);

        return View::make('user.account', $data);
    }
}