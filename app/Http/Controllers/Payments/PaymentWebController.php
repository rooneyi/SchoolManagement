<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Fee;
use App\Models\Payment;
use App\Services\TelegramLogger;
use Illuminate\Http\RedirectResponse;

class PaymentWebController extends Controller
{
    public function store(PaymentRequest $request, Fee $fee): RedirectResponse
    {
        $data = $request->validated();

        $fee->payments()->create([
            'payment_method' => $data['payment_method'],
            'amount' => $data['amount'],
            'paid_at' => $data['paid_at'] ?? now(),
            'notes' => $data['notes'] ?? null,
        ]);

        (new TelegramLogger)->log('Paiement enregistré pour le frais #'.$fee->id);

        return redirect()->route('fees.show', $fee)->with('success', 'Paiement ajouté.');
    }

    public function destroy(Payment $payment): RedirectResponse
    {
        $fee = $payment->fee;
        $payment->delete();
        $fee?->refreshStatus();
        (new TelegramLogger)->log('Paiement supprimé: #'.$payment->id);

        return redirect()->route('fees.show', $fee)->with('success', 'Paiement supprimé.');
    }
}
