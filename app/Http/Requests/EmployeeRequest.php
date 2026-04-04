<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'salary' => ['nullable', 'numeric', 'min:0'],
            'hiring_date' => ['nullable', 'date'],
            'status' => ['required', 'in:active,inactive,suspended'],
            'notes' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:1024'], // 1MB Max
            'create_user' => ['nullable', 'boolean'],
            'role' => ['nullable', 'string', 'in:admin,teacher,secretary,accountant'], // rôles possibles
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }
}
