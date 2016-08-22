<?php

namespace App\Http\Controllers;

use App\Member;
use App\Type;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Tithe;

class TitheController extends Controller
{
    public function index() {
        if (Auth::check()){
            $tithe = new Tithe();
            $data = $tithe->getTithe();

            return view('tithe.index', compact('data'));
        }else{
            return Redirect::to('/');
        }
    }

    public function add(){
        $member = Member::all();
        $type = Type::all();
        return view('tithe.add', compact('member'), compact('type'));
    }

    public function save(Request $request){
        $rules = array(
            'period' => 'required',
            'amount' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('tithes')
                ->withErrors($validator)
                ->withInput($request->except('tithe'));
        } else {
            // store
            $tithe = new Tithe;
            $tithe->type_id = $request->input('type_id');
            $tithe->member_id = $request->input('member_id');
            $tithe->period = $request->input('period');
            $tithe->amount = $request->input('amount');

            $msg = $tithe->save();
            $data = $tithe->getTithe();

            return view('tithe.index', compact('msg'), compact('data'));
        }
    }

    public function edit($id){
        $data = Tithe::find($id);

        $member = Member::all();
        $type = Type::all();

        dd($type);

        return view('tithe.edit', compact('data'), compact('member'), compact('type'));
    }

    public function update(Request $request){
        $Tithe = Tithe::find($request->id);

        $Tithe->name = $request->input('tithe');

        $msg = $Tithe->save();
        $data = $Tithe->all();

        return view('tithe.index', compact('msg'), compact('data'));
    }

    public function delete(Request $request){
        $Tithe = Tithe::destroy($request->id);

        if ($Tithe ==1){
            $data = Tithe::all();
            $msg = true;

            return view('tithe.index', compact('msg'), compact('data'));
        } else{
            $data = Tithe::all();
            $msg = false;

            return view('tithe.index', compact('msg'), compact('data'));
        }

    }
}
