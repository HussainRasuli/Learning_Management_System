<?php

namespace App\Http\Controllers;

use Request;
use App\Model\Department;
use App\Model\TeacherCourse;
use App\Model\Student;
use App\Model\Staff;
use Auth;
use Session;
use App\Notification;
use App\UserNotification;
use Symfony\Component\HttpFoundation\Response;
use Gate;


class CourseAproveController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('approve-course-view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = Department::with('fac')->where('set_course_done', 1)->get();

        return view('main/admin/approve-course/faculty-department', compact('data'));
    }

    public function activeCourse()
    {
        abort_if(Gate::denies('approve-course-view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $data = Department::with('fac')->get();
        return view('main/admin/approve-course/active-department', compact('data'));
    }

    public function activeDepartment()
    {
        $dep = Request::input('department');
        $update = Department::with('staff')->find($dep);
        $user_id = $update->staff->staff_id;

        $notification = new Notification;
        $notification->message = 'Set Course Activated For You.';
        $notification->event   = 1;
        $notification->save();

        $last_id = $notification->noti_id;

        $user_notification = new UserNotification;
        $user_notification->noti_id = $last_id;
        $user_notification->user_id = $user_id;
        $user_notification->save();

        $update->active_set_course = 1;
        $update->save();
        return 'activated';
    }

    public function deactiveDepartment()
    {
        $dep = Request::input('department');
        $update = Department::find($dep);
        $update->active_set_course = 0;
        $update->save();
        return 'deactivated';
    }

    public function getCourses($id)
    {
        $data = TeacherCourse::with('course', 'teacher', 'days')->where(['dep_id' => $id, 'approved' => 0])->get();
        
        return view('main/admin/approve-course/approving_courses', compact('data'));
    }

    public function approvingCourses()
    {
        $approved   = Request::input('course-approve');
        $dismissed  = Request::input('course-dismiss');
        $department = Request::input('department');

        if($approved != ''){
            foreach($approved as $row)
            {
                $update_approve             = TeacherCourse::find($row);
                $update_approve->approved   = 1;
                $update_approve->save();
            }
        }


        $department_update                  = Department::find($department);
        $department_update->course_checked  = 1;
        $department_update->save();

        Session::flash('courses-approved', 'Courses Are Approved Successfully.!');
        return redirect('/approve-course');
    }

    public function active_select_credit(){
        $staff_id = Auth::user()->record_id;
        $staff    = Staff::find($staff_id);
        $dep_id   = $staff->dep_id;

        $update  = Student::where('dep_id', $dep_id)->get();
        foreach($update as $x){
            $x->active_select_credit = '1';
            $x->select_credit        = '0';
            $x->admin_approve_credits= '0';
            $x->save();
        }

        return view('main/admin/course/deactive_btn');
    }

    public function deactive_select_credit(){
        $staff_id = Auth::user()->record_id;
        $staff    = Staff::find($staff_id);
        $dep_id   = $staff->dep_id;

        $update  = Student::where('dep_id', $dep_id)->get();
        foreach($update as $x){
            $x->active_select_credit = '0';
            $x->select_credit        = '0';
            $x->admin_approve_credits= '0';
            $x->save();
        }

        return view('main/admin/course/active_btn');
    }
}
