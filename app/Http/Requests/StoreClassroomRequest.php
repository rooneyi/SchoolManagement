<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroomRequest extends FormRequest
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
            'name' => 'required',
            'code' => 'unique:classrooms,code',
            'capacity' => 'required',
            'section_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom de la classe est obligatoire.',
            'code.unique' => 'Le code doit etre unique.',
            'capacity.required' => 'la capaciter de la classe est obligatoire.',
            'section_id.required' => 'La section est obligatoire.',
            'section_id.exists' => 'Le section n\'existe pas.',
        ];
    }
}
