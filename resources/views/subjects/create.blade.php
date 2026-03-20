@extends('dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Ajouter une matière</h1>
        <p class="text-zinc-500">Définissez une nouvelle matière ou activité pour l'emploi du temps.</p>
    </div>

    <div class="max-w-xl rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-950">
        <form action="{{ route('subjects.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="name" class="text-sm font-medium">Intitulé de la matière</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Ex: Mathématiques, Sieste, Anglais..." class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                @error('name') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="code" class="text-sm font-medium">Code / Abréviation</label>
                    <input type="text" name="code" id="code" value="{{ old('code') }}" placeholder="Ex: MATH, ANG" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">
                    @error('code') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="color" class="text-sm font-medium">Code Couleur</label>
                    <div class="flex items-center gap-2">
                        <input type="color" name="color" id="color" value="{{ old('color', '#3b82f6') }}" class="h-9 w-9 cursor-pointer rounded-md border border-zinc-200 p-1 dark:border-zinc-800">
                        <input type="text" name="color_text" value="{{ old('color', '#3b82f6') }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" oninput="document.getElementById('color').value = this.value">
                    </div>
                    @error('color') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4 border-t border-zinc-100">
                <a href="{{ route('subjects.index') }}" class="inline-flex h-10 items-center justify-center rounded-md border border-zinc-200 px-4 py-2 text-sm font-medium transition-colors hover:bg-zinc-100 dark:border-zinc-800 dark:hover:bg-zinc-900">Annuler</a>
                <button type="submit" class="inline-flex h-10 items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 transition-colors hover:bg-zinc-900/90 dark:bg-zinc-50 dark:text-zinc-900">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
@endsection

