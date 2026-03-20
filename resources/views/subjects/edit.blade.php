@extends('dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8 flex items-start justify-between">
        <div>
            <h1 class="text-3xl font-bold tracking-tight">Modifier la matière</h1>
            <p class="text-zinc-500">Mettez à jour les informations de {{ $subject->name }}.</p>
        </div>
        <form action="{{ route('subjects.destroy', $subject) }}" method="POST" onsubmit="return confirm('Confirmer la suppression de cette matière ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="inline-flex h-10 items-center justify-center rounded-md border border-red-200 bg-red-50 px-4 py-2 text-sm font-medium text-red-600 transition-colors hover:bg-red-100 dark:border-red-900/30 dark:bg-red-900/10 dark:text-red-400">
                Supprimer
            </button>
        </form>
    </div>

    <div class="max-w-xl rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-950">
        <form action="{{ route('subjects.update', $subject) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label for="name" class="text-sm font-medium">Intitulé de la matière</label>
                <input type="text" name="name" id="name" value="{{ old('name', $subject->name) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                @error('name') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="code" class="text-sm font-medium">Code / Abréviation</label>
                    <input type="text" name="code" id="code" value="{{ old('code', $subject->code) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">
                    @error('code') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="color" class="text-sm font-medium">Code Couleur</label>
                    <div class="flex items-center gap-2">
                        <input type="color" name="color" id="color" value="{{ old('color', $subject->color) }}" class="h-9 w-9 cursor-pointer rounded-md border border-zinc-200 p-1 dark:border-zinc-800">
                        <input type="text" name="color_text" value="{{ old('color', $subject->color) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" oninput="document.getElementById('color').value = this.value">
                    </div>
                    @error('color') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4 border-t border-zinc-100">
                <a href="{{ route('subjects.index') }}" class="inline-flex h-10 items-center justify-center rounded-md border border-zinc-200 px-4 py-2 text-sm font-medium transition-colors hover:bg-zinc-100 dark:border-zinc-800 dark:hover:bg-zinc-900">Annuler</a>
                <button type="submit" class="inline-flex h-10 items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 transition-colors hover:bg-zinc-900/90 dark:bg-zinc-50 dark:text-zinc-900">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
@endsection

