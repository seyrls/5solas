<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Member;
use App\Family;

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
            $data = $member->getFamilies();
            return view('member.index', compact('data'));
        }else{
            return Redirect::to('/');
        }
    }

    public function add() {
        //data for combobox
        $data = Family::all();

        return view ('member.add', compact('data'));
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
            $member = new Member();
            $member->family_id = $request->input('family_id');
            $member->name = $request->input('name');
            $member->birthday = $request->input('birthday');
            $member->telephone = $request->input('telephone');
            $member->cellphone = $request->input('cellphone');
            $member->email = $request->input('email');
            $member->gender = $request->input('gender');
            $member->status = $request->input('status');

            $msg = $member->save();
            $data = $member->getFamilies();

            return view('member.index', compact('msg'), compact('data'));
        }
    }

    public function edit($id){
        $data = Member::find($id);
        $family = Family::all();

        return view('member.edit', compact('data'), compact('family'));
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

            $msg = $member->save();
            $data = $member->getFamilies();

            return view('member.index', compact('msg'), compact('data'));
        }
    }

    public function delete(Request $request){
        $member = Member::destroy($request->id);

        if ($member ==1){
            $data = $member->getFamilies();
            $msg = true;

            return view('family.index', compact('msg'), compact('data'));
        } else{
            $data = $member->getFamilies();
            $msg = false;

            return view('family.index', compact('msg'), compact('data'));
        }

    }
}
