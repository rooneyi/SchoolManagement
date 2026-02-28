<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:guardians,email,' . $this->route('guardian'),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'school_id' => 'required|exists:schools,id',
        ];
    }

        public function messages(): array
        {
            return [
                'first_name.required' => 'Le prénom est obligatoire.',
                'first_name.string' => 'Le prénom doit être une chaîne de caractères.',
                'first_name.max' => 'Le prénom ne doit pas dépasser 255 caractères.',
                'last_name.required' => 'Le nom est obligatoire.',
                'last_name.string' => 'Le nom doit être une chaîne de caractères.',
                'last_name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
                'email.required' => 'L’email est obligatoire.',
                'email.email' => 'L’email doit être une adresse email valide.',
                'email.unique' => 'Cet email est déjà utilisé.',
                'phone.string' => 'Le téléphone doit être une chaîne de caractères.',
                'phone.max' => 'Le téléphone ne doit pas dépasser 20 caractères.',
                'address.string' => 'L’adresse doit être une chaîne de caractères.',
                'address.max' => 'L’adresse ne doit pas dépasser 255 caractères.',
                'school_id.required' => 'L’école est obligatoire.',
                'school_id.exists' => 'L’école sélectionnée est invalide.',
            ];
        }
}
