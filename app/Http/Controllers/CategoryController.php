<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\View;
use App\Category;

class CategoryController extends Controller
{
    public function index() {
        $data = "";

        if (Auth::check()){
            $data['data'] = Category::all();

            return View::make('category.index', $data);
        }else{
            return Redirect::to('/');
        }
    }

    public function add(){
        return View::make('category.add');
    }

    public function save(Request $request){
        $data = "";

        $rules = array(
            'category' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('categories')
                ->withErrors($validator)
                ->withInput($request->except('category'));
        } else {
            // store
            $category = new Category();
            $category->category = $request->input('category');

            $data['msg'] = $category->save();
            $data['data'] = Category::all();

            return View::make('category.index', $data);
        }
    }

    public function edit($id){
        $data['data'] = Category::find($id);

        return View::make('category.edit', $data);
    }

    public function update(Request $request){
        $data = "";

        $rules = array(
            'category' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('categories')
                ->withErrors($validator)
                ->withInput($request->except('category'));
        } else {
            // store
            $category = Category::find($request->id);

            $category->id = $request->input('id');
            $category->category = $request->input('category');

            $data['msg'] = $category->save();
            $data['data'] = Category::all();

            return View::make('category.index', $data);
        }
    }

    public function delete(Request $request){
        $data = "";

        $category = Category::destroy($request->id);

        if ($category ==1){
            $data['data'] = Category::all();
            $data['msg'] = true;

            return View::make('category.index', $data);
        } else{
            $data['data'] = Category::all();
            $data['msg'] = false;

            return View::make('category.index', $data);
        }

    }
}
