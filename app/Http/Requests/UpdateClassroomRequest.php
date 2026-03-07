<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassroomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:classrooms,code,'.$this->route('classroom')->id,
            'capacity' => 'required|integer|min:1',
            'section_id' => 'required|exists:sections,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom de la classe est obligatoire.',
            'code.required' => 'Le code de la classe est obligatoire.',
            'code.unique' => 'Ce code de classe existe déjà.',
            'capacity.required' => 'La capacité de la classe est obligatoire.',
            'capacity.integer' => 'La capacité doit être un nombre entier.',
            'section_id.required' => 'La section est obligatoire.',
            'section_id.exists' => 'La section sélectionnée est invalide.',
        ];
    }
}
