<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Role;
class Moderators extends Controller
{
    
    public function index()
    {
        $users = User::where('level' , 'admin')->get();
        return view(ad.'.moderators.index',compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view(ad.'.moderators.add',compact('roles'));
    }


    public function store(Request $request,User $user)
    {
       $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'name' => 'required',
        ]);


       $user->name = $request->name;
       $user->email = $request->email;
       $user->password = Hash::make($request->password);
       $user->active = $request->active;
              $user->level = 'admin';


       if($user->save()){
            $user->attachRole($request->group_id);
            $request->session()->flash('alert-success', __('admin.alerts_success_adding'));
        
       }else{
            $request->session()->flash('alert-danger', __('admin.alerts_error_happened'));
       }

       return back();
        
    }
    public function show($id)
    {
        $user = User::find($id);
       return view(ad.'.moderators.show',['user'=>$user]);
    }

   
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
       return view(ad.'.moderators.edite',['user'=>$user,'roles'=>$roles]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    $this->validate($request, [
            'email' => 'required|email|unique:users,email,'.$id,
            //'password' => 'required',
            'name' => 'required',
        ]);

       $user = User::find($id);
       $user->name = $request->name;
       $user->email = $request->email;
       $user->active = $request->active;
       if(!empty($request->password)){
        $user->password = Hash::make($request->password);
       }
       if($user->save()){
            $user->detachRoles($user->roles);
            $user->attachRole($request->group_id);
            $request->session()->flash('alert-success', __('admin.alerts_success_editing'));
        
       }else{
            $request->session()->flash('alert-danger', __('admin.alerts_error_happened'));
       }

       return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $user = User::find($id);

        $user->delete();
        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }


    public function mass_delete(Request $request)
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }
       
       User::destroy($request->checkboxes);
         $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }

}
