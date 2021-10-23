<?php

namespace App\Http\Controllers;

use Request;
use App\Model\TeacherCourse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Model\PeriodYear;
use App\Model\Course;
use App\Model\Role;
use App\Model\Matrial;
use App\Model\StudentCourse;
use App\Model\StudentAssignment;
use App\Model\Assignment;
use App\Model\Student;
use App\Model\RoleType;
use Auth;
use Session;
use Carbon\Carbon;
use ZipArchive;
use App\Notification;
use App\UserNotification;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class TeacherCourseController extends Controller
{
    protected function index()
    {
        abort_if(Gate::denies('teacher-courses'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data['courses']    = TeacherCourse::with('course')->where(['tea_id' => Auth::user()->record_id, 'approved' => 1])->get();

        return view('main/teacher/course/course_list', $data);
    }    

    protected function home($id, $sem)
    {
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

    protected function addSyllabus()
    {
        if(Request::file('syllabus-file') != '')
        {
            $add_syllabus               = new Matrial;
            $add_syllabus->type         = 1;
            $add_syllabus->co_id        = Request::input('course');
            $add_syllabus->record_id    = Auth::user()->record_id;
            $add_syllabus->table_name   = 1;
            $add_syllabus->file_path    = Storage::disk('syllabus')->putfile('/', new file(Request::file('syllabus-file')));
            $add_syllabus->save();

            Session::flash('syllabus-added', 'Syllabus Attached Successfully.!');
            return redirect('/teacher-course');
        }
    }

    protected function getSyllabus($id)
    {
        $data['course'] = $id;
        $data['course_syllabus'] = Matrial::where('co_id', $id)->where('type', 1)->get();

        foreach($data['course_syllabus'] as $y)
        {
            $data['row']  = $y->ma_id;
            $data['file'] = $y->file_path;
        }

        return view('main/teacher/course/syllabus_view', $data);
    }

    protected function deleteSyllabus()
    {
        $delete = Matrial::find(Request::input('data'));
        Storage::disk('syllabus')->delete($delete->file_path);
        $delete->delete();
        
        if($delete == true)
        {
            return 'Deleted';
        }else{
            return 'not';
        }
    }

    protected function getModule($date, $course, $semester)
    {
        $current_week = TeacherCourseController::getCurrentWeek($date);
        
        $weeks = Matrial::select('week')->where(['co_id' => $course, 'type' => 2])->distinct('week')->get();

        $materials = Matrial::where(['co_id' => $course, 'week' => $current_week, 'type' => 2, 'sem_id' => $semester])->get();

        return view('main/teacher/course/modules_view', compact('current_week', 'materials', 'weeks'));
    }

    protected function getWeekData($weekNumber, $course, $semester)
    {
        $materials = Matrial::where(['co_id' => $course, 'week' => $weekNumber, 'type' => 2, 'sem_id' => $semester])->get();
        
        return view('main/teacher/course/week_data_view', compact('materials'));
    }

    protected function getDropZone()
    {
        return view('main/teacher/course/dropZone');
    }

    protected function addData($course, $week, $semester)
    {
        $get_tc_id = TeacherCourse::with('course')->where('co_id', $course)->first();
        $data = StudentCourse::where(['tc_id' => $get_tc_id->tc_id, 'relevant_semester' => $get_tc_id->sem_id])->get();
        
        if(Request::hasFile('images')){
            $files = Request::file('images');

            foreach($files as $file)
            {   
                $name = $file->getClientOriginalName();
                $path = $file->storeAs("course-data/", $name, "course");

                $insertData                 = new Matrial;
                $insertData->type           = 2;
                $insertData->co_id          = $course;
                $insertData->sem_id         = $semester;
                $insertData->week           = $week;
                $insertData->record_id      = Auth::user()->record_id;
                $insertData->table_name     = 1;
                $insertData->file_path      = $name;
                $insertData->save();
            }

            $notification = new Notification;
            $notification->message = 'New Lecture Added To ' . $get_tc_id->course->co_name . ' Course';
            $notification->event   = 2;
            $notification->save();

            $last_id = $notification->noti_id;

            foreach($data as $row)
            {
                $user_notification = new UserNotification;
                $user_notification->noti_id = $last_id;
                $user_notification->user_id = $row->stu_id;
                $user_notification->tc_id   = $get_tc_id->tc_id;
                $user_notification->sem_id  = $semester;
                $user_notification->save();
            }

            echo "Uploaded";
        }else{
            echo 'Empty';
        }
    }

    protected function playData($fileName)
    {
        return view('main/teacher/course/video_play', compact('fileName'));
    }

    protected function downloadData($file)
    {
        return Storage::download('course/course-data/'. $file);
        return redirect()->back();
    }

    protected function deleteData()
    {
        $delete = Matrial::find(Request::input('data'));
        $file = $delete->file_path;
        unlink(storage_path('app/course/course-data/' . $file));
        $delete->delete();

        if($delete == true){
            return 'Deleted';
        }else{
            return 'Not Delete';
        }
    }

    protected function getAssignment($date, $course, $semester)
    {
        $data['current_week'] = TeacherCourseController::getCurrentWeek($date);

        $data['weeks'] = Matrial::select('week')->where(['co_id' => $course, 'type' => 3, 'sem_id' => $semester])->distinct('week')->get();

        $data['materials'] = Matrial::with('assignment_details')->where(['co_id' => $course, 'week' => $data['current_week'], 'type' => 3, 'sem_id' => $semester])->get();

        return view('main/teacher/course/assignment_view', $data);
    }

    protected function getAssignmentForm()
    {
        return view('main/teacher/course/assignment_form');
    }

    protected function addAssignment()
    {
        $file = Request::file('assignment-file');
        $name = $file->getClientOriginalName();
        $path = $file->storeAs("course-assignment/", $name, "course");

        $addAssignment = new Matrial;
        $addAssignment->type = 3;
        $addAssignment->co_id = Request::input('course');
        $addAssignment->sem_id = Request::input('sem-id');
        $addAssignment->week = Request::input('week');
        $addAssignment->record_id = Auth::user()->record_id;
        $addAssignment->table_name = 1;
        $addAssignment->file_path = $name;
        $addAssignment->save();

        $last_id = $addAssignment->ma_id;

        $assignment = new Assignment;
        $assignment->ma_id = $last_id;
        $assignment->start_date = Carbon::parse(Request::input('start-date'))->format('Y-m-d');
        $assignment->end_date = Carbon::parse(Request::input('end-date'))->format('Y-m-d');
        $assignment->full_mark = Request::input('mark');
        $assignment->save();

        $get_tc_id = TeacherCourse::with('course')->where('co_id', Request::input('course'))->first();
        $data = StudentCourse::where(['tc_id' => $get_tc_id->tc_id, 'relevant_semester' => $get_tc_id->sem_id])->get();
        
        $notification = new Notification;
        $notification->message = 'New Assignment Added To ' . $get_tc_id->course->co_name . ' Course';
        $notification->event   = 3;
        $notification->save();

        $last_id = $notification->noti_id;
        foreach($data as $row){
            $user_notification = new UserNotification;
            $user_notification->noti_id = $last_id;
            $user_notification->user_id = $row->stu_id;
            $user_notification->tc_id   = $get_tc_id->tc_id;
            $user_notification->sem_id  = $get_tc_id->sem_id;
            $user_notification->save();
        }
            
        
        Session::flash('assignment-added', 'Assignment Added Successfully.!');
        return redirect('/teacher-course');
    }

    protected function editAssignment()
    {
        $update_assignment = Assignment::find(Request::input('ass-id'));
        $update_assignment->start_date = Request::input('start-date');
        $update_assignment->end_date = Request::input('end-date');
        $update_assignment->save();

        if($update_assignment == true){
            return 'Updated';
        }else{
            return 'Not';
        }
    }

    protected function viewPDF()
    {
        $filePath = Request::input('data');

        return view('main/teacher/course/pdf_viewer', compact('filePath'));
    }

    protected function downloadAssignment($file)
    {
        return Storage::download('course/course-assignment/'. $file);
        return redirect()->back();
    }

    protected function deleteAssignment()
    {
        
        $delete = Matrial::find(Request::input('data'));
        $delete2 = Assignment::find(Request::input('data2'));
        $file = $delete->file_path;
        unlink(storage_path('app/course/course-assignment/' . $file));
        $delete->delete();
        $delete2->delete();

        if($delete == true){
            return 'Deleted';
        }else{
            return 'Not Delete';
        }
    }

    protected function getWeekAssignment($week, $course, $semester)
    {
        $data['materials'] = Matrial::with('assignment_details')->where(['co_id' => $course, 'week' => $week, 'type' => 3, 'sem_id' => $semester])->get();

        return view('main/teacher/course/assignment_data_view', $data);
    }


    protected function getPeople($course, $semester)
    {
       $role_id        = Auth::user()->role_id;
       $id             = Role::find($role_id);
       $type_id        = $id->role_type_id;
       $role_type      = RoleType::find($type_id);
       $user_type      = $role_type->role_type_id;
       
       $data = '';
        if($user_type == 3){
            $data = TeacherCourse::where(['co_id' => $course, 'tea_id' => Auth::user()->record_id, 'sem_id' => $semester])->get();
        }else{
           $data = TeacherCourse::where(['co_id' => $course, 'sem_id' => $semester])->get();
        }

        foreach($data as $data2){
            $tc_id = $data2->tc_id;
        }
        $people = StudentCourse::with('student')->where(['tc_id' => $tc_id, 'approve' => 1, 'relevant_semester' => $semester])->get();

        return view('main/teacher/course/people_view', compact('people'));
    }


    public static function getCurrentWeek($date)
    {
        $data = PeriodYear::orderByDesc('log_id')->limit(1)->get();
        foreach($data as $x)
        {
            $semester_start_date = $x->semester_start_date;
        }
        
        if($date >= $semester_start_date){
            // Calculate Date Difference
            $date1 = strtotime($semester_start_date); // Semester Start Date
            $date2 = strtotime($date); // Current Date

            $diff = ($date2 - $date1);
            $days = round($diff / 86400);

            // Multiply Every Day as Minute
            $dayToMin = ($days * 1440);

            if($dayToMin <= 10080){
                $current_week = '1';
            }else if($dayToMin <= 20160){
                $current_week = '2';
            }else if($dayToMin <= 30240){
                $current_week = '3';
            }else if($dayToMin <= 40320){
                $current_week = '4';
            }else if($dayToMin <= 50400){
                $current_week = '5';
            }else if($dayToMin <= 60480){
                $current_week = '6';
            }else if($dayToMin <= 70560){
                $current_week = '7';
            }else if($dayToMin <= 80640){
                $current_week = '8';
            }else if($dayToMin <= 90720){
                $current_week = '9';
            }else if($dayToMin <= 100800){
                $current_week = '10';
            }else if($dayToMin <= 110880){
                $current_week = '12';
            }else if($dayToMin <= 120960){
                $current_week = '12';
            }else if($dayToMin <= 131040){
                $current_week = '13';
            }else if($dayToMin <= 141121){
                $current_week = '14';
            }else if($dayToMin <= 151200){
                $current_week = '15';
            }else if($dayToMin <= 161280){
                $current_week = '16';
            }else{
                $current_week = 'Semester Ended.!';
            }
            return $current_week;
        }else{
            $current_week = 'Semester Ended.!';
            return $current_week;
        }
    }

    public function send_assignment(){
        $week  = Request::input('ass_week');
        $co_id = Request::input('as_id');
        $ma_id = Request::input('ma_id');
        $date  = Request::input('date');
        
        return view('main/teacher/course/send_assignment', compact('week','co_id','ma_id','date'));
    }

    public function student_assignment($course,$week,$date,$ma_id,$semester){
        
        $id    = Assignment::where('ma_id',$ma_id)->get();
        $as_id = "";
        foreach($id as $y){
            $as_id = $y->as_id;
        }
        
        if(Request::hasFile('images')){
            $files = Request::file('images');
            foreach($files as $file)
            { 
                $name = $file->getClientOriginalName();
                $path = $file->storeAs("student-assignment/", $name, "course");
 
                $insertData                 = new Matrial;
                $insertData->type           = 4;
                $insertData->co_id          = $course;
                $insertData->sem_id         = $semester;
                $insertData->week           = $week;
                $insertData->record_id      = Auth::user()->record_id;
                $insertData->table_name     = 2;
                $insertData->file_path      = $name;
                $insertData->save();

                $last_id = $insertData->ma_id;

                $insert = new StudentAssignment;
                $insert->stu_id        = Auth::user()->record_id;
                $insert->assignment_id = $as_id;
                $insert->ma_id         = $last_id;
                $insert->created_at    = Carbon::parse($date)->format('Y-m-d');
                $insert->save();
            }

            Session::flash('assignment_submitted','Your assignment was submitted successfully.');
            return redirect()->back();
        }
        else{

            Session::flash('assignment_not_submitted','Your assignment could not be sent. Please try again.');
            return redirect()->back();
        }
    }

    public function student_assignment_list($as_id){
        $as_id;
        $ma_id      = StudentAssignment::select('ma_id')->where('assignment_id', $as_id)->get();
        $student_id = Matrial::select('record_id')->whereIn('ma_id', $ma_id)->get();
        $data       = Student::whereIn('stu_id', $student_id)->get();

        return view('main/teacher/course/student_assignment_list', compact('data','as_id','ma_id'));
    }

    public function view_student_assignment($stu_id , $as_id)
    {
        $data['student_data'] = Student::find($stu_id);
        $data['student_assignments'] = StudentAssignment::with('material','assignment')->where(['assignment_id' => $as_id, 'stu_id' => $stu_id])->get();

        return view('main/teacher/course/view_student_assignment', $data); 
    }

    public function view_pdf_student_ass()
    {
        $filePath = Request::input('file_path');
        return view('main/teacher/course/stu_assignment_viewer', compact('filePath'));
    }

    public function download_student_assignment($file)
    {
        return Storage::download('course/student-assignment/'. $file);
        return redirect()->back();
    }

    public function status_assignment_list($stu_id , $as_id)
    {
        $data['student_data'] = Student::find($stu_id);
        $data['status_assignment'] = StudentAssignment::where('stu_id',$stu_id)->where('assignment_id', $as_id)->get();

        return view('main/teacher/course/status_stu_ass_list', $data);
       
    }

    public function student_mark_modal ($sg_id, $mark)
    {
        $sg_id;
        $mark;
        return view('main/teacher/course/student_mark_modal', compact('sg_id','mark'));
    }

    public function send_student_mark()
    {
        $sg_id = Request::input('sg_id');
        $update = StudentAssignment::find($sg_id);
        $update->mark = Request::input('mark');
        $update->status = 1;
        $update->description = Request::input('comment');
        $update->save();
        
        Session::flash('send_student_mark', 'Assignment Successfully Marked.');
        return redirect()->back();
    }

    public function student_resubmit_modal($sg_id)
    {
        $sg_id;
        return view('main/teacher/course/student_resubmit_modal', compact('sg_id'));
    }

    public function resubmit_assignment()
    {
        $sg_id = Request::input('sg_id');
        $update = StudentAssignment::find($sg_id);
        $update->status = 2;
        $update->description = Request::input('comment');
        $update->save();
        
        Session::flash('resubmit_assignment', 'Assignment Successfully Resubmit it.');
        return redirect()->back();
    }

    public function student_reject_modal($sg_id)
    {
        $sg_id;
        return view('main/teacher/course/student_reject_modal', compact('sg_id'));
    }

    public function reject_assignment()
    {
        $sg_id = Request::input('sg_id');
        $update = StudentAssignment::find($sg_id);
        $update->mark   = 0;
        $update->status = 3;
        $update->description = Request::input('comment');
        $update->save();
        
        Session::flash('reject_assignment', 'Assignment Successfully Reject it.');
        return redirect()->back();
    }


    public function update_picture_course()
    {     
        $tc_id = Request::input('tc-id');

        if(Request::file('file') != '')
        {
            $path = Storage::disk('course-picture')->putfile('/', new file(Request::file('file')));
            $one_row = TeacherCourse::find($tc_id);
            if($one_row != ''){
                Storage::disk('course-picture')->delete($one_row->photo);
            }
            $one_row->photo  = $path;  
        }
        $one_row->save();

        Session::flash('course-photo', 'Course Image Changed Successfully.!');
        return redirect('/teacher-course');
    }
}

