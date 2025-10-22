<?php

namespace App\Http\Requests\Admin\Referensi;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CategoryRequest extends FormRequest
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
        $isFile = $this->hasFile('icon');

        return [
            'name' => [
                'required',
                Rule::unique('categories', 'name')->ignore($this->category)
            ],
            'icon' => array_filter([
                'nullable',
                $isFile ? 'image' : null,
                $isFile ? 'max:2048' : null,
            ]),
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
