<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerificationRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    use ApiResponse;
    /**
     * Handle the incoming request.
     */
    public function __invoke(VerificationRequest $request){
        $user = User::where("phone", $request->phone)->first();
        if(!$user || $user->verification_code != $request->verification_code){
            return $this->error('Phone Number is not found, or otp is invalid!', 422);
        }

        $user->verified_at = now();
        $user->save();
        return $this->success('Your account is now verified!');
    }
}