<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthorRequest extends FormRequest
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
        $rules = [
            'site' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'title' => 'nullable|string|max:255',
        ];

        if ($this->isMethod('POST')) {
            // Regras para criação (store)
            $rules += [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:authors',
            ];
        } else {
            $authorId = $this->route('author');
            $rules += [
                'name' => 'sometimes|required|string|max:255',
                'email' => [
                    'sometimes',
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('authors')->ignore($authorId),
                ],
            ];
        }

        return $rules;
    }
}
