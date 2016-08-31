<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Member;
use App\Family;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Auth::check()){
            $member = new Member();
            $data['data'] = $member->getFamilies();

            return View::make('member.index', $data);
        }else{
            Auth::logout();
            return View::make('login');
        }
    }

    public function add() {
        //data for combobox
        $data['data'] = Family::all();

        return View::make('member.add', $data);
    }

    public function save(Request $request){
        $rules = array(
            'name' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('members')
                ->withErrors($validator)
                ->withInput($request->except('name'));
        } else {
            // store
            $img = Image::make($request->image)->resize(75,75);
            $img->save(base_path('uploads')."/".$request->image->getClientOriginalName());

            $member = new Member();
            $member->family_id = $request->input('family_id');
            $member->name = $request->input('name');
            $member->birthday = $request->input('birthday');
            $member->telephone = $request->input('telephone');
            $member->cellphone = $request->input('cellphone');
            $member->email = $request->input('email');
            $member->gender = $request->input('gender');
            $member->status = $request->input('status');
            $member->image = url('../uploads')."/".$request->image->getClientOriginalName();
            $member->path = base_path('uploads')."/".$request->image->getClientOriginalName();

            $data['msg'] = $member->save();
            $data['data'] = $member->getFamilies();

            return View::make('member.index', $data);
        }
    }

    public function edit($id){
        $data['data'] = Member::find($id);
        $data['family'] = Family::all();

        return View::make('member.edit', $data);
    }

    public function update(Request $request)
    {
        $rules = array(
            'name' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('members')
                ->withErrors($validator)
                ->withInput($request->except('name'));
        } else {
            // store
            $member = Member::find($request->id);
            $member->family_id = $request->input('family_id');
            $member->name = $request->input('name');
            $member->birthday = $request->input('birthday');
            $member->telephone = $request->input('telephone');
            $member->cellphone = $request->input('cellphone');
            $member->email = $request->input('email');
            $member->gender = $request->input('gender');
            $member->status = $request->input('status');

            if (!empty($request->image)){
                $img = Image::make($request->image)->resize(75,75);
                $img->save(base_path('uploads')."/".$request->image->getClientOriginalName());
                $member->image = url('../uploads')."/".$request->image->getClientOriginalName();
                $member->path = base_path('uploads')."/".$request->image->getClientOriginalName();
            }

            $data['msg'] = $member->save();
            $data['data'] = $member->getFamilies();

            return View::make('member.index', $data);
        }
    }

    public function delete(Request $request){
        $members = Member::find($request->id);
        $member = Member::destroy($request->id);
        File::delete($members->path);

        if ($member ==1){
            $obj = new Member();
            $data['data'] = $obj->getFamilies();
            $data['msg'] = true;

            return View::make('member.index', $data);
        } else{
            $obj = new Member();
            $data['data'] = $obj->getFamilies();
            $data['msg'] = false;

            return View::make('member.index', $data);
        }

    }

    public function detail($id){
        $data['data'] = Member::find($id);

        return View::make('member.detail', $data);
    }
}
