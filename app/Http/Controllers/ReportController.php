<?php

namespace App\Http\Controllers;

use App\Member;
use App\Tithe;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\View;

class ReportController extends Controller
{
    public function __construct()
    {
        if (Auth::check()){

        }else{
            Auth::logout();
            return View::make('login');
        }
    }

    public function index(){
        return View::make('report.index');
    }

    public function totalTithesMember(){
        $obj = new Tithe();
        $data['data'] = $obj->getTithesTotalMember();

        return View::make('report.tithemember', $data);
    }

    public function tithesDetail($id){
        $data['tithes'] = Member::find($id)->tithe()->get();
        $data['member'] = Member::find($id);

        return View::make('report.tithedetail', $data);
    }

    public function tithesPeriod(Request $request){
        if ((!empty($request->initialdate)) && (!empty($request->finaldate))){
            $data['data'] = Tithe::where('period', '>=', $request->initialdate)->where('period', '<=', $request->finaldate)->get();
        }elseif ((!empty($request->initialdate)) || (!empty($request->finaldate))){
            if (!empty($request->initialdate)){
                $data['data'] = Tithe::where('period', '>=', $request->initialdate)->get();
            }else{
                $data['data'] = Tithe::where('period', '<=', $request->finaldate)->get();
            }
        }else{
            $data['data'] = Tithe::all();
        }

        return View::make('report.titheperiod', $data);

    }
}
