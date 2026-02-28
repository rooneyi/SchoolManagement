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
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Le nom de la section est requis.',
            'code.required' => 'Le code de la section est requis.',
            'code.unique' => 'Ce code de section existe déjà.',
            'school_id.required' => 'L\'identifiant de l\'école est requis.',
            'school_id.exists' => 'L\'école spécifiée n\'existe pas.',
        ];
    }
}
