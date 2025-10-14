<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->isMethod('POST')) {
            return true;
        }

        $userToUpdate = $this->route('user');
        return $userToUpdate && $this->user()->can('update', $userToUpdate);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'birth_date' => 'nullable|date',
        ];

        if ($this->isMethod('POST')) {
            // Regras para criação (store)
            $rules += [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required', 'confirmed', Password::defaults()],
            ];
        } else {
            // Regras para atualização (update)
            $userId = $this->route('user')->id;
            $rules += [
                'name' => 'sometimes|required|string|max:255',
                'email' => [
                    'sometimes',
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($userId),
                ],
                // Permite atualizar a senha opcionalmente
                'password' => ['nullable', 'confirmed', Password::defaults()],
            ];
        }

        return $rules;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Remove a senha do request se ela estiver vazia, para não tentar atualizar com um valor nulo.
        if (empty($this->password)) {
            $this->request->remove('password');
            $this->request->remove('password_confirmation');
        }
    }
}
