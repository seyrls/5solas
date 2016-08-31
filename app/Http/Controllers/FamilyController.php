<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Family;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\View;

class FamilyController extends Controller
{
    public function index() {
        if (Auth::check()){
            $data['data'] = Family::all();
            return View::make('family.index', $data);

        }else{
            Auth::logout();
            return View::make('login');
        }
    }

    public function add(){
        return View::make('family.add');
    }

    public function save(Request $request){


        $rules = array(
            'name' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('families')
                ->withErrors($validator)
                ->withInput($request->except('name'));
        } else {
            // store
            $family = new Family;
            $family->name = $request->input('name');
            $family->address = $request->input('address');

            $data['msg'] = $family->save();
            $data['data'] = $family->all();

            return View::make('family.index', $data);
        }
    }

    public function edit($id){
        $data['data'] = Family::find($id);

        return View::make('family.edit', $data);
    }

    public function update(Request $request){
        $family = Family::find($request->id);

        $family->name = $request->input('name');
        $family->address = $request->input('address');

        $data['msg'] = $family->save();
        $data['data'] = $family->all();

        return View::make('family.index', $data);
    }

    public function delete(Request $request){
        $family = Family::destroy($request->id);

        if ($family ==1){
            $data['data'] = $family->all();
            $data['msg'] = true;

            return View::make('family.index', $data);
        } else{
            $data['data'] = $family->all();
            $data['msg'] = false;

            return View::make('family.index', $data);
        }

    }
}
