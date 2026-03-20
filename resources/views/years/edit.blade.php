@extends('dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Modifier l'année scolaire</h1>
        <p class="text-zinc-500">Mettez à jour les informations de la période académique.</p>
    </div>

    <div class="max-w-2xl rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-800 dark:bg-zinc-950">
        <form action="{{ route('years.update', $year) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label for="school_id" class="text-sm font-medium">École</label>
                <select name="school_id" id="school_id" class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950" required>
                    <option value="">Sélectionnez une école</option>
                    @foreach($schools as $school)
                        <option value="{{ $school->id }}" {{ (old('school_id', $year->school_id) == $school->id) ? 'selected' : '' }}>
                            {{ $school->name }}
                        </option>
                    @endforeach
                </select>
                @error('school_id') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="name" class="text-sm font-medium">Nom de l'année (ex: 2023-2024)</label>
                <input type="text" name="name" id="name" value="{{ old('name', $year->name) }}" class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950" required>
                @error('name') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="start_date" class="text-sm font-medium">Date de début</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $year->start_date) }}" class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950" required>
                    @error('start_date') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="end_date" class="text-sm font-medium">Date de fin</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $year->end_date) }}" class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950" required>
                    @error('end_date') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('years.index') }}" class="inline-flex h-10 items-center justify-center rounded-md border border-zinc-200 bg-white px-4 py-2 text-sm font-medium transition-colors hover:bg-zinc-100 dark:border-zinc-800 dark:bg-zinc-950 dark:hover:bg-zinc-900">
                    Annuler
                </a>
                <button type="submit" class="inline-flex h-10 items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 transition-colors hover:bg-zinc-900/90 dark:bg-zinc-50 dark:text-zinc-900">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
