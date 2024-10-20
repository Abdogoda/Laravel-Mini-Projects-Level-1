<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function resetForm(){
        return view("auth.password-reset");
    }

    public function reset(Request $request){
        $request->validate([
            'password' => 'required|string|min:6|confirmed'
        ]);
        
        $token = DB::table("password_reset_tokens")
            ->where("email", $request->email)
            ->where("token", $request->token)
            ->first();
        if(!$token){
            return back()->with('error', 'Token or email invalid!');
        }

        $user = User::where('email', $request->email)->first();
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        
        DB::table("password_reset_tokens")->where("email", $request->email)->delete();

        return redirect()->route("login")->with("success", 'Password changed successfully');

    }
}