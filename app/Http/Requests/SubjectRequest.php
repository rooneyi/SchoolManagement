<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:50'],
            'color' => ['required', 'string', 'max:7', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
        ];
    }
}

