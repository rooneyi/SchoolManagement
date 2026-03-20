<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeeRequest;
use App\Models\Fee;
use App\Models\Registration;
use App\Services\TelegramLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FeeWebController extends Controller
{
    public function index(): View
    {
        $fees = Fee::with(['registration.student'])
            ->withSum('payments as paid_total', 'amount')
            ->get();

        return view('fees.index', compact('fees'));
    }

    public function create(): View
    {
        $registrations = Registration::forCurrentSchool()->with(['student'])->get();

        return view('fees.create', compact('registrations'));
    }

    public function store(FeeRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['status'] = 'unpaid';

        $fee = Fee::create($data);
        (new TelegramLogger)->log('Frais créé (web): inscription #'.$fee->registration_id);

        return redirect()->route('fees.index')->with('success', 'Frais enregistré.');
    }

    public function show(Fee $fee): View
    {
        $fee->load(['registration.student', 'payments' => function ($query) {
            $query->latest();
        }]);
        $paidTotal = $fee->payments->sum('amount');

        return view('fees.show', compact('fee', 'paidTotal'));
    }

    public function edit(Fee $fee): View
    {
        $registrations = Registration::forCurrentSchool()->with(['student'])->get();

        return view('fees.edit', compact('fee', 'registrations'));
    }

    public function update(FeeRequest $request, Fee $fee): RedirectResponse
    {
        $fee->update($request->validated());
        $fee->refreshStatus();
        (new TelegramLogger)->log('Frais mis à jour (web): #'.$fee->id);

        return redirect()->route('fees.index')->with('success', 'Frais mis à jour.');
    }

    public function destroy(Fee $fee): RedirectResponse
    {
        $fee->delete();
        (new TelegramLogger)->log('Frais supprimé (web): #'.$fee->id);

        return redirect()->route('fees.index')->with('success', 'Frais supprimé.');
    }
}
