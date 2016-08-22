<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;
Use App\Member;

class DashboardController extends Controller
{
    public function index() {
        if (Auth::check()){
            $member = Member::count();
            $data = User::count();
            return view('dashboard.index', compact('data'), compact('member'));
        }else{
            return Redirect::to('/');
        }
    }

    public function show() {
        $user = User::find(Auth::user()->id);

        return view('user.account', compact('user'));
    }
}
