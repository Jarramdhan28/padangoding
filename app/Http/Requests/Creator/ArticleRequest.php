<?php

namespace App\Http\Requests\Creator;

use App\Enums\ArticleStatus;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;

class ArticleRequest extends FormRequest
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
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => ['required', new Enum(ArticleStatus::class)],
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

    public function attributes()
    {
        return [
            'category_id' => 'kategori',
            'title' => 'judul',
            'content' => 'konten',
            'description' => 'deskripsi',
        ];
    }
}
