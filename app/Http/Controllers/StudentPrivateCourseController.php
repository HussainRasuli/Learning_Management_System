<?php

namespace App\Http\Controllers;

use Request;
use App\Model\Student;
use App\Model\StudentCourse;
use App\Model\TeacherCourse;
use App\Model\PeriodYear;
use App\Model\Course;
use App\Model\Matrial;
use App\Model\StudentAssignment;
use Session;
use Auth;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class StudentPrivateCourseController extends Controller
{
    public function index(){
        abort_if(Gate::denies('student-courses'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student_id = Auth::user()->record_id;
        $student    = Student::find($student_id);
        $stu_id     = $student->stu_id;
        $semester   = $student->semester_id;

       $all_select_courses = StudentCourse::select('tc_id')->where('stu_id', $student_id)->where('relevant_semester', $semester)->where('approve', 1)->get();
       $data['all_course'] = TeacherCourse::with('course')->whereIn('tc_id', $all_select_courses)->get();

       return view('main/student/course/course_list', $data);
    }

    public function get_course_details($id, $sem){
        $data['y'] = PeriodYear::orderByDesc('log_id')->limit(1)->get();
        foreach($data['y'] as $x)
        {
            $data['year'] = $x->year;
            $data['period'] = $x->period;
        }
        
        $data['course'] = Course::find($id);
        $data['semester'] = $sem;
        
        return view('main/teacher/course/course-details', $data);
    }

    protected function getAssignments($date, $course, $semester)
    {
        $data['current_week'] = TeacherCourseController::getCurrentWeek($date);

        $data['weeks'] = Matrial::select('week')->where(['co_id' => $course, 'type' => 3, 'sem_id' => $semester])->distinct('week')->get();

        $data['materials'] = Matrial::with('assignment_details')->where(['co_id' => $course, 'week' => $data['current_week'], 'type' => 3, 'sem_id' => $semester])->get();
        
        if(!$data['materials']->isEmpty()){
            $data['student_assignment'] = array();

            foreach($data['materials'] as $x){
                $assignment_id = $x->assignment_details->as_id;

                $data['check'] = StudentAssignment::where(['stu_id' => Auth::user()->record_id, 'assignment_id' => $assignment_id])->first();
                if($data['check'] == ''){
                    array_push($data['student_assignment'], 1);
                }else{
                    array_push($data['student_assignment'], 2);
                }
            }
        }else{
            $data['student_assignment'] = 1;
        }
        
        return view('main/student/course/student_assignment_view', $data);
    }

    protected function getStudentWeekAssignment($week,$course,$semester)
    {
        $data['materials'] = Matrial::with('assignment_details')->where(['co_id' => $course, 'week' => $week, 'type' => 3, 'sem_id' => $semester])->get();
        
        if(!$data['materials']->isEmpty()){
            $data['student_assignment'] = array();

            foreach($data['materials'] as $x){
                $assignment_id = $x->assignment_details->as_id;

                $data['check'] = StudentAssignment::where(['stu_id' => Auth::user()->record_id, 'assignment_id' => $assignment_id])->first();
                if($data['check'] == ''){
                    array_push($data['student_assignment'], 1);
                }else{
                    array_push($data['student_assignment'], 2);
                }
            }
        }else{
            $data['student_assignment'] = 1;
        }
        
        return view('main/student/course/student_assignment_week_view', $data);
    }

    protected function resubmitAssignment()
    {

        
        if(Request::hasFile('file')){
            $file = Request::file('file');

            $update_material = Matrial::find(Request::input('material'));

            $old_file = $update_material->file_path;
            unlink(storage_path('app/course/student-assignment/' . $old_file));

            $name = $file->getClientOriginalName();
            $path = $file->storeAs("student-assignment/", $name, "course");

            $update_material->file_path = $name;
            $update_material->save();

            $update_student_assign = StudentAssignment::find(Request::input('stu-assign'));
            $update_student_assign->status = 0;
            $update_student_assign->description = '';
            $update_student_assign->save();

            Session::flash('resubmited', 'Your HomeWork Resubmited Successfully.!');
            return redirect('/student-course');
        }        
    }
}
