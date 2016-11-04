<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\View;
use App\Expense;
use App\Library\Combobox;
use App\Subcategory;
use Alert;

class ExpenseController extends Controller
{
    public function index() {
        $data = "";

        if (Auth::check()){
            $expense = new Expense();
            $data['data'] = $expense->getExpensesDetail();

            return View::make('expense.index', $data);
        }else{
            Auth::logout();
            return View::make('login');
        }
    }

    public function add(){
        $m = new ComboBox();

        $data['category'] = $m->getComboBoxCategory();
        $data['subcategory'] = $m->getJquerySubCategory();
        $data['account'] = $m->getComboBoxAccount();

        return View::make('expense.add', $data);
    }

    public function save(Request $request){
        $data = "";

        $rules = array(
            'description' => 'required|max:150',
            'amount' => 'required',
            'date' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            Alert::error($validator, trans('messages.expense'))->persistent(trans('menu.close'));
            return Redirect::to('expenses')
                ->withErrors($validator)
                ->withInput($request->except('amount'));
        } else {
            // store
            $account = \App\Account::find($request->input('account_id'));
            $account->balance = $account->balance - $request->input('amount');
            $account->save();
            
            $expense = new Expense();
            $expense->subcategory_id = $request->input('subcategory_id');
            $expense->account_id = $request->input('account_id');
            $expense->description = $request->input('description');
            $expense->observation = $request->input('observation');
            $expense->amount = $request->input('amount');
            $expense->date = $request->input('date');
            $expense->tag = $request->input('tag');

            $msg = $expense->save();

            if ($msg == true){
                Alert::success(trans('messages.save'), trans('messages.expense'))->persistent(trans('menu.close'));
                return Redirect::to('/expenses');
            }else{
                Alert::error(trans('messages.fail'), trans('messages.expense'))->persistent(trans('menu.close'));
                return Redirect::to('/expenses');
            }
        }
    }

    public function edit($id){
        $m = new ComboBox();

        $expense = Expense::find($id);
        $category = \App\Subcategory::find($expense->subcategory_id)->category()->get();
        
        $data['category'] = $m->getComboBoxCategory($category[0]->id);
        $data['subcategory'] = $m->getJquerySubCategory($expense->subcategory_id);
        $data['account'] = $m->getComboBoxAccount($expense->account_id);
        $data['data'] = $expense;

        return View::make('expense.edit', $data);
    }

    public function update(Request $request){
        $data = "";

         $rules = array(
             'subcategory_id' => 'required',
             'account_id' => 'required',
            'description' => 'required|max:150',
            'amount' => 'required',
            'date' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            Alert::error($validator, trans('messages.expense'))->persistent(trans('menu.close'));
            return Redirect::to('expenses')
                ->withErrors($validator)
                ->withInput($request->except('expense'));
        } else {
            // store
            $expense = Expense::find($request->id);
            
            $account = \App\Account::find($request->input('account_id'));
            $account->balance = ($account->balance + $expense->amount) - $request->input('amount');
            $account->save();

            $expense->subcategory_id = $request->input('subcategory_id');
            $expense->account_id = $request->input('account_id');
            $expense->description = $request->input('description');
            $expense->amount = $request->input('amount');
            $expense->date = $request->input('date');
            $expense->observation = $request->input('observation');
            $expense->tag = $request->input('tag');

            $msg = $expense->save();
            
            if ($msg == true){
                Alert::success(trans('messages.update'), trans('messages.expense'))->persistent(trans('menu.close'));
                return Redirect::to('/expenses');
            }else{
                Alert::error(trans('messages.fail'), trans('messages.expense'))->persistent(trans('menu.close'));
                return Redirect::to('/expenses');
            }
        }
    }

    public function delete(Request $request){
        $data = "";
        
        $expense_old = Expense::find($request->id);
        
        $account = \App\Account::find($expense_old->account_id);
        $account->balance = ($account->balance + $expense_old->amount);
        $account->save();

        $expense = Expense::destroy($request->id);
        
        if ($expense == 1){
            Alert::success(trans('messages.delete'), trans('messages.expense'))->persistent(trans('menu.close'));
            return Redirect::to('/expenses');
        }else{
            Alert::error(trans('messages.fail'), trans('messages.expense'))->persistent(trans('menu.close'));
            return Redirect::to('/expenses');
        }
    }
}
