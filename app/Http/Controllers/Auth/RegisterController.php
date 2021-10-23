<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Model\Staff;
use App\Model\Role;
use App\Model\Position;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

 
    public function __construct()
    {
        $x = User::all();
        $one_row = count($x);
        if($one_row == 0){
            $this->middleware('guest');
        }else{
            Redirect::to('/')->send();
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

     
    protected function create(array $data)
    {     
        $year = $data['year'];
        $yearDigit = substr($year, 0, 2);
        $user_name = $yearDigit . '1700001@gawharshad.edu.af';

        $add_position = new Position;
        $add_position->position_name = "Super Admin";
        $add_position->position_type_id = 1;
        $add_position->save();
        $position_last_id = $add_position->position_id;

        $add_to_staff = new Staff;
        $add_to_staff->first_name = $data['first-name'];
        $add_to_staff->last_name  = $data['last-name']; 
        $add_to_staff->email      = $data['email'];
        $add_to_staff->unique_id  = $yearDigit . '1700001';
        $add_to_staff->gender     = 1;
        $add_to_staff->position_id= $position_last_id;
        $add_to_staff->dep_id     = "70";
        $add_to_staff->save();
        $last_id = $add_to_staff->staff_id;

        return User::create([
            'email' => $user_name,
            'password' => Hash::make($data['password']),
            'user_status' => 1,
            'role_id' => 1,
            'table_name' => 3,
            'record_id' => $last_id,
        ]);
    }
}
