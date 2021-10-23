<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Hash;
use App\Model\PeriodYear;
use App\Model\Department;
use App\User;

class AccountController extends Controller
{
    protected function store()
    {
        // 14 2 10 0001
        $user_count = User::orderByDesc("id")->limit(1)->get();
        $count = count($user_count);

        if($count > 0){
            $year   = PeriodYear::orderByDesc("log_id")->limit(1)->get();
            $dep    = Department::find(1); //delete

            foreach($year as $row)
            {
                $currentYear = $row->year;
                $period = $row->period;
            }

            $subYear = substr($currentYear, 0, 2); // 1400 

            foreach($user_count as $user)
            {
                $last_email = $user->email; // 14 210 5121 @gawharshad.edu.com
            }

            $last_user = substr($last_email, 5, 4);

            $last_year = substr($last_email, 0, 2);

            $department_code = $dep->dep_code; //------->delete
            // if($department_code <= 9){
            //     $department_code = '0' . $dep->dep_code;
            // }
           
            if($subYear == $last_year){

                if($last_user <= 8){
                    $last_user += 1;                 //$request->input('dep_code');
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
                $new_email = $subYear . $period . $department_code . '0001'; // 151090001
            }
        }
        
        $store = new User;
        $store->email = $new_email . '@gawharshad.edu.com';
        $store->password = Hash::make($new_email);
        $store->user_status = 1;
        $store->role_id = Request::input('role');
        $store->table_name = 1;
        $store->record_id = Request::input('data');
        $store->save();
        
        if($store == true){
            return 'created';
        }else{
            return 'not';
        }
    }
}
