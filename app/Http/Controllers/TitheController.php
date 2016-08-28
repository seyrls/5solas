<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Combobox;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Tithe;
use App\Member;
use Illuminate\Support\Facades\View;



class TitheController extends Controller
{
    public function index() {
        $data = "";

        if (Auth::check()){
            $tithe = new Tithe();
            $data['data'] = $tithe->getTithe();

            return View::make('tithe.index', $data);
        }else{
            return Redirect::to('/');
        }
    }

    public function add(){
        $data = "";
        $combo = new ComboBox();

        $data['family'] = $combo->getComboBoxFamily();
        $data['member'] = $combo->getComboBoxMember();
        $data['type'] = $combo->getComboBoxTypes();

        return View::make('tithe.add', $data);
    }

    public function save(Request $request){
        $data = "";

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

            $data['msg'] = $tithe->save();
            $data['data'] = $tithe->getTithe();

            return View::make('tithe.index', $data);
        }
    }

    public function edit($id){
        //Object to create combobox
        $combo = new ComboBox();

        //get all data
        $data['data'] = Tithe::find($id);

        //get family_id on Member's table
        $family = Member::find($data['data']->member_id)->family()->get();

        //load html combobox
        $data['family'] = $combo->getComboBoxFamily($family->pluck('id')[0]);
        $data['member'] = $combo->getJqueryMember($family->pluck('id')[0]);
        $data['type'] = $combo->getComboBoxTypes($data['data']->type_id);

        //send data to view
        return View::make('tithe.edit', $data);
    }

    public function update(Request $request){
        $data = "";

        $rules = array(
            'period' => 'required',
            'amount' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('tithes')
                ->withErrors($validator)
                ->withInput($request->except('amount'));
        } else {
            // store
            $tithe = Tithe::find($request->id);

            $tithe->type_id = $request->input('type_id');
            $tithe->member_id = $request->input('member_id');
            $tithe->period = $request->input('period');
            $tithe->amount = $request->input('amount');

            $data['msg'] = $tithe->save();
            $data['data'] = $tithe->getTithe();

            return View::make('tithe.index', $data);
        }
    }

    public function delete(Request $request){
        $data = "";
        $obj = new Tithe();
        $tithe = Tithe::destroy($request->id);

        if ($tithe ==1){
            $data['data'] = $obj->getTithe();
            $data['msg'] = true;

            return view('tithe.index', compact('msg', 'data'));
        } else{
            $data['data'] = $obj->getTithe();
            $data['msg'] = false;

            return View::make('tithe.index', $data);
        }

    }
}
