<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'code' => ['required', 'string', 'unique:sections,code'],
            'school_id' => ['required', 'exists:schools,id'],
            'education_level' => ['required', 'string', 'in:preschool,primary,secondary,university,vocational'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom de la section est requis.',
            'code.required' => 'Le code de la section est requis.',
            'code.unique' => 'Ce code de section existe déjà.',
            'school_id.required' => 'L\'identifiant de l\'école est requis.',
            'education_level.required' => 'Le niveau d\'éducation est requis.',
            'education_level.in' => 'Le niveau d\'éducation doit être l\'un des suivants : preschool, primary, secondary, university, vocational.',
        ];
    }
}
