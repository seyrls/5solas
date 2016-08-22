<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Family;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;

class FamilyController extends Controller
{
    public function index() {
        if (Auth::check()){
            $data = Family::all();
            return view('family.index', compact('data'));

        }else{
            return Redirect::to('/');
        }
    }

    public function add(){
        return view('family.add');
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

            $msg = $family->save();
            $data = $family->all();

            return view('family.index', compact('msg'), compact('data'));
        }
    }

    public function edit($id){
        $data = Family::find($id);

        return view('family.edit', compact('data'));
    }

    public function update(Request $request){
        $family = Family::find($request->id);

        $family->name = $request->input('name');
        $family->address = $request->input('address');

        $msg = $family->save();
        $data = $family->all();

        return view('family.index', compact('msg'), compact('data'));
    }

    public function delete(Request $request){
        $family = Family::destroy($request->id);

        if ($family ==1){
            $data = $family->all();
            $msg = true;

            return view('family.index', compact('msg'), compact('data'));
        } else{
            $data = $family->all();
            $msg = false;

            return view('family.index', compact('msg'), compact('data'));
        }

    }
}
