<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $rules = [
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:255',
        ];

        if ($this->isMethod('POST')) {
            $rules += [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:categories',
            ];
        } else {
            $categoryId = $this->route('category');
            $rules += [
                'name' => 'sometimes|required|string|max:255',
                'slug' => [
                    'sometimes',
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('categories')->ignore($categoryId),
                ],
            ];
        }

        return $rules;
    }
}
