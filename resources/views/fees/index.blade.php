@extends('dashboard')

@section('content')
<div class="">
    <div class="mb-10 flex items-end justify-between">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-blue-950 dark:text-blue-400">Suivi des frais d'inscription</h1>
            <p class="text-zinc-500 font-medium">Vue d'ensemble des frais, paiements et soldes restants.</p>
        </div>
        <a href="{{ route('fees.create') }}" class="inline-flex h-11 items-center justify-center rounded-xl bg-blue-900 px-6 py-2 text-sm font-bold text-white shadow-lg shadow-blue-900/20 transition-all hover:bg-blue-800 active:scale-[0.98]">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="mr-2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            Ajouter des frais
        </a>
    </div>

    @if(session('success'))
        <div class="mb-8 flex items-center gap-3 rounded-2xl border border-green-100 bg-green-50 p-4 text-green-700 shadow-sm animate-in fade-in slide-in-from-top-4 duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <span class="text-sm font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
        <div class="p-6 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between bg-zinc-50/30 dark:bg-zinc-900/10">
            <h3 class="font-bold text-blue-950 dark:text-white uppercase tracking-wider text-xs">Liste des Frais</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                <tr class="text-zinc-500 uppercase text-[11px] font-bold tracking-widest border-b border-zinc-100 dark:border-zinc-800">
                    <th class="p-5">Inscription</th>
                    <th class="p-5">Libellé</th>
                    <th class="p-5">Montant dû</th>
                    <th class="p-5">Payé</th>
                    <th class="p-5">Statut</th>
                    <th class="p-5">Échéance</th>
                    <th class="p-5 text-right">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                @foreach($fees as $fee)
                    @php
                        $paid = (float)($fee->paid_total ?? 0);
                        $status = $fee->status;
                        $statusClasses = [
                            'paid' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
                            'partial' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300',
                            'unpaid' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
                        ];
                    @endphp
                    <tr class="group hover:bg-blue-50/30 transition-colors dark:hover:bg-blue-900/5">
                        <td class="p-5">
                            <div class="flex flex-col">
                                <span class="font-bold text-blue-950 dark:text-white">{{ $fee->registration->student->name ?? 'Inscription' }}</span>
                                <span class="text-[10px] text-zinc-400 font-medium">Inscription #{{ $fee->registration_id }}</span>
                            </div>
                        </td>
                        <td class="p-5">
                            <div class="flex flex-col">
                                <span class="font-bold text-sm text-zinc-900 dark:text-zinc-100">{{ $fee->title }}</span>
                                <span class="text-[10px] text-zinc-500 uppercase tracking-wider">{{ match($fee->type) { 'tuition' => 'Mensuel', 'registration' => 'Inscription', 'exam' => 'Examen', default => 'Autre' } }}</span>
                            </div>
                        </td>
                        <td class="p-5 font-mono text-sm font-bold text-blue-900 dark:text-blue-300">{{ number_format($fee->amount_due, 2) }} {{ $fee->currency }}</td>
                        <td class="p-5 font-mono text-sm text-zinc-700 dark:text-zinc-300">{{ number_format($paid, 2) }} {{ $fee->currency }}</td>
                        <td class="p-5">
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-[11px] font-extrabold uppercase tracking-wide {{ $statusClasses[$status] ?? 'bg-zinc-100 text-zinc-700' }}">
                                {{ match($status) { 'paid' => 'Payé', 'partial' => 'Partiel', default => 'Impayé' } }}
                            </span>
                        </td>
                        <td class="p-5 text-sm text-zinc-600 dark:text-zinc-400">{{ $fee->due_date ?
                            \Illuminate\Support\Carbon::parse($fee->due_date)->format('d/m/Y') : '—' }}</td>
                        <td class="p-5 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('fees.show', $fee) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-blue-600 hover:bg-blue-100 transition-colors dark:hover:bg-blue-900/30" title="Détails & paiements">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 20a7 7 0 0 0 7-7"/><path d="M5 5l14 14"/><path d="M19 5 5 19"/></svg>
                                </a>
                                <a href="{{ route('fees.edit', $fee) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-blue-600 hover:bg-blue-100 transition-colors dark:hover:bg-blue-900/30" title="Modifier">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                </a>
                                <form action="{{ route('fees.destroy', $fee) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ces frais ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-red-500 hover:bg-red-50 transition-colors dark:hover:bg-red-900/20" title="Supprimer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
