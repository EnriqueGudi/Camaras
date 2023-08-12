<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class LoginRequest extends FormRequest
{


    //para que se detenga al primer error de valicacion poner true
    protected $stopOnFirstFailure = true;

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errors = $validator->errors()->first();
        
        $response = new JsonResponse([
            'message' => $errors,
            'type' => 'warning',
            'error' => $errors,
        ]);

        throw new ValidationException($validator, $response);

    }


}