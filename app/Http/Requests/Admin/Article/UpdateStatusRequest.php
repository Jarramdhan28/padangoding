<?php

namespace App\Http\Requests\Admin\Article;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UpdateStatusRequest extends FormRequest
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
            'status' => 'required|in:approved,rejected',
            'comment' => [
                Rule::requiredIf(fn () => $this->status === 'rejected'),
                'nullable',
                'string',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Status wajib diisi.',
            'status.in' => 'Status tidak valid. Hanya boleh diisi dengan approved atau rejected.',
            'comment.required' => 'Komentar wajib diisi ketika article perlu direvisi.',
            'comment.string' => 'Komentar harus berupa teks yang valid.',
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
                    'message' => 'validasi gagal',
                    'errors' => $errors,
                ], 422)
            );
        }
    }
}
