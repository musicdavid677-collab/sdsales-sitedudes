<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index()
    {
    $users=User::all();
    $users=json_encode($users);
    return view('users.index')->with('users',$users);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {

        //$data   = User::dropdowns();
         $rec='';
         $data=[];
         $roles=Role::all();
   return view('users.create', compact('data'))->with('rec',$rec)->with('roles',$roles);
    

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
    //    if(request()->headers->get('referer') == route('edit_team_member_page', $member->id))
    //    {
    //         $member = new stdClass;
    //    }
    //    $data   = User::dropdowns();
    //    $member->team_id        = $member->teams()->pluck('team_id')->toArray();
    //    $member->skill_id       = $member->skills()->pluck('skill_id')->toArray();
    //    $member->department_id  = $member->departments()->pluck('department_id')->toArray();
    $roles=Role::all();
    $data=[];
        $user->is_admin=auth()->user()->is_administrator;
        return view('users.create', compact('data'))->with('rec',$user)->with('roles',$roles);

    }
    
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|email|unique:users',
            //'job_title'     => 'required',
            'password'      => 'nullable|min:6'
           // 'salary'        => 'nullable|numeric'

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        

        $obj = new User();     
        $obj->first_name        = $request->first_name;
        $obj->last_name         = $request->last_name;
        $obj->email             = $request->email;
        $obj->password          = Hash::make($request->password ?? DEFAULT_USER_PASSWORD) ;
        $obj->gender         = $request->gender;
        $obj->birth_date        = date2sql($request->birth_date);
        $obj->phone             = $request->phone;
        $obj->address           = $request->address;
    /*    $obj->city           = $request->city;
        $obj->state           = $request->state;
        $obj->zip_code           = $request->zip_code;
        $obj->country_id           = $request->country_id;*/
        $obj->job_title         = $request->job_title;
        $obj->start_date      = date2sql($request->start_date);
        $obj->is_administrator  = $request->is_administrator;
        $obj->role_id           = $request->role_id;


        $obj->save();
        session()->flash('message', __('form.success_add'));
        return redirect()->route('users');
    }

/**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request $request
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        $validator = Validator::make($request->all(), [

            'first_name'    => 'required',
            'last_name'     => 'required',         
            'email'         => [
                                'required',
            ],
            'password'      => 'sometimes|nullable|min:6',

        ]);

        if ($validator->fails()) {


            return redirect()->back()
                ->withErrors($validator)
                ->withInput(Input::all());
        }

       
        $obj = $user;
    
        $obj->first_name        = $request->first_name;
        $obj->last_name         = $request->last_name;
        $obj->email             = $request->email;

        if($request->password)
        {
            $obj->password          = Hash::make($request->password) ;
        }

        
        $obj->gender        = $request->gender;
        $obj->birth_date        = date2sql($request->birth_date);
        $obj->phone             = $request->phone;
        $obj->address           = $request->address;
    /*    $obj->city           = $request->city;
        $obj->state           = $request->state;
        $obj->zip_code           = $request->zip_code;
        $obj->country_id           = $request->country_id;*/

        $obj->job_title         = $request->job_title;

        $obj->start_date      = date2sql($request->start_date);

        $obj->is_administrator  = $request->is_administrator;
        $obj->role_id           = $request->role_id;



        $obj->save();


        session()->flash('message', __('form.success_update'));
        return redirect()->route('users');

    }


}
