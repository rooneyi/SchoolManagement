<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class YearRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'school_id' => 'required|exists:schools,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom de l’année est obligatoire.',
            'name.string' => 'Le nom de l’année doit être une chaîne de caractères.',
            'name.max' => 'Le nom de l’année ne doit pas dépasser 255 caractères.',
            'start_date.required' => 'La date de début est obligatoire.',
            'start_date.date' => 'La date de début doit être une date valide.',
            'end_date.required' => 'La date de fin est obligatoire.',
            'end_date.date' => 'La date de fin doit être une date valide.',
            'end_date.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
        ];
    }
}
