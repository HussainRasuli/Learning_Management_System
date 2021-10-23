<?php

namespace App\Http\Controllers;

use Request;
use App\Model\Teacher;
use App\Model\Role;
use App\Model\Staff;
use App\Model\Department;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\File;
use Session;
use Auth;
use App\Model\PeriodYear;
use App\User;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Gate;


class TeacherController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('view-teachers'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staff_id = Auth::user()->record_id;
        $staff = Staff::find($staff_id);
        $dep_id = $staff->dep_id; 
       
        $one_row_selected = Department::where('dep_id',$dep_id)->get();
        $fac_id = "";
        foreach($one_row_selected as $x){
            $fac_id = $x->fac_id;
        }
        
        $data['fac_id'] = $fac_id;

        $data['teacher'] = Teacher::with('user', 'dep')->orderByDesc('tea_id')->get();
        return view('main/teacher/teacher_list', $data);
    }

    public function addLecturer()
    {
        abort_if(Gate::denies('view-teachers'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('main/teacher/add_teacher');
    }

    public function store()
    {
        if(Request::input('account_btn') == 2){
            $student_id = Request::input('teacher');
            $department = Request::input('department');
            TeacherController::makeAccount(Request::input('account_btn'), $student_id, $department);
            return 'created';
        }else{
            $validations = Request::validate([
                'firstname'     => 'required|string',
                'lastname'      => 'required|string',
                'father_name'   => 'required|string',
                'email'         => 'required|string',
                'id_card'       => 'required|numeric',
                'phone'         => 'required|numeric',
                'dob'           => 'required', 
                'gender'        => 'required',
                'education'     => 'required',
            ]);

            $store = new Teacher;
            $path ='';
            if(Request::file('photo'))
            {
                $path = Storage::disk('teacher')->putFile('/', new File(Request::file('photo')));
                $store->photo = $path;
            }

            $admin_id = Auth::user()->record_id;
            $staff = Staff::find($admin_id);
            $department = $staff->dep_id;
            
            $store->first_name      = Request::input('firstname');
            $store->last_name       = Request::input('lastname');
            $store->father_name     = Request::input('father_name');
            $store->id_card_number  = Request::input('id_card');
            $store->date_of_birth   = Carbon::parse(Request::input('dob'))->format('Y-m-d');
            $store->gender          = Request::input('gender');
            $store->email           = Request::input('email');
            $store->phone           = Request::input('phone');
            $store->education       = Request::input('education');
            $store->dep_id          = $department;
            $store->save();

            $last_id = $store->tea_id;

            if(Request::input('make-account') != ''){
                TeacherController::makeAccount(Request::input('account_btn'), $last_id, $department);
            }
            Session::flash('teacher-added','Teacher Seccussefully Added');
        }

        return redirect('/lecturer');
    }

    public function edit($id)
    {
        $data['teacher'] = Teacher::find($id);
        return view('main/teacher/edit_teacher', $data);
    }

    public function update()
    {
        $teacher = Request::input('teacher');
        $update = Teacher::find($teacher);

        if(Request::file('photo') != '')
        {
            $path = Storage::disk('teacher')->putfile('/', new file(Request::file('photo')));
            $one_col = Teacher::find($teacher);
            if($one_col != ''){
                Storage::disk('teacher')->delete($one_col->photo);
            }
            $update->photo  = $path;
        }
      
        $update->first_name      = Request::input('firstname');
        $update->last_name       = Request::input('lastname');
        $update->father_name     = Request::input('father_name');
        $update->id_card_number  = Request::input('id_card');
        $update->date_of_birth   = Carbon::parse(Request::input('dob'))->format('Y-m-d');
        $update->gender          = Request::input('gender');
        $update->email           = Request::input('email');
        $update->phone           = Request::input('phone');
        $update->education       = Request::input('education');
        $update->dep_id          = 1;
        $update->save();
        
        Session::flash('teacher-updated','Teacher Seccussefully Updated.!');
        return redirect('/lecturer');
    }

    public function delete()
    {
        $teacher = Request::input('data');
        $delete = Teacher::find($teacher);
        Storage::disk('teacher')->delete($delete->photo);
        $delete->delete();

        $one_user = User::where('table_name', 1)->where('record_id', $teacher);
        $one_user->delete();

        if($delete == true){
        return 'Deleted';
        }
        else{
        return 'Not Delete';
        }
    }

    public function makeAccount($msg, $id, $dep)
    {

        $user_count = User::orderByDesc("id")->limit(1)->get();
        $count = count($user_count);

        if($count > 0){
            $year   = PeriodYear::orderByDesc("log_id")->limit(1)->get();
            $dep    = Department::find($dep); 

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

            $department_code = $dep->dep_code; 
            
            if($subYear == $last_year){
                if($last_user <= 8){
                    $last_user += 1;
                    $new_email = $subYear . $period . $department_code . '000'.$last_user;
                }else if($last_user <= 98){
                    $last_user += 1;
                    $new_email = $subYear . $period . $department_code . '00'.$last_user;
                }else if($last_user <= 998){
                    $last_user += 1;
                    $new_email = $subYear . $period . $department_code . '0'.$last_user;
                }else{
                    $last_user++;
                    $new_email = $subYear . $period . $department_code . $last_user;
                }

            }else{
                $new_email = $subYear . $period . $department_code . '0001';
            }
        }
        
        $role = Role::where('role_type_id', 3)->get();
        foreach($role as $y){
            $role_id = $y->role_id;
        }

        $store = new User;
        $store->email = $new_email . '@gawharshad.edu.com';
        $store->password = Hash::make($new_email);
        $store->user_status = 1;
        $store->role_id = $role_id;
        $store->table_name = 1;
        $store->record_id = $id;
        $store->save();

        $teacher = Teacher::find($id);
        $teacher->unique_id = $new_email;
        $teacher->save();

        if($msg == 1){
            Session::flash('teacher-account','Teacher Account Created Seccussefully.!');
        }
    }

    public function view_teacher_modal(){
        $teacher_id = Request::input('data');
        $data['data'] = Teacher::with('dep')->find($teacher_id);
        return view('main/teacher/view_teacher_modal', $data);
    }

    public function search_teacher(Request $request){
        
        $staff_id = Auth::user()->record_id;
        $staff = Staff::find($staff_id);
        $dep_id = $staff->dep_id; 
       
        $one_row_selected = Department::where('dep_id',$dep_id)->get();
        $fac_id = "";
        foreach($one_row_selected as $x){
            $fac_id = $x->fac_id;
        }
    
        $data = Request::input('input_send_data');
        $teacher = Teacher::with('user', 'dep')->where('unique_id',$data)->orWhere('id_card_number', $data)->get();
        return view('main/teacher/teacher_search_data', compact('teacher','fac_id'));
    }
}
