<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->isMethod('POST')) {
            return $this->user() != null;
        }

        $comment = $this->route('comment');
        return $comment && $this->user()->can('update', $comment);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $ruleSet = $this->isMethod('POST') ? 'required' : 'sometimes|required';

        $rules = [
            'content' => [$ruleSet, 'string'],
        ];

        if ($this->isMethod('POST')) {
            $rules['post_id'] = 'required|exists:posts,id';
        }

        return $rules;
    }
}
