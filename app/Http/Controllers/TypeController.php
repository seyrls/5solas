<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Type;

class TypeController extends Controller
{
    public function index() {
        if (Auth::check()){
            $data = Type::all();
            return view('type.index', compact('data'));
        }else{
            return Redirect::to('/');
        }
    }

    public function add(){
        return view('type.add');
    }

    public function save(Request $request){
        $rules = array(
            'type' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('types')
                ->withErrors($validator)
                ->withInput($request->except('type'));
        } else {
            // store
            $type = new Type;
            $type->type = $request->input('type');

            $msg = $type->save();
            $data = $type->all();

            return view('type.index', compact('msg'), compact('data'));
        }
    }

    public function edit($id){
        $data = Type::find($id);

        return view('type.edit', compact('data'));
    }

    public function update(Request $request){
        $type = Type::find($request->id);

        $type->name = $request->input('type');

        $msg = $type->save();
        $data = $type->all();

        return view('type.index', compact('msg'), compact('data'));
    }

    public function delete(Request $request){
        $type = Type::destroy($request->id);

        if ($type ==1){
            $data = Type::all();
            $msg = true;

            return view('type.index', compact('msg'), compact('data'));
        } else{
            $data = Type::all();
            $msg = false;

            return view('type.index', compact('msg'), compact('data'));
        }

    }
}
