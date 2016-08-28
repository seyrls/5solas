<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Validator;
use App\Type;

class TypeController extends Controller
{
    public function index() {
        if (Auth::check()){
            $data['data'] = Type::all();
            return View::make('type.index', $data);
        }else{
            return Redirect::to('/');
        }
    }

    public function add(){
        return View::make('type.add');
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

            $data['msg'] = $type->save();
            $data['data'] = $type->all();

            return View::make('type.index', $data);
        }
    }

    public function edit($id){
        $data['data'] = Type::find($id);

        return View::make('type.edit', $data);
    }

    public function update(Request $request){
        $type = Type::find($request->id);

        $type->name = $request->input('type');

        $data['msg'] = $type->save();
        $data['data'] = $type->all();

        return View::make('type.index', $data);
    }

    public function delete(Request $request){
        $type = Type::destroy($request->id);

        if ($type ==1){
            $data['data'] = Type::all();
            $data['msg'] = true;

            return View::make('type.index', $data);
        } else{
            $data['data'] = Type::all();
            $data['msg'] = false;

            return View::make('type.index', $data);
        }

    }
}
