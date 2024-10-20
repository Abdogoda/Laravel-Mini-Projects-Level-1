<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $name = time() . '.' . $file->getClientOriginalExtension(); // eg: 1728770256.jpg
            
            $file->storeAs('uploaded/users', $name, 'public');
            $user->image = $name;
            $user->update();
        }

        return redirect()->route("login")->with('success', 'You have created your account successfully');
    }
}