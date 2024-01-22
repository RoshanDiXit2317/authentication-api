<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\ResponseTrait;

class RegisterRequest extends FormRequest
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
            'name' => 'required|max:50',
            'email' => 'email|required|unique:users,email',
            'password' => 'required'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException( $this->errorResponse( $validator->errors(), 'Validation errors', Response::HTTP_BAD_REQUEST ) );
    }

    public function message()
    {
        return [
            'name.required' => 'Name is Required',
            'name.max' => 'Only 50 characters Allowed',
            'email.required' => 'Email is Required'
        ];
    }
}


