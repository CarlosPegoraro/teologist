<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StudySubjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('name') && ! $this->filled('slug')) {
            $this->merge([
                'slug' => Str::slug($this->string('name')->value()),
            ]);
        }
    }

    public function rules(): array
    {
        $subject = $this->route('subject');
        $subjectId = $subject?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('study_subjects', 'slug')->ignore($subjectId)],
            'related_course' => ['required', 'string', 'max:255'],
            'science_field' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1500'],
        ];
    }
}
