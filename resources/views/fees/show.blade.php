@extends('dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8 flex items-start justify-between">
        <div>
            <h1 class="text-3xl font-bold tracking-tight">{{ $fee->title }}</h1>
            <div class="flex items-center gap-2 mt-2">
                <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                    {{ match($fee->type) { 'tuition' => 'Frais de scolarité', 'registration' => 'Frais d\'inscription', 'exam' => 'Frais d\'examen', default => 'Autre' } }}
                </span>
                <span class="text-zinc-500 font-medium text-sm">Inscription #{{ $fee->registration_id }} — {{ $fee->registration->student->name ?? 'Élève' }}</span>
            </div>
        </div>
        <a href="{{ route('fees.edit', $fee) }}" class="inline-flex h-10 items-center justify-center rounded-md bg-blue-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-blue-800">Modifier</a>
    </div>

    @if(session('success'))
        <div class="mb-8 flex items-center gap-3 rounded-2xl border border-green-100 bg-green-50 p-4 text-green-700 shadow-sm animate-in fade-in slide-in-from-top-4 duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <span class="text-sm font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
                <h3 class="mb-4 text-sm font-bold uppercase tracking-wider text-zinc-500">Détails</h3>
                <dl class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <dt class="text-zinc-500">Montant dû</dt>
                        <dd class="font-bold text-blue-900 dark:text-blue-300">{{ number_format($fee->amount_due, 2) }} {{ $fee->currency }}</dd>
                    </div>
                    <div>
                        <dt class="text-zinc-500">Payé</dt>
                        <dd class="font-mono text-sm text-zinc-800 dark:text-zinc-200">{{ number_format($paidTotal, 2) }} {{ $fee->currency }}</dd>
                    </div>
                    <div>
                        <dt class="text-zinc-500">Statut</dt>
                        <dd class="mt-1">
                            @php
                                $statusClasses = [
                                    'paid' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
                                    'partial' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300',
                                    'unpaid' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
                                ];
                            @endphp
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-[11px] font-extrabold uppercase tracking-wide {{ $statusClasses[$fee->status] ?? 'bg-zinc-100 text-zinc-700' }}">
                                {{ match($fee->status) { 'paid' => 'Payé', 'partial' => 'Partiel', default => 'Impayé' } }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-zinc-500">Échéance</dt>
                        <dd class="text-sm text-zinc-700 dark:text-zinc-300">{{ $fee->due_date ? \Illuminate\Support\Carbon::parse($fee->due_date)->format('d/m/Y') : '—' }}</dd>
                    </div>
                    <div class="col-span-2">
                        <dt class="text-zinc-500">Notes</dt>
                        <dd class="text-sm text-zinc-700 dark:text-zinc-300">{{ $fee->notes ?: '—' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-zinc-500">Paiements</h3>
                    <span class="text-xs text-zinc-500">{{ $fee->payments->count() }} paiement(s)</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                        <tr class="text-zinc-500 uppercase text-[11px] font-bold tracking-widest border-b border-zinc-100 dark:border-zinc-800">
                            <th class="p-3">Référence</th>
                            <th class="p-3">Méthode</th>
                            <th class="p-3">Montant</th>
                            <th class="p-3">Payé le</th>
                            <th class="p-3 text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        @forelse($fee->payments as $payment)
                            <tr class="hover:bg-blue-50/30 dark:hover:bg-blue-900/5">
                                <td class="p-3 font-mono text-xs">{{ $payment->reference }}</td>
                                <td class="p-3 font-semibold text-zinc-800 dark:text-zinc-200">{{ ucfirst($payment->payment_method) }}</td>
                                <td class="p-3 font-mono text-sm text-blue-900 dark:text-blue-300">{{ number_format($payment->amount, 2) }} {{ $fee->currency }}</td>
                                <td class="p-3 text-sm text-zinc-600 dark:text-zinc-400">{{ \Illuminate\Support\Carbon::parse($payment->paid_at)->format('d/m/Y H:i') }}</td>
                                <td class="p-3 text-right">
                                    <form action="{{ route('payments.destroy', $payment) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce paiement ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-red-500 hover:bg-red-50 transition-colors dark:hover:bg-red-900/20" title="Supprimer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-sm text-zinc-500">Aucun paiement enregistré.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
                <h3 class="mb-4 text-sm font-bold uppercase tracking-wider text-zinc-500">Ajouter un paiement</h3>
                <form action="{{ route('payments.store', $fee) }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="space-y-2">
                        <label for="payment_method" class="text-sm font-medium">Méthode</label>
                        <select name="payment_method" id="payment_method" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                            <option value="cash" {{ old('payment_method') === 'cash' ? 'selected' : '' }}>Espèces</option>
                            <option value="mobile_money" {{ old('payment_method') === 'mobile_money' ? 'selected' : '' }}>Mobile Money</option>
                            <option value="bank_transfer" {{ old('payment_method') === 'bank_transfer' ? 'selected' : '' }}>Virement</option>
                            <option value="card" {{ old('payment_method') === 'card' ? 'selected' : '' }}>Carte</option>
                        </select>
                        @error('payment_method') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="amount" class="text-sm font-medium">Montant</label>
                        <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount') }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                        @error('amount') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="paid_at" class="text-sm font-medium">Payé le</label>
                        <input type="datetime-local" name="paid_at" id="paid_at" value="{{ old('paid_at') }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">
                        @error('paid_at') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="notes" class="text-sm font-medium">Notes (facultatif)</label>
                        <textarea name="notes" id="notes" rows="3" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">{{ old('notes') }}</textarea>
                        @error('notes') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="inline-flex w-full h-10 items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 transition-colors hover:bg-zinc-900/90 dark:bg-zinc-50 dark:text-zinc-900">Enregistrer le paiement</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
