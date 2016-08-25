<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\View;
use App\Subcategory;
use App\Library\Combobox;

class SubcategoryController extends Controller
{
    public function index() {
        $data = "";

        if (Auth::check()){
            $subcategory = new Subcategory();
            $data['data'] = $subcategory->getCategories();

            return View::make('subcategory.index', $data);
        }else{
            return Redirect::to('/');
        }
    }

    public function add(){
        $m = new ComboBox();

        $data['category'] = $m->getComboBoxCategory();

        return View::make('subcategory.add', $data);
    }

    public function save(Request $request){
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
            $subcategory = new subcategory();
            $subcategory->subcategory = $request->input('subcategory');
            $subcategory->category_id = $request->input('category_id');

            $data['msg'] = $subcategory->save();
            $data['data'] = $subcategory->getCategories();

            return View::make('subcategory.index', $data);
        }
    }

    public function edit($id){
        $m = new ComboBox();

        $data['data'] = Subcategory::find($id);
        $data['category'] = $m->getComboBoxCategory($data['data']->category_id);

        return View::make('subcategory.edit', $data);
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

            return View::make('subcategory.index', $data);
        }
    }

    public function delete(Request $request){
        $data = "";

        $subcategory = Subcategory::destroy($request->id);

        if ($subcategory ==1){
            $data['data'] = Subcategory::all();
            $data['msg'] = true;

            return View::make('subcategory.index', $data);
        } else{
            $data['data'] = Subcategory::all();
            $data['msg'] = false;

            return View::make('subcategory.index', $data);
        }

    }
}
