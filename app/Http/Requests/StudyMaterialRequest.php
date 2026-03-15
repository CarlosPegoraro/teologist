<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudyMaterialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'type' => ['required', Rule::in(['upload', 'link'])],
            'external_url' => ['nullable', 'required_if:type,link', 'url', 'max:2048'],
            'file' => [
                'nullable',
                'required_if:type,upload',
                'file',
                'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,odt,ods,odp,csv,txt,rtf,zip,rar,7z',
                'max:20480',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'file.mimes' => 'Envie um PDF, Word, Excel, PowerPoint ou outro documento compatível.',
            'file.max' => 'O arquivo deve ter no máximo 20 MB.',
        ];
    }
}
