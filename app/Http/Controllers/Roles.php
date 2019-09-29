<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;

class Roles extends Controller
{
   
    /*
        method for viewing alla of the administrator roles in the admin panel 
    */
    public function index()
    {
     $roles = Role::all();

     return view(ad.'.roles.index',compact('roles'));   
    }

    /*
        method to view the add roles form
    */
    public function create()
    {
        return view(ad.'.roles/add');
    }

    /*
        method to store the  roles and permessions
    */
    public function store(Request $request,Role $role)
    {
        $this->validate($request, [
            'name' =>  array(
            'bail',
            'required',
            'regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'unique:roles'
            )
            
        ]);
        //first we store the role it self
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        if($role->save()){

        //an empty array to prepare the form date permessions for the roles
        $permessions_list = array();
        //loop throw the form data array and push it to the empty array
            foreach ($request->parmession as $key => $values) {

                foreach ($values as $keys=>$value) {

                    array_push($permessions_list,$value."-".$key);

                }
               
            }

            //getting all the permessions that has ben already stored in the database
            $all_permissions = Permission::all();

            //loop throw the data 
            foreach ($all_permissions as $key=>$permission){
               
               //we check if the permession that`s already stored in database are exists in the form data array
                if(in_array($permission->name, $permessions_list)){
                    //if it is .. then assign that permession to the role we just stored
                    $role->attachPermission($permission->id);
                }else{
                   //if not .. create a new permession in the database and then assign it to the role
                    $new_permission = new Permission();
                    $new_permission->name         = $permission->name;
                    $new_permission->display_name = str_replace('-',' ',$permission->name); 
                    $new_permission->description  = 'can '.str_replace('-',' ',$permission->name);
                    $new_permission->save();
                    $role->attachPermissions($new_permission);
                }
            }   

        }


        $request->session()->flash('alert-success', __('admin.alerts_success_adding'));
        return back();
    }

    
    public function show($id)
    {
        $role = Role::find($id);
       return view(ad.'.roles.show',['role'=>$role]);
    }

   
    public function edit($id)
    {
        $role = Role::find($id);
        
       return view(ad.'.roles.edite',['role'=>$role]);
    }

    
    public function update(Request $request, $id)
    {
       $this->validate($request, [
            'name' =>  array(
            'bail',
            'required',
            'regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'unique:roles,name,'.$id
            )
            
        ]);
        //first we store the role it self
        $role = Role::find($id);
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        if($role->save()){

        //an empty array to prepare the form date permessions for the roles
        $permessions_list = array();
        //loop throw the form data array and push it to the empty array
            foreach ($request->parmession as $key => $values) {

                foreach ($values as $keys=>$value) {

                    array_push($permessions_list,$value."-".$key);

                }
               
            }

            //getting all the permessions that has ben already stored in the database
            $all_permissions = Permission::all();

            //an empty array for the permissions ids so we can sync it for the role
            $permissions_ids = array();
            //loop throw the data 
            foreach ($all_permissions as $key=>$permission){
               //if the permission selected already in databse then we push the id of it to the permissions_ids array and unset it from the main array
                if(in_array($permission->name, $permessions_list)){
                   array_push($permissions_ids,$permission->id);
                   if (($key = array_search($permission->name, $permessions_list)) !== false) {
                        unset($permessions_list[$key]);
                    }
                }
            } 

            //we check the main array that came from the submited form if it still have values it means new roles and not seaved in database so we need to create it
            if(count($permessions_list) != 0){
                //loop throw the unsaved permissions and create it
                foreach ($permessions_list as $key => $value) {
                    //create a new permession in the database and then push it to the sync array
                    $new_permission = new Permission();
                    $new_permission->name         = $value;
                    $new_permission->display_name = str_replace('-',' ',$value); 
                    $new_permission->description  = 'can '.str_replace('-',' ',$value);
                    $new_permission->save();
                    array_push($permissions_ids,$new_permission->id);
                }
                    
            }

            //finally we sync the permissions to the role and update it 
            $role->syncPermissions($permissions_ids);

        }


        $request->session()->flash('alert-success', __('admin.alerts_success_editing'));
        return back();
    }

    
    public function destroy($id)
    {
       
        $role = Role::find($id);

        $role->delete();
        $request->session()->flash('alert-success', __('admin.alerts_success_deleting'));
        return back();
    }

    public function mass_delete(Request $request)
    {
        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }
       
       Role::destroy($request->checkboxes);
        $request->session()->flash('alert-success', __('admin.alerts_success_deleting'));
        return back();
    }
}
