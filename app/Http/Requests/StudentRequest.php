<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'matricule' => 'required|string|max:50|unique:students,matricule,'.$this->route('student'),
            'name' => 'required|string|max:255',
            'post_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:students,email,'.$this->route('student'),
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'photo' => 'nullable|string|max:255',
            'bulletin_file' => 'nullable|string|max:255',
            'school_id' => 'required|exists:schools,id',
            'guardian_id' => 'required|exists:guardians,id',
        ];
    }

    public function messages(): array
    {
        return [
            'matricule.required' => 'Le matricule est obligatoire.',
            'matricule.string' => 'Le matricule doit être une chaîne de caractères.',
            'matricule.max' => 'Le matricule ne doit pas dépasser 50 caractères.',
            'matricule.unique' => 'Ce matricule est déjà utilisé.',
            'name.required' => 'Le nom est obligatoire.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'post_name.string' => 'Le post-nom doit être une chaîne de caractères.',
            'post_name.max' => 'Le post-nom ne doit pas dépasser 255 caractères.',
            'email.email' => 'L’email doit être une adresse email valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'phone.string' => 'Le téléphone doit être une chaîne de caractères.',
            'phone.max' => 'Le téléphone ne doit pas dépasser 20 caractères.',
            'birth_date.date' => 'La date de naissance doit être une date valide.',
            'address.string' => 'L’adresse doit être une chaîne de caractères.',
            'address.max' => 'L’adresse ne doit pas dépasser 255 caractères.',
            'photo.string' => 'La photo doit être une chaîne de caractères.',
            'photo.max' => 'La photo ne doit pas dépasser 255 caractères.',
            'bulletin_file.string' => 'Le fichier bulletin doit être une chaîne de caractères.',
            'bulletin_file.max' => 'Le fichier bulletin ne doit pas dépasser 255 caractères.',
            'school_id.required' => 'L’école est obligatoire.',
            'school_id.exists' => 'L’école sélectionnée est invalide.',
            'guardian_id.required' => 'Le parent est obligatoire.',
            'guardian_id.exists' => 'Le parent sélectionné est invalide.',
        ];
    }
}
