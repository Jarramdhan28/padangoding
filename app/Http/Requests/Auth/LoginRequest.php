<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = [];
        $fails  = (new ValidationException($validator))->errors();
        foreach ($fails as $key => $error) {
            $errors[$key] = $error[0];
        }

        if (count($errors) > 0) {
            throw new HttpResponseException(
                response([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $errors,
                ], 422)
            );
        }
    }
}
