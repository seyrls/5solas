<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\View;
use App\Entity;
use Intervention\Image\Facades\Image;

class EntityController extends Controller
{
    public function __construct() {
        if (Auth::check()){
            $this->index();
        }else{
            Auth::logout();
            return View::make('login');
        }
    }

    public function index(){
        $data = "";

        if (Auth::check()){
            $data['data'] = Entity::all();

            return View::make('entity.index', $data);
        }else{
            Auth::logout();
            return View::make('login');
        }
    }

    public function add(){
        return View::make('entity.add');
    }

    public function save(Request $request){
        $rules = array(
            'name' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('entities')
                ->withErrors($validator)
                ->withInput($request->except('name'));
        } else {
            // store
            $entity = new Entity();
            $entity->name = $request->input('name');
            $entity->address = $request->input('address');
            $entity->city = $request->input('city');
            $entity->state = $request->input('state');
            $entity->zip = $request->input('zip');
            $entity->telephone = $request->input('telephone');
            $entity->email = $request->input('email');
            $img = Image::make($request->logo);
            $img->save(base_path('uploads')."/".$request->logo->getClientOriginalName());
            $entity->logo = url('../uploads')."/".$request->logo->getClientOriginalName();

            $data['msg'] = $entity->save();
            $data['data'] = $entity->all();

            return View::make('entity.index', $data);
        }
    }

    public function edit($id){
        $data['data'] = Entity::find($id);
        return View::make('entity.edit', $data);
    }

    public function update(Request $request)
    {
        $rules = array(
            'name' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('entities')
                ->withErrors($validator)
                ->withInput($request->except('name'));
        } else {
            // store
            $entity = Entity::find($request->id);
            $entity->name = $request->input('name');
            $entity->address = $request->input('address');
            $entity->city = $request->input('city');
            $entity->state = $request->input('state');
            $entity->zip = $request->input('zip');
            $entity->telephone = $request->input('telefone');
            $entity->email = $request->input('email');

            if (!empty($request->logo)){
                $img = Image::make($request->logo);
                $img->save(base_path('uploads')."/".$request->logo->getClientOriginalName());
                $entity->logo = url('../uploads')."/".$request->logo->getClientOriginalName();
            }

            $data['msg'] = $entity->save();
            $data['data'] = Entity::all();

            return View::make('entity.index', $data);
        }
    }

    public function delete(Request $request){
        $entity = Entity::destroy($request->id);

        if ($entity ==1){
            $data['data'] = Entity::all();
            $data['msg'] = true;

            return View::make('entity.index', $data);
        } else{
            $data['data'] = Entity::all();
            $data['msg'] = false;

            return View::make('entity.index', $data);
        }

    }
}
