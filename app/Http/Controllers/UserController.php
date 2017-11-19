<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Question;
use Validator;
use DB;

class UserController extends Controller
{
    //
    public function index(){
    	return view('user.home');
    }

    

     public function showProfile(Request $request){
    	$member = DB::table('users_table')
            ->join('users_profile_table','users_table.user_id','users_profile_table.user_id')
            ->where('users_table.user_id',$request->session()->get('userid'))
            ->first();
        /*
        echo "<pre>";
        print_r($admin);
        echo "</pre>";
        */
        return view('user.profile')
            ->withMember($member);	
    }

    public function changePassword(Request $request){
        return view('user.changepassword');
    }

    public function confirmChangePassword(Request $request){
        $oldpass = $request->oldpassword;
        $password = $request->password;
        $newpassword = $request->repassword;

        $validator = Validator::make($request->all(),[
            'oldpassword' => 'required',
            'password' => 'required|same:repassword|min:5',
        ]);

        if ($validator->fails()) {
            return redirect()->route('User.changePassword')
                ->withErrors($validator);
        }else{
            $user = DB::table('users_table')
                    ->where('user_id',$request->session()->get('userid'))
                    ->where('password',$oldpass)
                    ->first();
            if ($user != null) {
                DB::table('users_table')
                    ->where('user_id',$request->session()->get('userid'))
                    ->update(['password' => $newpassword]);
                    $request->session()->flash('changepassword','Your Password Changed Succesfully');
                    return redirect()->route('User.showProfile');
            }
        }
    }

     public function logout(Request $request){
     	$request->session()->flush();
     	return redirect()->route('Login.loginView');
    }
}
