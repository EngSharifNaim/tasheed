<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Users_addresse ;

class Users extends Controller
{
    
    public function getdealers(Request $request)
    {
        $users = User::where('level','dealer')->get();
        return view(ad.'.users.index',compact('users'));
    }
    public function getanother(Request $request)
    {
        $users = User::where('level' , '!=' ,'dealer')->where('level' , '!=' ,'user')->where('level' , '!=' ,'admin')->get();
        return view(ad.'.users.index',compact('users'));
    }

    public function index(Request $request)
    {
        $users = User::where('level','user')->get();
        return view(ad.'.users.index',compact('users'));
    }

    public function create()
    {
        return view(ad.'.users.add');
    }


    public function store(Request $request,User $user)
    {
       $this->validate($request, [
            'email' => 'required|email|unique:users',
            'name' => 'required',
        ]);


       $user->name = $request->name;
       $user->email = $request->email;
       $user->password = Hash::make($request->password);
       $user->active = $request->active;
       $user->level = $request->level;

       if($user->save()){
            $request->session()->flash('alert-success', __('admin.alerts_success_adding'));
        
       }else{
            $request->session()->flash('alert-danger', __('admin.alerts_error_happened'));
       }

       return back();
        
    }
    public function show($id)
    {
        $user = User::find($id);
        $user_addresses = Users_addresse::where('user_id' , $id )->get() ;
       return view(ad.'.users.show',['user'=>$user , 'user_addresses'=> $user_addresses ]);
    }

   
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $user_addresses = Users_addresse::where('user_id' , $id )->get() ;
       return view(ad.'.users.edite',['user'=>$user,'roles'=>$roles , 'user_addresses'=> $user_addresses ]);
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'name' => 'required',
        ]);

       $user = User::find($id);
       $user->name = $request->name;
       $user->email = $request->email;
       $user->active = $request->active;
       $user->level = $request->level;
       if(!empty($request->password)){
        $user->password = Hash::make($request->password);
       }

       if($user->save()){
           //update addresse
           /*$region_id = (isset($request->region_id)) ? $request->region_id : 0 ;
           $addresse = Users_addresse::find(intval($request->addresse_id)) ;
           $addresse->user_id = $user->id ;
           $addresse->addresse_ar = $request->name_ar ;
           $addresse->addresse_en = $request->name_en ;
           $addresse->countrie_id = $request->countrie_id ;
           $addresse->citie_id = $request->citie_id ;
           $addresse->region_id = $region_id ;*/
           //end updateing addresse
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
       // $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }


    public function mass_delete(Request $request)
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }
       foreach($request->checkboxes as $value){
           $user = User::find(intval($value)) ;
           $user->email = $user->email.'_old'.time() ;
           $user->delete() ;
       }
      // User::destroy($request->checkboxes);
         $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }

}
