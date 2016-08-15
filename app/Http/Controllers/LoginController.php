<?php

namespace App\Http\Controllers;


use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;


use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()){
            echo(Auth::user()->name);
            return view('dashboard.index');
        }else{
            Auth::logout();
            return view('login');
        }
    }

   public function login(){

       $data = Input::all();


       //Validar campos
       $rules = array(
           'email' => 'required|email',
           'password' => 'required|min:6',
       );
       $validator = Validator::make($data, $rules);

       if ($validator->fails()){
           // If validation falis redirect back to login.
           return Redirect::to('/')->withInput(Input::except('password'))->withErrors($validator);
       }
       else {
           $userdata = array(
               'email' => Input::get('email'),
               'password' => Input::get('password')
           );
           // doing login.
           if (Auth::validate($userdata)) {
               if (Auth::attempt($userdata)) {
                   return Redirect::intended('/dashboard');
               }
           } else {
               // if any error send back with message.
               Session::flash('error', 'Something went wrong');
               return Redirect::to('/');
           }
       }

   }

   public function logout() {
       Auth::logout();
       return Redirect::to('/');
   }

}
