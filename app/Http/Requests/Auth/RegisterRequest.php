<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:3',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],

            'password' => [
                'required',
                'confirmed',

                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ];
    }

    public function messages(): array
    {
        return [

            'name.required' => 'O nome é obrigatório.',
            'name.min' => 'O nome deve possuir pelo menos 3 caracteres.',

            'email.required' => 'O email é obrigatório.',
            'email.email' => 'Informe um email válido.',
            'email.unique' => 'Este email já está cadastrado.',

            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve possuir pelo menos 8 caracteres.',
            'password.confirmed' => 'As senhas não coincidem.',

            'password.mixed_case' => 'A senha deve possuir letras maiúsculas e minúsculas.',
            'password.numbers' => 'A senha deve possuir pelo menos um número.',
            'password.symbols' => 'A senha deve possuir pelo menos um caractere especial.',
        ];
    }
}
