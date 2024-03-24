<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use App\Traits\ResponseTrait;


class ForgotPasswordRequest extends FormRequest
{
    use ResponseTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|exists:users,email'
        ];
    }

    /**
    * Handle a failed validation attempt.
    *
    * @param \Illuminate\Contracts\Validation\Validator $validator
    * @return void
    * @throws \Illuminate\Http\Exceptions\HttpResponseException
    */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException( $this->errorResponse( $validator->errors(), 'Validation errors', Response::HTTP_NOT_FOUND ));
    }

    /**
     *  Get the validation error messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.exists' => 'User with specified email does not exist',
        ];
    }
}
