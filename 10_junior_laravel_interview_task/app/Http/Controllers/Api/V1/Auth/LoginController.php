<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use ApiResponse;
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        
        $user = User::where('phone', $request->phone)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            $this->error('Invalid phone number or password!', 422);
        }

        if(!$user->verified_at){
            Log::info("Your verfication otp is: ". $user->verification_code);
            $this->error('Your account is not verified to login, We sent you the otp, check your phone messages!', 422);
        }

        return $this->success(
            'Tag created successfully', 
            [
                "user" => new UserResource($user),
                "token" => $user->createToken('auth_token')->plainTextToken
            ]
        );
    }
}