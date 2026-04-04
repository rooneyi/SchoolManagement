<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_id' => 'required|exists:students,id',
            'guardian_id' => 'required|exists:guardians,id',
            'school_id' => 'required|exists:schools,id',
            'year_id' => 'required|exists:years,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
            'registration_date' => 'required|date',
            'status' => 'required|string|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'student_id.required' => 'L’étudiant est obligatoire.',
            'student_id.exists' => 'L’étudiant sélectionné est invalide.',
            'guardian_id.required' => 'Le parent est obligatoire.',
            'guardian_id.exists' => 'Le parent sélectionné est invalide.',
            'school_id.required' => 'L’école est obligatoire.',
            'school_id.exists' => 'L’école sélectionnée est invalide.',
            'year_id.required' => 'L’année scolaire est obligatoire.',
            'year_id.exists' => 'L’année scolaire sélectionnée est invalide.',
            'classroom_id.required' => 'La classe est obligatoire.',
            'classroom_id.exists' => 'La classe sélectionnée est invalide.',
            'section_id.required' => 'La section est obligatoire.',
            'section_id.exists' => 'La section sélectionnée est invalide.',
            'registration_date.required' => 'La date d’inscription est obligatoire.',
            'registration_date.date' => 'La date d’inscription doit être une date valide.',
            'status.required' => 'Le statut est obligatoire.',
            'status.string' => 'Le statut doit être une chaîne de caractères.',
            'status.max' => 'Le statut ne doit pas dépasser 50 caractères.',
        ];
    }
}
