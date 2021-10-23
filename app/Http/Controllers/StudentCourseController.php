<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\TeacherCourse;
use Auth;
use App\Model\Role;
use App\Model\Student;
use App\Model\PeriodYear;
use App\Model\StudentCourse;
use App\Model\Staff;
use App\Model\Semester;
use App\Model\Department;
use App\Model\Course;
use Session;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class StudentCourseController extends Controller
{
    public function index(){
        abort_if(Gate::denies('student_select_credits'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $student_id = Auth::user()->record_id;  
        $data['student'] = Student::find($student_id);
        $data['dep_id']  = $data['student']->dep_id;
        $data['select_credit']  = $data['student']->select_credit;
        $admin_approve_credits  = $data['student']->admin_approve_credits;
        $data['semester_id'] = $data['student']->semester_id;
        $data['shift'] = $data['student']->shift_id; 

     if($admin_approve_credits == 1){
        $data['select_credit'];
        $all_course = StudentCourse::select('tc_id')->where('stu_id', $student_id)->where('relevant_semester', $data['semester_id'])->where('seen', 1)->get();
        $data['department'] = Department::all();
        $data['semester']   = Semester::all();

        $data['all_credit'] = TeacherCourse::with('course','teacher','days','department','approve_or_dismiss')->whereIn('tc_id', $all_course)->get();
        
        $all_approve_course = StudentCourse::select('tc_id')->where('stu_id', $student_id)->where('relevant_semester', $data['semester_id'])->where('approve', 1)->where('seen', 1)->get();
        $teacher_courses = TeacherCourse::whereIn('tc_id', $all_approve_course)->get();
        $first_value = 0;
        $data['total_credit'] = 0;
        foreach($teacher_courses as $x){
            $first_value = Course::where('co_id', $x->co_id)->get();
            foreach($first_value as $i){
                $data['total_credit'] = $data['total_credit'] + $i->credit;
            }
        }
        return view('main/student/select_credit', $data);
     }
     else{
            $data['y'] = PeriodYear::orderByDesc('log_id')->limit(1)->get();
            foreach($data['y'] as $x)
            {
                $data['year'] = $x->year;
            }
            $data['department'] = Department::all();
            $data['semester']   = Semester::all();

            $data['all_course'] = TeacherCourse::with('course','teacher','days','department')->where('approved', '1')->where('dep_id', $data['dep_id'])->where('sem_id', $data['semester_id'])->where('shift', $data['shift'] )->get();
            return view('main/student/select_credit', $data);
      }
    }

    public function credit_submited(Request $request){

       $student_id = Auth::user()->record_id;
       $student    = Student::find($student_id);
       $stu_id     = $student->stu_id;
       $relevant_semester = $student->semester_id;
       $student->select_credit = 1;
       $student->save();

       $course = $request->input('course');
       if($course != ''){
         foreach($course as $x){
            $insert = new StudentCourse;
            $insert->stu_id = $stu_id;
            $insert->tc_id  = $x;
            $insert->relevant_semester = $relevant_semester;
            $insert->save();
         }
         return 'Submited';
       }
    }

    public function student_credit_list(){
        abort_if(Gate::denies('students_credit_list'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staff_id = Auth::user()->record_id;
        $data['staff'] = Staff::find($staff_id);
        $data['dep_id']  = $data['staff']->dep_id;
        
        $data['data'] = Student::where('dep_id', $data['dep_id'])->where('select_credit','1')->paginate(2);
        return view('main/admin/approve-student-credit/approve_student_credit',$data);
    }

    public function getPage(Request $request){
        if($request->ajax())
        {
            $staff_id = Auth::user()->record_id;  
            $data['staff'] = Staff::find($staff_id);
            $data['dep_id']  = $data['staff']->dep_id;

            $data['data'] = Student::where('dep_id', $data['dep_id'])->where('select_credit','1')->paginate(2);
            return view('main/admin/approve-student-credit/pagination', $data);
        }
    }


    public function delails_credit_selection(Request $request){
        $student_id = $request->input('student');

        $data['student'] = Student::find($student_id);
        $data['semester_id'] = $data['student']->semester_id;

        $data['all_credit'] = StudentCourse::with('semester.course','semester.teacher','semester.department','semester.days')->where('stu_id',$student_id)->where('relevant_semester' , $data['semester_id'])->where('seen', 0)->get();
       
        $all_course = StudentCourse::select('tc_id')->where('stu_id', $student_id)->where('relevant_semester', $data['semester_id'])->where('seen', 1)->get();
        $data['all_credits'] = TeacherCourse::with('course','teacher','days','department','approve_or_dismiss')->whereIn('tc_id', $all_course)->get();
        $all_approve_course = StudentCourse::select('tc_id')->where('stu_id', $student_id)->where('relevant_semester', $data['semester_id'])->where('approve', 1)->where('seen', 1)->get();
        $teacher_courses = TeacherCourse::whereIn('tc_id', $all_approve_course)->get();
        $first_value = 0;
        $data['total_credit'] = 0;
        foreach($teacher_courses as $x){
            $first_value = Course::where('co_id', $x->co_id)->get();
            foreach($first_value as $i){
                $data['total_credit'] = $data['total_credit'] + $i->credit;
            }
        }
        return view('main/admin/approve-student-credit/details_credit_selection', $data);
    }


    public function approve_student_credit(Request $request ,$stu_id){
           
           $dismiss_or_approve = $request->input('dismiss-or-approve');
           $student_id = "";
           if($dismiss_or_approve != ''){
                foreach($dismiss_or_approve as $x){
                     $update = StudentCourse::find($x);
                     $update->approve = 1;
                     $student_id = $update->stu_id;
                     $update->save();
                }
           }
           
           $insert = Student::find($stu_id);
           $insert->admin_approve_credits = 1;
           $insert->active_select_credit  = 0;
           $stu_semester = $insert->semester_id;
           $insert->save();

           $insert_seen = StudentCourse::where('stu_id',$stu_id)->where('relevant_semester',$stu_semester)->get();
            foreach($insert_seen as $y){
                $y->seen = 1;
                $y->save();
            }
           

         Session::flash('credit_approved','Credits Successfully Approve or Dismiss it.');
         
         if($insert == true){
            return 'Saved';
        }
    }


    public function edit_student_credit(Request $request){
      $dismiss_or_approve = $request->input('dismiss-or-approve');
      $student_id = $request->input('student_id');

        $value_of_db = StudentCourse::where('stu_id', $student_id)->get();
        foreach($value_of_db as $row){
          if($dismiss_or_approve != ''){
            if(!in_array($row->sc_id , $dismiss_or_approve)){
                $update_credit = StudentCourse::find($row->sc_id);
                $update_credit->approve = 0;
                $update_credit->save();
            }
            else{
                $update_credit = StudentCourse::find($row->sc_id);
                $update_credit->approve = 1;
                $update_credit->save();
            }
        }
         else{
               $update_credits = StudentCourse::find($row->sc_id);
               $update_credits->approve = 0;
               $update_credits->save();
        }
    }
    
        return'Edited';

    }

    public function student_credits_page(){
        abort_if(Gate::denies('students_credit_list'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('main/admin/approve-student-credit/search_student_credits');
    }

    public function get_student_credit(Request $request){
        $id_number = $request->input('id_number');

        $data['stu']   = Student::where('unique_id', $id_number)->get();
        $student_id='';
        $stu_semester='';
        foreach($data['stu'] as $x){
            $student_id = $x->stu_id;
            $stu_semester = $x->semester_id;
        }
        $data['all_credit'] = StudentCourse::with('semester.course','semester.teacher')->where('stu_id', $student_id)->where('relevant_semester', $stu_semester)->where('seen', 1)->get();
            
        $all_approve_course = StudentCourse::select('tc_id')->where('stu_id', $student_id)->where('relevant_semester', $stu_semester)->where('approve', 1)->where('seen', 1)->get();
        $teacher_courses = TeacherCourse::whereIn('tc_id', $all_approve_course)->get();
        $first_value = 0;
        $data['total_credit'] = 0;
        foreach($teacher_courses as $x){
            $first_value = Course::where('co_id', $x->co_id)->get();
            foreach($first_value as $i){
                $data['total_credit'] = $data['total_credit'] + $i->credit;
            }
        }
            
        return view('main/admin/approve-student-credit/student_individual', $data);

    }

    public function delete_student_credit(Request $request){
          $sc_id = $request->input('id');
          $delete = StudentCourse::find($sc_id);
          $delete->delete();

          if($delete == true){
              return 'Deleted';
          }
    }

    public function change_course(Request $request){
        $stu_course_id = $request->input('id_number');
        $data['student_course_id'] = StudentCourse::find($stu_course_id);
        
        $data['semester'] = Semester::all();
        return view('main/admin/approve-student-credit/change_course', $data);
    }

    public function show_student_course(Request $request){
       
       $course_name = $request->input('course_name');
       $semester = $request->input('semester');

       $staff_id = Auth::user()->record_id;
       $staff    = Staff::find($staff_id);
       $dep_id = $staff->dep_id;
       
       if($course_name != '' && $semester != ''){
           $courses = Course::select('co_id')->where('dep_id', $dep_id)->where('co_name', 'LIKE', "%$course_name%")->get();
           $data['all_course'] = TeacherCourse::with('course','teacher','department')->where('dep_id', $dep_id)->where('approved','1')->whereIn('co_id', $courses)->where('sem_id', $semester)->get();
           return view('main/admin/approve-student-credit/edit_student_course', $data);
        }
        else if($course_name != '' && $semester == ''){
            $courses = Course::select('co_id')->where('dep_id', $dep_id)->where('co_name', 'LIKE', "%$course_name%")->get();
            $data['all_course'] = TeacherCourse::with('course','teacher','department')->where('dep_id', $dep_id)->where('approved','1')->whereIn('co_id', $courses)->get();
            return view('main/admin/approve-student-credit/edit_student_course', $data);
        }
        else if($course_name == '' && $semester != ''){
            $data['all_course'] = TeacherCourse::with('course','teacher','department')->where('dep_id', $dep_id)->where('approved','1')->where('sem_id', $semester)->get();
            return view('main/admin/approve-student-credit/edit_student_course', $data);
        }
    }

    public function change_student_course(Request $request){
        $old_tc_id = $request->input('old_tc_id');
        $new_tc_id = $request->input('new_tc_id');
        
        $update = StudentCourse::find($old_tc_id);
        $update->tc_id = $new_tc_id;
        $update->save();

        if($update == true){
            return "Updated";
        }
        else{
            return "NotUpdate";
        }
    }

    public function active_credit_page(){
        abort_if(Gate::denies('students_credit_list'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('main/admin/approve-student-credit/active_credit_page');
    }

    public function show_student_info(Request $request){
        $student_id = $request->input('id_number');
        $data['student_info'] = Student::where('unique_id', $student_id)->get();
        
        $student_id = "";
        $data['semester_id'] = "";
        foreach($data['student_info'] as $x){
            $student_id = $x->stu_id;
            $data['semester_id'] = $x->semester_id;
        }
        
        $all_approve_course = StudentCourse::select('tc_id')->where('stu_id', $student_id)->where('relevant_semester', $data['semester_id'])->where('approve', 1)->where('seen', 1)->get();
        $teacher_courses = TeacherCourse::whereIn('tc_id', $all_approve_course)->get();
        $first_value = 0;
        $data['total_credit'] = 0;
        foreach($teacher_courses as $x){
            $first_value = Course::where('co_id', $x->co_id)->get();
            foreach($first_value as $i){
                $data['total_credit'] = $data['total_credit'] + $i->credit;
            }
        }
        return view('main/admin/approve-student-credit/student_active_credit', $data);
    }

    public function activeCreditFor_one_student(Request $request){
        $student_id = $request->input('stu_id_number');

        $update = Student::find($student_id);
        $update->active_select_credit = 1;
        $update->select_credit = 0;
        $update->save();

        $data['student_info'] = Student::where('stu_id', $student_id)->get();
        return view('main/admin/approve-student-credit/student_deactive_credit_btn', $data);
    }

    public function deactiveCreditFor_one_student(Request $request){
        $student_id = $request->input('stu_id_number');

        $update = Student::find($student_id);
        $update->active_select_credit = 0;
        $update->select_credit = 1;
        $update->save();

        $data['student_info'] = Student::where('stu_id', $student_id)->get();
        return view('main/admin/approve-student-credit/student_active_credit_btn', $data);
    }

    public function get_courses($id){
        $all_course = TeacherCourse::select('co_id')->where('dep_id', $id)->get();
        $data['all_course'] = Course::whereIn('co_id', $all_course)->get();
        return view('main/student/specific_courses', $data);
        
    }

    public function advance_search(Request $request){

       $student_id = Auth::user()->record_id;
       $student    = Student::find($student_id);
       $data['semester_id']   = $student->semester_id;
       $stu_id     = $student->stu_id;
       $data['admin_approve_credits'] = $student->admin_approve_credits;

        $department_id = $request->input('department');
        $course_id     = $request->input('course');
        $semester      = $request->input('semester');

        $all_approve_course = StudentCourse::select('tc_id')->where('stu_id', $student_id)->where('relevant_semester', $data['semester_id'])->where('approve', 1)->where('seen', 1)->get();
        $teacher_courses = TeacherCourse::whereIn('tc_id', $all_approve_course)->get();
        $first_value = 0;
        $data['total_credit'] = 0;
        foreach($teacher_courses as $x){
            $first_value = Course::where('co_id', $x->co_id)->get();
            foreach($first_value as $i){
                $data['total_credit'] = $data['total_credit'] + $i->credit;
            }
        }
        
        if($department_id != '' && $course_id != '' && $semester != ''){
            $courses = Course::select('co_id')->where('co_id', $course_id)->get();
            $data['all_course'] = TeacherCourse::with('course','teacher','department')->where('approved','1')->where('dep_id', $department_id)->where('co_id', $course_id)->where('sem_id', $semester)->get();
           // pld selected courses
            $data['selected_courses'] = StudentCourse::select('tc_id')->where('stu_id', $stu_id)->where('relevant_semester', $data['semester_id'])->where('seen', 1)->get();
            return view('main/admin/approve-student-credit/advance_search_data', $data);
        }

        else if($department_id != '' && $course_id != ''){
            $courses = Course::select('co_id')->where('co_id', $course_id)->get();
            $data['all_course'] = TeacherCourse::with('course','teacher','department')->where('approved','1')->where('dep_id', $department_id)->where('co_id', $course_id)->get();
            $data['selected_courses'] = StudentCourse::select('tc_id')->where('stu_id', $stu_id)->where('relevant_semester', $data['semester_id'])->where('seen', 1)->get();
            return view('main/admin/approve-student-credit/advance_search_data', $data);
        }

        else if($department_id != '' && $semester != ''){
            $data['all_course'] = TeacherCourse::with('course','teacher','department')->where('approved','1')->where('dep_id', $department_id)->where('sem_id', $semester)->get();
            $data['selected_courses'] = StudentCourse::select('tc_id')->where('stu_id', $stu_id)->where('relevant_semester', $data['semester_id'])->where('seen', 1)->get();
            return view('main/admin/approve-student-credit/advance_search_data', $data);
        }

        else if($department_id != ''){
            $data['all_course'] = TeacherCourse::with('course','teacher','department')->where('approved','1')->where('dep_id', $department_id)->get();
            $data['selected_courses'] = StudentCourse::select('tc_id')->where('stu_id', $stu_id)->where('relevant_semester', $data['semester_id'])->where('seen', 1)->get();
            return view('main/admin/approve-student-credit/advance_search_data', $data);
        }
    }

    public function advance_credit_submited(Request $request){

       $student_id = Auth::user()->record_id;
       $student    = Student::find($student_id);
       $stu_id     = $student->stu_id;
       $relevant_semester = $student->semester_id;
       $student->select_credit = 1;
       $student->save();

       $course = $request->input('advance_course');
       if($course != ''){
         foreach($course as $x){
            $insert = new StudentCourse;
            $insert->stu_id = $stu_id;
            $insert->tc_id  = $x;
            $insert->relevant_semester = $relevant_semester;
            $insert->save();
         }
         return 'Submited';
       }
    }
}


