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

class ExpenseController extends Controller
{
    public function index() {
        $data = "";

        if (Auth::check()){
            $expense = new Expense();
            $data['data'] = $expense->getExpenses();

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
            return Redirect::to('expenses')
                ->withErrors($validator)
                ->withInput($request->except('amount'));
        } else {
            // store
            $expense = new Expense();
            $expense->subcategory_id = $request->input('subcategory_id');
            $expense->account_id = $request->input('account_id');
            $expense->description = $request->input('description');
            $expense->observation = $request->input('observation');
            $expense->amount = $request->input('amount');
            $expense->date = $request->input('date');
            $expense->tag = $request->input('tag');

            $data['msg'] = $expense->save();
            $data['data'] = $expense->getExpenses();

            return View::make('expense.index', $data);
        }
    }

    public function edit($id){
        $m = new ComboBox();

        $data['data'] = Subcategory::find($id);
        $data['category'] = $m->getComboBoxCategory($data['data']->category_id);

        return View::make('expense.edit', $data);
    }

    public function update(Request $request){
        $data = "";

        $rules = array(
            'subcategory' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('subcategories')
                ->withErrors($validator)
                ->withInput($request->except('subcategory'));
        } else {
            // store
            $subcategory = Subcategory::find($request->id);

            $subcategory->id = $request->input('id');
            $subcategory->category_id = $request->input('category_id');
            $subcategory->subcategory = $request->input('subcategory');

            $data['msg'] = $subcategory->save();
            $data['data'] = Subcategory::all();

            return View::make('expense.index', $data);
        }
    }

    public function delete(Request $request){
        $data = "";

        $subcategory = Subcategory::destroy($request->id);

        if ($subcategory ==1){
            $data['data'] = Subcategory::all();
            $data['msg'] = true;

            return View::make('expense.index', $data);
        } else{
            $data['data'] = Subcategory::all();
            $data['msg'] = false;

            return View::make('expense.index', $data);
        }

    }
}
