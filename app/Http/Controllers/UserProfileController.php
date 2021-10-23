<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Student;
use App\Model\Teacher;
use App\Model\Staff;
use App\Model\Role;
use App\Model\RollType;
use App\Model\User;
use App\Model\Position;
use App\Model\PositionType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Auth;
use Session;

class UserProfileController extends Controller
{
    public function index(){
        $user_id   = Auth::user()->id;
        $row       = User::find($user_id);
        $record_id = $row->record_id;
        $role_id   = $row->role_id;
        $id        = Role::find($role_id);
        $role_type = $id->role_type_id;

        $data['data'] = '';
        $data['type'] = '';
        $data['position_type'] = '';
        if($role_type == 1 || $role_type == 2 || $role_type == 5){
           $data['data'] = Staff::with('position','dep')->find($record_id);
           $position_id  = $data['data']->position_id;
           $pos_id       = Position::find($position_id);
           $position_type = $pos_id->position_type_id;
           $pos_type      = PositionType::find($position_type);
           $data['position_type'] = $pos_type->position_type_name;
           $data['type'] = $role_type;
        }
        else if($role_type == 3){
            $data['data'] = Teacher::with('dep')->find($record_id);
            $data['type'] = $role_type;
        }
        else if($role_type == 4){
            $data['data'] = Student::with('faculties','dep')->find($record_id);
            $data['type'] = $role_type;
        }

        return view('main/profile/user_profile',$data);
    }


    public function change_password(Request $request){
         $user_id  = Auth::user()->id;
         $db_pass  = Auth::user()->password;
         $old_pass = $request->input('old_password');
         $new_pass = $request->input('new_password');
         $con_pass = $request->input('confirm_password');
     
         $validation = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required_with:new_password|same:new_password|min:6'
         ]);
       
         if(Hash::check($old_pass, $db_pass)){
                $update             = User::find($user_id);
                $update->password   = Hash::make($new_pass);
                $update->save();

            if($update == true){
                Session::flash('pass_changed','Succussfully Changed.');
                return redirect()->back();
            }
         }
         else{
                Session::flash('NotMatch','Your Current Password, Please try again');
                return redirect()->back();
         }
    }


    public function update_picture(Request $request){
        $user_id   = Auth::user()->id;
        $row       = User::find($user_id);
        $record_id = $row->record_id;
        $role_id   = $row->role_id;
        $id        = Role::find($role_id);
        $role_type = $id->role_type_id;


    if($role_type == 1 || $role_type == 2 || $role_type == 5){
        $update = Staff::find($record_id);

        if($request->file('profile_photo') != '')
        {
            $path = Storage::disk('staff')->putfile('/', new file($request->file('profile_photo')));

            $one_col = Staff::find($record_id);

            if($one_col != ''){
                Storage::disk('staff')->delete($one_col->photo);
            }

            $update->photo  = $path;
               
        }
    }

    if($role_type == 3){
        $update = Teacher::find($record_id);

        if($request->file('profile_photo') != '')
        {
            $path = Storage::disk('teacher')->putfile('/', new file($request->file('profile_photo')));

            $one_col = Teacher::find($record_id);

            if($one_col != ''){
                Storage::disk('teacher')->delete($one_col->photo);
            }

            $update->photo  = $path;
               
        }
    }

    if($role_type == 4){
        $update = Student::find($record_id);

        if($request->file('profile_photo') != '')
        {
            $path = Storage::disk('student')->putfile('/', new file($request->file('profile_photo')));

            $one_col = Student::find($record_id);

            if($one_col != ''){
                Storage::disk('teacher')->delete($one_col->photo);
            }

            $update->photo  = $path;
               
        }
    }

        $update->save();
        if($update){
            return 'Updated';
        }
        else{
            return 'error';
        }

       
    }
}
