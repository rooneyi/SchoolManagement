<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'registration_id' => ['required', 'exists:registrations,id'],
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:tuition,registration,exam,other'],
            'amount_due' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'max:8'],
            'due_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
