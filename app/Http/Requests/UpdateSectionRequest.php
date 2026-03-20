<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionRequest extends FormRequest
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
            'code' => ['required', 'string', 'unique:sections,code,'.$this->route('section')->id],
            'school_id' => ['required', 'exists:schools,id'],
            'education_level' => ['required', 'string', 'in:preschool,primary,secondary,university,vocational'],
        ];
    }
}
