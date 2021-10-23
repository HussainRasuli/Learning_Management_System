<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Model\Faculty;
use App\Model\Staff;
use App\Model\Role;
use App\Model\PeriodYear;
use App\User;
use App\Model\Department;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class FacultyController extends Controller
{
    public function index(){
        abort_if(Gate::denies('view-faculties'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data['all_faculty']  = Faculty::with('dep')->get();
        $data['staff']        = Staff::with('user')->get();
        $data['role']         = Role::all();
        return view('main/admin/faculty/faculty_list', $data);
    }

    public function show(){
        abort_if(Gate::denies('view-faculties'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return view('main/admin/faculty/add_faculty');
    }

    public function store(Request $request){

        $validations = $request->validate([
            'faculty'    => 'required',
            'department' => 'required',
            'dep_code'   => 'required'
        ]);

        $insert_faculty = new Faculty();
        $insert_faculty->fac_name = $request->faculty;
        $insert_faculty->save();
        $last_id = $insert_faculty->fac_id;
        

        $departments = $request->input('department');
        $dep_code    = $request->input('dep_code');

        if($departments != ''){
          foreach($departments as $key => $value){
            $insert_department = new Department();
            $insert_department->dep_name = $departments[$key];
            $insert_department->dep_code = $dep_code[$key];
            $insert_department->fac_id   = $last_id;
            $insert_department->save();
          }
        }

        Session::flash('added', 'Successfuly added');
        return redirect()->action('FacultyController@index');
    }

    public function edit(Request $request){
        $fac_id = $request->input('id');
        $faculty = Faculty::find($fac_id);
        $department = Department::all();
        return view('main/admin/faculty/add_new_department',compact('faculty','department'));
    }

    public function add_new_department(Request $request){
        $validations = $request->validate([
            'department' => 'required|string',
            'dep_code' => 'required|numeric'
        ]);
        
        $faculty_id  = $request->input('faculty_id');
        $departments = $request->input('department');
        $dep_code    = $request->input('dep_code');

        if($departments != ''){
          foreach($departments as $key => $value){
            $insert_department = new Department();
            $insert_department->dep_name = $departments[$key];
            $insert_department->dep_code = $dep_code[$key];
            $insert_department->fac_id   = $faculty_id;
            $insert_department->save();
          }
        }

        Session::flash('new_department', 'Successfuly added');
        return redirect()->action('FacultyController@index');
    }

    public function delete_faculty(Request $request){
        $fac_id = $request->input('id');
        $faculty = Faculty::find($fac_id);
        $department = Department::where('fac_id',$fac_id);
        $faculty->delete();
        $department->delete();

        if($faculty == true && $department == true){
            return 'Deleted';
        }
        else{
            return 'NotDeleted';
        }
    }

    public function delete_department(Request $request){
        $dep_id = $request->input('id');
        $department = Department::find($dep_id);
        $department->delete();

        if($department == true){
            return 'Deleted';
        }
        else{
            return 'NotDeleted';
        }
    }

    public function edit_faculty(Request $request){
        $faculty_id = $request->input('fac_id');
        $faculty = Faculty::find($faculty_id);
        $faculty->fac_name = $request->faculty;
        $faculty->save();

        if($faculty == true){
            return 'Updated';
        }
        else{
            return 'Not Updated';
        }
    }


    public function edit_department_name(Request $request){
        $department_id = $request->input('dep_id');
        $department = Department::find($department_id);
        $department->dep_name = $request->department;
        $department->dep_code = $request->dep_code;
        $department->save();

        if($department == true){
            return 'Updated';
        }
        else{
            return 'Not Updated';
        }
    } 

    public function set_admin(Request $request){
        $dep_id   = $request->input('dep_id');
        $staff_id = $request->input('staff');

        $insert   = Department::find($dep_id);
        $insert->set_admin = 1;
        $insert->save();
        
        $update   = Staff::find($staff_id);
        $update->dep_id = $dep_id;
        $update->save();
        $last_id  = $update->staff_id;

        
        $user_count = User::orderByDesc("id")->limit(1)->get();
        $count = count($user_count);

        if($count > 0){
            $year   = PeriodYear::orderByDesc("log_id")->limit(1)->get();
            // $dep    = Department::find(1); //delete

            foreach($year as $row)
            {
                $currentYear = $row->year;
                $period = $row->period;
            }

            $subYear = substr($currentYear, 0, 2);

            foreach($user_count as $user)
            {
                $last_email = $user->email;
            }

            $last_user = substr($last_email, 5, 4); 

            $last_year = substr($last_email, 0, 2);

            // $department_code = $dep->dep_code; //------->delete

            // if($department_code <= 9){
            //     $department_code = '0' . $dep->dep_code;
            // }
           
            if($subYear == $last_year){

                if($last_user <= 8){
                    $last_user += 1;                 //$request->input('dep_code');
                    $new_email = $subYear . $period . $request->input('dep_code') . '000'.$last_user;
                }else if($last_user <= 98){
                    $last_user += 1;
                    $new_email = $subYear . $period . $request->input('dep_code') . '00'.$last_user;
                }else if($last_user <= 998){
                    $last_user += 1;
                    $new_email = $subYear . $period . $request->input('dep_code') . '0'.$last_user;
                }else{
                    $last_user++;
                    $new_email = $subYear . $period . $request->input('dep_code') . $last_user;
                }

            }else{
                $new_email = $subYear . $period . $request->input('dep_code') . '0001';
            }
        }
        
        $store = new User;
        $store->email = $new_email . '@gawharshad.edu.com';
        $store->password = Hash::make($new_email);
        $store->user_status = 1;
        $store->role_id = $request->input('role');
        $store->table_name = 3;
        $store->record_id = $last_id;
        $store->save();

        $update_staff = Staff::find($last_id);
        $update_staff->unique_id = $new_email;
        $update_staff->save();
        
        if($store == true){
            return 'created';
        }else{
            return 'not';
        }
        
    }
}
