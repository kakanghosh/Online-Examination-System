<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Helper\Question;

class LoginController extends Controller
{
    //
    public function index(){
    	return view('landing');
    }
    
    public function loginView(){
    	return view('login');
    }

    public function checkLogin(Request $request){
        //It will check for some basic requirment
        $validator = Validator::make( $request->all(),[
            'username' => 'required',
            'password' => 'required'
        ]);
        //If fails redirect to login view with errors message
        if ($validator->fails()) {
            return redirect()->route('Login.loginView')
            ->withErrors($validator);
        }else{
            //Data valid
            //And here checking for authenticate user
            $user = DB::table('users_table')
                ->join('users_profile_table','users_table.user_id','=','users_profile_table.user_id')
                ->join('users_type_table','users_type_table.user_type_id','=','users_profile_table.user_type_id')
                ->where('user_name',$request->username)
                ->where('password',$request->password)
                ->first();
            //If not found redirect to login page
            //With proper error message    
            if ($user == null) {
                $request->session()->flash('loginError','Username or Password is Incorrect');
                return redirect()->route('Login.loginView');
            }else{
                //If user is admin then redirected to admin home page
                $request->session()->put('userid',$user->user_id);
                $request->session()->put('firstname',$user->first_name);
                $request->session()->put('usertype',$user->user_type);
                if ($user->user_type == 'ADMIN') {
                    return redirect()->route('Admin.index');
                }else if ($user->user_type == 'MEMBER') {
                    //If user is user then redirected to USER home page
                    return redirect()->route('User.index');
                }
                
            }
        }
    }

    public function registrationView(){
        return view('registration');
    }

    public function checkRegistration(Request $request){
        /*
            This part will validate the user registration
            data with required information
        */
        $validator = Validator::make($request->all(),[
            'firstname' => 'required|min:4',
            'lastname' => 'required|min:3',
            'username' => 'required|min:6|unique:users_table,user_name',
            'email' => 'required|email|unique:users_profile_table,email',
            'gender' => 'required',
            'dob' => 'required',
            'password' => 'required|min:5|same:repassword'
        ]);

        //If Failes it will redirect to
        // the registration page with some addition data
        if ($validator->fails()) {
            $request->session()->flash('firstname',$request->firstname);
            $request->session()->flash('lastname',$request->lastname);
            $request->session()->flash('username',$request->username);
            $request->session()->flash('email',$request->email);
            $request->session()->flash('gender',$request->gender);
            $request->session()->flash('dob',$request->dob);
            return redirect()
            ->route('Login.registerView')
            ->withErrors($validator);

        }else{
            // data is valide 
            // then the new user will be created and stored in DB
            date_default_timezone_set('Asia/Dhaka');
            $userid = DB::table('users_table')->insertGetId([
                'first_name'=> $request->firstname,
                'last_name' => $request->lastname,
                'user_name' => $request->username,
                'password' => $request->password,
                'date_time' => date("Y-m-d h:i:s")

            ]);

            DB::table('users_profile_table')->insert([
                'user_id' => $userid,
                'email' => $request->email,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'user_type_id' => 2
            ]);

            $request->session()->flash('registrationsucess','Registration Succesful. Please Login');
            return redirect()->route('Login.loginView');
        }
    }
}
