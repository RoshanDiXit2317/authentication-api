<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Constants\AuthConstants;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\ForgotPasswordRequest;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
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

        $user->notify(new \App\Notifications\UserRegisteredNotification($user));

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

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return $this->successResponse( message: AuthConstants::LOGOUT );
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $response = Password::sendResetLink( $request->only('email'));

        switch($response){
            case Password::RESET_THROTTLED:
                return $this->errorResponse( message: AuthConstants::PASSWORD_RESET_LINK_TROTTLED, statusCode: 429);

            case Password::RESET_LINK_SENT:
                return $this->successResponse( message: AuthConstants::PASSWORD_RESET_LINK_SENT );

            default:
                return $this->errorResponse( message: AuthConstants::PASSWORD_RESET_LINK_FAILED);
        }

    }

    public function resetPassword(ResetPasswordRequest $request)
    { 
        // The token is obtained from the forgot password email link.
        $response = Password::reset(
            $request->only('email','token','password','password_confirmation'),
                function (User $user, string $password)
                {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ]);
                    $user->save();

                }
        );

        switch ($response) {
            case Password::INVALID_TOKEN:
                return $this->errorResponse( message: AuthConstants::PASSWORD_RESET_INVALID_TOKEN, statusCode: 400);

            case Password::PASSWORD_RESET:
                return $this->successResponse( message: AuthConstants::PASSWORD_RESET_SUCCESS);

            default:
                return $this->errorResponse( message: AuthConstants::PASSWORD_RESET_FAILED );
        }

    }
}
