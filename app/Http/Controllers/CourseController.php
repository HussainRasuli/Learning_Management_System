<?php

namespace App\Http\Controllers;

use Request;
use App\Model\Course;
use App\Model\Faculty;
use App\Model\Department;
use App\Model\Semester;
use App\Model\Teacher;
use App\Model\TeacherCourse;
use App\Model\StudentCourse;
use App\Model\Staff;
use App\Model\CourseShift;
use App\Model\Day;
use App\Model\Student;
use Session;
use Auth;
use Symfony\Component\HttpFoundation\Response;
use Gate;
use App\Notification;
use App\UserNotification;

class CourseController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('view-course'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = Faculty::all();
        return view('main/admin/course/course_list', compact('data'));
    }

    public function getDepartment($id)
    {
        $data = Faculty::with('departments')->find($id);
        return view('main/admin/course/selected_department', compact('data'));
    }

    public function getCourses()
    {
        $faculty = Request::input('fac');
        $department = Request::input('dep');
        
        if (($faculty != '') && ($department == '')){  // Only Faculty
            $data = Faculty::with('departments.course.semesters')->where('fac_id', $faculty)->get();
            return view('main/admin/course/course_search_view', compact('data'));

        }else if(($faculty != '') && ($department != '')){ // Faculty And Department 
            $data = Department::with('course')->where('dep_id', $department)->get();
            return view('main/admin/course/course_search_individual', compact('data'));
        }
    }

    public function addNew()
    {
        abort_if(Gate::denies('set-course'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = Semester::all();
        return view('main/admin/course/add_course', compact('data'));
    }

    public function store()
    {
        $credit = Request::input('credit');
        $course = Request::input('course');

        foreach($credit as $key => $value)
        {
            $store = new Course;
            $store->co_name = $course[$key];
            $store->dep_id = 1;
            $store->sem_id = Request::input('semester');
            $store->credit =  $credit[$key];
            $store->save();
        }

        Session::flash('course-add', 'Course Successfully Added');
        return redirect('/course');
    }

    public function edit($id)
    {
        $data = Course::find($id);
        return view('main/admin/course/edit_modal', compact('data'));
    }

    public function update()
    {
        $course = Request::input('data-id');
        $update = Course::find($course);
        $update->co_name = Request::input('course');
        $update->sem_id = Request::input('semester');
        $update->credit = Request::input('credit');
        $update->save();

        if($update == true){
            return 'Updated';
        }
        else{
            return 'Not Updated';
        }
    }

    public function delete()
    {
        $data = Request::input('data');
        $course = Course::find($data);
        $course->delete();

        if($course == true){
            return 'Deleted';
        }
        else{
            return 'NotDeleted';
        }
    }

    public function appreovedCourses()
    {
        abort_if(Gate::denies('set-course'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $record_id  = Auth::user()->record_id;
        $data = Staff::find($record_id);
        $dep  = $data->dep_id;

        $courses['deactived'] = Student::where('active_select_credit', 0)->where('select_credit', 0)->where('admin_approve_credits', 0)->get();

        $courses['approved'] = TeacherCourse::with('course', 'teacher', 'days')->where(['dep_id' => $dep, 'approved' => 1])->get();

        $courses['dismissed'] = TeacherCourse::with('course', 'teacher', 'days')->where(['dep_id' => $dep, 'approved' => 2])->get();
        
        return view('main/admin/course/approved_courses', $courses);
    }

    public function setCourse()
    {
        abort_if(Gate::denies('set-course'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = CourseController::set_course_feilds();

        return view('main/admin/course/set_course', $data);
    }

    public function getNewTr()
    {
        $data = CourseController::set_course_feilds();

        return view('main/admin/course/get-new-tr-set_course', $data);
    }

    protected function set_course_feilds()
    {
        $record_id  = Auth::user()->record_id;
        $data = Staff::find($record_id);
        $dep  = $data->dep_id;

        $data = Department::find($dep);
        $set_course = $data->active_set_course;
        
        if($set_course == 1){
            $data['course']     = Course::where('dep_id', $dep)->orderBy('sem_id')->get();
            $data['teacher']    = Teacher::select('tea_id', 'first_name', 'last_name')->get();
            $data['shift']      = CourseShift::all();
            $data['day']        = Day::all();
            $data['semester']   = Semester::all();
        }else{
            $data['msg'] = 'Set course is not avaliable, You have been done this section.!';
        }
        return $data;
    }

    public function setCourseTeacher()
    {
        $record_id  = Auth::user()->record_id;
        $data = Staff::find($record_id);
        $dep  = $data->dep_id;
        
        $courses    = Request::input('course');
        $teach      = Request::input('tea');
        $shifts     = Request::input('shift');
        $days       = Request::input('day');
        $semester   = Request::input('semester');

        foreach($courses as $index => $val)
        {
            $teacher_course_store           = new TeacherCourse;
            $teacher_course_store->co_id    = $courses[$index];
            $teacher_course_store->tea_id   = $teach[$index];
            $teacher_course_store->sem_id   = $semester[$index];
            $teacher_course_store->shift    = $shifts[$index];
            $teacher_course_store->day      = $days[$index];
            $teacher_course_store->dep_id   = $dep;
            $teacher_course_store->save();
        }

        if($teacher_course_store == true){
            $update = Department::find($dep);
            $update->active_set_course  = 0;
            $update->set_course_done    = 1;
            $update->save();
        }

        $department_update                  = Department::find($dep);
        $department_update->course_checked  = 0;
        $department_update->save();

        $department_update                  = Department::find($dep);

        $notification = new Notification;
        $notification->message = $department_update->dep_name . ' Done Set Course';
        $notification->event   = 4;
        $notification->save();

        $last_id = $notification->noti_id;

        $user_notification = new UserNotification;
        $user_notification->noti_id = $last_id;
        $user_notification->user_id = 1;
        $user_notification->save();

        Session::flash('set-course-done', 'Courses Are Set Successfully.!');
        return redirect('/approved-courses');
    }

    public function setCourseEdit($id)
    {
        $data['set_course'] = TeacherCourse::find($id);
        $data['teacher']    = Teacher::select('tea_id', 'first_name', 'last_name')->get();
        $data['semester']   = Semester::all();
        $data['shift']      = CourseShift::all();
        $data['day']        = Day::all(); 

        return view('main/admin/course/set_course_edit_modal', $data);
    }

    public function updateSetCourse()
    {
        $id             = Request::input('data-id');
        $update         = TeacherCourse::find($id);
        $update->tea_id = Request::input('teacher');
        $update->sem_id = Request::input('semester');
        $update->shift  = Request::input('shift');
        $update->day    = Request::input('day');

        if($update->approved == 2){
            $update->approved = 1;
        }
        
        $update->save();

        if($update == true){
            return 'Updated';
        }else{
            return 'not';
        }
    }

    public function deleteSetCourse()
    {
        $id = Request::input('data-id');
        $delete = TeacherCourse::find($id);
        $delete->delete();

        if($delete == true){
            return 'Deleted';
        }else{
            return 'not';
        }
    }
}