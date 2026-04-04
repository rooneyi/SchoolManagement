<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payment_method' => ['required', 'string', 'max:50'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'paid_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
