<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Notification;
use App\UserNotification;
use App\Model\StudentCourse;

class DashboardController extends Controller
{
    protected function index()
    {
        $x = User::all();
        $one_row = count($x);
        if($one_row == 0){
            return redirect('/register');
        }else{
            return view('auth/login');
        }
    }

    protected function getNotification()
    {
        if(Auth::user()->table_name == 3){
            $noti_data = UserNotification::with('notification')->where(['user_id' => Auth::user()->record_id])->orderByDesc('user_noti_id')->get();
            
            $data['notification_count'] = UserNotification::with('notification')->where(['user_id' => Auth::user()->record_id, 'nofi_read' => 0])->get();
            $noti_count = count($data['notification_count']);

            return view('layouts/notification', compact('noti_data', 'noti_count'));
        }else if(Auth::user()->table_name == 2){
            $course_array = array();
            $semester_id;
            $data = StudentCourse::where(['stu_id' => Auth::user()->record_id])->get();
            foreach($data as $row)
            {
                array_push($course_array, $row->tc_id);
                $semester_id = $row->relevant_semester;
            }
            $noti_data = UserNotification::with('notification')->where(['user_id' => Auth::user()->record_id, 'sem_id' => $semester_id])->whereIn('tc_id', $course_array)->orderByDesc('user_noti_id')->get();
            
            $data['notification_count'] = UserNotification::with('notification')->where(['user_id' => Auth::user()->record_id, 'nofi_read' => 0 ,'sem_id' => $semester_id])->whereIn('tc_id', $course_array)->get();
            $noti_count = count($data['notification_count']);
            // foreach($data['notifications'] as $x)
            // {
            //     echo $x->notification->message;
            // }
            // exit();
            // dd($noti_data);

            return view('layouts/notification', compact('noti_data', 'noti_count'));
        }
        
    }

    protected function notificationReaded()
    {
        $update = UserNotification::where(['user_id' => Auth::user()->record_id])->get();

        foreach($update as $x){
            $x->nofi_read = 1;
            $x->save();
        }

        return 'Updated';
    }
}
