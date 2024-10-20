<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        if(Auth::attempt($request->only('email', 'password'))){
            return redirect()->route('dashboard')->with('success', 'Welcome back!');
        }
        return back()->with("error", 'Email or password Invalid!');
    }
}