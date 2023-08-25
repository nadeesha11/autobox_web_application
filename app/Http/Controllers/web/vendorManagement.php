<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\forgetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class vendorManagement extends Controller
{

    public function login(Request $request)
    {

        $request->validate([
            'name' => 'required|min:8',
            'password' => 'required'
        ]);

        $credentials = $request->only('name', 'password');


        if (Auth::attempt($credentials)) {
            $vendor_details = DB::table('users')->where('name', $request->name)->first();
            session(['vendor_data' => $vendor_details]);
            // check remember me token clicked or not start
            if (isset($request->checkbox)) {

                Cookie::queue('autobox_vendor_username', $request->name, 1440);
                Cookie::queue('autobox_vendor_password', $request->password, 1440);
            } else {
                Cookie::queue(Cookie::forget('autobox_vendor_username'));
                Cookie::queue(Cookie::forget('autobox_vendor_password'));
            }
            return response()->json(['code' => 'true', 'msg' => "Login Success"]);
        } else {
            return response()->json(['code' => 'false', 'msg' => "The username and password do not match."]);
        }
    }

    public function index()
    {

        return view('Web.vendorLogin');
    }

    public function registerIndex()
    {
        return view('Web.vendorRegister');
    }

    public function create(Request $request)
    {
        $request->validate([
            'username' => 'required|min:8|unique:users,name',
            'email' => 'required|email|email|unique:users,email',
            'password' => ['required', 'confirmed', 'max:20', 'min:6', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
        ]);

        $result = DB::table('users')->insertGetId([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'status' => 1,
            'isAdmin' => 0,
            'cus_role_id' => 1,
            'is_free_package_active' => 0,
        ]);

        if ($result) {
            $vendor_details = DB::table('users')->find($result);
            session(['vendor_data' => $vendor_details]);
            return response()->json(['code' => 'true', 'msg' => "register successfully"]);
        } else {
            return response()->json(['code' => 'false', 'msg' => "Something went wrong !!!"]);
        }
    }

    public function provider()
    {

        return Socialite::driver('facebook')->redirect();
    }

    public function handleCallback()
    {
        $user = Socialite::driver('facebook')->user();
        dd($user);
    }

    public function providerFacebook()
    {

        return Socialite::driver('google')->redirect();
    }

    public function handleCallbackFacebook()
    {

        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);
                return "successful";
                return redirect()->intended('web.dashboard');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('123456dummy'),
                    'cus_role_id' => 1
                ]);

                Auth::login($newUser);
                return "successful";
                return redirect()->intended('web.dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function forgetPasswordVendor()
    {
        return view('Web.forgetPassword');
    }

    public function forgetPasswordMail(forgetPasswordMail $request)
    {
        $token = \Str::random(64);
        $query = DB::table('password_reset_tokens')->where('email', $request->email);
        if ($query->exists()) {
            DB::table('password_reset_tokens')->where('email', $request->email)->update([
                'token' => $token,
                'expired_at' => Carbon::now()->addMinutes(15),
            ]);
        } else {
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'expired_at' => Carbon::now()->addMinutes(15),
            ]);
        }

        $action_link = route('forget_password_link.email.web', ['token' => $token, 'email' => $request->email]);
        $body = "we are recieved a request to reset the password for <b>app name</b> account associated with " . $request->email . ". You can reset your password by clicking the link below ";

        $result =  \Mail::send('email-forgot', ['action_link' => $action_link, 'body' => $body], function ($message) use ($request) {
            $message->from('jayathilaka221b@gmail.com', 'your app name');
            $message->to($request->email, 'your name')->subject('Reset password');
        });
        if ($result) {
            return response()->json(['code' => 'true', 'msg' => "We sent you a mail, please check your mails."]);
        } else {
            return response()->json(['code' => 'false', 'msg' => "Something went wrong."]);
        }
    }

    public function showResetForm($token)
    {
        return view('Web.resetPassword', compact(['token']));
    }

    public function resetPassword(Request $request)
    {
        $check_expired = DB::table('password_reset_tokens')->where(['token' => $request->token])->first();
        $check_time = Carbon::parse($check_expired->expired_at);
        $current_time = Carbon::now();
        if ($check_time->gt($current_time)) {
            $request->validate(
                [
                    'password' => ['required', 'confirmed', 'max:20', 'min:6', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
                ]
            );
            //check token available or not 
            $reset = DB::table('password_reset_tokens')->where(['token' => $request->token])->first();
            if ($reset) {
                // change password 
                $change =  DB::table('users')->where('email', $reset->email)->update(
                    ['password' => Hash::make($request->password)]
                );
                if ($change) {
                    return response()->json(['code' => 'false', 'msg' => "Password Changed."]);
                } else {
                    return response()->json(['code' => 'true', 'msg' => "The username and password do not match."]);
                }
            } else {
                return response()->json(['code' => 'false', 'msg' => "Invalid Token."]);
            }
        } else {
            return response()->json(['code' => 'false', 'msg' => "Token Expired"]);
        }
    }
}
