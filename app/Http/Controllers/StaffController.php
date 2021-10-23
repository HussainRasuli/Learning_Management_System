<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\File;
use App\Model\Role;
use App\Model\PeriodYear;
use App\User;
use App\Model\Staff;
use App\Model\Position;
use App\Model\PositionType;
use Session;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class StaffController extends Controller
{
    public function index(){
        abort_if(Gate::denies('view-staffs'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $all_staff = Staff::with('position','user')->orderByDesc('staff_id')->get();
        return view('main/admin/staff/staff_list', compact('all_staff'));
    }

    public function staff_form(){
        abort_if(Gate::denies('view-staffs'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $all_position = Position::all();
        return view('main/admin/staff/add_staff', compact('all_position'));
    }

    public function store(Request $request){
        $validations = $request->validate([
            'firstname'     => 'required|string',
            'lastname'      => 'required|string',
            'father_name'   => 'required|string',
            'email'         => 'required|string',
            'id_card'       => 'required|numeric',
            'phone'         => 'required|numeric',
            'dob'           => 'required', 
            'gender'        => 'required',
            'education'     => 'required',
            'position'      => 'required'
        ]);
        
        if($request->account_btn == 2){
            $staff_id = $request->staff_id;
            StaffController::makeAccount($request->account_btn, $staff_id, '70');
            return 'created';
        }else{
        $staff_insert = new Staff();
        $path ='';
        if($request->file('photo'))
        {
          $path = Storage::disk('staff')->putFile('/', new File($request->file('photo')));
            $staff_insert->photo      = $path;
        }
           
            $staff_insert->first_name   = $request->firstname;
            $staff_insert->last_name    = $request->lastname;
            $staff_insert->father_name  = $request->father_name;
            $staff_insert->tazkira_id   = $request->id_card;
            $staff_insert->date_of_birth= Carbon::parse($request->dob)->format('Y-m-d');
            $staff_insert->education    = $request->education;
            $staff_insert->gender       = $request->gender;
            $staff_insert->position_id  = $request->position;
            $staff_insert->phone        = $request->phone;
            $staff_insert->email        = $request->email;
            $staff_insert->save();

            $last_id = $staff_insert->staff_id;

            $x = $request->input('make_account');
            if($x == 1){
                $dep_id = Staff::find($last_id);
                $dep_id->dep_id = '70';
                $dep_id->save();

                $x = $request->input('make_account');
                StaffController::makeAccount($x, $last_id, '70');
            }

            Session::flash('staff_added','Seccussefuly Added');
        } 

        return redirect()->action('StaffController@index');       
 }


    public function delete_staff(Request $request){
         $staff_id = $request->input('id');

         $one_staff = Staff::find($staff_id);
         $one_staff->delete();

         $one_user = User::where('table_name', 3)->where('record_id', $staff_id);
         $one_user->delete();

         if($one_staff == true){
            return 'Deleted';
         }
         else{
            return 'Not Delete';
         }
    }


    public function update_staff(Request $request){
        
        $staff_id = $request->input('staff_id');
        $update = Staff::find($staff_id);

        if($request->file('photo') != '')
        {
            $path = Storage::disk('staff')->putfile('/', new file($request->file('photo')));

            $one_col = Staff::find($staff_id);

            if($one_col != ''){
                Storage::disk('staff')->delete($one_col->photo);
            }

            $update->photo  = $path;
               
        }

        $update->first_name    = $request->firstname;
        $update->last_name     = $request->lastname;
        $update->father_name   = $request->father_name;
        $update->tazkira_id    = $request->id_card;
        $update->date_of_birth = Carbon::parse($request->dob)->format('Y-m-d');
        $update->education     = $request->education;
        $update->gender        = $request->gender;
        $update->position_id   = $request->position;
        $update->phone         = $request->phone;
        $update->email         = $request->email;
        $update->save();
        
        Session::flash('staff-updated','Staff Seccussefuly Updated.!');

        return redirect()->action('StaffController@index'); 
    }

     public function edit_staff_model(Request $request){

        $staff_id = $request->input('id');
        $data['data'] = Staff::find($staff_id);
        $data['position'] = Position::all();
        return view('main/admin/staff/edit_staff_modal', $data);

     }


     public function makeAccount($msg, $id, $dep){

        $dep_id = Staff::find($id);
        $dep_id->dep_id = '70';
        $dep_id->save();

        $user_count = User::orderByDesc("id")->limit(1)->get();
        $count = count($user_count);

        if($count > 0){
            $year   = PeriodYear::orderByDesc("log_id")->limit(1)->get();
        
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

        
            if($subYear == $last_year){

                if($last_user <= 8){
                    $last_user += 1;                
                    $new_email = $subYear . $period . $dep . '000'.$last_user;
                }else if($last_user <= 98){
                    $last_user += 1;
                    $new_email = $subYear . $period . $dep . '00'.$last_user;
                }else if($last_user <= 998){
                    $last_user += 1;
                    $new_email = $subYear . $period . $dep . '0'.$last_user;
                }else{
                    $last_user++;
                    $new_email = $subYear . $period . $dep . $last_user;
                }

            }else{
                $new_email = $subYear . $period . $dep . '0001';
            }
        }
    
        $role_id = Role::where('role_type_id', 5)->get();
        foreach($role_id as $x){
            $role_id = $x->role_id;
        }
        $store = new User;
        $store->email = $new_email . '@gawharshad.edu.com';
        $store->password = Hash::make($new_email);
        $store->user_status = 1;
        $store->role_id = $role_id;
        $store->table_name = 3;
        $store->record_id = $id;
        $store->save();

        $staff = Staff::find($id);
        $staff->unique_id = $new_email;
        $staff->save();

        if($msg == 1){
            Session::flash('account_created','Seccussefuly Created');
        }
    }

    public function check_position_type_id($id){
        $all_position_type = PositionType::all();
        $one_row_selected = Position::find($id);

        if($one_row_selected->position_type_id == 2){
            return 'staff';
        }
        else{
            return 'head of department';
        }
     }


     public function view_staff_modal(Request $request){
        $staff_id = $request->input('id');
        $data = Staff::with('position')->find($staff_id);
        return view('main/admin/staff/view_staff_modal', compact('data'));
    }

    public function search_staff(Request $request){
        $data = $request->input('input_send_data');
        $all_staff = Staff::where('unique_id',$data)->orWhere('tazkira_id', $data)->with('position','user')->get();
        return view('main/admin/staff/staff_search_data', compact('all_staff'));
    }
    
}
