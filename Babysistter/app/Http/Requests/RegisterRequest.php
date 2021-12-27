<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'     => 'required|string|between:2,100',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'date_of_birth' => 'before:today',
            'address' => 'required|max:255',
            'phone' => 'required|min:11|numeric',
            'type' => 'required',
        ];

    }

    public $validator = null;
    protected function failedValidation($validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(response()->json([
            'errors' => $errors
        ], 422));
    }
}
