<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;
Use App\Member;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function index() {
        $data = "";
        if (Auth::check()){
            $data['member'] = Member::count();
            $data['data'] = User::count();

            return View::make('dashboard.index', $data);
        }else{
            return Redirect::to('/');
        }
    }

    public function show() {
        $data['user'] = User::find(Auth::user()->id);

        return View::make('user.account', $data);
    }
}
