<?php

namespace App\Http\Controllers;
use App\Model\Role;
use App\Model\Permission;
use App\Model\RolePermission;
use App\Model\RoleType;
use Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class RoleController extends Controller
{
    public function index(){
      abort_if(Gate::denies('view-roles'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data['all_role'] = Role::with('permission','role_type')->paginate(10);
        return view('main/admin/role/role_list', $data);
    }

    public function role_form(){
      abort_if(Gate::denies('view-roles'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data['all_permission'] = Permission::all();
        $data['role_type']      = RoleType::all();
        return view('main/admin/role/add_role', $data);
    }

    public function add_role(Request $request){
        $validations = $request->validate([
            'role_name'    => 'required|string',
            'role_type'    => 'required',
            'permission'   => 'required'
        ]);

        $insert_role = new Role;
        $insert_role->role_name = $request->role_name;
        $insert_role->role_type_id   = $request->role_type;
        $insert_role->save();
        $last_id = $insert_role->role_id;


        $permissions = $request->input('permission');
        if($permissions != ''){
          foreach($permissions as $x){
            $insert = new RolePermission;
            $insert->roles_id = $last_id;
            $insert->permission_id = $x;
            $insert->save();
          }
        }

        Session::flash('add_role', 'Successfuly Created');
        return redirect()->action('RoleController@index');
    }

    public function edit_role(Request $request){
      $role_id = $request->input('id');
      $data['all_role'] = Role::with('permission')->find($role_id);
      $data['role_type'] = RoleType::all();
      $data['all_permission'] = Permission::all();
      return view('main/admin/role/edit_role', $data);
    }

    public function update_role(Request $request){
        $validations = $request->validate([
          'role_name'    => 'required|string',
          'role_type'    => 'required',
          'permission'   => 'required'
        ]);
        
        $role_id = $request->input('role_id');
        $update_role = Role::find($role_id);
        $update_role->role_name = $request->role_name;
        $update_role->role_type_id = $request->role_type;
        $update_role->save();

        $permissions = $request->input('permission');
        if($permissions != ''){
          foreach($permissions as $x){
            $old_id = RolePermission::where('roles_id', $role_id)->where('permission_id', $x)->get();
            if($old_id->isEmpty()){
              $insert = new RolePermission;
              $insert->roles_id = $role_id;
              $insert->permission_id = $x;
              $insert->save();
            }
          }
        }

        $old_id = RolePermission::where('roles_id', $role_id)->get();
        foreach($old_id as $x){
          if($permissions != ''){
            if(!in_array($x->permission_id, $permissions)){
                RolePermission::destroy($x->rp_id);
            }
        }
         else{
                RolePermission::destroy($x->rp_id);
        }
      }

      Session::flash('updated_role','Successfully Updated.');
      return redirect()->action('RoleController@index');
    }


    public function delete_role(Request $request){
      $role_id = $request->input('id');
      $role = Role::find($role_id);
      $role->delete();

      $role_permission = RolePermission::where('roles_id', $role_id)->delete();
  
      if($role == true && $role_permission == true){
          return 'Deleted';
      }
      else {
          return 'Not Deleted';
      }

    }
   
    public function select_all(Request $request){
      $data['all_permission'] = Permission::all();
      return view('main/admin/role/select_all', $data);
  }

  public function deselect_all(Request $request){
    $data['all_permission'] = Permission::all();
    return view('main/admin/role/deselect_all', $data);
   }
}
