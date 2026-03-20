@extends('dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Créer des frais</h1>
        <p class="text-zinc-500">Définissez le montant dû pour une inscription.</p>
    </div>

    <div class="max-w-2xl rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-950">
        <form action="{{ route('fees.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="space-y-2">
                <label for="registration_id" class="text-sm font-medium">Inscription</label>
                <select name="registration_id" id="registration_id" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                    <option value="">Sélectionnez une inscription</option>
                    @foreach($registrations as $registration)
                        <option value="{{ $registration->id }}" {{ old('registration_id') == $registration->id ? 'selected' : '' }}>
                            #{{ $registration->id }} — {{ $registration->student->name ?? 'Élève' }}
                        </option>
                    @endforeach
                </select>
                @error('registration_id') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="title" class="text-sm font-medium">Libellé</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Ex: Mensualité Septembre" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                    @error('title') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="type" class="text-sm font-medium">Type</label>
                    <select name="type" id="type" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                        <option value="tuition" {{ old('type') == 'tuition' ? 'selected' : '' }}>Frais de scolarité (Mensuel)</option>
                        <option value="registration" {{ old('type') == 'registration' ? 'selected' : '' }}>Frais d'inscription</option>
                        <option value="exam" {{ old('type') == 'exam' ? 'selected' : '' }}>Frais d'examen</option>
                        <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Autre</option>
                    </select>
                    @error('type') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="amount_due" class="text-sm font-medium">Montant dû</label>
                    <input type="number" step="0.01" name="amount_due" id="amount_due" value="{{ old('amount_due') }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                    @error('amount_due') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="currency" class="text-sm font-medium">Devise</label>
                    <input type="text" name="currency" id="currency" value="{{ old('currency', 'XAF') }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                    @error('currency') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label for="due_date" class="text-sm font-medium">Date d'échéance</label>
                <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">
                @error('due_date') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="notes" class="text-sm font-medium">Notes (facultatif)</label>
                <textarea name="notes" id="notes" rows="3" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">{{ old('notes') }}</textarea>
                @error('notes') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('fees.index') }}" class="inline-flex h-10 items-center justify-center rounded-md border border-zinc-200 px-4 py-2 text-sm font-medium transition-colors hover:bg-zinc-100 dark:border-zinc-800 dark:hover:bg-zinc-900">Annuler</a>
                <button type="submit" class="inline-flex h-10 items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 transition-colors hover:bg-zinc-900/90 dark:bg-zinc-50 dark:text-zinc-900">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
@endsection
