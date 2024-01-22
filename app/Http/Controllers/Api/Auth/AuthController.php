<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Constants\AuthConstants;
use App\Http\Requests\Api\Auth\RegisterRequest;
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
}
