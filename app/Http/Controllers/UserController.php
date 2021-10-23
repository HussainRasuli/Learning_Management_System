<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Hash;
use App\Model\Teacher;
use App\Model\Student;
use App\Model\Staff;
use App\Model\Department;
use App\User;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class UserController extends Controller
{
    protected function index(){
        abort_if(Gate::denies('view-users'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return view('main/admin/user/user_list');
    }
    
    protected function getUsers()
    {
        $section = Request::input('type');
        $id      = Request::input('id');
        
        if(($section != '') && ($id != '')){ // Search Both
            $user = User::where('email', $id . '@gawharshad.edu.com')->get();

            foreach($user as $row)
            {
                $table_name = $row->table_name;
                $record_id  = $row->record_id;
                $status     = $row->user_status;
                $role_id    = $row->role_id;
            }
            if($section == 1){
                $data = Teacher::with('user.user_role', 'dep')->find($record_id);
            }else if($section == 2){
                $data = Student::with('user.user_role', 'dep')->find($record_id);
            }else if($section == 3){
                $data = Staff::with('user.user_role', 'dep')->find($record_id);
            }

            return view('main/admin/user/user_individual', compact('data'));
        }else if($section != ''){ // Search By Section
            if($section == 1){
                $data = Teacher::with('user.user_role', 'dep')->get();
            }else if($section == 2){
                $data = Student::with('user.user_role', 'dep')->get();
            }else if($section == 3){
                $data = Staff::with('user.user_role', 'dep')->get();
            }

            return view('main/admin/user/user_pagination', compact('data'));
        }else if($id != ''){ // Search By ID
            $user = User::where('email', 'like', '%' . $id . '%')->get();

            foreach($user as $row)
            {
                $table_name = $row->table_name;
                $record_id  = $row->record_id;
                $status     = $row->user_status;
                $role_id    = $row->role_id;
            }

            if($table_name == 1){
                $data = Teacher::with('user.user_role', 'dep')->find($record_id);
            }else if($table_name == 2){
                $data = Student::with('user.user_role', 'dep')->find($record_id);
            }else if($table_name == 3){
                $data = Staff::with('user.user_role', 'dep')->find($record_id);
            }

            return view('main/admin/user/user_individual', compact('data'));
        }
    }

    protected function editUser($id)
    {
        $data['user']       = User::find($id);
        $data['department'] = Department::all();
        
        if($data['user']->table_name == 3){
            $data['staff'] = Staff::find($data['user']->record_id);
        }
        
        return view('main/admin/user/user-edit-modal', $data);
    }

    protected function updateUser()
    {
        $data       = Request::input('data-id');
        $new_pass   = Request::input('new-pass');
        $conf_pass  = Request::input('conf-pass');

        $department = Request::input('department');
        $staff      = Request::input('staff');

        if(($department != '') && ($new_pass != '') && ($conf_pass != '') && ($new_pass == $conf_pass)){
            $update             = User::find($data);
            $update->password   = Hash::make($new_pass);
            $update->save();

            return UserController::updateDepartmentAdmin($department, $staff);
                
        }else if(($department != '') && ($new_pass == '') && ($conf_pass == '')){

            return UserController::updateDepartmentAdmin($department, $staff);
            
        }else if(($department == '') && ($new_pass != '') && ($conf_pass != '') && ($new_pass == $conf_pass)){
            $update             = User::find($data);
            $update->password   = Hash::make($new_pass);
            $update->save();
        }
    }

    protected function updateDepartmentAdmin($department, $staff)
    {
        $update_staff_department = Staff::find($staff);

        if(($update_staff_department->dep_id != '') && ($update_staff_department->dep_id != 70)){

            $search_for_duplicate = Staff::where('dep_id', $department)->first();

            if($search_for_duplicate != ''){

                $duplicate_staff_id = $search_for_duplicate->staff_id;
        
                $update_user_duplicate_role = User::where(['table_name' => 3, 'record_id' => $duplicate_staff_id])->first();
                $update_user_duplicate_role->role_id = 5;
                $update_user_duplicate_role->save();

                $update_user_duplicate_role = User::where(['table_name' => 3, 'record_id' => $staff])->first();
                $update_user_duplicate_role->role_id = 2;
                $update_user_duplicate_role->save();

                $update_duplicate_staff_department = Staff::find($duplicate_staff_id);
                $update_duplicate_staff_department->dep_id = 70;
                $update_duplicate_staff_department->save();

                $update_duplicate_department = Department::find($update_staff_department->dep_id);
                $update_duplicate_department->set_admin = 0;
                $update_duplicate_department->save(); 

                $update_staff_department->dep_id = $department;
                $update_staff_department->save();

                return 'Updated';
            }else{
                $update_department = Department::find($update_staff_department->dep_id);
                $update_department->set_admin = 0;
                $update_department->save();   
                
                $update_staff_department->dep_id = $department;
                $update_staff_department->save();
                
                $update_department = Department::find($department);
                $update_department->set_admin = 1;
                $update_department->save();
                return 'Updated';
            }

        }else if(($update_staff_department->dep_id != '') && ($update_staff_department->dep_id == 70)){
            $search_for_duplicate = Staff::where('dep_id', $department)->first();

            if($search_for_duplicate != ''){

                $duplicate_staff_id = $search_for_duplicate->staff_id;
                
                $update_duplicate_staff_department = Staff::find($duplicate_staff_id);
                $update_duplicate_staff_department->dep_id = 70;
                $update_duplicate_staff_department->save();

                $update_staff_department->dep_id = $department;
                $update_staff_department->save();

                return 'Updated';
            }else{
                $update_staff_department->dep_id    = $department;
                $update_staff_department->save();

                $update_department = Department::find($department);
                $update_department->set_admin = 1;
                $update_department->save();    
                return 'Updated';        
            }
        }   
    }

    protected function deleteUser()
    {
        $data   = Request::input('data-id');
        $delete = User::find($data);
        $staff_id = $delete->record_id;
        $delete->delete();
    
        $update   = Staff::find($staff_id);
        $dep_id   = $update->dep_id;
        $update->dep_id = 0;
        $update->save();

        $update_dep = Department::find($dep_id);
        $update_dep->set_admin = 0;
        $update_dep->save();

        
        if($delete == true){
            return 'Deleted';
        }else{
            return 'not';
        }
    }
}
