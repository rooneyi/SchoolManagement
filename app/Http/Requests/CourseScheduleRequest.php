<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'classroom_id' => ['required', 'exists:classrooms,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'employee_id' => ['nullable', 'exists:employees,id'],
            'day_of_week' => ['required', 'integer', 'between:1,7'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'room' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'classroom_id.required' => 'La classe est obligatoire.',
            'subject_id.required' => 'La matière est obligatoire.',
            'day_of_week.required' => 'Le jour de la semaine est requis.',
            'start_time.required' => 'L\'heure de début est requise.',
            'end_time.required' => 'L\'heure de fin est requise.',
            'end_time.after' => 'L\'heure de fin doit être après l\'heure de début.',
        ];
    }
}

