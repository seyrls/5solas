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
use Alert;



class TitheController extends Controller
{
    public function index() {
        $data = "";
        
        if (Auth::check()){
            $tithe = new Tithe();
            $data['data'] = $tithe->getTithe();

            return View::make('tithe.index', $data);
        }else{
            Auth::logout();
            return View::make('login');
        }
    }

    public function add(){
        $data = "";
        $combo = new ComboBox();

        $data['family'] = $combo->getComboBoxFamily();
        $data['member'] = $combo->getComboBoxMember();
        $data['type'] = $combo->getComboBoxTypes();
        $data['account'] = $combo->getComboBoxAccount();

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
            Alert::error($validator, 'Error');
            return Redirect::to('tithes')
                ->withErrors($validator)
                ->withInput($request->except('tithe'));
        } else {
            // store
            $account = \App\Account::find($request->input('account_id'));
            $account->balance = $account->balance + $request->input('amount');
            $account->save();
            
            $tithe = new Tithe;
            $tithe->type_id = $request->input('type_id');
            $tithe->member_id = $request->input('member_id');
            $tithe->account_id = $request->input('account_id');
            $tithe->period = $request->input('period');
            $tithe->amount = $request->input('amount');

            $data['msg'] = $tithe->save();
            
            if ($data['msg'] == true){
                Alert::success(trans('messages.save'), trans('messages.tithe'))->persistent(trans('menu.close'));
                return Redirect::to('/tithes');
            }else{
                Alert::error(trans('messages.fail'), trans('messages.tithe'))->persistent(trans('menu.close'));
                return Redirect::to('/tithes');
            }
        }
    }

    public function edit($id){
        if (Auth::check()){
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
            $data['account'] = $combo->getComboBoxAccount($data['data']->account_id);

            //send data to view
            return View::make('tithe.edit', $data);
        }else{
            Auth::logout();
            return View::make('login');
        }
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
            Alert::error($validator, trans('messages.tithe'))->persistent(trans('menu.close'));
            return Redirect::to('tithes')
                ->withErrors($validator)
                ->withInput($request->except('amount'));
        } else {
            // store
            $tithe = Tithe::find($request->id);
            
            $account = \App\Account::find($request->input('account_id'));
            $account->balance = ($account->balance - $tithe->amount) + $request->input('amount');
            $account->save();

            $tithe->type_id = $request->input('type_id');
            $tithe->member_id = $request->input('member_id');
            $tithe->period = $request->input('period');
            $tithe->amount = $request->input('amount');

            $data['msg'] = $tithe->save();
            
            if ($data['msg'] == true){
                Alert::success(trans('messages.update'), trans('messages.tithe'))->persistent(trans('menu.close'));
                return Redirect::to('/tithes');
            }else{
                Alert::error(trans('messages.fail'), trans('messages.tithe'))->persistent(trans('menu.close'));
                return Redirect::to('/tithes');
            }
        }
    }

    public function delete(Request $request){
        $data = "";
        $obj = new Tithe();
        $tithe = Tithe::destroy($request->id);

        if ($tithe ==1){
            Alert::success(trans('messages.delete'), trans('messages.tithe'))->persistent(trans('menu.close'));
            return Redirect::to('/tithes');
        } else{
            Alert::error(trans('messages.fail'), trans('messages.tithe'))->persistent(trans('menu.close'));

            return Redirect::to('/tithes');
        }

    }
}
