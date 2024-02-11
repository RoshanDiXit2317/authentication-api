<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Constants\AuthConstants;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends ApiController
{
    public function register(RegisterRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('UserToken')->plainTextToken; // Created token by token_name = "UserToken"

        return $this->successResponse( $success, AuthConstants::REGISTER);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if( !Auth::attempt($credentials) ){
            return $this->respondWithUnauthorized(message: AuthConstants::VALIDATION);
        }
        $user = Auth::user();
        $success = $user;
        $success['token'] = $user->createToken('UserToken')->plainTextToken;
        return $this->successResponse($success, AuthConstants::LOGIN );
    }
}
