<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class AdminController extends Controller
{
    //
     public function index(){
    	return view('admin.home');
    }

    
    public function memberDetails(){
    	$users = DB::table('users_table')
                ->join('users_profile_table','users_table.user_id','=','users_profile_table.user_id')
                ->join('users_type_table','users_type_table.user_type_id','=','users_profile_table.user_type_id')
                ->get();

    	return View('admin.memberdetails')
    			->with('users',$users);
    }

    

    public function editMemberDetails(Request $request, $userid){
    	$user = DB::table('users_table')
                ->join('users_profile_table','users_table.user_id','=','users_profile_table.user_id')
                ->join('users_type_table','users_type_table.user_type_id','=','users_profile_table.user_type_id')
                ->where('users_table.user_id',$userid)
    			->first();
    	return view('admin.editmember')
    			->withUser($user);
    }

    public function updateMemberDetails(Request $request, $userid){
    
       /* echo $userid.'<br/>';
        echo $request->fname.'<br/>';
        echo $request->lname.'<br/>';
        echo $request->usertype.'<br/>';*/
        DB::table('users_table')
            ->where('user_id',$userid)
            ->update(['first_name'=>$request->fname,
            'last_name'=>$request->lname
            ]);
        DB::table('users_profile_table')
            ->where('user_id',$userid)
            ->update(['user_type_id'=>$request->usertype]);
        return redirect()->route('Admin.memberDetails');
    }

    public function deleteMember(Request $request, $userid){
        $user = DB::table('users_table')
                ->join('users_profile_table','users_table.user_id','=','users_profile_table.user_id')
                ->join('users_type_table','users_type_table.user_type_id','=','users_profile_table.user_type_id')
                ->where('users_table.user_id',$userid)
                ->first();
        return view('admin.confirmdeletemember')
                ->withUser($user);
    }

    public function confirmDeleteMember(Request $request, $userid){
        DB::table('users_profile_table')
            ->where('user_id',$userid)
            ->delete();
        DB::table('users_profile_table')
            ->where('user_id',$userid)
            ->delete();
        return redirect()->route('Admin.memberDetails');    
    }	
    
    public function showProfile(Request $request){
        $admin = DB::table('users_table')
            ->join('users_profile_table','users_table.user_id','users_profile_table.user_id')
            ->where('users_table.user_id',$request->session()->get('userid'))
            ->first();
        /*
        echo "<pre>";
        print_r($admin);
        echo "</pre>";
        */
        return view('admin.profile')
            ->withAdmin($admin);
    }

    public function changePassword(Request $request){
        return view('admin.changepassword');
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
            return redirect()->route('Admin.changePassword')
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
                    return redirect()->route('Admin.showprofile');
            }
        }
    }

    public function logout(Request $request){
    	$request->session()->flush();
    	return redirect()->route('Login.loginView');
    }
}
