<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminManagement extends Controller
{
    public function login(){

        return view('Admin.adminLogin');
    }

    public function create(Request $request){
       $request->validate([
       'name'=>"required|max:100",
       'password'=>'required|max:100',
       ]);

       $credentials = $request->only('name','password');
       
       if(Auth::attempt($credentials)) {
           
        // check remember me token clicked or not start
        if( isset($request->remember) ){
        Cookie::queue('autobox_username',$request->name,1440);
        Cookie::queue('autobox_password',$request->password,1440); 
        }
        return response()->json(['code' =>'true','msg'=>"Login Success"]);
       }
       else{
        return response()->json(['code' =>'false','msg'=>"The username and password do not match."]);
       }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function forgetPassword(){
        return view("Admin.forgetPassword");
    }

    public function forgetPasswordMail(Request $request){
    $request->validate([
    'mail'=>'required|email|exists:users,email|max:100',
    ]);
    $token = \Str::random(64);
    $query = DB::table('password_reset_tokens')->where('email',$request->mail);
    if($query->exists()) {
      DB::table('password_reset_tokens')->where('email',$request->mail)->update([
        'token'=>$token,
        'expired_at'=>Carbon::now()->addMinutes(15),
      ]);
    } else {
        DB::table('password_reset_tokens')->insert([
          'email'=>$request->mail,
          'token'=>$token,
          'expired_at'=>Carbon::now()->addMinutes(15),
        ]);
    }

    $action_link = route('forget_password_link.email',['token'=>$token,'email'=>$request->mail]);
    $body = "we are recieved a request to reset the password for <b>app name</b> account associated with ".$request->mail.". You can reset your password by clicking the link below ";

    $result =  \Mail::send('email-forgot',['action_link'=>$action_link,'body'=>$body], function($message) use ($request){
      $message->from('jayathilaka221b@gmail.com','your app name');
      $message->to($request->mail,'your name')->subject('Reset password');
    });
    if($result){
      return response()->json(['code'=>'true','msg'=>"We sent you a mail, please check your mails."]);
    }else{
      return response()->json(['code'=>'false','msg'=>"Something went wrong."]);
    }

    }

    public function showResetForm($token){
        return view('Admin.reset_password',compact(['token']));
    }

    public function resetPassword(Request $request){
      $check_expired = DB::table('password_reset_tokens')->where(['token'=>$request->token])->first();     
      $check_time = Carbon::parse($check_expired->expired_at);
      $current_time = Carbon::now(); 
      if ($check_time->gt($current_time)) {
        $request->validate(
          [
          'password' => ['required','confirmed','max:20','min:6','regex:/[a-z]/','regex:/[A-Z]/','regex:/[0-9]/','regex:/[@$!%*#?&]/'], 
          ]
          );
          //check token available or not 
          $reset = DB::table('password_reset_tokens')->where(['token'=>$request->token])->first();
          if($reset){
          // change password 
          $change =  DB::table('users')->where('email',$reset->email)->update(
          ['password'=>Hash::make($request->password)]
          );
          if($change){
          return response()->json(['code'=>'false','msg'=>"Password Changed."]);
          }
          else{
          return response()->json(['code'=>'true','msg'=>"The username and password do not match."]);
          }
          }
          else{
          return response()->json(['code'=>'false','msg'=>"Invalid Token."]);
          }

      } else {
          return response()->json(['code'=>'false','msg'=>"Token Expired"]);
      }
        }

}
