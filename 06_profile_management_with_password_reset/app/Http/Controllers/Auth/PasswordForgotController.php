<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendResetPasswordLinkMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordForgotController extends Controller
{
    public function forgotForm(){
        return view("auth.password-forgot");
    }

    public function forgot(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);
        
        $user = User::where('email', $request->email)->first();

        $token = Str::random(60);

        DB::table("password_reset_tokens")->where("email", $request->email)->delete();
        DB::table('password_reset_tokens')->insert([
            'token' => $token,
            'email' => $request->email,
            'created_at' => Carbon::now()
        ]);

        Mail::to($request->email)->send(new SendResetPasswordLinkMail($token, $user));

        return back()->with("success", 'We have emailed your account with the reset link!');
    }
}