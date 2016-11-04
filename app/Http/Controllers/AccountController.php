<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\View;
use App\Account;
use Alert;


class AccountController extends Controller
{
    public function index() {
        $data = "";

        if (Auth::check()){
            $data['data'] = Account::all();

            return View::make('account.index', $data);
        }else{
            Auth::logout();
            return View::make('login');
        }
    }

    public function add(){
        return View::make('account.add');
    }

    public function save(Request $request){
        $data = "";

        $rules = array(
            'account_name' => 'required|max:45',
            'balance' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            Alert::error($validator, '')->persistent('Fechar');
            return Redirect::to('accounts')
                ->withErrors($validator)
                ->withInput($request->except('account_name'));
        } else {
            // store
            $account = new Account();
            $account->account_name = $request->input('account_name');
            $account->balance = $request->input('balance');

            $data['msg'] = $account->save();
            $data['data'] = Account::all();

            return View::make('account.index', $data);
        }
    }

    public function edit($id){
        $data['data'] = Account::find($id);

        return View::make('account.edit', $data);
    }

    public function update(Request $request){
        $data = "";

        $rules = array(
            'account_name' => 'required|max:45',
            'balance' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('accounts')
                ->withErrors($validator)
                ->withInput($request->except('account_name'));
        } else {
            // store
            $account = Account::find($request->id);

            $account->id = $request->input('id');
            $account->account_name = $request->input('account_name');
            $account->balance = $request->input('balance');

            $data['msg'] = $account->save();
            $data['data'] = Account::all();

            return View::make('account.index', $data);
        }
    }

    public function delete(Request $request){
        $data = "";

        $account = Account::destroy($request->id);

        if ($account ==1){
            $data['data'] = Account::all();
            $data['msg'] = true;

            return View::make('account.index', $data);
        } else{
            $data['data'] = Account::all();
            $data['msg'] = false;

            return View::make('account.index', $data);
        }

    }
}
