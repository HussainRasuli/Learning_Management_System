<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\File;
use App\Model\Student;
use App\User;
use App\Model\Role;
use App\Model\PeriodYear;
use App\Model\Faculty;
use App\Model\Semester;
use App\Model\CourseShift;
use App\Model\Department;
use Session;
use Auth;
use Carbon\Carbon;
use Gate;

class StudentController extends Controller
{
    public function index(){
        abort_if(Gate::denies('view-students'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data['data'] = Student::with('user')->orderByDesc('stu_id')->paginate(5);
        return view('main/student/student_list', $data);
    }

    public function student_form(){
        abort_if(Gate::denies('add-student'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data['faculty'] = Faculty::all();
        $data['semester'] = Semester::all();
        $data['shift'] = CourseShift::all();
        return view('main/student/student_form', $data);
    }

    public function add_student(Request $request){
        abort_if(Gate::denies('add-student'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        if($request->account_btn == 2){
            $student_id = $request->student;
            $department = $request->department;
            StudentController::makeAccount($request->account_btn, $student_id, $department);
            return 'created';
        }else{
            
            $validations = $request->validate([
                'firstname'     => 'required|string',
                'lastname'      => 'required|string',
                'father_name'   => 'required|string',
                'email'         => 'required|string',
                'tazkira_id'    => 'required|numeric',
                'phone'         => 'required|numeric',
                'dob'           => 'required', 
                'gender'        => 'required',
                'faculty'       => 'required',
                'department'    => 'required',
                'semester'      => 'required',
                'shift'         => 'required'
            ]);

            $student_insert = new Student;
            $path ='';
            if($request->file('photo'))
            {
                $path = Storage::disk('student')->putFile('/', new File($request->file('photo')));
                $student_insert->photo      = $path;
            }
            
            $student_insert->first_name    = $request->firstname;
            $student_insert->last_name     = $request->lastname;
            $student_insert->father_name   = $request->father_name;
            $student_insert->date_of_birth = Carbon::parse($request->dob)->format('Y-m-d');
            $student_insert->tazkira_id    = $request->tazkira_id;
            $student_insert->gender        = $request->gender;
            $student_insert->email         = $request->email;
            $student_insert->phone         = $request->phone;
            $student_insert->faculty_id    = $request->faculty;
            $student_insert->dep_id        = $request->department;
            $student_insert->semester_id   = $request->semester;
            $student_insert->shift_id      = $request->shift;
            $student_insert->save();

            $last_id = $student_insert->stu_id;

            $x = $request->input('make_account');
            if($x == 1){
                $x = $request->input('make_account');
                StudentController::makeAccount($x, $last_id, $request->department);
            }

            Session::flash('student_added','Seccussefuly Added');
        }
        return redirect()->action('StudentController@index');    
    }

    public function delete_student(Request $request){
        $student_id = $request->input('id');
        $student    = Student::find($student_id);
        $student->delete();

        $one_user = User::where('table_name', 2)->where('record_id', $student_id);
        $one_user->delete();

        if($student == true){
            return 'Deleted';
        }
        else{
            return 'Not Deleted';
        }
    }


    public function edit_student_modal(Request $request){
        $student_id             = $request->input('id');
        $data['data']           = Student::with('dep','semesters','shifts','faculties')->find($student_id);
        $data['faculty']        = Faculty::all();
        $data['semester']       = Semester::all();
        $data['shift']          = CourseShift::all();
        $data['all_department'] = Department::all();
        return view('main/student/edit_student_modal', $data);
    }


    public function update_student(Request $request){
        $validations = $request->validate([
            'firstname'     => 'required|string',
            'lastname'      => 'required|string',
            'father_name'   => 'required|string',
            'email'         => 'required|string',
            'tazkira_id'    => 'required|numeric',
            'phone'         => 'required|numeric',
            'dob'           => 'required', 
            'gender'        => 'required',
            'faculty'       => 'required',
            'department'    => 'required',
            'semester'      => 'required',
            'shift'         => 'required'
        ]);

        $student_id = $request->input('student_id');
        $update_student = Student::find($student_id);

        if($request->file('photo') != '')
        {
            $path = Storage::disk('student')->putfile('/', new file($request->file('photo')));

            $one_col = Student::find($student_id);

            if($one_col != ''){
                Storage::disk('student')->delete($one_col->photo);
            }
            $update_student->photo  = $path;
               
        }

        $update_student->first_name    = $request->firstname;
        $update_student->last_name     = $request->lastname;
        $update_student->father_name   = $request->father_name;
        $update_student->date_of_birth = Carbon::parse($request->dob)->format('Y-m-d');
        $update_student->tazkira_id    = $request->tazkira_id;
        $update_student->gender        = $request->gender;
        $update_student->email         = $request->email;
        $update_student->phone         = $request->phone;
        $update_student->faculty_id    = $request->faculty;
        $update_student->dep_id        = $request->department;
        $update_student->semester_id   = $request->semester;
        $update_student->shift_id      = $request->shift;

        $update_student->save();
        
        Session::flash('student-updated','Student Seccussefully Updated.!');

        return redirect()->action('StudentController@index');  
    }


    public function view_student_modal(Request $request){
        $student_id = $request->input('id');
        $data = Student::with('dep')->find($student_id);
        return view('main/student/view_student_modal', compact('data'));
    }


    public function getPage(Request $request){
        if($request->ajax())
        {
            $data['data'] = Student::with('user')->orderByDesc('stu_id')->paginate(5);
            return view('main/student/pagination', $data);
        }
    }


    public function getDepartment($id){
        $data = Faculty::with('departments')->find($id);
        return view('main/student/selected_department', compact('data'));
    }

    public function makeAccount($msg, $id, $dep){
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
    
        $role_id = Role::where('role_type_id', 4)->get();
        foreach($role_id as $x){
            $role_id = $x->role_id;
        }
        $store = new User;
        $store->email = $new_email . '@gawharshad.edu.com';
        $store->password = Hash::make($new_email);
        $store->user_status = 1;
        $store->role_id = $role_id;
        $store->table_name = 2;
        $store->record_id = $id;
        $store->save();

        $student = Student::find($id);
        $student->unique_id = $new_email;
        $student->save();

        if($msg == 1){
            Session::flash('account_created','Seccussefuly Created');
        }
    }

    public function search_student(Request $request){
        $data = $request->input('input_send_data');
        $data = Student::with('user')->where('unique_id',$data)->orWhere('tazkira_id', $data)->get();
        return view('main/student/student_search_data', compact('data'));

    }
}
