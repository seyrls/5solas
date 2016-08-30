<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\View;
use App\User;
use App\Library\Combobox;

class UserController extends Controller
{
    public function index() {
        $data = "";

        if (Auth::check()){
            $user = new User();
            $data['data'] = $user->getUsers();
            return View::make('user.index', $data);
        }else{
            return Redirect::to('/logout');
        }
    }

    public function add(){
        return View::make('user.add');
    }

    public function save(Request $request){
        $rules = array(
            'name' => 'required|max:255',
            'password' => 'required|max:255',
            'email' => 'required|max:255'
        );

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('users')
                ->withErrors($validator)
                ->withInput($request->except('name'));
        } else {
            // store
            $request->merge(['password' => Hash::make($request->password)]);
            $return = User::create($request->all());

            if($return->exists){
                $data['data'] = User::all();
                $data['msg'] = true;
            }else{
                $data['data'] = User::all();
                $data['msg'] = false;
            }

            return View::make('user.index', $data);
        }

    }
}
