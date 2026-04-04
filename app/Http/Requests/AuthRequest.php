<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'L\'email est obligatoire.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ];
    }
}
